<?php

if (!isset($_SESSION)) {
    session_start();
}

$conn = mysqli_connect('localhost', 'root', '', 'visitbosnia');

$mainCategories = mysqli_query($conn, "SELECT t.tid,t.name FROM type t WHERE t.supertype IS NULL"); // Retreive main categories

?>

<nav class="navbar navbar-expand-lg navbar-dark">
   <div class="container">
       <a class="navbar-brand" href="../Citypage/citypage.php">VisitBosnia</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">
               <?php while ($row = mysqli_fetch_assoc($mainCategories)): ?>
                   <li class="nav-item"><a class="nav-link" href="../Category/category.php?category=<?= $row['tid'] ?>"><?= $row['name'] ?></a></li>
               <?php endwhile; ?>
               <?php if (isset($_SESSION['auth'])): ?>
                   <li class="nav-item"><a class="nav-link" href="../Profile/profile.php">My Account</a></li>
                   <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
               <?php endif; ?>
               <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                   <li class="nav-item"><a class="nav-link" href="../Dashboard/dashboard.php">Dashboard</a></li>
               <?php endif; ?>
           </ul>
       </div>
   </div>
</nav>
