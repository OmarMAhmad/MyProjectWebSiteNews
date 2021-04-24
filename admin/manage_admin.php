<?php
ob_start("ob_gzhandler");
include "includes/header.php";
?>

<title> Newsportal | Manage Admin</title>

</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <?php include "includes/topheader.php"?>

    <!-- ========== Left Sidebar Start ========== -->
    <?php include "includes/leftsidebar.php"?>
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
                            <h4 class="page-title">Manage Admin</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li class="active">
                                    Manage Admin
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
                        if (isset($_SESSION['admin'])) {
                            echo $_SESSION['admin'];
                            unset($_SESSION['admin']);
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-box m-t-20">
                                <div class="m-b-30">
                                    <a href="add_admin.php">
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
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $SQL = "Select * from admin";
                                        $Result = mysqli_query($CONN, $SQL);
                                        if ($Result->num_rows > 0) {
                                            while ($Row = $Result->fetch_assoc()) {
                                                $Id = $Row['id'];
                                                $FullName = $Row['full_name'];
                                                $Username = $Row['username'];
                                                ?>
                                                <tr>
                                                    <th scope="row"> <?php echo $Id ?> </th>
                                                    <td> <?php echo $FullName ?> </td>
                                                    <td> <?php echo $Username ?> </td>
                                                    <td> &deg; &deg; &deg; &deg; &deg; &deg; &deg; &deg;</td>

                                                    <td>
                                                        <a href="edit_admin.php?id=<?php echo $Id ?>">
                                                            <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                                        </a>
                                                        &nbsp
                                                        <a href="delete_admin.php?id=<?php echo $Id ?>">
                                                            <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }else {
                                        ?>
                                        <tr>
                                            <td colspan="5" align="center">
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
            <?php include "includes/footer.php"?>
        </div>

    </div>
    <!-- END wrapper -->


    <?php include "includes/script.php"?>

</body>
</html>
<?php ob_end_flush(); ?>