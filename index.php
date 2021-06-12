<!doctype html>
<html lang="en">
<head>
    <?php include("Includes/head.php") ?>
    <link rel="stylesheet" href="index.css">
</head>
<body background="images/homephoto.png" style="background-size: cover">

    <div id="S1" class="flex window-height">

        <header class="flex">
            <a href="LogIn/login.php"><i class="fas fa-user-alt"></i></a>
            <a href="SignIn/signin.php"><i class="fas fa-sign-in-alt"></i></a>
        </header>

        <div class="text">
            <p class="thin">Welcome to</p>
            <p class="thick">Bosnia and Herzegovina</p>
        </div>

        <div class="flex explore">
            <p class="explore-text">SEE MORE</p>
            <a href="#S2"><i class="fas fa-chevron-down"></i></a>
        </div>

    </div>

    <div id="S2" class="flex window-height">
         <div class="goal">
             <h2 class="thick">Our Goal</h2>
             <hr>
             <p class="goal-text">Our main objective is to promote tourism in Bosnia and Herzegovina. Being a country with beautiful and breathtaking places, we believe that Bosnia and Herzegovina's charm are not used to its greatest potential. In order to reduce the difficulties navigating through the country for the tourists, as well as the locals, we decided to unify all the interesting sites in one place. Click the "EXPLORE BOSNIA" button in order to choose your city!</p>
             <a href="#S3" class="explore-btn">EXPLORE BOSNIA</a>
         </div>
    </div>

    <div id="S3" class="flex window-height">
        <div class="fixed">
            <img src="images/map.png" alt="bosnia-map" class="map">
            <a href="Citypage/citypage.php"><span class="marker sarajevo">Sarajevo</span></a>
            <span class="marker bihac">Bihac</span>
            <span class="marker mostar">Mostar</span>
            <span class="marker tuzla">Tuzla</span>
            <span class="marker zenica">Zenica</span>
            <span class="marker travnik">Travnik</span>
            <span class="marker banja-luka">Banja Luka</span>
        </div>
        <div class="mobile">
            <h2 class="thick">Beautiful cities</h2>
            <hr class="line">
            <div class="flex wrapper">
                <div class="cities">
                    <a href="Citypage/citypage.php"><h4>Sarajevo</h4></a>
                    <h4>Zenica</h4>
                    <h4>Mostar</h4>
                    <h4>Tuzla</h4>
                </div>
                <div class="cities">
                    <h4>Travnik</h4>
                    <h4>Jajce</h4>
                    <h4>Trebinje</h4>
                    <h4>Bihac</h4>
                </div>
            </div>
        </div>
    </div>
</body>
</html>