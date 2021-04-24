<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="../index.php" class="logo"><span>NEWS<span>PORTAL</span></span><i class="mdi mdi-layers"></i></a>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">

            <!-- Navbar-left -->
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <button class="button-menu-mobile open-left waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>


            </ul>

            <!-- Right(Notification) -->
            <ul class="nav navbar-nav navbar-right">


                <li class="dropdown user-box">
                    <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown"
                       aria-expanded="true">
                        <img src="assets/images/users/users.jpg" alt="user-img" class="img-circle user-img">
                    </a>

                    <?php
                        $Id = $_SESSION['IdUser'];
                        $Sql = $CONN->prepare("Select * from admin where id = ?");
                        $Sql->bind_param("i", $Id);
                        $Sql->execute();
                        $Res = $Sql->get_result();
                        if ($Res->num_rows > 0) {
                            $Row = $Res->fetch_assoc();
                            $FullName = $Row['full_name'];
                        }
                    ?>

                    <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                        <li>
                            <h5>
                                Hi, Admin
                                <span style='color: #7fc1fc; display: block; padding-top: 5px'>
                                    <?php echo $FullName?>
                                </span>
                            </h5>
                        </li>

                        <li>
                            <a href="change_password.php">
                                <i class="ti-settings m-r-5"></i>
                                Chnage Password
                            </a>
                        </li>

                        <li><a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                    </ul>
                </li>

            </ul> <!-- end navbar-right -->

        </div><!-- end container -->
    </div><!-- end navbar -->
</div>