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
        <script defer src="scripts/profile_list_script.js"></script>
        <script defer src="scripts/logout_store_score.js"></script>
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
                                <a class="nav-link" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about-me.php">About me</a>
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
                            <li class="nav-item active">
                                <a class="nav-link" href="scoreboard.php">Scoreboard<span class="sr-only">(current)</span></a>
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
            <div id="table" class="col-xs-12 col-sm-12 col-md-8 col-lg-10 table-responsive mt-3 w-auto">
                    <table class="table mb-5">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col" class="text-center">Score</th>
                                <th scope="col" class="text-center">Scored date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($_SESSION['HighScoreList'])) {
                                $rows = $_SESSION['HighScoreList'];
                                foreach($rows as $row) {
                                    echo '
                                    <tr>
                                        <td>'.$row['username'].'</td>
                                        <td class="text-center">'.$row['score'].'</td>
                                        <td class="text-center">'.date('F j, Y.', strtotime($row['date'])).'</td>
                                    </tr>';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>

