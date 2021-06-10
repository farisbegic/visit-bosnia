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
    $queryObjects = mysqli_query($conn, "SELECT * FROM user WHERE name LIKE '%{$input}%' AND active = 1");
} else {
    $queryObjects = mysqli_query($conn, "SELECT * FROM user WHERE active = 1");
}

$queryObjects = mysqli_query($conn, "SELECT * FROM user WHERE active = 1");
$numOfObjects = mysqli_num_rows($queryObjects);
$objectsPerPage = 15;
$pages = ceil($numOfObjects / $objectsPerPage);
$offset = ($page - 1) * $objectsPerPage;

// Fetch

if ($_POST){
    $usersResult = mysqli_query($conn,"SELECT uid, name, surname, dob, email, phone, username FROM user WHERE name LIKE '%{$input}%' LIMIT {$offset}, {$objectsPerPage} ");
} else {
    $usersResult = mysqli_query($conn, "SELECT uid, name, surname, dob, email, phone, username FROM user WHERE active = 1 LIMIT {$offset}, {$objectsPerPage}");
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
    <style>
        .search-bar{
            width: 100%;
        }
    </style>
</head>
<body>
<div id="hdr">
    <?php include("../Includes/header.php"); ?>
</div>

<div class="wrapper">
    <div class="second-nav">
        <form action="" method="POST">
            <input name="search" class="search-bar" type="text" placeholder="Search user by name..">
        </form>
    </div>
    <div class="responsive-table">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>E-Mail</th>
                <th>Phone</th>
                <th>Date Of Birth</th>
                <th>Username</th>
                <th colspan="2">Options</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($usersResult)): ?>
                <tr>
                    <td><?= $row['uid'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['surname'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= date('F j, Y',strtotime($row['dob'])); ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><a href="delete.php?id=<?= $row['uid'] ?>" class="icon"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div class="pagination">
        <?php for ($i=0 ; $i<$pages ; $i++) :?>
            <a href="users.php?page=<?= $i+1 ?>"><?= $i+1 ?></a>
        <?php endfor; ?>
    </div>
</div>
<?php include("../Includes/footer.php");?>
</body>
</html>