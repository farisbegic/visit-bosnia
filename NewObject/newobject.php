<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../index.php");
    exit();
}

require("../dbase.php");

$types = mysqli_query($conn, "SELECT t.tid, t.name FROM type t"); // Fetch all category types

$cities = mysqli_query($conn, "SELECT c.cid, c.name FROM city c"); // Fetch all cities

$countries = mysqli_query($conn, "SELECT c.cid,c.name FROM country c"); // Fetch all countries

if ($_POST){

    //if (!isset($name) && !isset($phone) && !isset($street) && !isset($oHours) && !isset($cHours) && !isset($oDay) && !isset($cDay) && !isset($city) && !isset($email) && !isset($pricing) && !isset($description)){
    //    die("You need to set required attributes");
    //}

    $type = $_POST['type'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $street = $_POST['street'];
    $oHours = $_POST['o-hours'];
    $cHours = $_POST['c-hours'];
    $pricing = $_POST['pricing'];
    $webpage = $_POST['webpage'];
    $email = $_POST['email'];
    $oDay = $_POST['openingDay'];
    $cDay = $_POST['closingDay'];
    $description = nl2br($_POST['description']);
    $isVegan = isset($_POST['isVegan'][0]) ? 1 : 0;
    $isGlutenFree = isset($_POST['isGlutenFree'][0]) ? 1 : 0;
    $isPetFriendly = isset($_POST['isPetFriendly'][0]) ? 1 : 0;
    $isHalal = isset($_POST['isHalal'][0]) ? 1 : 0;
    $city = $_POST['city'];
    $imgName = '';

    if (isset($_FILES['image']) && $_FILES['image']){
        $imgName = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/ObjectImages/" . $imgName);
    }

    // Insert Object

    $insertObjectQuery = "INSERT INTO object (name, street, phone, opening_hours, closing_hours, pricing, webpage, email, start_day, close_day, description, isVegan, isGlutenFree, isPetFriendly, isHalal, city, image) VALUES ('$name', '$street', '$phone', '$oHours', '$cHours', '$pricing', '$webpage', '$email', '$oDay', '$cDay', '{$description}', '$isVegan', '$isGlutenFree', '$isPetFriendly', '$isHalal', '$city', '$imgName')";

    mysqli_query($conn, $insertObjectQuery);

    // Take inserted objects ID

    $objectID = mysqli_insert_id($conn);

    // Insert M-M

    for ($i=0 ; $i<count($type) ; $i++){
        $insertObjectTypeQuery = "INSERT INTO objecttype(type , object) VALUES ('{$type[$i]}', '{$objectID}')";
        mysqli_query($conn, $insertObjectTypeQuery);
    }

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
    <link rel="stylesheet" type="text/css" href="newobject.css">
</head>
<body>

<div class="s1">
<?php include("../Includes/header.php");?>
</div>


<h1 class="add-title">Add Your Object</h1>

<form action="" method="POST" enctype="multipart/form-data">

    <div class="wrapper">
        <div class="first-part">

            <select name="type[]" id="type" onchange="display()" required multiple>
                <?php while ($row = mysqli_fetch_assoc($types)): ?>
                    <option value="<?= $row['tid'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>

            <input type="text" name="phone" placeholder="Phone" required>

            <input type="text" name="street" placeholder="Street" required>

            <input type="time" name="o-hours" placeholder="Opening Hours" required>

            <select name="openingDay" required>
                <option value="" disabled selected>Opening Day</option>
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
            </select>

            <select name="city" required>
                <option value="" disabled selected>City</option>
                <?php while ($row = mysqli_fetch_assoc($cities)): ?>
                    <option value="<?= $row['cid'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>

            <select name="pricing" required>
                <option value="" disabled selected>Pricing Range</option>
                <option value="1">$</option>
                <option value="2">$$</option>
                <option value="3">$$$</option>
            </select>

        </div>

        <div class="second-part">
            <input type="text" name="name" placeholder="Name" required>

            <input type="text" name="webpage" placeholder="Web Site">

            <input type="email" name="email" placeholder="E-Mail" required>

            <input type="time" name="c-hours" placeholder="Closing Hours" required>

            <select name="closingDay" required>
                <option value="" disabled selected>Closing Day</option>
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
            </select>

            <select name="country" required>
                <option value="" disabled selected>Country</option>
                <?php while ($row = mysqli_fetch_assoc($countries)): ?>
                    <option value="<?= $row['cid'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>

            <div class="checkbox-wrapper">
                <div class="check-box">
                    <label for="isVegan">Is Pet Friendly</label>
                    <input type="checkbox" name="isPetFriendly">
                </div>

                <div class="check-box">
                    <label for="isVegan">Is Halal</label>
                    <input type="checkbox" name="isHalal">
                </div>

                <div class="check-box">
                    <label for="isVegan">Is Vegan</label>
                    <input type="checkbox" name="isVegan">
                </div>

                <div class="check-box">
                    <label for="isVegan">Is Gluten Free</label>
                    <input type="checkbox" name="isGlutenFree">
                </div>
            </div>

            <input type="file" name="image" id="image" required>

        </div>
    </div>

    <textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>

    <button type="submit">Submit</button>
</form>

    <?php include("../Includes/footer.php");?>

<script src="../script.js"></script>
</body>
</html>
