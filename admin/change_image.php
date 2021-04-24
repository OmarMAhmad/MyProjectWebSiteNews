<?php
ob_start("ob_gzhandler");
include "includes/header.php";
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $Sql = $CONN->prepare("Select * from posts where id = ?");
    $Sql->bind_param("i", $id);
    $Sql->execute();
    $result = $Sql->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $OldTitlePost = $row['title_post'];
        $OldPostImage = $row['post_image'];
    }else {
        $_SESSION['posts'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Found </div>";
        header("location: " . SITEURL . "admin/manage_posts.php");
    }
}else {
    $_SESSION['posts'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Found </div>";
    header("location: " . SITEURL . "admin/manage_posts.php");
}
?>

<!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- App title -->
    <title>Newsportal | Add Post</title>

    <!-- Summernote css -->
    <link href="../plugins/summernote/summernote.css" rel="stylesheet"/>

    <!-- Select2 -->
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>

    <!-- Jquery filer css -->
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet"/>
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet"/>

    <script>
        function getSubCat(val) {
            $.ajax({
                type: "POST",
                url: "get_subcategory.php",
                data: 'catid=' + val,
                success: function (data) {
                    $("#subcategory").html(data);
                }
            });
        }
    </script>
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
                            <h4 class="page-title">Update Image </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li>
                                    <a href="manage_posts.php"> Posts </a>
                                </li>
                                <li>
                                    <a href="edit-post.php?id=<?php echo $id?>"> Edit Posts </a>
                                </li>
                                <li class="active">
                                    Update Image
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
                        if (isset($_SESSION['ChangeImage'])) {
                            echo $_SESSION['ChangeImage'];
                            unset($_SESSION['ChangeImage']);
                        }
                        ?>
                    </div>
                    <form name="addpost" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Post Title</label>
                                                <input type="text" class="form-control" id="posttitle" value="<?php echo $OldTitlePost?>"
                                                       name="posttitle" readonly>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Current Post Image</b>
                                                        </h4>
                                                        <img src="../<?php echo $OldPostImage?>" width="300" alt="<?php echo $OldPostImage?>">
                                                        <br/>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>New Feature Image</b>
                                                        </h4>
                                                        <input type="file" class="form-control" id="postimage"
                                                               name="post_image" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" name="update"
                                                    class="btn btn-success waves-effect waves-light">Update
                                            </button>
                                        </form>

                                        <?php
                                        if (isset($_POST['update'])) {
                                            if (isset($_FILES['post_image']['name']) && $_FILES['post_image']['name'] != "") {
                                                $ImageName = $_FILES['post_image']['name'];
                                                $TempName = $_FILES['post_image']['tmp_name'];
                                                $extension = explode('.', $ImageName);
                                                $ImageName = "images/" . $OldTitlePost . "_" . time() . "." . end($extension);
                                                $uploade = move_uploaded_file($TempName, "../" . $ImageName);

                                                $SQL = $CONN->prepare("Update posts SET post_image = ? Where id = '$id'");
                                                $SQL->bind_param("s", $ImageName);
                                                $SQL->execute();
                                                $Result = $SQL->get_result();
                                                if ($Result == null) {
                                                    $_SESSION['ChangeImage'] = "<div class='alert alert-success' role='alert'> Image Is Updated </div>";
                                                    header("location: " . SITEURL . "admin/change_image.php?id='$id");
                                                } else {
                                                    $_SESSION['ChangeImage'] = "<div class='alert alert-danger' role='alert'> Image Is Not Updated </div>";
                                                    header("location: " . SITEURL . "admin/change_image.php?id='$id");
                                                }
                                            } else {
                                                $_SESSION['ChangeImage'] = "<div class='alert alert-danger' role='alert'> Image Is Not Found </div>";
                                                header("location: " . SITEURL . "admin/change_image.php?id='$id");
                                            }
                                        }
                                        ?>

                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->


                </div> <!-- container -->

            </div> <!-- content -->

            <?php include "includes/footer.php" ?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->


    <?php include "includes/script.php" ?>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>
    <!-- Select 2 -->
    <script src="../plugins/select2/js/select2.min.js"></script>
    <!-- Jquery filer js -->
    <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

    <!-- page specific js -->
    <script src="assets/pages/jquery.blog-add.init.js"></script>

    <script src="../plugins/switchery/switchery.min.js"></script>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>