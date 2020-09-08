
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT EmailId,Password,Status,id FROM employees WHERE EmailId=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $status = $result->Status;
            $_SESSION['eid'] = $result->id;
        }
        if ($status == 0) {
            $msg = "Your account is Inactive. Please contact admin";
        } else {
            $_SESSION['emplogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location = 'apply-leave.php'; </script>";
        }
    } else {

        echo "<script>alert('Invalid Details');</script>";
    }
}
?><!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Title -->
        <title>Home</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="assets/css/materialdesign.css" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">        


        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>

        <div class="mn-content fixed-sidebar" style="background: #C1FFC1">
            <header class="mn-header navbar-fixed">
                <nav class="cyan darken-1">
                    <div class="nav-wrapper row" style="background: #303030">
                        <section class="material-design-hamburger navigation-toggle">
                            <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                                <span class="material-design-hamburger__layer"></span>
                            </a>
                        </section>
                        <div class="header-title col s10">      
                            <span class="chapter-title">Employee Leave Management System</span>
                        </div> 
                    </div>
                </nav>
            </header>


            <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper" style="background:#B0E0E6" >
                    <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion" style="">
                        <li>&nbsp;</li>
                        <li class="no-padding"><a class="waves-effect waves-grey" href="index.php"><i class="material-icons">account_box</i>Employe Login</a></li>
                        <li class="no-padding"><a class="waves-effect waves-grey" href="admin/"><i class="material-icons">account_box</i>Admin Login</a></li>

                    </ul>
                    <div class="footer">


                    </div>
                </div>
            </aside>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title"><h4>Please login to access the system!!!</h4></div>

                        <div class="col s12 m6 l8 offset-l2 offset-m3">
                            <div class="card white darken-1">

                                <div class="card-content ">
                                    <span class="card-title" style="font-size:20px;">Employee Login</span>
                                    <?php if ($msg) { ?><div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <div class="row">
                                        <form class="col s12" name="signin" method="post">
                                            <div class="input-field col s12">
                                                <input id="username" type="text" name="username" class="validate" autocomplete="off" required >
                                                <label for="email">Email Id</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                <label for="password">Password</label>
                                            </div>
                                            <br>
                                            <a  href="forgot-password.php">Forgot password?</a>
                                            <div class="col s12 right-align m-t-sm">
                                                <input type="submit" style="background: #1698C0" name="signin" value="Sign in" class="btn " >
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover"></div>

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>

    </body>
</html>