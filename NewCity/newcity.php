<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../object.php");
    exit();
}

require("../dbase.php");

$countries = mysqli_query($conn, "SELECT c.cid,c.name FROM country c"); // Fetch all countries

if ($_POST){
    $city = $_POST['city'];
    $countryID = $_POST['country'];

    mysqli_query($conn, "INSERT INTO city(name, Country) VALUES ('{$city}', '{$countryID}')");
    header("Location: ../Dashboard/dashboard.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" type="text/css" href="../Includes/header.css">
    <link rel="stylesheet" type="text/css" href="../Includes/footer.css">
    <link rel="stylesheet" type="text/css" href="newcity.css">
</head>
<body>

<div class="s1">
    <?php include("../Includes/header.php");?>
</div>


<h1 class="add-title">Add Your City</h1>

<form action="" method="POST" enctype="multipart/form-data">

    <input type="text" name="city" placeholder="City" required>

    <select name="country" required>
        <option value="" disabled selected>Country</option>
        <?php while ($row = mysqli_fetch_assoc($countries)): ?>
            <option value="<?= $row['cid'] ?>"><?= $row['name'] ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Submit</button>
</form>

<?php include("../Includes/footer.php");?>

<script src="../script.js"></script>
</body>
</html>
