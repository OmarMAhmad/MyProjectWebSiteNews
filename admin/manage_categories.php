<?php
ob_start("ob_gzhandler");
include "includes/header.php";
?>

<title> Newsportal | Manage Categories</title>

</head>
<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <?php include('includes/topheader.php'); ?>

    <!-- ========== Left Sidebar Start ========== -->
    <?php include('includes/leftsidebar.php'); ?>
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
                            <h4 class="page-title">Manage Categories</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li>
                                    <a href="manage_categories.php">Category </a>
                                </li>
                                <li class="active">
                                    Manage Categories
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
                        if (isset($_SESSION['category'])) {
                            echo $_SESSION['category'];
                            unset($_SESSION['category']);
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-box m-t-20">
                                <div class="m-b-30">
                                    <a href="add_category.php">
                                        <button id="addToTable" class="btn btn-success waves-effect waves-light">
                                            Add <i class="mdi mdi-plus-circle-outline"></i>
                                        </button>
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Posting Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $SQL = "Select * from category";
                                        $Result = mysqli_query($CONN, $SQL);
                                        if ($Result->num_rows > 0) {
                                            while ($Row = $Result->fetch_assoc()) {
                                                $Id = $Row['id'];
                                                $CategoryName = $Row['category_name'];
                                                $DateCreated = $Row['date_created'];
                                                ?>
                                                <tr>
                                                    <th scope="row"> <?php echo $Id?> </th>
                                                    <td> <?php echo $CategoryName?> </td>
                                                    <td> <?php echo $DateCreated?> </td>
                                                    <td>
                                                        <a href="edit_category.php?id=<?php echo $Id?>">
                                                            <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                                        </a>
                                                        &nbsp
                                                        <a href="delete_category.php?id=<?php echo $Id?>">
                                                            <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4" align="center">
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

                </div> <!-- container -->

            </div> <!-- content -->
            <?php include "includes/footer.php" ?>
        </div>

    </div>
    <!-- END wrapper -->

    <?php include "includes/script.php" ?>

</body>
</html>
<?php ob_end_flush(); ?>