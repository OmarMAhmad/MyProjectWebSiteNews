<?php
ob_start("ob_gzhandler");
include "includes/header.php";
?>

<!-- App favicon -->
<link rel="shortcut icon" href="assets/images/favicon.ico">
<!-- App title -->
<title>Newsportal | Manage Posts</title>

<!--Morris Chart CSS -->
<link rel="stylesheet" href="../plugins/morris/morris.css">

<!-- jvectormap -->
<link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>

<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<script src="assets/js/modernizr.min.js"></script>

</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <?php include "includes/topheader.php" ?>

    <!-- ========== Left Sidebar Start ========== -->
    <?php include "includes/leftsidebar.php" ?>


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
                            <h4 class="page-title">Manage Posts </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li>
                                    <a href="manage_posts.php">Posts</a>
                                </li>
                                <li class="active">
                                    Manage Post
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        if (isset($_SESSION['posts'])) {
                            echo $_SESSION['posts'];
                            unset($_SESSION['posts']);
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-box m-t-20">
                                <div class="m-b-30">
                                    <a href="add_post.php">
                                        <button id="addToTable" class="btn btn-success waves-effect waves-light">
                                            Add <i class="mdi mdi-plus-circle-outline"></i>
                                        </button>
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-colored table-centered table-inverse m-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title Post</th>
                                            <th>Category</th>
                                            <th>Feature Image</th>
                                            <th>Details</th>
                                            <th>Posting Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $SQL = "Select * from posts";
                                        $Result = mysqli_query($CONN, $SQL);
                                        if ($Result->num_rows > 0) {
                                            while ($Row = $Result->fetch_assoc()) {
                                                $Id = $Row['id'];
                                                $TitlePost = $Row['title_post'];
                                                $CategoryId = $Row['category_id'];
                                                $sql = "Select * from category where id = '$CategoryId'";
                                                $res = mysqli_query($CONN, $sql);
                                                if ($res->num_rows > 0) {
                                                    $row = $res->fetch_assoc();
                                                    $CategoryName = $row['category_name'];
                                                }
                                                $PostImage = $Row['post_image'];
                                                $Details = $Row['details'];
                                                $DateCreated = $Row['date_created'];
                                                ?>
                                                <tr>
                                                    <th> <?php echo $Id?> </th>
                                                    <th> <?php echo $TitlePost?> </th>
                                                    <th> <?php echo $CategoryName?> </th>
                                                    <th> <img src="../<?php echo $PostImage?>" width="60" style="border-radius: 10px" alt="<?php echo $PostImage?>"> </th>
                                                    <th> <?php echo $Details?> </th>
                                                    <th> <?php echo $DateCreated?> </th>
                                                    <td>
                                                        <a href="edit-post.php?id=<?php echo $Id?>">
                                                            <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                                        </a>
                                                        &nbsp;<a href="delete_post.php?id=<?php echo $Id?>" onclick="return confirm('Do you reaaly want to delete ?')">
                                                            <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="7" align="center">
                                                    <h3 style="color:red"> No Record Found </h3>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!--- end row -->

                </div>

            </div> <!-- container -->

        </div> <!-- content -->

        <?php include('includes/footer.php'); ?>

    </div>

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<?php include('includes/script.php'); ?>

<!-- CounterUp  -->
<script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="../plugins/counterup/jquery.counterup.min.js"></script>

<!--Morris Chart-->
<script src="../plugins/morris/morris.min.js"></script>
<script src="../plugins/raphael/raphael-min.js"></script>

<!-- Load page level scripts-->
<script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../plugins/jvectormap/gdp-data.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>


<!-- Dashboard Init js -->
<script src="assets/pages/jquery.blog-dashboard.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>