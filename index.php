<?php
ob_start("ob_gzhandler");
$Title = "Home Page";
include "includes/header.php";
?>
<br>
<div class="row" style="margin-top: 4%">
    <!-- Blog Entries Column -->
    <div class="col-md-8">
        <!-- Blog Post -->
        <?php
        $SQL = "Select * From posts";
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
                    <img class="card-img-top" src="<?php echo $PostImage?>" alt="<?php echo $TitlePost?>">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $TitlePost?></h2>
                        <p>
                            <?php
                            $sql = "Select * From category where id = '$CategoryId'";
                            $res = mysqli_query($CONN, $sql);
                            $row = $res->fetch_assoc();
                            $category_name = $row['category_name'];
                            ?>
                            <b>Category : <?php echo $category_name?></b>
                            <a href="category.php?id=<?php echo $CategoryId?>"></a>
                        </p>
                        <a href="news-details.php?id=<?php echo $Id?>" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        <b>Posted on : </b> <i> <?php echo $Date?> </i>
                    </div>
                </div> <br>
                <?php
            }
        } else {
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
<?php ob_end_flush(); ?>