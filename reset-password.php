<?php
    session_start();

    if(isset($_SESSION['UserName']) || isset($_SESSION['Email']) || isset($_SESSION['Password'])) {
        header("Location: home.php");
    }

    else if(isset($_GET['message'])) {
        if($_GET['message'] == 'passwordResetSuccessful') {
            header("Refresh: 3; url=index.php");
        }
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
                    <a class="navbar-brand" href="index.php"> <img id="logo-pic" alt="logo" src="img/web_site_logo.png"> Nemanja Babić</a>
                </div>
            </nav>
        </header>
        <div class="container-fluid mt-5 mb-5 content-page-load">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-12 col-md-8 col-lg-6 mb-5">
                    <!--form password reset-->
                    <form id="password_recovery_form" action="includes/site.reset-password-request.php" method="POST">
                        <p class="text-center text-info display-4">Reset your password</p>
                        <div class="form-group">
                            <label for="email" class="text-info">Enter your Email:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control" autofocus required>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="password_recovery_btn" id="password_recovery_btn" class="btn btn-info btn-md">Send request</button>
                        </div>
                        <?php 
                            if(isset($_GET['message'])) {
                                if($_GET['message'] == 'passwordRequestSuccessful') {
                                    echo '
                                        <div class="form-group text-center">
                                            <div id="alert_msg" class="alert alert-success text-center" role="alert">
                                                <p>Request was sent. Check your email.<br>We are redirecting you to login page.</p>
                                            </div>
                                        </div>';
                                }
                            }
                            else if(isset($_GET['error'])) {
                                if($_GET['error'] == 'serverError') {
                                    echo '
                                        <div class="form-group text-center">
                                            <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                                <p>Error occur on Database while processing informacion. Please try again later.</p>
                                            </div>
                                        </div>';
                                }
                                else if($_GET['error'] == 'emailIsNotValid') {
                                    echo '
                                        <div class="form-group text-center">
                                            <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                                <p>invalid email address. Please check for misspelling mistakes and fill field again.</p>
                                            </div>
                                        </div>';
                                }
                                else if($_GET['error'] == 'errorSendingEmail') {
                                    echo '
                                        <div class="form-group text-center">
                                            <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                                <p>Error occur while sending email. Try again later.</p>
                                            </div>
                                        </div>';
                                }
                                else if($_GET['error'] == 'fatalError') {
                                    echo '
                                        <div class="form-group text-center">
                                            <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                                <p>Something went wrong. Please try again later.</p>
                                            </div>
                                        </div>';
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>     
        </div>
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>

