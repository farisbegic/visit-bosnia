<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../object.php");
    exit();
}

require("../dbase.php");

$oID = $_GET['id'];

mysqli_query($conn, "UPDATE object SET isactive = 0 WHERE oid = '{$oID}'");

header("Location: objects.php");
exit();
