<?php

require("../dbase.php");
$categoryID = $_GET['category'] ;
$page = $_GET['page'] ?? 1;
$pricing = $_GET['pricing'] ?? null;
$vegan = $_GET['vegan'] ?? 0;
$glutenFree = $_GET['vegan'] ?? 0;
$petFriendly = $_GET['vegan'] ?? 0;
$halal = $_GET['vegan'] ?? 0;

$pageLink = "category.php?category= " . $categoryID;

// Pagination

$objects = mysqli_fetch_assoc(mysqli_query($conn, "SELECT DISTINCT count(*) as numOfPages FROM objecttype ot, object o, type t WHERE o.active = 1 AND (t.supertype = {$categoryID} OR t.tid = {$categoryID}) AND t.tid = ot.type AND ot.object = o.oid"));

if ($_POST) {
    $input = $_POST['inputSearch'];
    $objects = mysqli_fetch_assoc(mysqli_query($conn,"SELECT count(*) as numOfPages FROM objecttype ot, object o, type t WHERE o.active = 1 AND ot.type = {$categoryID} AND ot.object = o.oid AND o.name LIKE '%{$input}%'"));
}

if (isset($_GET['pricing'])) {
    $objects = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as numOfPages FROM objecttype ot, object o, type t WHERE o.active = 1 AND ot.type= {$categoryID} AND ot.object = o.oid AND o.pricing = {$pricing}"));
}

$objectsPerPage = 6;
$pages = ceil($objects['numOfPages']/$objectsPerPage);
$offset = ($page - 1) * $objectsPerPage;

// Displaying information

$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM type t WHERE t.tid = '$categoryID'")); // Fetch category from types
$subtypeQuery = mysqli_query($conn, "SELECT t.tid, t.name FROM type t WHERE t.supertype = '$categoryID'");

// Query for displaying objects depending on the type/category

$objectQuery = mysqli_query($conn, "SELECT DISTINCT o.oid,o.name, o.street, o.start_day, o.close_day, o.opening_hours, o.closing_hours, o.phone, o.webpage, o.image FROM objecttype ot, object o, type t WHERE o.active = 1 AND (t.supertype = {$categoryID} OR t.tid = {$categoryID}) AND t.tid = ot.type AND ot.object = o.oid LIMIT {$offset} , {$objectsPerPage}");

// Search bar

if ($_POST) {
    $input = $_POST['inputSearch'];
    $objectQuery = mysqli_query($conn,"SELECT o.oid,o.name, o.street, o.start_day, o.close_day, o.opening_hours, o.closing_hours, o.phone, o.webpage, o.image FROM objecttype ot, object o, type t WHERE o.active = 1 AND (t.supertype = {$categoryID} OR t.tid = {$categoryID}) AND t.tid = ot.type AND ot.object = o.oid AND o.name LIKE '%{$input}%' LIMIT {$offset} , {$objectsPerPage}");
}

// Pricing

if (isset($_GET['pricing'])) {
    $objectQuery = mysqli_query($conn, "SELECT o.oid,o.name, o.street, o.start_day, o.close_day, o.opening_hours, o.closing_hours, o.phone, o.webpage, o.image FROM objecttype ot, object o, type t WHERE o.active = 1 AND (t.supertype ={$categoryID} OR t.tid = {$categoryID}) AND t.tid = ot.type AND ot.object = o.oid AND o.pricing = {$pricing} LIMIT {$offset} , {$objectsPerPage}");
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Includes/header.css">
    <link rel="stylesheet" type="text/css" href="../Includes/footer.css">
    <link rel="stylesheet" type="text/css" href="category.css">
    <link rel="stylesheet" href="../Includes/box.css">

</head>
<body>


<div class="cover" style="background-image: url('../images/<?= $category['name'] ?>.jpg'">
    <div class="overlay"></div>
    <?php include("../Includes//header.php");?>
    <div class="cat-type">
        <h1 class="h1"><?= $category['name'] ?></h1>
        <hr class="line1">
    </div>
</div>


<div class="mid">
<form class="search" action="" method="post">
    <input type="text" class="search-box" placeholder="Search <?= $category['name'] ?> via name.." name="inputSearch" value="<?= $_POST['inputSearch'] ?? "" ?>">
    <button type="submit">Search</button>
</form>
<?php if ($category['name'] === "Catering"): ?>

    <div class="filter">
        <div class="subtype">

            <h2>Subtype</h2>
            <dl class="edit">
                <?php while ($row = mysqli_fetch_assoc($subtypeQuery)): ?>
                    <a class="subtype-text" href="category.php?category=<?= $row['tid']; ?>"> <dt><?= $row['name']; ?></dt> </a>
                <?php endwhile; ?>
            </dl>

        </div>
        <hr class="line">

        <div class="pricing">

            <h2>Pricing</h2>
            <dl class="edit">
                <a class="subtype-text" href="category.php?category=<?= $categoryID ?>&pricing=1"> <dt>$</dt> </a>
                <a class="subtype-text" href="category.php?category=<?= $categoryID ?>&pricing=2"> <dt>$$</dt> </a>
                <a class="subtype-text" href="category.php?category=<?= $categoryID ?>&pricing=3"> <dt>$$$</dt> </a>
            </dl>

        </div>

    </div>

<?php endif; ?>

    <div class="content">
        <?php while ($row = mysqli_fetch_assoc($objectQuery)): ?>
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
                </div>
            </div>
        <?php endwhile; ?>

    </div>

    <div class="pagination">
        <?php for ($i=0 ; $i<$pages ; $i++) :?>
            <?php if ($pricing): ?>
                <a href="category.php?category=<?= $categoryID ?>&page=<?= $i+1 ?>&pricing=<?= $pricing ?>"><?= $i+1 ?></a>
            <?php else: ?>
                <a href="category.php?category=<?= $categoryID ?>&page=<?= $i+1 ?>" ><?= $i+1 ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

</div>

<div class="last">
<?php include("../Includes/footer.php");?>
</div>
</body>
</html>
