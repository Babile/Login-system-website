<?php
    session_start();

    $selector = $_GET['selector'];
    $validator = $_GET['validator'];

    if(isset($_SESSION['UserName']) || isset($_SESSION['Email']) || isset($_SESSION['Password'])) {
        header("Location: /home.php");
    }

    else if(empty($selector) || empty($validator)) {
        header("Location: /index.php?error=invalidValidation");
        exit();
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
        <div class="container-fluid mt-5 content-page-load">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-12 col-md-8 col-lg-6">
                   <?php
                        $selector = $_GET['selector'];
                        $validator = $_GET['validator'];

                        if(ctype_xdigit($selector) === true && ctype_xdigit($validator) === true) {
                            ?>
                            <!--form new password create-->
                            <form id="reset_password_form" action="/includes/site.reset-password.php" method="POST">
                                <p class="text-center text-info display-4">Enter your new password</p>
                                <input type="hidden" name="selector" id="selector" value="<?php echo $selector ?>">
                                <input type="hidden" name="validator" id="validator" value="<?php echo $validator ?>">
                                <div class="form-group text-left">
                                    <label for="password" class="text-info">Password:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Type your new password" autofocus  autofocus required>
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <label for="password_retype" class="text-info">Retype password:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="password" name="password_retype" id="password_retype" class="form-control" placeholder="Retype password" autofocus  autofocus required>
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <button type="submit" name="reset_password_btn" id="reset_password_btn" class="btn btn-info btn-md">Reset password</button>
                                </div>
                            </form>
                    <?php
                        }
                    ?>
                </div>
            </div>     
        </div>
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>

