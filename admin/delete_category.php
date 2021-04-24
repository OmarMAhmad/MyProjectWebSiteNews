<?php
include "includes/config.php";

$Id = $_GET['id'];
$SQL ="Delete From category Where id = '$Id'";
$Result = mysqli_query($CONN, $SQL);
if ($Result) {
    $_SESSION['category'] = "<div class='alert alert-success' role='alert'> Category Is Deleted </div>";
    header("location: " . SITEURL . "admin/manage_categories.php");
}else {
    $_SESSION['category'] = "<div class='alert alert-danger' role='alert'> Category Is Not Deleted </div>";
    header("location: " . SITEURL . "admin/manage_categories.php");
}

