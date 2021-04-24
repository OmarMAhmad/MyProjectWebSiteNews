<?php
include "includes/config.php";

$Id = $_GET['id'];
$SQL ="Delete From posts Where id = '$Id'";
$Result = mysqli_query($CONN, $SQL);
if ($Result) {
    $_SESSION['posts'] = "<div class='alert alert-success' role='alert'> Post Is Deleted </div>";
    header("location: " . SITEURL . "/admin/manage_posts.php");
}else {
    $_SESSION['posts'] = "<div class='alert alert-danger' role='alert'> Post Is Not Deleted </div>";
    header("location: " . SITEURL . "/admin/manage_posts.php");
}

