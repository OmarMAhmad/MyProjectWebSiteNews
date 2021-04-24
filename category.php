<?php
$Title = "Category Page";
include "includes/header.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location: " . SITEURL . "category.php");
}
?>

<div class="row" style="margin-top: 4%">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <!-- Blog Post -->
        <?php
        $sql = "Select * From category where id = '$id'";
        $res = mysqli_query($CONN, $sql);
        if ($res->num_rows > 0) {
            $Row = $res->fetch_assoc();
            $category_name = $Row['category_name'];
        }else {
            header("location: 404.html");
        }
        ?>
        <h1> <?php echo $category_name ?> </h1>
        <br>
        <?php
        $SQL = "Select * From posts where category_id = '$id'";
        $Result = mysqli_query($CONN, $SQL);
        if ($Result->num_rows > 0) {
            while ($Row = $Result->fetch_assoc()) {
                $Id = $Row['id'];
                $TitlePost = $Row['title_post'];
                $CategoryId = $Row['category_id'];
                $PostImage = $Row['post_image'];
                $Date = $Row['date_created'];
                ?>
                <div class="card mb-4">
                    <img class="card-img-top" src="<?php echo $PostImage ?>" alt="posttitle">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $TitlePost ?></h2>
                        <a href="news-details.php?nid=22" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        <b>Posted on : </b><?php echo $Date ?>
                    </div>
                </div>
                <?php
            }
        }else {
            ?>
            <h3 style="color:red"> No Record Found </h3>
            <?php
        }
        ?>


    </div>

    <!-- Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>
</div>
<!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<?php include "includes/footer.php" ?>

