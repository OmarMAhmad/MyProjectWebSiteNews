<div class="col-md-4">
    <!-- Search Widget -->
    <div class="card mb-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <form name="search" action="search.php" method="post">
                <div class="input-group">
                    <input type="text" name="search_title" class="form-control" placeholder="Search for..." required>
                    <span class="input-group-btn">
                  <button class="btn btn-secondary" name="Go" type="submit"> Go! </button>
                </span>
            </form>
        </div>
    </div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <ul style="list-style-type: circle; margin-left: 20px" class="list-unstyled mb-0">
                    <?php
                    $SQL = "Select * From category";
                    $Result = mysqli_query($CONN, $SQL);
                    if ($Result->num_rows > 0) {
                        while ($Row = $Result->fetch_assoc()) {
                            $Id = $Row['id'];
                            $CategoryName = $Row['category_name'];
                            ?>
                            <li>
                                <a href="category.php?id=<?php echo $Id ?>" style="text-decoration: none; color: #6c757d">
                                    <?php echo $CategoryName ?>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- Side Widget -->
<div class="card my-4">
    <h5 class="card-header">Recent News</h5>
    <div class="card-body">
        <ul class="mb-0" style="list-style-type: none; padding: 0px">
            <?php
            $sql = "Select * From posts order by id desc limit 5";
            $result = mysqli_query($CONN, $sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $TitlePost = $row['title_post'];
                    $PostImage = $row['post_image'];
                    ?>
                    <li class="col-lg-12">
                        <img src="<?php echo $PostImage?>" alt="<?php echo $TitlePost?>" style="width: 100%">
                    </li>
                    <li class="col-lg-12">
                        <a href="news-details.php?id=<?php echo $id?>" style="text-decoration: none; color: #6c757d">
                            <?php echo $TitlePost?>
                        </a>
                    </li>
                    <hr style="border: 1px solid #6c757d">
                    <br>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>

</div>
