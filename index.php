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
             <p class="goal-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda autem beatae commodi, corporis, distinctio doloremque eligendi explicabo iste iusto praesentium quod ratione soluta tempore voluptates voluptatum. Deleniti ea ipsam odit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda autem doloremque, doloribus eligendi eveniet, facere fuga fugiat fugit iste iure necessitatibus nesciunt odit optio quidem quo rerum, sed? Deserunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aliquid dicta dolorem ducimus enim id in laborum libero, maxime nihil officia quaerat quasi quis, quo tempore, ut vel veniam voluptatibus.</p>
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
                    <h4>Sarajevo</h4>
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