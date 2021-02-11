<?php
    session_start();

    if(!isset($_SESSION['UserName']) || !isset($_SESSION['Email']) || !isset($_SESSION['Password'])) {
        header("Location: sign-in.php");
    }
?>

<!DOCTYPE html>


<html>
    <head>
        <?php include("header.php"); ?>
        <link rel="stylesheet" type="text/css" href="css/home_style.css">
        <script defer src="scripts/profile_list_script.js"></script>
        <script defer src="scripts/logout_store_score.js"></script>
        <script defer src="scripts/score_saver.js"></script>
        <script defer src="scripts/enable_disable_user.js"></script>
        <script defer src="scripts/scroll_button_go_top.js"></script>
    </head>
    <body>
        <button id="btnGoTop" title="Go to top"><i class="fa fa-arrow-up fa-2x"></i></button>
        <header>
            <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="home.php"> <img id="logo-pic" alt="logo" src="img/web_site_logo.png" onclick="saveScore()"> Nemanja Babić</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarResponsive">
                        <span id="drop-down-ico" class="navbar-toggler-icon"></span>
                    </button>
                    <div id="navBarResponsive" class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="home.php" onclick="saveScore()">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about-me.php" onclick="saveScore()">About me</a>
                            </li>
                            <?php
                                if(isset($_SESSION['Membership'])) {
                                    if($_SESSION['Membership'] == "Admin") {
                                        ?>
                                            <li class="nav-item active">
                                                <a class="nav-link" href="members.php" onclick="saveScore()">Members<span class="sr-only">(current)</span></a>
                                            </li>
                                        <?php
                                    }
                                }
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="scoreboard.php">Scoreboard</a>
                            </li>
                        </ul>
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
                    </div>
                </div>
            </nav>
        </header>  
        <div class="row justify-content-center mt-5 mb-5 content-page-load-fadein">
            <?php
                if(isset($_GET['message'])) {
                    if($_GET['message'] == 'successful') {
                        echo '
                            <div class="form-group text-center col-xs-12 col-sm-12 col-md-7 col-lg-7 mt-3">
                                <div id="alert_msg" class="alert alert-success text-center" role="alert">
                                <p>Successfully update user.</p>
                                </div>
                            </div>';
                    }
                }
                else if(isset($_GET['error'])) {
                    if($_GET['error'] == 'userNotFound') {
                        echo '
                            <div class="form-group text-center col-xs-12 col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                    <p>User not found.</p>
                                </div>
                            </div>';
                    }
                    else if($_GET['error'] == 'userBlocked'){
                        echo '
                            <div class="form-group text-center col-sm-12 col-md-7 col-lg-7 mt-3"> 
                                <div id="alert_msg" class="alert alert-danger text-center" role="alert">
                                    <p>User is blocked from administrator of site. Contact administrator to revoke rule</p>
                                </div>
                            </div>';
                    }
                }
            ?>
            <div id="table" class="col-xs-12 col-sm-12 col-md-8 col-lg-10 table-responsive mt-3 w-auto">
                <table class="table mb-5">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Membership</th>
                            <th scope="col">Registration date</th>
                            <th scope="col">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(isset($_SESSION['ListUsers'])) {
                            $rows = $_SESSION['ListUsers'];
                            foreach($rows as $row) {
                                echo '
                                <tr>
                                    <th scope="row">'.$row['ID'].'</th>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['surname'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>'.$row['username'].'</td>
                                    <td>'.$row['membership'].'</td>
                                    <td>'.date('F j, Y.', strtotime($row['date'])).'</td>
                                    '.($row['flag'] == 1 ? '<td><button type="button" onclick="checkFlag('.$row['ID'].')" class="btn btn-danger">Disable user</button></td>': '<td><button type="button" onclick="checkFlag('.$row['ID'].')" class="btn btn-success">Enable user</button></td>').'
                                </tr>';
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>  
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>