<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../index.php");
    exit();
}

require("../dbase.php");

// Get City ID

$cityID = $_GET['id'];

mysqli_query($conn, "DELETE FROM city WHERE cid = '{$cityID}'");

header("Location: cities.php");
exit();