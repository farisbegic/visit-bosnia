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
    $queryObjects = mysqli_query($conn, "SELECT * FROM most_active_users WHERE GetUserName(user) LIKE '%{$input}%'");
} else {
    $queryObjects = mysqli_query($conn, "SELECT * FROM most_active_users");
}

$queryObjects = mysqli_query($conn, "SELECT * FROM most_active_users");
$numOfObjects = mysqli_num_rows($queryObjects);
$objectsPerPage = 15;
$pages = ceil($numOfObjects / $objectsPerPage);
$offset = ($page - 1) * $objectsPerPage;

// Fetch

if ($_POST){
    $query = mysqli_query($conn,"SELECT * FROM most_active_users WHERE GetUserName(user) LIKE '%{$input}%' LIMIT {$offset}, {$objectsPerPage} ");
} else {
    $query = mysqli_query($conn, "SELECT * FROM most_active_users LIMIT {$offset}, {$objectsPerPage}");
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
            <input name="search" class="search-bar" type="text" placeholder="Search user by name">
        </form>
    </div>
    <div class="responsive-table">
        <table>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Number of times favourited</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $row['user'] ?></td>
                    <td><?= $row['GetUserName(user)'] ?></td>
                    <td><?= $row['favno'] ?></td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div class="pagination">
        <?php for ($i=0 ; $i<$pages ; $i++) :?>
            <a href="mostactiveusers.php?page=<?= $i+1 ?>"><?= $i+1 ?></a>
        <?php endfor; ?>
    </div>
</div>
<?php include("../Includes/footer.php");?>
</body>
</html>