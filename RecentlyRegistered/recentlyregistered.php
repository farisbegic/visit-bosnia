<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("Location: ../index.php");
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'visitbosnia');
$query = null;
if ($_POST){
    $lower_limit = $_POST['startdate'];
    $upper_limit = $_POST['enddate'];

    // Fetch users registered in this time interval

    $query = mysqli_query($conn, "SELECT * FROM active_users WHERE startdate > '{$lower_limit}' AND startdate < '{$upper_limit}'");

}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="../Includes/dashboard.css">
    <link rel="stylesheet" href="recentlyregistered.css">
    <link rel="stylesheet" href="../Includes/header.css" type="text/css">
    <link rel="stylesheet" href="../Includes/footer.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <div id="hdr">
        <?php include("../Includes/header.php"); ?>
    </div>
    <p class="info-text">Please insert the following details</p>
    <form action="" method="POST" class="input-labels">
        <div class="date">
            <label for=startdate"">Start Date</label>
            <input type="date" id="startdate" name="startdate" value="<?= $lower_limit ?>" required>
        </div>
        <div class="date">
            <label for="enddate">End Date</label>
            <input type="date" id="enddate" name="enddate" value="<?= $upper_limit ?>" required>
        </div>
        <button type="submit">Search</button>
    </form>
    <?php if ($query): ?>
        <div class="responsive-table">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Username</th>
                    <th>E-Mail</th>
                    <th>Date Created</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['surname'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['startdate'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    <?php endif; ?>
    <?php include("../Includes/footer.php");?>

</body>
</html>