<?php
ob_start("ob_gzhandler");
include "includes/header.php";
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
                            <h4 class="page-title">Add Post </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="dashboard.php">Admin</a>
                                </li>
                                <li>
                                    <a href="manage_posts.php">Add Post </a>
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
                                <form name="addpost" method="post" enctype="multipart/form-data">
                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Post Title</label>
                                        <input type="text" class="form-control" id="posttitle" name="title_post"
                                               placeholder="Enter title" required>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select class="form-control" name="category" id="category"
                                                onChange="getSubCat(this.value);" required>
                                            <?PHP
                                            $SQL = "Select * from category";
                                            $Result = mysqli_query($CONN, $SQL);
                                            if ($Result->num_rows > 0) {
                                                while ($Row = $Result->fetch_assoc()) {
                                                    $category_id = $Row['id'];
                                                    $category_name = $Row['category_name'];
                                                    ?>
                                                    <option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
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
                                                    <textarea class="form-control" rows="5" name="details" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <div class="form-group">
                                                    <h4 class="m-b-30 m-t-0 header-title" class="col-md-2 control-label"><b>Post Description</b></h4>
                                                    <textarea class="form-control" rows="5" name="description" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <h4 class="m-b-30 m-t-0 header-title">
                                                    <b>Feature Image</b>
                                                </h4>
                                                <input type="file" class="form-control" id="postimage" name="post_image">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="submit"
                                            class="btn btn-success waves-effect waves-light">
                                        Save and Post
                                    </button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light">
                                        Discard
                                    </button>
                                </form>


                    <?php
                    if (isset($_POST['submit'])) {
                        $TitlePost = $_POST['title_post'];
                        $CategoryId = $_POST['category'];
                        $Details = $_POST['details'];
                        $Description = $_POST['description'];

                        if (isset($_FILES['post_image']['name']) && $_FILES['post_image']['name'] != "") {
                            $ImageName = $_FILES['post_image']['name'];
                            $TempName = $_FILES['post_image']['tmp_name'];
                            $extension = explode('.', $ImageName);
                            $ImageName = "images/" . $TitlePost . "_" . time() . "." . end($extension);
                            $uploade = move_uploaded_file($TempName, "../" . $ImageName);
                        } else {
                            $ImageName = "images/template.svg";
                        }
//                        echo $ImageName;
                        $SQL = $CONN->prepare("Insert Into posts SET title_post = ?, category_id = ?, post_image = ?, details = ?, description = ?");
                        $SQL->bind_param("sisss", $TitlePost, $CategoryId, $ImageName, $Details, $Description);
                        $SQL->execute();
                        $Result = $SQL->get_result();
                        if ($Result == null) {
                            $_SESSION['posts'] = "<div class='alert alert-success' role='alert'> Post Is Added </div>";
                            header("location: " . SITEURL . "admin/manage_posts.php");
                        } else {
                            $_SESSION['posts'] = "<div class='alert alert-danger' role='alert'> Post Is Not Added </div>";
                            header("location: " . SITEURL . "admin/manage_posts.php");
                        }
                    }
                    ?>
                            </div>
                        </div> <!-- end p-20 -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

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