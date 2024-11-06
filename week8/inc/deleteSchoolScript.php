<?php
require('../reusable/connect.php');

if (isset($_GET['schoolID'])) {
    $schoolID = $_GET['schoolID'];

    $query = "DELETE FROM schools WHERE `id` = '$schoolID'";

    if (mysqli_query($connect, $query)) {
        header("Location: ../index.php?delete=success");
        exit;
    } else {
        header("Location: ../index.php?delete=failed");
        exit;
    }
} else {
    header("Location: ../index.php");
    exit;
}