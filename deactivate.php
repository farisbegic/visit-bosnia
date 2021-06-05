<?php

$conn = mysqli_connect('localhost', 'root', '', 'visitbosnia');

session_start();

if (!isset($_SESSION['auth'])) {
    header("Location: object.php");
    exit();
}

$userID = $_SESSION['user'];

mysqli_query($conn, "UPDATE user u SET u.active = 0 WHERE u.uid = {$userID}");

header("Location: logout.php");
exit();