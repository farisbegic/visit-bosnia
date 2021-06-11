<?php

session_start();

if (isset($_SESSION['auth'])) {
    header("Location: ../Citypage/citypage.php");
    exit();
}

require("../dbase.php");

$cities = mysqli_query($conn, "SELECT c.cid, c.name FROM city c"); // Fetch all cities

$countries = mysqli_query($conn, "SELECT c.cid,c.name FROM country c"); // Fetch all countries

if ($_POST) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $imgName = null;

    if (isset($_FILES['image']) && $_FILES['image']) {
        $imgName = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/UserImages/" . $imgName);
    }

    // Check if email or username exits
    $checkQuery = mysqli_query($conn, "SELECT * FROM user u WHERE u.email = '{$email}' OR u.username = '{$username}'");
    if (mysqli_num_rows($checkQuery) >= 1){
        $_SESSION['exists'] = "User with same email/username exits";
        header("Location: signin.php");
        exit();
    }

    // Check if user exits

    $userQuery = mysqli_query($conn, "SELECT uid FROM user WHERE name = '{$name}' AND surname = '{$surname}' AND email = '{$email}' AND phone = '{$phone}' AND dob = '{$dob}' AND gender = '{$gender}' AND username = '{$username}' AND password = sha1('{$password}') AND city = '{$city}'");
    if (mysqli_num_rows($userQuery) == 1){
        $user = mysqli_fetch_assoc($userQuery);
        mysqli_query($conn,"UPDATE user SET active = 1 WHERE uid = '{$user['uid']}'");
    } else{
        $insert = mysqli_query($conn, "INSERT INTO user(name, surname, email, phone, dob, gender, username, password, city, image) VALUES ('{$name}', '{$surname}', '{$email}', '{$phone}', '{$dob}', '{$gender}', '{$username}', sha1('{$password}'), '{$city}', '{$imgName}')");
    }

    header("Location: ../LogIn/login.php");
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="signin.css" type="text/css">
    <link rel="stylesheet" href="../FormHeader/formheader.css" type="text/css">
</head>
<body background="../images/homephoto.png" style="background-size: cover">

    <header>
        <h1><a href="../index.php">VisitBosnia</a></h1>
    </header>

    <main>
        <h3>Create an account</h3>
        <?php if(isset($_SESSION['exists'])): ?>
        <p class="existing"><?= $_SESSION['exists']; unset($_SESSION['exists']); ?></p>
        <?php endif; ?>
        <form action="" method = "POST" enctype="multipart/form-data">
            <div id = "mainDiv">
                <div class = "part">
                    <input type="text" name="name" placeholder="First Name" required>
                    <input type="text" name="surname" placeholder="Surname" required>
                    <select name="country" required>
                        <option value="" disabled selected>Country</option>
                        <?php while ($row = mysqli_fetch_assoc($countries)): ?>
                            <option value="<?= $row['cid'] ?>"><?= $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <select name="city" required>
                        <option value="" disabled selected>City</option>
                        <?php while ($row = mysqli_fetch_assoc($cities)): ?>
                            <option value="<?= $row['cid'] ?>"><?= $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <input type="text" name="email" placeholder="E-Mail" required>
                    <select name="gender" id="gender"">
                    <option value="" disabled selected>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="Other">Other</option>
                    </select>
                </div>

                <div class = "part">
                    <input type="text" name="phone" placeholder="Phone Number">
                    <input id = "dt" type="date" name="dob" placeholder="Date of birth" value="Date of birth"required>
                    <input type="username" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password" placeholder="Confirm Password" required>
                    <input type="file" name="image">
                </div>
            </div>
            <button type="submit">Sign in</button>

        </form>
    </main>

</body>
</html>