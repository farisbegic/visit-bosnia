<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../index.php");
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'visitbosnia');

$objectID = $_GET['id'];
$object = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, street, phone, opening_hours, closing_hours, pricing, webpage, email, start_day, close_day, description, isVegan, isGlutenFree, isPetFriendly, isHalal, city, image FROM object WHERE oid = '{$objectID}'"));


// Get type of the object

$objectType = mysqli_fetch_assoc(mysqli_query($conn, "SELECT type FROM objecttype ot WHERE ot.object = '{$objectID}'"));

// Get country from city

$country = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Country FROM city WHERE cid = '{$object['city']}'"));

// Fetch data

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
    mysqli_query($conn, "UPDATE object SET name = '{$name}', phone = '{$phone}', street = '{$street}', opening_hours = '{$oHours}', closing_hours = '{$cHours}', pricing = '{$pricing}', webpage = '{$webpage}', email = '{$email}', start_day = '{$oDay}', close_day = '{$cDay}', description = '{$description}', isVegan = '{$isVegan}', isGlutenFree = '{$isGlutenFree}', isPetFriendly = '{$isPetFriendly}', isHalal = '{$isHalal}', city = '{$city}', image = '{$imgName}' WHERE oid = $objectID");
    header("Location: objects.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" type="text/css" href="../Includes/header.css">
    <link rel="stylesheet" type="text/css" href="../Includes/footer.css">
    <link rel="stylesheet" type="text/css" href="edit.css">
</head>
<body>

<div class="s1">
    <?php include("../Includes/header.php");?>
</div>


<h1 class="add-title">Edit Object</h1>

<form action="" method="POST" enctype="multipart/form-data">

    <div class="wrapper">
        <div class="first-part">

            <select name="type" id="type" onchange="display()" required>
                <option value="<?= $object['phone'] ?>" disabled selected>Type</option>
                <?php while ($row = mysqli_fetch_assoc($types)): ?>
                <?php if ($row['tid'] == $objectType['type']): ?>
                        <option value="<?= $row['tid'] ?>" selected><?= $row['name'] ?></option>
                <?php else: ?>
                        <option value="<?= $row['tid'] ?>"><?= $row['name'] ?></option>
                <?php endif; ?>
                <?php endwhile; ?>
            </select>

            <input type="text" name="phone" placeholder="Phone" value="<?= $object['phone'] ?>" required>

            <input type="text" name="street" placeholder="Street" required value="<?= $object['street'] ?>">

            <input type="time" name="o-hours" placeholder="Opening Hours" required value="<?= $object['opening_hours'] ?>">

            <select name="openingDay" required>
                <option value="" disabled selected>Opening Day</option>
                <option value="monday" <?php if ($object['start_day'] == 'monday') echo "selected" ?> >Monday</option>
                <option value="tuesday" <?php if ($object['start_day'] == 'tuesday') echo "selected" ?> >Tuesday</option>
                <option value="wednesday" <?php if ($object['start_day'] == 'wednesday') echo "selected" ?> >Wednesday</option>
                <option value="thursday" <?php if ($object['start_day'] == 'thursday') echo "selected" ?> >Thursday</option>
                <option value="friday" <?php if ($object['start_day'] == 'friday') echo "selected" ?> >Friday</option>
                <option value="saturday" <?php if ($object['start_day'] == 'saturday') echo "selected" ?> >Saturday</option>
                <option value="sunday" <?php if ($object['start_day'] == 'sunday') echo "selected" ?> >Sunday</option>
            </select>

            <select name="city" required>
                <option value="" disabled selected>City</option>
                <?php while ($row = mysqli_fetch_assoc($cities)): ?>
                    <option value="<?= $row['cid'] ?>"  <?php if ($row['cid'] == $object['city']) echo "selected"?> ><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>

            <select name="pricing" required>
                <option value="" disabled selected>Pricing Range</option>
                <option value="1" <?php if ($object['pricing'] == 1) echo "selected"?>>$</option>
                <option value="2" <?php if ($object['pricing'] == 2) echo "selected"?>>$$</option>
                <option value="3" <?php if ($object['pricing'] == 3) echo "selected"?>>$$$</option>
            </select>

        </div>

        <div class="second-part">
            <input type="text" name="name" placeholder="Name" value="<?= $object['name'] ?>" required>

            <input type="text" name="webpage" placeholder="Web Site" value="<?= $object['webpage'] ?>">

            <input type="email" name="email" placeholder="E-Mail" value="<?= $object['email'] ?>" required>

            <input type="time" name="c-hours" placeholder="Closing Hours" value="<?= $object['closing_hours'] ?>" required>

            <select name="closingDay" required>
                <option value="" disabled selected>Closing Day</option>
                <option value="monday" <?php if ($object['close_day'] == 'monday') echo "selected" ?> >Monday</option>
                <option value="tuesday" <?php if ($object['close_day'] == 'tuesday') echo "selected" ?> >Tuesday</option>
                <option value="wednesday" <?php if ($object['close_day'] == 'wednesday') echo "selected" ?> >Wednesday</option>
                <option value="thursday" <?php if ($object['close_day'] == 'thursday') echo "selected" ?> >Thursday</option>
                <option value="friday" <?php if ($object['close_day'] == 'friday') echo "selected" ?> >Friday</option>
                <option value="saturday" <?php if ($object['close_day'] == 'saturday') echo "selected" ?> >Saturday</option>
                <option value="sunday" <?php if ($object['close_day'] == 'sunday') echo "selected" ?> >Sunday</option>
            </select>

            <select name="country" required>
                <option value="" disabled selected>Country</option>
                <?php while ($row = mysqli_fetch_assoc($countries)): ?>
                    <option value="<?= $row['cid'] ?>" <?php if ($row['cid'] == $country['Country']) echo "selected"?> ><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
            <div class="checkbox-wrapper">
                <div class="check-box">
                    <label for="isVegan">Is Pet Friendly</label>
                    <input type="checkbox" name="isPetFriendly" <?php if ($object['isPetFriendly'] == 1) echo "checked"; ?>>
                </div>

                <div class="check-box">
                    <label for="isVegan">Is Halal</label>
                    <input type="checkbox" name="isHalal" <?php if ($object['isHalal'] == 1) echo "checked"; ?>>
                </div>

                <div class="check-box">
                    <label for="isVegan">Is Vegan</label>
                    <input type="checkbox" name="isVegan" <?php if ($object['isVegan'] == 1) echo "checked"; ?>>
                </div>

                <div class="check-box">
                    <label for="isVegan">Is Gluten Free</label>
                    <input type="checkbox" name="isGlutenFree" <?php if ($object['isGlutenFree'] == 1) echo "checked"; ?>>
                </div>
            </div>

            <input type="file" name="image" id="image" value="<?= $object['image'] ?>>">

        </div>
    </div>

    <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" ><?= $object['description'] ?></textarea>

    <button type="submit">Submit</button>
</form>

<?php include("../Includes/footer.php");?>

<script src="../script.js"></script>
</body>
</html>
