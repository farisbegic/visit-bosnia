<?php

$conn = mysqli_connect('localhost', 'root', '', 'visitbosnia');

$ufID = $_GET['id'];
mysqli_query($conn, "DELETE FROM userfavorites WHERE fid = '{$ufID}'");

header("Location: profile.php");