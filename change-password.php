<?php 
  session_start();
if(empty($_SESSION['user'])) {
    echo "<script> location.href='logout.php';</script>";
}else{
 ?>
<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>

<?php include 'php/edit_profile_server.php'; ?>


<?php 
if (isset($_POST['changePassBtn'])) {
      
      $cpass= md5($_POST['cpass']);
      $npass= md5($_POST['npass']);
      $cnpass= md5($_POST['cnpass']);
      $user_id = $_SESSION['id'];
      if ($cnpass == $npass) {
          
            $sql ="SELECT password FROM users WHERE id=:user_id and password=:cpass";
            $query= $db -> prepare($sql);
            $query-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $query-> bindParam(':cpass', $cpass, PDO::PARAM_STR);
            $query-> execute();
            $results = $query -> fetchAll(PDO::FETCH_OBJ);
            if($query -> rowCount() > 0){
            

               $sql_1="UPDATE users SET password='$npass' WHERE id = '$user_id'";
              $query_1 = $db->prepare($sql_1);
              $query_1->execute();
            if($query_1){
               $msg="Password updated successfully.";
            }
            else {
              $error="Error. Try again";
            }
         }else{ $error="Invalid Current Password"; }
      }else{ $error="Password mismatch"; }

      
}
?>
<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <?php include 'include/header.php'; ?>
        <!-- END HEADER DESKTOP -->

        <!-- PAGE CONTENT-->
        <div class="page-container3">
            <section>
                <div class="container"><br>
                    <div class="row">
                        <div class="col-xl-3">
                            <!-- MENU SIDEBAR-->
                            <?php include 'include/side_menu.php'; ?>
                            <!-- END MENU SIDEBAR-->
                        </div>
                        <div class="col-xl-9">
                            <!-- PAGE CONTENT-->
                            <div class="page-content">
                                <div class="row">
                                    <!-- -------------------first row-------------------------- -->
                                    <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">CHANGE PASSWORD</h3>
                        <?php
                        if (isset($msg)) { ?>
                             <section class="alert-wrap">
                                <div class="container">
                                    <!-- ALERT-->
                                    <div class="alert au-alert-success alert-dismissible fade show au-alert au-alert--70per" role="alert">
                                        <i class="zmdi zmdi-check-circle"></i>
                                        <span class="content"><?php echo $msg; ?></span>
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">
                                                <i class="zmdi zmdi-close-circle"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <!-- END ALERT-->
                                </div>
                            </section><br><br>
                         <?php } ?>

                         <?php
                        if (isset($error)) { ?>
                             <section class="alert-wrap">
                                <div class="container">
                                    <!-- ALERT-->
                                    <div class="alert alert-danger" role="alert" style="width: 49%;">
                                        <i class="zmdi zmdi-check-circle"></i>
                                        <span class="content"><?php echo $error; ?></span>
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">
                                                <i class="zmdi zmdi-close-circle"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <!-- END ALERT-->
                                </div>
                            </section>
                        <?php } ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="card">
                                  <div class="card-body card-block">
                                    <form action="" method="POST" id="" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-sm-12 col-xs-12">   
                                        <div class="form-group">
                                            <label for="cpass">Current Password</label>
                                            <input type="password" name="cpass" id="cpass" class="au-input au-input--full" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="npass">New Password</label>
                                            <input type="password" name="npass" id="npass" class="au-input au-input--full">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="cnpass">Confirm New Password</label>
                                            <input type="password" name="cnpass" id="cnpass" class="au-input au-input--full" required>
                                        </div>
                                    </div>
                                </div>
                                     <div class="card-footer">
                                        <button type="submit" name="changePassBtn" class="btn btn-primary btn-xl">
                                            <i class="fa fa-dot-circle-o"></i> Update
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-xl">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                           
                                <!-- END DATA TABLE -->
                            </div>
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
<script>
        $(document).ready(function () {
           $('#prison_table').DataTable();
        });
    
  </script>

  <?php } ?>