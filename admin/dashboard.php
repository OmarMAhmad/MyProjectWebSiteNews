<?php include "includes/header.php" ?>

    <!-- App title -->
    <title>News Portal | Dashboard</title>
    <link rel="stylesheet" href="../plugins/morris/morris.css">
</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="index.html" class="logo"><span>NP<span>Admin</span></span><i class="mdi mdi-layers"></i></a>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <?php include "includes/topheader.php" ?>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <?php include "includes/leftsidebar.php" ?>
    <!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Dashboard</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="../index.php">NewsPortal</a>
                                </li>
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li class="active">
                                    Dashboard
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <a href="manage_admin.php">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="card-box widget-box-one">
                                <i class="fa fa-user-plus widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <?php
                                    $SQL = "Select * From admin";
                                    $Result = mysqli_query($CONN, $SQL);
                                    $Row = $Result->num_rows;
                                    ?>
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                                        The Number Of Admin : <b><?php echo $Row?></b>
                                    </p>
                                    <h2> Admin </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- end col -->

                    <a href="manage_categories.php">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="card-box widget-box-one">
                                <i class="mdi mdi-format-list-bulleted widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <?php
                                    $SQL = "Select * From category";
                                    $Result = mysqli_query($CONN, $SQL);
                                    $Row = $Result->num_rows;
                                    ?>
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">
                                        The Number Of Categories : <b><?php echo $Row?></b>
                                    </p>
                                    <h2> Categories <small></small></h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- end col -->

                    <a href="manage_posts.php">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="card-box widget-box-one">
                                <i class="fa fa-newspaper-o widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <?php
                                    $SQL = "Select * From posts";
                                    $Result = mysqli_query($CONN, $SQL);
                                    $Row = $Result->num_rows;
                                    ?>
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">
                                        The Number Of Posts : <b><?php echo $Row?></b>
                                    </p>
                                    <h2> Posts <small></small></h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- end col -->

                </div>
                <!-- end row -->

                <div class="row">
                    <a href="manage_comments.php">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="card-box widget-box-one">
                                <i class="fa fa-comment-o widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <?php
                                    $SQL = "Select * From comment";
                                    $Result = mysqli_query($CONN, $SQL);
                                    $Row = $Result->num_rows;
                                    ?>
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">
                                        The Number Of comments : <b><?php echo $Row?></b>
                                    </p>
                                    <h2> comments <small></small></h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->

        <?php include('includes/footer.php'); ?>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    <!-- Right Sidebar -->
    <div class="side-bar right-bar">
        <a href="javascript:void(0);" class="right-bar-toggle">
            <i class="mdi mdi-close-circle-outline"></i>
        </a>
        <h4 class="">Settings</h4>
        <div class="setting-list nicescroll">
            <div class="row m-t-20">
                <div class="col-xs-8">
                    <h5 class="m-0">Notifications</h5>
                    <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                </div>
                <div class="col-xs-4 text-right">
                    <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-xs-8">
                    <h5 class="m-0">API Access</h5>
                    <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                </div>
                <div class="col-xs-4 text-right">
                    <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-xs-8">
                    <h5 class="m-0">Auto Updates</h5>
                    <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                </div>
                <div class="col-xs-4 text-right">
                    <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-xs-8">
                    <h5 class="m-0">Online Status</h5>
                    <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                </div>
                <div class="col-xs-4 text-right">
                    <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
                </div>
            </div>
        </div>
    </div>
    <!-- /Right-bar -->

</div>
<!-- END wrapper -->

<?php include('includes/script.php'); ?>

<!-- Counter js  -->
<script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="../plugins/counterup/jquery.counterup.min.js"></script>

<!--Morris Chart-->
<script src="../plugins/morris/morris.min.js"></script>
<script src="../plugins/raphael/raphael-min.js"></script>

<!-- Dashboard init -->
<script src="assets/pages/jquery.dashboard.js"></script>

</body>
</html>
