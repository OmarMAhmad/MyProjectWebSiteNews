<?php
ob_start("ob_gzhandler");
include "includes/header.php";
?>

<title> | Manage Comments</title>

</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <?php include "includes/topheader.php" ?>

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
                            <h4 class="page-title">Manage Approved Comments</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li>
                                    <a href="manage_comments.php">Comments </a>
                                </li>
                                <li class="active">
                                    Approved Comments
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-6">

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-box m-t-20">

                                <div class="table-responsive">
                                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th width="300">Comment</th>
                                            <th>Comment Date</th>
                                            <th>Action</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php
                                        $SQL = "Select * from comment";
                                        $Result = mysqli_query($CONN, $SQL);
                                        if ($Result->num_rows > 0) {
                                            while ($Row = $Result->fetch_assoc()) {
                                                $Id = $Row['id'];
                                                $FirstName = $Row['first_name'];
                                                $LastName = $Row['last_name'];
                                                $Email = $Row['email'];
                                                $Massage = $Row['massage_comment'];
                                                $DateComment = $Row['date_comment'];
                                                ?>
                                                <tr>
                                                    <th scope="row"> <?php echo $Id ?> </th>
                                                    <td> <?php echo $FirstName ?> </td>
                                                    <td> <?php echo $LastName ?> </td>
                                                    <td> <?php echo $Email ?> </td>
                                                    <td> <?php echo $Massage ?> </td>
                                                    <td> <?php echo $DateComment ?> </td>
                                                    <td>
                                                        <a href="delete_comment.php?id=<?php echo $Id ?>">
                                                            <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }else {
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-box m-t-20">
                                <div class="m-b-30">

                                </div>

                            </div>
                        </div>
                    </div>
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