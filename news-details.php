<?php
$Title = "Details Page";
include "includes/header.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $Sql = $CONN->prepare("Select * from posts where id = ?");
    $Sql->bind_param("i", $id);
    $Sql->execute();
    $result = $Sql->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $TitlePost = $row['title_post'];
        $CategoryId = $row['category_id'];
        $PostImage = $row['post_image'];
        $Description = $row['description'];
        $Date = $row['date_created'];
    } else {
        header("location: " . SITEURL . "index.php");
    }
} else {
    header("location: " . SITEURL . "index.php");
}
?>

<div class="row" style="margin-top: 4%">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <!-- Blog Post -->
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
                    <a href="category.php?id=<?php echo $CategoryId ?>" style="text-decoration: none; color: #6c757d">
                        <b>Category : <?php echo $category_name ?> </b>
                    </a>
                </p>
                <hr/>
                <img class="img-fluid rounded" src="<?php echo $PostImage ?>" alt="<?php echo $PostImage ?>">
                <br><br>
                <p class="card-text"> <?php echo $Description ?> </p>
            </div>
            <div class="card-footer text-muted">
                <b> Posted on : </b><?php echo $Date ?>
            </div>
        </div>

    </div>

    <!-- Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>
</div>
<!-- /.row -->
<!---Comment Section --->


</div>

<!-- Footer -->
<?php include "includes/footer.php" ?>

