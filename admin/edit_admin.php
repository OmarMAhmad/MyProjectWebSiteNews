<?php
ob_start("ob_gzhandler");
include "includes/header.php";
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $SQL = $CONN->prepare("Select * from admin where id = ?");
    $SQL->bind_param("i", $id);
    $SQL->execute();
    $Result = $SQL->get_result();
    if ($Result->num_rows > 0) {
        $Row = $Result->fetch_assoc();
        $OldFullName = $Row['full_name'];
        $OldUsername = $Row['username'];
    }else {
        $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Found </div>";
        header("location: " . SITEURL . "admin/manage_admin.php");
    }
}else {
    $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Found </div>";
    header("location: " . SITEURL . "admin/manage_admin.php");
}
?>

<title>Newsportal | Edit Admin</title>

</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <?php include "includes/topheader.php"  ?>
    <!-- Top Bar End -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include "includes/leftsidebar.php"?>
    <!-- Left Sidebar End -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Edit Category</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li>
                                    <a href="manage_admin.php">Admin</a>
                                </li>
                                <li class="active">
                                    Edit Admin
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
                            <h4 class="m-t-0 header-title"><b>Edit Admin</b></h4>
                            <hr/>

                            <div class="col-md-3">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <form class="form-horizontal" name="category" method="post">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Full Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?php echo $OldFullName?>" name="full_name" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Username</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?php echo $OldUsername?>" name="username" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">&nbsp;</label>
                                            <div class="col-md-10">
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
                                $NewFullName = $_POST['full_name'];
                                $NewUsername = $_POST['username'];

                                $SQL = $CONN->prepare("Update admin SET full_name = ?, username = ? where id = '$id'");
                                $SQL->bind_param("ss", $NewFullName, $NewUsername);
                                $SQL->execute();
                                $Result = $SQL->get_result();
                                if ($Result == null) {
                                    $_SESSION['admin'] = "<div class='alert alert-success' role='alert'> Admin Is Updated </div>";
                                    header("Location: http://localhost:63342/Project/admin/manage_admin.php");
                                }else {
                                    $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Updated </div>";
                                    header("Location: " . SITEURL . "admin/manage_admin.php");
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
<!-- END wrapper -->

<?php include "includes/script.php "?>

</body>
</html>

<?php ob_end_flush(); ?>