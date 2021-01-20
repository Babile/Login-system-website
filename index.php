<?php
    session_start();

    if(isset($_SESSION['UserName']) || isset($_SESSION['Email']) || isset($_SESSION['Password'])) {
        header("Location: home.php");
    }
?>

<!DOCTYPE html>


<html>
    <head>
        <?php include("header.php"); ?>
        <link rel="stylesheet" type="text/css" href="css/home_style.css">
        <script defer src="scripts/endless_runner_game.js"></script>
        <script defer src="scripts/score_saver.js"></script>
    </head>
    <body>
    <header>
            <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php"> <img id="logo-pic" alt="logo" src="img/web_site_logo.png"> Nemanja Babić</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarResponsive">
                        <span id="drop-down-ico" class="navbar-toggler-icon"></span>
                    </button>
                    <div id="navBarResponsive" class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about-me.php">About me</a>
                            </li>
                        </ul>
                        <div class="navbar-nav ml-auto">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="sign-in.php">Sign in</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="register.php">Sign up</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header> 
        <div class="container content-page-load">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <h2 class="d-flex justify-content-center text-info">Hello 
                    <?php 
                        if(isset($_SESSION['Name'])){
                            echo $_SESSION['Name'];
                        } 
                        else {
                            echo "Guest";
                        }
                    ?>, let's play a game :)</h2>
                </div>
                <div id="gameScene" class="col-sm-12 col-md-10 col-lg-8">
                    <canvas id="game"></canvas>
                </div>
            </div> 
        </div>
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>