<?php
ob_start("ob_gzhandler");
include('includes/header.php');
if (isset($_SESSION['IdUser'])){
    $id = $_SESSION['IdUser'];
    $SQL = $CONN->prepare("Select * From admin Where id = ?");
    $SQL->bind_param("i", $id);
    $SQL->execute();
    $Result = $SQL->get_result();
    if ($Result->num_rows > 0){
        $Row = $Result->fetch_assoc();
        $OldPassword = $Row['password'];
    }
}else {
    $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Your Must Login First ! </div>";
    header("location: " . SITEURL . "admin/index.php");
}
?>

<title>Newsportal | Add Category</title>

</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <?php include "includes/topheader.php" ?>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <?php include "includes/leftsidebar.php" ?>
    <!-- Left Sidebar End -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Chnage Password</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li class="active">
                                    Change Password
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Change Password </b></h4>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-6">
                                    <?php
                                    if (isset($_SESSION['admin'])) {
                                        echo $_SESSION['admin'];
                                        unset($_SESSION['admin']);
                                    }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-10">
                                        <form class="form-horizontal" name="chngpwd" method="post" onSubmit="return valid();">

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Current Password</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" value="" name="password" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">New Password</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" value="" name="newpassword" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Confirm Password</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" value="" name="confirmpassword" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">&nbsp;</label>
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <?php
                                if (isset($_POST['submit'])) {
                                    $CurrentPassword = md5($_POST['password']);
                                    $NewPassword = $_POST['newpassword'];
                                    $ConfirmPassword = $_POST['confirmpassword'];

                                    if ($OldPassword == $CurrentPassword) {

                                        if ($NewPassword == $ConfirmPassword) {
                                            $NewPassword = md5($NewPassword);
                                            $sql = $CONN->prepare("Update admin SET password = ? Where id = ?");
                                            $sql->bind_param("si", $NewPassword, $id);
                                            $sql->execute();
                                            $res = $sql->get_result();
                                            if ($res == null) {
                                                $_SESSION['admin'] = "<div class='alert alert-success' role='alert'> Admin Is Updated Password </div>";
                                                header("location: " . SITEURL . "admin/change_password.php");
                                            } else {
                                                $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Updated Password !! </div>";
                                                header("location: " . SITEURL . "admin/change_password.php");
                                            }

                                        } else {
                                            $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Password and Confirm Password Field do not match !! </div>";
                                            header("location: " . SITEURL . "admin/change_password.php");
                                        }

                                    } else {
                                        $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Password is incorrect !! </div>";
                                        header("location: " . SITEURL . "admin/change_password.php");
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <?php include "includes/footer.php" ?>

        </div>
    </div>

    <?php include "includes/script.php" ?>

</body>
</html>
<?php ob_end_flush(); ?>