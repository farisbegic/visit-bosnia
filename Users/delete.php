<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../object.php");
    exit();
}

require("../dbase.php");
$userID = $_GET['id'];

mysqli_query($conn, "UPDATE user SET active = 0 WHERE uid = '{$userID}'");
header("Location: users.php");
exit();