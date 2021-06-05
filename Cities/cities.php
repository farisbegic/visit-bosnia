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
    $queryObjects = mysqli_query($conn, "SELECT * FROM city WHERE name LIKE '%{$input}%' AND o.isactive = 1");
} else {
    $queryObjects = mysqli_query($conn, "SELECT * FROM city");
}

$queryObjects = mysqli_query($conn, "SELECT * FROM city");
$numOfObjects = mysqli_num_rows($queryObjects);
$objectsPerPage = 15;
$pages = ceil($numOfObjects / $objectsPerPage);
$offset = ($page - 1) * $objectsPerPage;

// Fetch

if ($_POST){
    $query = mysqli_query($conn,"SELECT cid, name, Country FROM city WHERE name LIKE '%{$input}%' LIMIT {$offset}, {$objectsPerPage} ");
} else {
    $query = mysqli_query($conn, "SELECT cid, name, Country FROM city LIMIT {$offset}, {$objectsPerPage}");
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="cities.css">
    <link rel="stylesheet" href="../Includes/header.css" type="text/css">
    <link rel="stylesheet" href="../Includes/footer.css" type="text/css">
    <title>Objects</title>
</head>
<body>
<?php include("../Includes/header.php");?>

<div class="wrapper">
    <div class="second-nav">
        <form action="" method="POST">
            <input name="search" class="search-bar" type="text" placeholder="Search city by name..">
        </form>
        <a href="../NewCity/newcity.php" class="addObjectBtn">Add City</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>City</th>
            <th colspan="2">Options</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $row['cid'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><a href="edit.php?id=<?= $row['cid'] ?>" class="icon"><i class="fas fa-pencil-alt"></i></a></td>
                <td><a href="delete.php?id=<?= $row['cid'] ?>" class="icon"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <div class="pagination">
        <?php for ($i=0 ; $i<$pages ; $i++) :?>
            <a href="cities.php?page=<?= $i+1 ?>"><?= $i+1 ?></a>
        <?php endfor; ?>
    </div>
</div>
<?php include("../Includes/footer.php");?>
</body>
</html>