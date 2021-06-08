<?php

session_start();

require("../dbase.php");
if (isset($_SESSION["auth"])) { // Retrieving user id
    $user = $_SESSION["user"];
} else{
    $user = -1;
}

$objectID = $_GET['object'];
$objectRating = $_GET['rating'] ?? null;

// Query for setting object rating

if ($objectRating) {
    $checkIfRatedQuery = mysqli_query($conn, "SELECT * FROM userratings ur WHERE ur.user = {$user} AND ur.object = {$objectID}");
    if (mysqli_num_rows($checkIfRatedQuery) == 1){
        $rating = mysqli_fetch_assoc($checkIfRatedQuery);
        mysqli_query($conn, "UPDATE userratings SET rating = '{$objectRating}' WHERE uid = '{$rating['uid']}'");
    }
    if (mysqli_num_rows($checkIfRatedQuery) != 1){
        mysqli_query($conn, "INSERT INTO userratings(user, object, rating) VALUES ('{$user}', '{$objectID}', '{$objectRating}')");
    }
    $_SESSION['rating'] = "Thank you for your rating";
}

// Fetch an object with given ID

$objectQuery = mysqli_query($conn, "SELECT o.name, o.street, o.start_day, o.close_day, o.opening_hours, o.closing_hours, o.phone, o.webpage, o.description, o.image, o.averagerating FROM object o WHERE o.oid = '$objectID' AND active = 1");

$object = mysqli_fetch_assoc($objectQuery);

?>

<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="object.css">
    <link rel="stylesheet" href="../Includes/header.css">
    <link rel="stylesheet" href="../Includes/footer.css">
</head>
<body onload="rating()">
    <div id="S1" style="background-image: url('../images/ObjectImages/<?php if ($object['image']) echo $object['image']; else echo "default.jpg"; ?>')">
        <div class="overlay"></div>
        <?php include("../Includes/header.php");?>

        <div class="object-wrap">
            <h1 class="object-title"><?= $object['name'] ?></h1>
            <hr class="divider">
            <div class="object-info">
                <div class="object-subwrap">
                    <div class="one-info">
                        <i class="fas fa-map-marked-alt info-icon"></i>
                        <span class="info-line"><?= $object['street'] ?></span>
                    </div>
                    <div class="one-info">
                        <i class="far fa-clock info-icon"></i>
                        <span class="info-line"><?= strtoupper($object['start_day'][0]) . substr($object['start_day'],1,2) ?>-<?= strtoupper($object['close_day'][0]) . substr($object['close_day'],1,2) ?>: <?= substr($object['opening_hours'], 0,5) ?> - <?= substr($object['closing_hours'], 0,5) ?></span>
                    </div>
                    <div class="one-info">
                        <i class="fas fa-phone-alt info-icon"></i>
                        <span class="info-line"><?= $object['phone'] ?></span>
                    </div>
                    <div class="one-info">
                        <i class="fas fa-pager info-icon"></i>
                        <span class="info-line"><?= $object['webpage'] ?></span>
                    </div>
                    <?php if (isset($_SESSION['auth'])): ?>
                        <div class="one-info">
                            <i class="far fa-heart info-icon"></i>
                            <a class="rating" href="addfavourite.php?object=<?= $objectID ?>"><span class="info-line">Add To Favourites</span></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="object-rating">
                    <input type="hidden" value="<?= $object['averagerating'] ?>" id="avg">
                    <i class="far fa-star info-icon"></i>
                    <i class="far fa-star info-icon"></i>
                    <i class="far fa-star info-icon"></i>
                    <i class="far fa-star info-icon"></i>
                    <i class="far fa-star info-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div id="S2">
        <div class="boxing">
            <h3 class="about-title">About</h3>
            <img class="about-img" src="../images/objectLocation.png" alt="Map">
            <h3 class="about-title">Description</h3>
            <p class="about-desc"><?= $object['description'] ?></p>
        </div>

        <div class="boxing">
            <h3 class="about-title">Pictures</h3>
        </div>

        <div class="boxing">
            <h3 class="about-title">Rating</h3>
            <p class="about-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, atque aut beatae commodi culpa ea fuga inventore laboriosam.</p>
            <?php if(isset($_SESSION['rating'])):  ?>
            <p class="about-desc"><?= $_SESSION['rating'] ?></p>
            <?php unset($_SESSION['rating']); endif; ?>
            <div class="rate-box">
                <a href="object.php?object=<?= $objectID ?>&rating=1" class="rate">Poor</a>
                <a href="object.php?object=<?= $objectID ?>&rating=2" class="rate">Weak</a>
                <a href="object.php?object=<?= $objectID ?>&rating=3" class="rate">Good</a>
                <a href="object.php?object=<?= $objectID ?>&rating=4" class="rate">Very</a>
                <a href="object.php?object=<?= $objectID ?>&rating=5" class="rate">Excellent</a>
            </div>
        </div>
    </div>

    <?php include("../Includes/footer.php");?>
    <script src="../script.js"></script>
</body>
</html>