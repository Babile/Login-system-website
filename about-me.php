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
        <link rel="stylesheet" type="text/css" href="/css/home_style.css">
        <script defer src="/scripts/profile_list_script.js"></script>
        <script defer src="/scripts/logout_store_score.js"></script>
        <script defer src="/scripts/score_saver.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/home.php"> <img id="logo-pic" alt="logo" src="/img/web_site_logo.png" onclick="saveScore()"> Nemanja Babić</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarResponsive">
                        <span id="drop-down-ico" class="navbar-toggler-icon"></span>
                    </button>
                    <div id="navBarResponsive" class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/home.php" onclick="saveScore()">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/about-me.php" onclick="saveScore()">About me<span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                                if(isset($_SESSION['Membership'])) {
                                    if($_SESSION['Membership'] == "Admin") {
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/members.php" onclick="saveScore()">Members</a>
                                            </li>
                                        <?php
                                    }
                                }
                            ?>
                        </ul>
                        <div class="navbar-nav ml-auto">
                            <button class="btn btn-info btn-md" data-toggle="dropdown" role="button" id="login_btn_dropdown_list">
                                <label>Profile</label>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!--Profile-->
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <label>Membership:</label>
                                        <span class="badge badge-primary badge-pill"><?php echo $_SESSION['Membership']; ?></span>
                                    </li>
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
                                     <button id="logout_btn" class="btn btn-info btn-md" onclick="logout()">Logout</button>
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>  
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-sm-12 col-md-10 col-lg-8 mt-5 text-center">
                <img id="profile_picture" class="rounded-circle" src="/img/profile_picture.jpg" alt="profile_picture">
            </div>
            <div class="col-sm-12 col-md-10 col-lg-8 text-center">
                <h3 class="text-info">Hello I'm Nemanja Babić</h3>
                <h3 class="text-info">I'm 24 years old and final year student at <br>Electrical and Computer Engineering of Applied Studies in Belgrade <i>New computer technology department</i></h3>
            </div>
            <?php
                if(isset($_GET['message'])) {
                    if($_GET['message'] == 'successful') {
                        echo '
                            <div class="col-sm-12 col-md-8 col-lg-6 text-center">
                                <div id="alert_msg" class="alert alert-success text-center" role="alert">
                                    <p>Message was successfully sent.</p>
                                </div>
                            </div>
                            <div class="w-100"></div>';
                    }
                }
                else if(isset($_GET['error'])) {
                    if($_GET['error'] == 'failedToSendEmail') {
                        echo '
                            <div class="col-sm-12 col-md-8 col-lg-6 text-center">
                                <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                    <p>Failed to send message. Try again.</p>
                                </div>
                            </div>
                            <div class="w-100"></div>';
                    }
                }
            ?>
            <div class="col-sm-12 col-md-10 col-lg-8 mb-5 text-center">
                <h3 class="text-info">Contact me</h3>
                <form action="https://submit-form.com/your-form-id" target="_self" method="POST">
                    <input type="hidden" name="_redirect" value="https://nemanjababic.000webhostapp.com/about-me.php?message=successful"/>
                    <input type="hidden" name="_error" value="https://nemanjababic.000webhostapp.com/about-me.php?error=failedToSendEmail"/>
                    <div class="form-group">
                        <label for="name" class="text-info pull-left">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-info pull-left">Your Email:</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="subject" class="text-info pull-left">Subject:</label>
                        <input type="text" name="subject" id="user-subject" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <label for="message" class="text-info pull-left">Message:</label>
                        <textarea id="message" name="-message" cols="30" rows="6" class="form-control" placeholder="Enter your Message"></textarea>
                    </div>
                    <button type="submit" name="sent_msg" class="btn btn-info btn-md"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send</button>
                </form>
            </div>
        </div>  
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>

