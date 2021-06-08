<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../object.php");
    exit();
}

require("../dbase.php");

$page = $_GET['page'] ?? 1;

// Pagination

if ($_POST){
    $input = $_POST['search'];
    $queryObjects = mysqli_query($conn, "SELECT * FROM fav_objects WHERE object LIKE '%{$input}%'");
} else {
    $queryObjects = mysqli_query($conn, "SELECT * FROM fav_objects");
}

$queryObjects = mysqli_query($conn, "SELECT * FROM fav_objects");
$numOfObjects = mysqli_num_rows($queryObjects);
$objectsPerPage = 15;
$pages = ceil($numOfObjects / $objectsPerPage);
$offset = ($page - 1) * $objectsPerPage;

// Fetch

if ($_POST){
    $query = mysqli_query($conn,"SELECT * FROM fav_objects WHERE object LIKE '%{$input}%' LIMIT {$offset}, {$objectsPerPage} ");
} else {
    $query = mysqli_query($conn, "SELECT * FROM fav_objects LIMIT {$offset}, {$objectsPerPage}");
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="favouritedobjects.css">
    <link rel="stylesheet" href="../Includes/header.css" type="text/css">
    <link rel="stylesheet" href="../Includes/footer.css" type="text/css">
    <title>Objects</title>
</head>
<body>
<?php include("../Includes/header.php");?>

<div class="wrapper">
    <div class="second-nav">
        <form action="" method="POST">
            <input name="search" class="search-bar" type="text" placeholder="Search object by a name..">
        </form>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Object</th>
            <th>Number of times favourited</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $row['objectid'] ?></td>
                <td><?= $row['object'] ?></td>
                <td><?= $row['favnum'] ?></td>

            </tr>
        <?php endwhile; ?>
    </table>
    <div class="pagination">
        <?php for ($i=0 ; $i<$pages ; $i++) :?>
            <a href="favouritedobjects.php?page=<?= $i+1 ?>"><?= $i+1 ?></a>
        <?php endfor; ?>
    </div>
</div>
<?php include("../Includes/footer.php");?>
</body>
</html>