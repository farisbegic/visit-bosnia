<?php
    session_start();

    if (!isset($_SESSION['auth'])) {
        header("Location: ../index.php");
        exit();
    }

    require("../dbase.php");

    $userID = $_SESSION['user'];

    $userResults = mysqli_query($conn,"SELECT u.image,u.email, u.password, u.name, u.surname FROM user u WHERE u.uid = '$userID'");

    $user = mysqli_fetch_assoc($userResults);

    $imgName = $user['image'];

    if ($_POST){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        if (isset($_FILES['image']) && $_FILES['image']['name']){
            $imgName = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "../images/UserImages/" . $imgName);
        }


        $checkEmail = mysqli_query($conn, "SELECT * FROM user u WHERE u.email = '$email'");// Check for email duplicates

        if (mysqli_num_rows($checkEmail) === 1) {
            $updateCredentials = mysqli_query($conn, "UPDATE user SET email='$email', password='$password', name='$name', surname='$surname', image='$imgName' WHERE uid={$userID}");
        } else {
            die("User with the same email already exists");
        }

        header("Location: ../Profile/profile.php");
        exit();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="accSettings.css">
    <link rel="stylesheet" href="../Includes/header.css" type="text/css">
    <link rel="stylesheet" href="../Includes/footer.css" type="text/css">
</head>
<body>

    <div class="hdr">
         <?php include("../Includes/header.php");?>
    </div>

    <main>
        <h1>Change your settings</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name" value="<?= $user['name'] ?? "" ?>">
            <input type="text" name="surname" placeholder="Surname" value="<?= $user['surname'] ?? "" ?>">
            <input type="text" name="email" placeholder="E-mail" value="<?= $user['email'] ?? "" ?>">
            <input id="password" type="password" name="password" placeholder="Password" value="<?= $user['password'] ?? "" ?>">
            <input type="file" name="image" value="../images/ <?= $user['image'] ?>">
            <button type="submit">Save Changes</button>
        </form>
        <a class="deactivate-btn" href="../deactivate.php">Deactivate account</a>
    </main>

    <?php include("../Includes/footer.php");?>
</body>
</html>