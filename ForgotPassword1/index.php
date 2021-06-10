<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="../Includes/formheader.css" type="text/css">
</head>


<body background="../images/homephoto.png" style="background-size: cover">

    <header>
        <h1><a href="../index.php">VisitBosnia</a></h1>
    </header>

<form action="" method="POST">
    <div class = "s1">
        <p>Help us find your account</p>
    </div>
    <hr>
    <div class ="s2">
        <p>Please enter your email address to search for your account.</p>
    </div>

    <input type="email" name="email" placeholder="E-Mail" required>

    <a href="../ForgotPassword2/index2.php" class="submit-btn">Submit</a>
</form>

</body>

</html>
