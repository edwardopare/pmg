<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>
<?php 
  session_start();
if(empty($_SESSION['user'])) {
    echo "<script> location.href='logout.php';</script>";
}else{
 ?>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <?php include 'include/header.php'; ?>
        <!-- END HEADER DESKTOP -->

        <!-- WELCOME-->
        <section class="welcome2 p-t-40 p-b-55">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="au-breadcrumb3">
                            <div class="au-breadcrumb-left">
                                <ul class="list-unstyled list-inline au-breadcrumb__list">
                                    <li class="list-inline-item active">
                                        <a href="javascript:;">Home</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Dashboard</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome2-inner m-t-10">
                            <div class="welcome2-greeting">
                                <h1 class="title-6"><?php include 'greetings.php'; ?>
                            </div>
                            <form class="form-header form-header2" action="" method="post" onsubmit="return false">
                                <input class="au-input au-input--w435" type="text" name="search" placeholder="Search for datas &amp; reports...">
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <!-- PAGE CONTENT-->
        <div class="page-container3"> 
            <section>
                <div class="container"><br>
                    <div class="row">
                        <div class="col-xl-3">
                            <!-- MENU SIDEBAR-->
                            <?php include 'include/side_menu.php'; ?>
                            <!-- END MENU SIDEBAR-->
                            <br><br><br>
                        </div>
                        <div class="col-xl-9">
                            <!-- PAGE CONTENT-->
                            <div class="page-content">
                                <div class="row">
                                    <!-- -------------------first row-------------------------- -->
                                        <!-- <div class="container"> -->
                                            <!-- <div class="row"> -->
                                                <!-- <div class="col-sm-3">
                                                    <section class="card">
                                                        <div class="card-header user-header alt bg-info">
                                                            <div class="media">
                                                                <i class="fa fa-user" style="font-size: 65px; color: #fff;"></i>
                                                                <div class="media-body">
                                                                    <h2 class="text-light display-6">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <?php 
                                    $inmate_qry = $db->query("SELECT * FROM inmate_list WHERE delete_flag=0");
                                    $num_inmate = $inmate_qry->rowCount(); 
                                    echo htmlentities($num_inmate);
                                    ?>
                                                                    </h2>
                                                                    <p style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INMATE</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section> 
                                                  </div> -->
                                              <div class="col-sm-4">
                                              <div class="nav-item"><a class="nav-link" href="prison.php">
                                                    <section class="card">
                                                        <div class="card-header user-header alt bg-dark">
                                                            <div class="media">
                                                                <i class="fa fa-list" style="font-size: 65px; color: #fff;"></i>
                                                                <div class="media-body">
                                                                    <h2 class="text-light display-6">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <?php 
                                    $prison_qry = $db->query("SELECT * FROM prison_list");
                                    $num_prison = $prison_qry->rowCount(); 
                                    echo htmlentities($num_prison);
                                    ?>
                                                                    </h2>
                                                                    <p style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRISON</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    </a></div>
                                                  </div>
                                              <div class="col-sm-4">
                                              <div class="nav-item"><a class="nav-link" href="cell.php">
                                                    <section class="card">
                                                        <div class="card-header user-header alt bg-success">
                                                            <div class="media">
                                                                <i class="fa fa-list" style="font-size: 65px; color: #fff;"></i>
                                                                <div class="media-body">
                                                                    <h2 class="text-light display-6">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <?php 
                                    $cell_qry = $db->query("SELECT * FROM cell_list");
                                    $num_cell = $cell_qry->rowCount(); 
                                    echo htmlentities($num_cell);
                                    ?>
                                                                    </h2>
                                                                    <p style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CELL LIST</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    </a></div>
                                                  </div>
                                                   <div class="col-sm-4">
                                                    <div class="nav-item"><a class="nav-link" href="crime.php">
                                                    <section class="card">
                                                        <div class="card-header user-header alt bg-warning">
                                                            <div class="media">
                                                                <i class="fa fa-list" style="font-size: 65px; color: #fff;"></i>
                                                                <div class="media-body">
                                                                    <h2 class="text-light display-6">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <?php 
                                    $crime_qry = $db->query("SELECT * FROM crime_list");
                                    $num_crime = $crime_qry->rowCount(); 
                                    echo htmlentities($num_crime);
                                    ?>
                                                                    </h2>
                                                                    <p style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CRIME LIST</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    </a></div>
                                                  </div>
                                            
                                    <!-- END STATISTIC-->
                                </div>
                                
                                <!-- footer_note -->
                                <?php include 'include/footer_note.php'; ?>
                            </div>
                            <!-- END PAGE CONTENT-->
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- END PAGE CONTENT  -->

    </div>

<?php include 'include/footer.php'; ?>
<?php } ?>