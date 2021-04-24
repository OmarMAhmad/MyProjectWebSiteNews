<?php
include "includes/config.php";

$Id = $_GET['id'];
$SQL ="Delete From admin Where id = '$Id'";
$Result = mysqli_query($CONN, $SQL);
if ($Result) {
    $_SESSION['admin'] = "<div class='alert alert-success' role='alert'> Admin Is Deleted </div>";
    header("location: " . SITEURL . "/admin/manage_admin.php");
}else {
    $_SESSION['admin'] = "<div class='alert alert-danger' role='alert'> Admin Is Not Deleted </div>";
    header("location: " . SITEURL . "/admin/manage_admin.php");
}

