<?php
    session_start();

    if(isset($_SESSION['UserName']) || isset($_SESSION['Email']) || isset($_SESSION['Password'])) {
        header("Location: /home.php");
    }
?>

<!DOCTYPE html>


<html>
    <head>
        <?php include("header.php"); ?>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/index.php"> <img id="logo-pic" alt="logo" src="/img/web_site_logo.png"> Nemanja Babić</a>
                </div>
            </nav>
        </header>   
        <div class="container-fluid mt-5 mb-5 content-page-load">
            <div class="row justify-content-center align-items-center">
                <?php
                    if(isset($_GET['error'])) {
                        if($_GET['error'] == 'incorrectCredentials') {
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <p>Incorrect Email or Username or password. Try again.</p>
                                    </div>
                                </div>';
                        }
                        else if ($_GET['error'] == 'invalidToken'){
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <p>Invalid token. Try again.</p>
                                    </div>
                                </div>';
                        }
                        else if ($_GET['error'] == 'invalidValidation'){
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <p>Invalid validation. Try again.</p>
                                    </div>
                                </div>';
                        }
                        else if ($_GET['error'] == 'invalidEmail'){
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <p>Invalid email. Try again.</p>
                                    </div>
                                </div>';
                        }
                        else if ($_GET['error'] == 'failedToGetPassword'){
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <p>Incorrect password. Check for misspelling mistakes and try again.</p>
                                    </div>
                                </div>';
                        }
                        else if ($_GET['error'] == 'failedToConnectToDataBase'){
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <p>Failed to connect. Please try again.</p>
                                    </div>
                                </div>';
                        }
                        else if ($_GET['error'] == 'failedToStoreScore'){
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <p>We failed to store highscore that you made.</p>
                                    </div>
                                </div>';
                        }
                        else if ($_GET['error'] == 'fatalError'){
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <p>Something went wrong. Please try again.</p>
                                    </div>
                                </div>';
                        }
                    }
                    if(isset($_GET['message'])) {
                        if($_GET['message'] == 'passwordUpdated') {
                            echo '
                                <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3">
                                    <div id="alert_msg" class="alert alert-success text-center" role="alert">
                                    <p>You successful reset your password.</p>
                                    </div>
                                </div>';
                        }
                    }
                ?>
                <div class="col-sm-12 col-md-8 col-lg-6">
                    <!--form login-->
                    <form id="login_form" action="/includes/db.login.php" method="POST">
                        <p class="text-center text-info display-4">Login</p>
                        <label for="email_username" class="text-info">Email or Username:</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" name="email_username" id="email_username" class="form-control" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control" autofocus required>
                            </div>
                        </div>
                        <div id="forgot_password_link" class="text-left">
                            <a href="/reset-password.php" class="text-info">Forgot password?</a>
                        </div>
                        <div class="form-group"><br>
                            <button type="submit" name="login_btn" id="login_btn" class="btn btn-info btn-md button_load">Login</button>
                            <div id="register_link" class="text-right">
                                <a href="/register.php" class="text-info">Register here</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>     
        </div>
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>
