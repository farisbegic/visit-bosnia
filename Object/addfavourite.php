<?php

session_start();

require("../dbase.php");

$objectID = $_GET['object'];
$user = $_SESSION["user"];

$checkIfExists = mysqli_fetch_assoc(mysqli_query($conn,"SELECT count(*) as count FROM userfavorites uf WHERE uf.user = {$user} AND uf.object = {$objectID}"));

if ($checkIfExists['count'] != 1) {
    mysqli_query($conn, "INSERT INTO userfavorites(user, object) VALUES ('{$user}', '{$objectID}')");
}

header("Location: ../Profile/profile.php");
exit();