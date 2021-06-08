<?php
    require("../dbase.php");
    $page = $_GET['page'] ?? 1;
    $searchQuery = mysqli_query($conn, "SELECT o.oid,o.name, o.street, o.start_day, o.close_day, o.opening_hours, o.closing_hours, o.phone, o.webpage, o.image FROM object o WHERE o.active = 1 LIMIT 0, 3");

    if ($_POST){
        $input = $_POST['searchInput'];

        // Pagination

        $pagesQuery = mysqli_query($conn, "SELECT count(*) as numOfPages FROM object o WHERE o.name LIKE '%{$input}%' AND o.active = 1");
        $objects = mysqli_fetch_assoc($pagesQuery);
        $totalObjects = $objects['numOfPages'];
        $objectsPerPage = 3;
        $pages = ceil($totalObjects/$objectsPerPage);
        $offset = ($page - 1) * $objectsPerPage;

        $searchQuery = mysqli_query($conn, "SELECT o.oid,o.name, o.street, o.start_day, o.close_day, o.opening_hours, o.closing_hours, o.phone, o.webpage, o.image FROM object o WHERE o.name LIKE '%{$input}%' AND o.active = 1");
    }

?>
<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="../Includes/header.css">
    <link rel="stylesheet" href="../Includes/footer.css">
    <link rel="stylesheet" href="citypage.css">
</head>
<body>

    <div id="S1">
        <?php include("../Includes/header.php"); ?>

        <div class="text">
            <h1 class="city">Sarajevo</h1>
            <h4 class="desc">The capital of Bosnia and Herzegovina</h4>

            <form action="" method="POST">
                <input type="text" placeholder="Search for places via name.." name="searchInput" class="search-box" value="<?= $_POST['searchInput'] ?? "" ?>">
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>

    </div>
    <div id="S2">
        <?php if($_POST):?>
            <h1 class="recommend">Searches on <?= $input ?></h1>
        <?php else: ?>
            <h1 class="recommend">We Recommend</h1>
        <?php endif; ?>

        <div class="content">

            <?php while ($row = mysqli_fetch_assoc($searchQuery)): ?>

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
    </div>

    <?php include("../Includes/footer.php"); ?>

</body>
</html>