<?php

session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: ../index.php");
    exit();
}

require("../dbase.php");
$page = $_GET['page'] ?? 1;
$userID = $_SESSION['user'];

// Pagination

$pagesQuery = mysqli_query($conn, "SELECT count(*) as numOfPages FROM userfavorites uf, object o WHERE uf.user = {$userID} AND uf.object = o.oid");
$objects = mysqli_fetch_assoc($pagesQuery);
$totalObjects = $objects['numOfPages'];
$objectsPerPage = 3;
$pages = ceil($totalObjects/$objectsPerPage);
$offset = ($page - 1) * $objectsPerPage;

// Fetch user data

$userResults = mysqli_query($conn,"SELECT u.name, u.surname, u.image FROM user u WHERE u.uid = '{$userID}'");
$user = mysqli_fetch_assoc($userResults);

// Fetch user favourites

$userFavorites = mysqli_query($conn, "SELECT uf.fid, o.oid,o.name, o.street, o.start_day, o.close_day, o.opening_hours, o.closing_hours, o.phone, o.webpage, o.image FROM userfavorites uf, object o WHERE uf.user = {$userID} AND uf.object = o.oid LIMIT {$offset}, {$objectsPerPage}");
$noOfFavorites = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as totalNumber FROM userfavorites uf, object o WHERE uf.user = {$userID} AND uf.object = o.oid"));
?>

<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Includes/header.css">
    <link rel="stylesheet" type="text/css" href="../Includes/footer.css">
    <link rel="stylesheet" type="text/css" href="profile.css">
    <link rel="stylesheet" href="../Includes/box.css">
</head>
<body>

    <div id="hdr">
        <?php include("../Includes/header.php"); ?>
    </div>

    <main>
        <div id="user">
            <?php if ($user['image'] == null): ?>
                <img src="../images/UserImages/default.png" alt="User Picture">
            <?php else: ?>
                <img src="../images/UserImages/<?= $user['image'] ?>" alt="User Picture">
            <?php endif; ?>
            <div id="info">
                <div>
                    <h1><?= $user['name'] . ' ' . $user['surname'] ?></h1>
                    <i class="far fa-heart heart"></i>
                    <span><?= $noOfFavorites['totalNumber'] ?> favorite <?php if ($noOfFavorites['totalNumber'] == 1): ?> place <?php else: ?> places <?php endif; ?></span>
                </div>
                <div id="settings">
                    <a href="../AccountSettings/accountSettings.php" target="_self"><i class="fas fa-cog"></i></a>
                </div>
            </div>
        </div>

        <div class="content">

            <?php while ($row = mysqli_fetch_assoc($userFavorites)): ?>
                <div class="box" onClick="location.href='../Object/object.php?object=<?= $row['oid']; ?>'" style="cursor:pointer;">
                    <img class="object-image" src="../images/ObjectImages/<?php if ($row['image']) echo $row['image']; else echo "default.jpg"; ?>" alt="Picture">
                    <div class="info">
                        <h1 class="title"><?= $row['name'] ?></h1>
                        <div class="one-info">
                            <i class="fas fa-map-marked-alt"></i>
                            <span class="info-line"><?= $row['street'] ?></span>
                        </div>
                        <div class="one-info">
                            <i class="far fa-clock"></i>
                            <span class="info-line"><?= strtoupper($row['start_day'][0]) . substr($row['start_day'],1,2) ?>-<?= strtoupper($row['close_day'][0]) . substr($row['close_day'],1,2) ?>: <?= substr($row['opening_hours'], 0,5) ?> - <?= substr($row['closing_hours'], 0,5) ?></span>
                        </div>
                        <div class="one-info">
                            <i class="fas fa-phone-alt"></i>
                            <span class="info-line"><?= $row['phone'] ?></span>
                        </div>
                        <div class="one-info">
                            <i class="fas fa-pager"></i>
                            <span class="info-line"><?= $row['webpage'] ?></span>
                        </div>
                        <div class="one-info">
                            <i class="far fa-trash-alt deleteObjectBtn"></i>
                            <a href="RemoveFavourite.php?id=<?= $row['fid'] ?>" class="deleteObjectBtn">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>

        <div class="pagination">
            <?php for ($i=0 ; $i<$pages ; $i++) :?>
                <a href="profile.php?page=<?= $i+1 ?>"><?= $i+1 ?></a>
            <?php endfor; ?>
        </div>
    </main>

    <?php include("../Includes/footer.php"); ?>
</body>
</html>