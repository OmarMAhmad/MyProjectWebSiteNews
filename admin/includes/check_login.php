<?php
include "config.php";
if (isset($_SESSION['IdUser'])){

}else {
    $_SESSION['Login'] = "<div class='alert alert-danger' role='alert'> Your Must Login First ! </div>";
    header("location: " . SITEURL . "admin/index.php");
}
?>