<?php
    $host = '127.0.0.1';
    $user = 'root';
    $password = 'root';
    $db = 'schools';
    $port = 8889;

    $connect = mysqli_connect($host, $user, $password, $db, $port);

    if (!$connect) {
        echo 'Error Code: ' . mysqli_connect_errno();
        echo '<br>Error Message: ' . mysqli_connect_error();
        exit();
    } else {
        echo "<div>Connection to the database Successful<br></div>";
    }
