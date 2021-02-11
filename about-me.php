<?php
    session_start();
?>

<!DOCTYPE html>


<html>
    <head>
        <?php include("header.php"); ?>
        <link rel="stylesheet" type="text/css" href="css/home_style.css">
        <script defer src="scripts/profile_list_script.js"></script>
        <script defer src="scripts/logout_store_score.js"></script>
        <script defer src="scripts/scroll_button_go_top.js"></script>
    </head>
    <body>
        <button id="btnGoTop" title="Go to top"><i class="fa fa-arrow-up fa-2x"></i></button>
        <header>
            <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href= <?php if(isset($_SESSION['UserName']) || isset($_SESSION['Email']) || isset($_SESSION['Password'])) { echo "home.php"; } else { echo "index.php"; } ?>> <img id="logo-pic" alt="logo" src="img/web_site_logo.png"> Nemanja Babić</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarResponsive">
                        <span id="drop-down-ico" class="navbar-toggler-icon"></span>
                    </button>
                    <div id="navBarResponsive" class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href= <?php if(isset($_SESSION['UserName']) || isset($_SESSION['Email']) || isset($_SESSION['Password'])) { echo "home.php"; } else { echo "index.php"; } ?>>Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="about-me.php">About me<span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                                if(isset($_SESSION['Membership'])) {
                                    if($_SESSION['Membership'] == "Admin") {
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="members.php">Members</a>
                                            </li>
                                        <?php
                                    }
                                }
                            ?>
                            <?php if(isset($_SESSION['UserName']) || isset($_SESSION['Email']) || isset($_SESSION['Password'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="scoreboard.php">Scoreboard</a>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php if(!isset($_SESSION['UserName']) || !isset($_SESSION['Email']) || !isset($_SESSION['Password'])) { ?>
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
                        <?php } ?>
                        <?php if(isset($_SESSION['UserName']) || isset($_SESSION['Email']) || isset($_SESSION['Password'])) { ?>
                            <div class="navbar-nav ml-auto">
                                <button class="btn btn-info btn-md" data-toggle="dropdown" role="button" id="login_btn_dropdown_list">
                                    <label>Profile</label>
                                </button>
                                <div id="dropdown-list" class="dropdown-menu dropdown-menu-right">
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
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </header>  
        <div class="row justify-content-center mt-5 mb-5 content-page-load-fadein">
            <div class="col-sm-12 col-md-10 col-lg-8 mt-5 text-center">
                <img id="profile_picture" class="rounded-circle" src="img/profile_picture.jpg" alt="profile_picture">
            </div>
            <div class="col-sm-12 col-md-10 col-lg-8 text-center">
                <h3 class="text-info">Hello I'm Nemanja Babić</h3>
                <h3 class="text-info">I'm 24 years old and final year student at <br>Electrical and Computer Engineering of Applied Studies in Belgrade <br><i>New computer technology department</i></h3>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-8 text-center">
                <h4 class="text-info">Technology used to create site</h4>
                <div class="card-deck">
                    <div class="card border-light mb-3">
                        <img class="card-img-top card-picture" src="img/HTML5.png" alt="html5">
                        <div class="card-body">
                            <h5 class="card-title">HTML5</h5>
                        </div>
                    </div>
                    <div class="card border-light mb-3">
                        <img class="card-img-top card-picture" src="img/CSS3.png" alt="css3">
                        <div class="card-body">
                            <h5 class="card-title">CSS3</h5>
                        </div>
                    </div>
                    <div class="card border-light mb-3">
                        <img class="card-img-top card-picture" src="img/JavaScript.png" alt="javascript">
                        <div class="card-body">
                            <h5 class="card-title">JavaScript</h5>
                        </div>
                    </div>
                    <div class="card border-light mb-3">
                        <img class="card-img-top card-picture" src="img/Bootstrap.png" alt="bootstrap">
                        <div class="card-body">
                            <h5 class="card-title">Bootstrap 4</h5>
                        </div>
                    </div>
                    <div class="card border-light mb-3">
                        <img class="card-img-top card-picture" src="img/PHP.png" alt="php">
                        <div class="card-body">
                            <h5 class="card-title">PHP</h5>
                        </div>
                    </div>
                    <div class="card border-light mb-3">
                        <img class="card-img-top card-picture" src="img/MySQL.png" alt="mysql">
                        <div class="card-body">
                            <h5 class="card-title">MySQL</h5>
                        </div>
                    </div>
                </div>
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
                <form action="https://submit-form.com/example" target="_self" method="POST">
                    <input type="hidden" name="_redirect" value="https://nemanjababic.infinityfreeapp.com/about-me.php?message=successful"/>
                    <input type="hidden" name="_error" value="https://nemanjababic.infinityfreeapp.com/about-me.php?error=failedToSendEmail"/>
                    <div class="form-group">
                        <label for="name" class="text-info pull-left">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-info pull-left">Your Email:</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="text-info pull-left">Subject:</label>
                        <input type="text" name="subject" id="user-subject" class="form-control" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message" class="text-info pull-left">Message:</label>
                        <textarea id="message" name="-message" cols="30" rows="6" class="form-control" placeholder="Enter your Message" required></textarea>
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

