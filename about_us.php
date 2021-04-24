<?php
$Title = "About us";
include "includes/header.php";
?>
<br><br><br><br>
<!-- Intro Content -->
<div class="row">
    <!-- Blog Entries Column -->
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
            $Details = $Row['details'];
            $Date = $Row['date_created'];
            ?>
            <div class="col-md-6">

                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"> <?php echo $TitlePost ?> </h2>
                        <p>
                            <?php
                            $sql = "Select * From category where id = '$CategoryId'";
                            $res = mysqli_query($CONN, $sql);
                            $Row = $res->fetch_assoc();
                            $category_name = $Row['category_name'];
                            ?>
                            <a href="category.php?id=<?php echo $CategoryId ?>"
                               style="text-decoration: none; color: #6c757d">
                                <b>Category : <?php echo $category_name ?> </b>
                            </a>
                        </p>
                        <hr/>
                        <img class="img-fluid rounded" src="<?php echo $PostImage ?>" alt="<?php echo $PostImage ?>">
                        <br><br>
                        <p class="card-text"> <?php echo $Details ?> </p>
                    </div>
                    <div class="card-footer text-muted">
                        <b> Posted on : </b><?php echo $Date ?>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        ?>
        <h3 style="color:red"> No Record Found </h3>
        <?php
    }
    ?>

</div>
<!-- /.row -->

<!-- /.container -->
</div>

<!-- Footer -->
<?php include "includes/footer.php" ?>

