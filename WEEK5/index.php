<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> 
    table {
        width: 100%;
        margin: 10px 0;
        border-collapse: collapse;
    }
    th , td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }
</style>
</head>
<body>
    <?php
        $connect = mysqli_connect(
            'localhost',
            'root',
            'root',
            'HTTP5225_PHP' 
        );


        if (!$connect){
            echo 'Error Code: ' . mysqli_connect_errno ();
            echo 'Error Message: ' . mysqli_connect_error();
            exit;
        }
        // else {
        //     echo 'Connection Succesful';
        // }

        $query =  'SELECT `Name`, `Hex` FROM colors ';
        $results = mysqli_query ($connect, $query);

        if(!$results){
            echo 'Error Message: ' . mysqli_errno($connect);
        }else{
            echo 'The query found the following numbers of result: ' . mysqli_num_rows($results);
            echo '<table>';
            echo '<tr><th>Color Name</th></tr>';

            while ($row = mysqli_fetch_assoc($results)) {
                echo '<tr>';
                echo '<td style="background-color: ' . htmlspecialchars($row['Hex']) . ';">'. htmlspecialchars($row['Name']) . '</td>';
            }
    
            echo '</table>';
        }
    
        mysqli_close($connect);
        ?>
    </body>
    </html>
    