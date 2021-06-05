<?php

session_start();

if (isset($_SESSION['auth'])) {
    header("Location: ../Citypage/citypage.php");
    exit();
}

if ($_POST){

    require("../dbase.php");

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!isset($email) || !isset($password)){
        die("You need to set username/password");
    }

    $checkCredentials = mysqli_query($conn,"SELECT u.uid, u.email, u.password, u.isadmin, u.active FROM user u WHERE email = '{$email}' AND password= '{$password}'");
    $result = mysqli_fetch_assoc($checkCredentials);

    if (mysqli_num_rows($checkCredentials) == 1 && $result['active']) {
        $_SESSION['auth'] = true;
        $_SESSION['user'] = $result['uid'];
        $_SESSION['admin'] = $result['isadmin'];
        header("Location: ../Citypage/citypage.php");
        exit();
    } else{
        header("Location: login.php");
        $_SESSION['incorrect'] = 'Incorrect username/password';
        exit();
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../FormHeader/formheader.css">
</head>
<body background="../images/homephoto.png" style="background-size: cover">

    <header>
        <h1><a href="../index.php">VisitBosnia</a></h1>
    </header>

    <form action="" method="POST">
        <div id = "flex">
            <p>Login</p>
            <a href = "../SignIn/signin.php">Create Account</a>
        </div>

        <input type="email" name="email" placeholder="E-Mail" required>
        <input type="password" name="password" placeholder="Password" required>

        <div class="flex">
            <a href = "../ForgotPassword1/index.php">Forgot password?</a>
            <span class="forgot-password">
                <?php if(isset($_SESSION['incorrect'])) {
                    echo $_SESSION['incorrect'];
                    unset($_SESSION['incorrect']);
                }?></span>
        </div>

        <button type="submit">Log in</button>
    </form>

</body>
</html>