<?php
ob_start("ob_gzhandler");
$Title = "Contact us";
include "includes/header.php";
?>
<br>
<h1 class="mt-4 mb-3"> Contact Pages </h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"> Home</li>
    <li style="color: #00aced" class="breadcrumb-item active">Contact</li>
</ol>

<!-- Intro Content -->
<div class="row">
    <div class="col-lg-3 col-md-0"></div>
    <div class="col-lg-6">

        <div class="col-lg-12">
            <?php
            if (isset($_SESSION['Contact'])) {
                echo "<br>" . $_SESSION['Contact'] . "<br>";
                unset($_SESSION['Contact']);
            }
            ?>
        </div>
        <br>
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="text" name="first_name" required="" placeholder="Enter First Name" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="text" name="last_name" required="" placeholder="Enter Last Name" autocomplete="off">
                </div>
            </div>

            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" type="email" required="" name="email" placeholder="Enter Email" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="massage_comment" required="" placeholder="Massage" autocomplete="off"></textarea>
                </div>
            </div>

            <div class="form-group account-btn text-center m-t-10">
                <div class="col-xs-12">
                    <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
                            type="submit" name="Contact">Contact Us
                    </button>
                </div>
            </div>

        </form>
        <?php
        if (isset($_POST['Contact'])) {
            $FirstName = $_POST['first_name'];
            $LastName = $_POST['last_name'];
            $Email = $_POST['email'];
            $Massage = $_POST['massage_comment'];
            $SQL = $CONN->prepare("Insert Into comment SET first_name = ?, last_name = ?, email = ?, massage_comment = ?");
            $SQL->bind_param("ssss", $FirstName, $LastName, $Email, $Massage);
            $SQL->execute();
            $Result = $SQL->get_result();
            if ($Result == null) {
                $_SESSION['Contact'] = "<div class='alert alert-success' role='alert'> The Message Has Been Sent Successfully </div>";
                header("location: " . SITEURL . "contact_us.php");
            } else {
                $_SESSION['Contact'] = "<div class='alert alert-danger' role='alert'> The Message Sending Process Has Failed </div>";
                header("location: " . SITEURL . "contact_us.php");
            }
        }
        ?>
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<?php include "includes/footer.php" ?>
<?php ob_end_flush(); ?>