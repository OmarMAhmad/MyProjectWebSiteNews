<?php
$Title = "Search Page";
include "includes/header.php";
if (isset($_POST['Go'])) {
    $SearchTitle = $_POST['search_title'];
} else {
    header("Location: index.php");
}
?>
<br>
<h1 class="mt-4 mb-3" style="text-align: center"> Post on Your Search <b style="color: #6c757d">"<?php echo $SearchTitle ?>"</b> </h1>
<br>
<div class="row" style="margin-top: 4%">

    <!-- Blog Entries Column -->

    <!-- Blog Post -->
    <?php
    $SQL = "Select * From posts Where title_post LIKE '%$SearchTitle%' OR details LIKE '%$SearchTitle%'";
    $Result = mysqli_query($CONN, $SQL);
    if ($Result->num_rows > 0) {
        while ($Row = $Result->fetch_assoc()) {
            $Id = $Row['id'];
            $TitlePost = $Row['title_post'];
            $CategoryId = $Row['category_id'];
            $PostImage = $Row['post_image'];
            $Date = $Row['date_created'];
            ?>
            <div class="col-md-6">
                <div class="card mb-4">
                    <img class="card-img-top" src="<?php echo $PostImage ?>" alt="<?php echo $TitlePost ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $TitlePost ?></h2>
                        <p>
                            <?php
                            $sql = "Select * From category where id = '$CategoryId'";
                            $res = mysqli_query($CONN, $sql);
                            $row = $res->fetch_assoc();
                            $category_name = $row['category_name'];
                            ?>
                            <a href="category.php?id=<?php echo $CategoryId ?>"></a>
                        </p>
                        <a href="news-details.php?id=<?php echo $Id ?>" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        <b>Posted on : </b> <i> <?php echo $Date ?> </i>
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

    <ul class="pagination justify-content-center mb-4">
        <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
        <li class="disabled page-item">
            <a href="#" class="page-link">Prev</a>
        </li>
        <li class="disabled page-item">
            <a href="#" class="page-link">Next</a>
        </li>
        <li class="page-item"><a href="?pageno=22" class="page-link">Last</a></li>
    </ul>
    <!-- Pagination -->

</div>
<!-- /.row -->
</div>
<!-- /.container -->

<!-- Footer -->
<?php include "includes/footer.php" ?>

