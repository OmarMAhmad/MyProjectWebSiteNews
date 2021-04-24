<?php
ob_start("ob_gzhandler");
include "includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="News Portal.">
    <meta name="author" content="PHPGurukul">

    <!-- App title -->
    <title>News Portal | Admin Panel</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <script src="assets/js/modernizr.min.js"></script>
</head>

<body class="bg-transparent">

<!-- HOME -->
<section>
    <div class="container-alt">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper-page">

                    <div class="m-t-40 account-pages">
                        <div class="text-center account-logo-box">
                            <h2 class="text-uppercase">
                                <a href="index.php" class="text-success">
                                    <span><img src="assets/images/logo.png" alt="" height="56"></span>
                                </a>
                            </h2>
                            <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                        </div>
                        <div class="account-content">

                            <div class="col-sm-12">
                                <?php
                                if (isset($_SESSION['Login'])) {
                                    echo $_SESSION['Login'];
                                    unset($_SESSION['Login']);
                                }
                                ?>
                            </div>

                            <form class="form-horizontal" method="post" action="index.php">
                                <div class="form-group ">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" required="" name="username" placeholder="Username" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" name="password" required="" placeholder="Password" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-xs-12">
                                        <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">
                                            Log In
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- end card-box-->

                    <?php
                    if (isset($_POST['login'])) {
                        $Username = $_POST['username'];
                        $Password = md5($_POST['password']);
                        $SQL = $CONN->prepare("Select * From admin Where username = ? and password = ?");
                        $SQL->bind_param("ss", $Username, $Password);
                        $SQL->execute();
                        $Result = $SQL->get_result();
                        $Row = $Result->fetch_assoc();
                        $Id = $Row['id'];

                        if ($Result->num_rows > 0) {
                            $_SESSION['IdUser'] = $Id;
                            header("location: " . SITEURL . "admin/dashboard.php");
                        } else {
                            $_SESSION['Login'] = "<div class='alert alert-danger' role='alert'> Incorrect Username Or Password </div>";
                            header("location: " . SITEURL . "/admin/index.php");
                        }
                    }
                    ?>

                </div>
                <!-- end wrapper -->

            </div>
        </div>
    </div>
</section>
<!-- END HOME -->

<?php include('includes/script.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>