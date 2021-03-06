<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../index.php");
    exit();
}

require("../dbase.php");

$page = $_GET['page'] ?? 1;

// Pagination

if ($_POST){
    $input = $_POST['search'];
    $queryObjects = mysqli_query($conn, "SELECT * FROM object o WHERE o.name LIKE '%{$input}%' AND o.active = 1");
} else {
    $queryObjects = mysqli_query($conn, "SELECT * FROM object o WHERE o.active = 1");
}

$numOfObjects = mysqli_num_rows($queryObjects);
$objectsPerPage = 15;
$pages = ceil($numOfObjects / $objectsPerPage);
$offset = ($page - 1) * $objectsPerPage;

// Fetch

if ($_POST){
    $query = mysqli_query($conn,"SELECT o.oid, o.name, o.phone, o.street, o.email FROM object o WHERE o.name LIKE '%{$input}%' AND o.active = 1 LIMIT {$offset}, {$objectsPerPage} ");
} else {
    $query = mysqli_query($conn, "SELECT o.oid, o.name, o.phone, o.street, o.email FROM object o WHERE o.active = 1 LIMIT {$offset}, {$objectsPerPage}");
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="../Includes/dashboard.css">
    <link rel="stylesheet" href="../Includes/header.css" type="text/css">
    <link rel="stylesheet" href="../Includes/footer.css" type="text/css">
    <title>Objects</title>
</head>
<body>
    <div id="hdr">
        <?php include("../Includes/header.php"); ?>
    </div>

    <div class="wrapper">
        <div class="second-nav">
            <form action="" method="POST">
                <input name="search" class="search-bar" type="text" placeholder="Search objects by name..">
            </form>
            <a href="../NewObject/newobject.php" class="addObjectBtn">Add Object</a>
        </div>
        <div class="responsive-table">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Street</th>
                    <th>E-Mail</th>
                    <th colspan="2">Options</th>
                </tr>
                <!--Query to fetch all objects and display their info-->
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['street'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><a href="edit.php?id=<?= $row['oid']; ?>" class="icon"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a href="delete.php?id=<?= $row['oid']; ?>" class="icon"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <div class="pagination">
            <?php for ($i=0 ; $i<$pages ; $i++) :?>
                <a href="objects.php?page=<?= $i+1 ?>"><?= $i+1 ?></a>
            <?php endfor; ?>
        </div>
    </div>
    <?php include("../Includes/footer.php");?>
</body>
</html>