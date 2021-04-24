<?php
ob_start("ob_gzhandler");
include "includes/header.php";
?>

<title> Newsportal | Add Admin</title>
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
                            <h4 class="page-title">Add Admin</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li class="active">
                                    Add Admin
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
                            <h4 class="m-t-0 header-title"><b>Add Admin </b></h4>
                            <hr/>
                            <div class="row">
                                <div class="col-md-3">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="form-horizontal" name="category" method="post">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Full Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" value="" name="full_name" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" value="" name="username" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Password</label>
                                                <div class="col-md-10">
                                                    <input type="password" class="form-control" value="" name="password" required>
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
                            </div>

                            <?php
                            if (isset($_POST['submit'])) {
                                $FullName = $_POST['full_name'];
                                $Username = $_POST['username'];
                                $Password = md5($_POST['password']);

                                $SQL = $CONN->prepare("Insert Into admin SET full_name = ?, username = ?, password = ?");
                                $SQL->bind_param("sss", $FullName, $Username, $Password);
                                $SQL->execute();
                                $Result = $SQL->get_result();
                                if ($Result == null) {
                                    $_SESSION['admin'] = "<div class='alert alert-success' role='alert'> Admin Is Added </div>";
                                    header("location: " . SITEURL . "admin/manage_admin.php");
                                } else {
                                    $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Added </div>";
                                    header("location: " . SITEURL . "admin/manage_admin.php");
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <?php include "includes/footer.php"?>

        </div>

    </div>
    <!-- END wrapper -->
    <?php include "includes/script.php"?>

</body>
</html>
<?php ob_end_flush(); ?>