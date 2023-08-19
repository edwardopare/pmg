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
if (isset($_POST['updateStatusBtn'])) {
            
    if(isset($_POST['status'])){
         $status = 1;
      }else{
         $status = 0;
      }

      $user_id = $_POST['user_id'];
       $sql="UPDATE users SET status='$status' WHERE id = '$user_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Status updated successfully.";
    }
    else {
      $error="Error. Try again";
    }
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
                                <h3 class="title-5 m-b-35">MY PROFILE</h3>
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
                                    <div class="alert alert-danger" role="alert">
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
                            </section><br><br>
                         <?php } ?>
                         
                         <?php 
                        $userId = $_SESSION['id'];
                        $qry = $db->prepare("SELECT * FROM `users` WHERE id = '{$userId}'");
                        $qry->execute();
                        $results=$qry->fetchAll(PDO::FETCH_OBJ);
                        foreach($results as $result){ 
                            $img = '<img src="'.$result->avatar.'" style="width:50px;">';
                    ?>
                        
                                <div class="card">
                                  <div class="card-body card-block">
                                    <form action="" method="POST" id="manage-user" enctype="multipart/form-data">
                                        <input type="hidden" name="userId" value="<?php echo($result->id) ?>">
                                    <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">   
                                        <div class="form-group">
                                            <label for="name">First Name</label>
                                            <input type="text" name="firstname" id="firstname" class="au-input au-input--full" value="<?php echo($result->firstname) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Middle Name</label>
                                            <input type="text" name="middlename" id="middlename" class="au-input au-input--full" value="<?php echo($result->middlename) ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Last Name</label>
                                            <input type="text" name="lastname" id="lastname" class="au-input au-input--full" value="<?php echo($result->lastname) ?>" required>
                                        </div>
                                    </div>
                                    <?php 
                                  if ($_SESSION['type'] == 1) { 
                                     $readonly = ""; 
                                 }else{
                                    $readonly = "readonly";
                                 }
                                    ?>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="au-input au-input--full" value="<?php echo($result->username) ?>" required <?php echo $readonly; ?>  autocomplete="off">
                                        </div>
                                    </div>
                                  <?php 
                                  if ($_SESSION['type'] == 1) { ?>
                                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="type" class="control-label">Type</label>
                                            <select name="type" id="type" class="form-control" required>
                                            <option value="1" <?php echo isset($result->type) && $result->type == 1 ? 'selected' : '' ?>>Administrator</option>
                                            <option value="2" <?php echo isset($result->type) && $result->type == 2 ? 'selected' : '' ?>>Staff</option>
                                            </select>
                                        </div>
                                    </div>
                                 <?php }else{ ?>
                                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="type" class="control-label">Type</label>
                                            <input type="text" class="au-input au-input--full" value="Staff" readonly>
                                            <input type="text" name="type1" class="au-input au-input--full" value="Staff" value="<?php echo($result->type) ?>" hidden>
                                        </div>
                                    </div>
                                  <?php }
                                  ?>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="" class="control-label">Image</label>
                                            <div class="custom-file">
                                              <input type="file" class="form-control-file" id="customFile1" name="img" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                            <label class="custom-file-label rounded-0" for="customFile1">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group d-flex justify-content-center">
                                            <img id="blah" src="<?php echo($result->avatar) ?>" alt="Preview Will Show Here" style="height: 150px; width: 40%;" />
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="editProfileBtn" class="btn btn-primary btn-xl">
                                            <i class="fa fa-dot-circle-o"></i> Update
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-xl">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            <?php } ?>
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