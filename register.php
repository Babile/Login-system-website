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
                  <a class="navbar-brand" href="/login.php"> <img id="logo-pic" alt="logo" src="/img/web_site_logo.png"> Nemanja Babić</a>
                </div> 
            </nav>
        </header>
        <div class="container-fluid mt-xl-5 mt-lg-5 mt-md-5 mt-5">
          <div class="row justify-content-center mt-5 mb-5">
                <?php 
                    if(isset($_GET['error'])) {
                        if($_GET['error'] == 'registrationFailed') {
                            echo '
                                <div class="col-sm-12 col-md-8 col-lg-6 mt-xl-3 mt-lg-3 mt-md-3 mt-3">
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
                                <div class="col-sm-12 col-md-8 col-lg-6 mt-xl-3 mt-lg-3 mt-md-3 mt-3">
                                    <div id="alert_msg" class="alert alert-success text-center" role="alert">
                                        <p>You were successfully registered. In 2 seconds you will be redirected to login page.</p>
                                    </div>
                                </div>
                                <div class="w-100"></div>';
                        }
                    } 
                ?>
                <div class="col-sm-12 col-md-8 col-lg-6 mt-2 mb-5">
                    <!--form register-->
                    <button id="back_btn" class="btn btn-info btn-md" onclick="location.href='/index.php'"> <i class="fa fa-chevron-left"></i> Back</button>
                    <form id="register_form" action="/includes/db.register.php" method="POST">
                        <h3 class="text-center text-info">Register</h3>
                        <div class="form-group">
                            <label for="Name" class="text-info">Name:</label><br>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Example: John" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="Surname" class="text-info">Surname:</label><br>
                            <input type="text" name="surname" id="surname" class="form-control" placeholder="Example: Doe" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="Username" class="text-info">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control" aria-describedby="usernameHelp" placeholder="Example: JohnD1" pattern=".{5,}" required title="Username mast have more than 5 characters." autofocus required>
                            <small id="usernameHelp" class="form-text text-muted">Username mast have more than 5 characters.</small>
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" placeholder="Example: john.doe@gmail.com" autofocus required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone.</small>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Type your password" autofocus required>
                            <label for="Retype password" class="text-info">Retype password:</label><br>
                            <input type="password" name="password_retype" id="password_retype" class="form-control" placeholder="Retype password" autofocus required>
                        </div>
                        <button type="submit" name="register_btn" id="register_btn" class="btn btn-info btn-md">Register</button>
                    </form>
                </div>
            </div>   
        </div>
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>