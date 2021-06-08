<?php

    session_start();

    if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
        header("Location: ../object.php");
        exit();
    }

    require("../dbase.php");

    // Fetch number of objects
    $objects = mysqli_query($conn, "SELECT * FROM object o WHERE o.active = 1");
    $numOfObjects = mysqli_num_rows($objects);

    // Fetch number of cities
    $cities = mysqli_query($conn, "SELECT * FROM city");
    $numOfCities = mysqli_num_rows($cities);

    // Fetch number of registered users
    $users = mysqli_query($conn, "SELECT * FROM user u WHERE u.active = 1");
    $numOfUsers = mysqli_num_rows($users);

    // Fetch number of favourited objects

    $favouritedObjects = mysqli_query($conn, "SELECT * FROM fav_objects");
    $numOfFavourited = mysqli_num_rows($favouritedObjects);

    // Fetch number of most active users

    $activeUsers = mysqli_query($conn, "SELECT * FROM most_active_users");
    $numOfActive = mysqli_num_rows($activeUsers);

?>
<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="../Includes/header.css" type="text/css">
    <link rel="stylesheet" href="../Includes/footer.css" type="text/css">
    <title>Dashboard</title>
</head>
<body>
    <?php include("../Includes/header.php"); ?>

    <div class="wrapper">

        <div class="boxing">
            <div class="text-info">
                <p class="number"><?= $numOfObjects ?></p>
                <p class="type">Objects</p>
            </div>
            <a class="view-button" href="../Objects/objects.php">View Objects</a>
        </div>

        <div class="boxing">
            <div class="text-info">
                <p class="number"><?= $numOfCities ?></p>
                <p class="type">Cities</p>
            </div>
            <a class="view-button" href="../Cities/cities.php">View Cities</a>
        </div>

        <div class="boxing">
            <div class="text-info">
                <p class="number"><?= $numOfUsers ?></p>
                <p class="type">Users</p>
            </div>
            <a class="view-button" href="../Users/users.php">View Users</a>
        </div>

        <div class="boxing">
            <div class="text-info">
                <p class="number"><?= $numOfFavourited ?></p>
                <p class="type">Favourited Objects</p>
            </div>
            <a class="view-button" href="../FavouritedObjects/favouritedobjects.php">Favourited</a>
        </div>

        <div class="boxing">
            <div class="text-info">
                <p class="number"><?= $numOfActive ?></p>
                <p class="type">Active Users</p>
            </div>
            <a class="view-button" href="../MostActiveUsers/mostactiveusers.php">Active Users</a>
        </div>
    </div>

    <?php include("../Includes/footer.php"); ?>
</body>
</html>