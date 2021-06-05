<!doctype html>
<html lang="en">
<head>
    <?php include("../Includes/head.php") ?>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="../FormHeader/formheader.css" type="text/css">
</head>


<body background="../images/homephoto.png" style="background-size: cover">

    <?php
        include("../FormHeader/formheader.php");
    ?>

<form action="" method="POST">
    <div class = "s1">
        <p>Help us find your account</p>
    </div>
    <hr>
    <div class ="s2">
        <p>Please enter your email address to search for your account.</p>
    </div>

    <input type="email" name="email" placeholder="E-Mail" required>

    <button type="submit">Log in</button>
</form>

</body>

</html>
