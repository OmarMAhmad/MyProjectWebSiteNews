<?php
ob_start("ob_gzhandler");
include('includes/header.php');
?>

<!-- App title -->
<title>Newsportal | Add Category</title>
</head>

<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <?php include('includes/topheader.php'); ?>
    <!-- Top Bar End -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include('includes/leftsidebar.php'); ?>
    <!-- Left Sidebar End -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Add Category</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li>
                                    <a href="manage_categories.php">Category </a>
                                </li>
                                <li class="active">
                                    Add Category
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
                            <h4 class="m-t-0 header-title"><b>Add Category </b></h4>
                            <hr/>

                            <div class="row">
                                <div class="col-md-3">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="form-horizontal" name="category" method="post">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Category</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" value="" name="category" required>
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
                                $CategoryName = $_POST['category'];

                                $SQL = $CONN->prepare("Insert Into category SET category_name = ?");
                                $SQL->bind_param("s", $CategoryName);
                                $SQL->execute();
                                $Result = $SQL->get_result();
                                if ($Result == null) {
                                    $_SESSION['category'] = "<div class='alert alert-success' role='alert'> Category Is Added </div>";
                                    header("location: " . SITEURL . "admin/manage_categories.php");
                                } else {
                                    $_SESSION['category'] = "<div class='alert alert-danger' role='alert'> Category Is Not Added </div>";
                                    header("location: " . SITEURL . "admin/manage_categories.php");
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <!-- end row -->


                </div>
                <!-- end row -->

            </div> <!-- content -->

            <?php include "includes/footer.php" ?>

        </div>
    </div>

    <?php include "includes/script.php" ?>

</body>
</html>
<?php ob_end_flush(); ?>