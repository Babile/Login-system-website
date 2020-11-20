<?php
    session_start();

    if(!isset($_SESSION['UserName']) || !isset($_SESSION['Email']) || !isset($_SESSION['Password'])) {
        header("Location: /index.php");
    }
?>

<!DOCTYPE html>


<html>
    <head>
        <?php include("header.php"); ?>
        <script defer src="/scripts/endless_runner_game.js"></script>
        <script defer src="/scripts/profile_list_script.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/home_style.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/home.php"> <img id="logo-pic" alt="logo" src="/img/web_site_logo.png"> Nemanja Babić</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarResponsive">
                        <span class="navbar-toggler-icon style="color:#fff;"></span>
                    </button>
                    <div id="navBarResponsive" class="collapse navbar-collapse">
                        <div class="navbar-nav ml-auto">
                            <button class="btn btn-info btn-md" data-toggle="dropdown" role="button" id="login_btn_dropdown_list">
                                <label>Profile</label>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!--Profile-->
                                <ul class="list-group list-group-flush">
                                     <li class="list-group-item d-flex justify-content-between align-items-center">
                                         <label>Name:</label>
                                         <span class="badge badge-primary badge-pill"><?php echo $_SESSION['Name']; ?></span>
                                     </li>
                                     <li class="list-group-item d-flex justify-content-between align-items-center">
                                         <label>Surname:</label>
                                         <span class="badge badge-primary badge-pill"><?php echo $_SESSION['Surname']; ?></span>
                                     </li>
                                     <li class="list-group-item d-flex justify-content-between align-items-center">
                                         <label>Username:</label>
                                         <span class="badge badge-primary badge-pill"><?php echo $_SESSION['UserName']; ?></span>
                                     </li>
                                     <li class="list-group-item d-flex justify-content-between align-items-center">
                                         <label>Email:</label>
                                         <span class="badge badge-primary badge-pill"><?php echo $_SESSION['Email']; ?></span>
                                     </li>
                                     <button id="logout_btn" class="btn btn-info btn-md" onclick="location.href='/includes/site.logout.php'">Logout</button>
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>  
        <div class="row justify-content-center mt-xl-5 mt-lg-5 mt-md-5 mt-5">
            <div class="col-sm-12 col-md-10 col-lg-8">
                <h2 class="d-flex justify-content-center text-info">Hello <?php echo $_SESSION['Name']; ?>, let's play a game :)</h2>
            </div>
            <div id="gameScene" class="col-sm-12 col-md-10 col-lg-8">
                <canvas id="game"></canvas>
            </div>
        </div>  
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>

