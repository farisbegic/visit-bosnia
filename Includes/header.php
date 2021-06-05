<?php

if (!isset($_SESSION)) {
    session_start();
}

$conn = mysqli_connect('localhost', 'root', '', 'visitbosnia');

$mainCategories = mysqli_query($conn, "SELECT t.tid,t.name FROM type t WHERE t.supertype IS NULL"); // Retreive main categories

?>

<header>
    <a href="../Citypage/citypage.php"><h1>VisitBosnia</h1></a>
    <nav>
        <?php while ($row = mysqli_fetch_assoc($mainCategories)): ?>
            <a class="nav-link" href="../Category/category.php?category=<?= $row['tid'] ?>"><?= $row['name'] ?></a>
        <?php endwhile; ?>
        <?php if (isset($_SESSION['auth'])): ?>
            <a class="nav-link" href="../Profile/profile.php">My Account</a>
            <a class="nav-link" href="../logout.php">Logout</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
            <a class="nav-link" href="../Dashboard/dashboard.php">Dashboard</a>
        <?php endif; ?>
    </nav>
</header>
