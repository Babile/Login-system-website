<?php 
    if(isset($_GET['message'])) {
        if($_GET['message'] == 'registrationSuccessful') {
            header("Refresh: 2; url=/index.php");
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
                  <a class="navbar-brand" href="/index.php"> <img id="logo-pic" alt="logo" src="/img/web_site_logo.png"> Nemanja Babić</a>
                </div> 
            </nav>
        </header>
        <div class="container-fluid content-page-load">
          <div class="row justify-content-center mt-5 mb-5">
                <?php 
                    if(isset($_GET['error'])) {
                        if($_GET['error'] == 'registrationFailed') {
                            echo '
                                <div class="col-sm-12 col-md-8 col-lg-6 mt-3">
                                    <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                        <h5> <i class="fa fa-lightbulb-o fa-lg"></i> Tips </h5>
                                        <p>Check for misspelling mistakes and retype fields again. <br> Check your password if you typed two times right. Maybe Email or Username already exists or Username have less than 5 characters.</p>
                                    </div>
                                </div>
                                <div class="w-100"></div>';
                        }
                    } 
                    else if(isset($_GET['message'])) {
                        if($_GET['message'] == 'registrationSuccessful') {
                            echo '
                                <div class="col-sm-12 col-md-8 col-lg-6 mt-3">
                                    <div id="alert_msg" class="alert alert-success text-center" role="alert">
                                        <p>You were successfully registered. In 2 seconds you will be redirected to login page.</p>
                                    </div>
                                </div>
                                <div class="w-100"></div>';
                        }
                    } 
                ?>
                <div class="col-sm-12 col-md-8 col-lg-6 mb-5">
                    <!--form register-->
                    <form id="register_form" action="/includes/db.register.php" method="POST">
                        <p class="text-center text-info display-4">Register</p>
                        <div class="form-group">
                            <label for="name" class="text-info">Name:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Example: John" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="surname" class="text-info">Surname:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" name="surname" id="surname" class="form-control" placeholder="Example: Doe" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" name="username" id="username" class="form-control" aria-describedby="usernameHelp" placeholder="Example: JohnD1" pattern=".{5,}" required title="Username mast have more than 5 characters." autofocus required>
                            </div>
                            <small id="usernameHelp" class="form-text text-muted">Username mast have more than 5 characters.</small>
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" placeholder="Example: john.doe@gmail.com" autofocus required>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone.</small>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Type your password" autofocus required>
                            </div>
                            <label for="password_retype" class="text-info">Retype password:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                                </div>
                                <input type="password" name="password_retype" id="password_retype" class="form-control" placeholder="Retype password" autofocus required>
                            </div>
                        </div>
                        <button type="submit" name="register_btn" id="register_btn" class="btn btn-info btn-md">Register</button>
                    </form>
                    <br>
                    <p>Already have account? <a href="/index.php">Login</a></p>
                </div>
            </div>   
        </div>
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>
