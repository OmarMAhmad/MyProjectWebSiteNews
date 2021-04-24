<?php
include "includes/config.php";

$Id = $_GET['id'];
$SQL ="Delete From comment Where id = '$Id'";
$Result = mysqli_query($CONN, $SQL);
if ($Result) {
    $_SESSION['comment'] = "<div class='alert alert-success' role='alert'> Comment Is Deleted </div>";
    header("location: " . SITEURL . "admin/manage_categories.php");
}else {
    $_SESSION['comment'] = "<div class='alert alert-danger' role='alert'> Comment Is Not Deleted </div>";
    header("location: " . SITEURL . "admin/manage_categories.php");
}

