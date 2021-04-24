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
        $OldCategoryId = $row['category_id'];
        $OldPostImage = $row['post_image'];
        $OldDetails = $row['details'];
        $OldDescription = $row['description'];
    }else {
        $_SESSION['posts'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Found </div>";
        header("location: " . SITEURL . "admin/manage_posts.php");
    }
}else {
    $_SESSION['posts'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Found </div>";
    header("location: " . SITEURL . "admin/manage_posts.php");
}
?>
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
                            <h4 class="page-title">Edit Post </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li>
                                    <a href="manage_posts.php"> Posts </a>
                                </li>
                                <li class="active">
                                    Add Post
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="p-6">
                            <div class="">
                                <form name="addpost" method="post">
                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Post Title</label>
                                        <input type="text" class="form-control" id="posttitle" value="<?php echo $OldTitlePost?>"
                                               name="title_post" placeholder="Enter title" required>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select class="form-control" name="category" id="category"
                                                onChange="getSubCat(this.value);" required>
                                            <?PHP
                                            $sql = "Select * from category";
                                            $Res = mysqli_query($CONN, $sql);
                                            if ($Res->num_rows > 0) {
                                                while ($R = $Res->fetch_assoc()) {
                                                    $category_id = $R['id'];
                                                    $category_name = $R['category_name'];
                                                    ?>
                                                    <option value="<?php echo $category_id ?>" <?php echo($OldCategoryId == $category_id)? "selected" : "" ?>><?php echo $category_name ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option name=""> undefined Category Name</option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <div class="form-group">
                                                    <h4 class="m-b-30 m-t-0 header-title" class="col-md-2 control-label"><b>Post Details</b></h4>
                                                    <textarea class="form-control" rows="5" name="details" required><?php echo $OldDetails?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <div class="form-group">
                                                    <h4 class="m-b-30 m-t-0 header-title" class="col-md-2 control-label"><b>Post Description</b></h4>
                                                    <textarea class="form-control" rows="5" name="description" required><?php echo $OldDescription?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                                <img src="../<?php echo $OldPostImage?>" width="300" alt="<?php echo $OldPostImage?>">
                                                <br><br>
                                                <a href="change_image.php?id=<?php echo $id?>">Update Image</a>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" name="update"
                                            class="btn btn-success waves-effect waves-light">Update
                                    </button>
                                </form>

                                <?php
                                if (isset($_POST['update'])) {
                                    $TitlePost = $_POST['title_post'];
                                    $CategoryId = $_POST['category'];
                                    $Details = $_POST['details'];
                                    $Description = $_POST['description'];
                                    $SQL = $CONN->prepare("Update posts SET title_post = ?, category_id = ?, details = ?, description = ? Where id = '$id'");
                                    $SQL->bind_param("siss", $TitlePost, $CategoryId, $Details, $Description);
                                    $SQL->execute();
                                    $Result = $SQL->get_result();
                                    if ($Result == null) {
                                        $_SESSION['posts'] = "<div class='alert alert-success' role='alert'> Post Is Updated </div>";
                                        header("location: " . SITEURL . "admin/manage_posts.php");
                                    } else {
                                        $_SESSION['posts'] = "<div class='alert alert-danger' role='alert'> Post Is Not Updated </div>";
                                        header("location: " . SITEURL . "admin/manage_posts.php");
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

<script>

    jQuery(document).ready(function () {

        $('.summernote').summernote({
            height: 240,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
    });
</script>
<script src="../plugins/switchery/switchery.min.js"></script>

<!--Summernote js-->
<script src="../plugins/summernote/summernote.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>