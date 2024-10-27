<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trail List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/slate/bootstrap.min.css" crossorigin="anonymous">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        #map {
            height: 400px; /* Set height for the map */
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <?php require('reusable/nav.php'); ?>
            </div>
        </div>
    </div>

    <!-- Search Box -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-2">Trails</h1>
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search for trail by name" aria-label="Search for trail">
                    <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Container within a Bootstrap Card -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Trail Map</h5>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="trailList">
            <?php 
            require('reusable/connect.php');
            $query = 'SELECT * FROM ontarioTrail';
            $trails = mysqli_query($connect, $query);
            
            foreach($trails as $trail) {
                echo '<div class="card col-md-4 trail-card mb-2" data-name="' . strtolower($trail['TRAIL_NAME']) . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $trail['TRAIL_NAME'] . '</h5>
                        <p class="card-text">Length: ' . $trail['TRAIL_LENGTH_KM'] . ' KM</p>
                        <span class="badge bg-secondary">Accuracy: ' . $trail['LOCATION_ACCURACY'] . '</span><br><br>';
                
                // Handle permitted uses for activity icons
                $permittedUses = explode(',', $trail['PERMITTED_USES']);
                foreach ($permittedUses as $use) {
                    $use = trim($use);
                    if ($use == 'Hiking or Walking') {
                        echo '<i class="fas fa-hiking" title="Hiking"></i> ';
                    } elseif ($use == 'Cycling') {
                        echo '<i class="fas fa-bicycle" title="Cycling"></i> ';
                    } elseif ($use == 'Cross Country Skiing') {
                        echo '<i class="fas fa-skiing-nordic" title="Cross Country Skiing"></i> ';
                    } elseif ($use == 'Snowshoeing') {
                        echo '<i class="fas fa-snowflake" title="Snowshoeing"></i> ';
                    } elseif ($use == 'Equestrian') {
                        echo '<i class="fas fa-horse" title="Equestrian"></i> ';
                   
                    } elseif ($use == 'Snowmobiling') {
                        echo '<i class="fas fa-snowmobile" title="Snowmobiling"></i> ';
                    } elseif ($use == 'All-Terrain Vehicles (ATV)') {
                        echo '<i class="fas fa-motorcycle" title="All-Terrain Vehicles (ATV)"></i> ';
                    }
                }

                echo '<br><br>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <form method="GET" action="updateTrail.php">
                                    <input type="hidden" name="id" value="' . $trail['OGF_ID'] . '">
                                    <button class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </div>
                            <div class="col">
                                <form method="GET" action="INC/deleteScript.php">
                                    <input type="hidden" name="id" value="' . $trail['OGF_ID'] . '">
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Map Initialization -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Initialize the map
        var map = L.map('map').setView([43.7, -79.4], 8); // Default center coordinates

        // Add a tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        // Fetch GeoJSON data and add to the map
        fetch('https://ws.lioservices.lrc.gov.on.ca/arcgis2/rest/services/LIO_OPEN_DATA/LIO_Open04/MapServer/19/query?outFields=*&where=1%3D1&f=geojson')
            .then(response => response.json())
            .then(geojsonData => {
                L.geoJSON(geojsonData, {
                    onEachFeature: function (feature, layer) {
                        layer.bindPopup(feature.properties.name); // Display trail name on click
                    }
                }).addTo(map);
            })
            .catch(error => console.error('Error fetching GeoJSON:', error));

        // Search functionality
        document.getElementById('searchButton').addEventListener('click', function() {
            var searchTerm = document.getElementById('searchInput').value.toLowerCase();
            var trailCards = document.querySelectorAll('.trail-card');

            trailCards.forEach(function(card) {
                var trailName = card.getAttribute('data-name');
                if (trailName.includes(searchTerm)) {
                    card.style.display = 'block'; // Show matching trails
                } else {
                    card.style.display = 'none'; // Hide non-matching trails
                }
            });
        });
    </script>
</body>
</html>
