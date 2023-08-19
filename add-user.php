<?php 
  session_start();
if(empty($_SESSION['user'])) {
    echo "<script> location.href='logout.php';</script>";
}else{
 ?>
<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>
<?php include 'php/add_user_server.php'; ?>
<?php //include 'php/edit_cell_server.php'; ?>
<?php //include 'php/delete_cell_server.php'; ?>

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
                                <h3 class="title-5 m-b-35">USER LIST</h3>
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
                         
                        
                                <div class="card">
                                  <div class="card-body card-block">
                                    <form action="" method="POST" id="manage-user" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">   
                                        <div class="form-group">
                                            <label for="name">First Name</label>
                                            <input type="text" name="firstname" id="firstname" class="au-input au-input--full" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Middle Name</label>
                                            <input type="text" name="middlename" id="middlename" class="au-input au-input--full">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Last Name</label>
                                            <input type="text" name="lastname" id="lastname" class="au-input au-input--full" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="au-input au-input--full" required  autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="password">Password (Default: 123456)</label>
                                            <input type="password" name="password" id="password" class="au-input au-input--full" value="123456" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="type" class="control-label">Type</label>
                                            <select name="type" id="type" class="form-control" required>
                                            <option value="">Select Type</option> 
                                            <option value="1">Administrator</option>
                                            <option value="2">Staff</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="type" class="control-label">Rank</label>
                                            <select name="rank" class="form-control" required>
                                              <option value="">Select Rank</option> 
                                                <?php 
                                                $ret=$db->query("SELECT * FROM rank_title");
                                                    $row_data = $ret->fetchAll(PDO::FETCH_OBJ);
                                                     foreach($row_data as $data){
                                                        $rT_id = $data->id; ?>
                                                        <optgroup label="<?php echo($data->rank_title) ?>">
                                               <?php $query_ranks = $db->query("SELECT * FROM ranks WHERE title_code='$rT_id' ORDER BY rank ASC");
                                                     $rows_ranks = $query_ranks->fetchAll(PDO::FETCH_OBJ);
                                                     foreach($rows_ranks as $row_ranks){?>
                                                
                                                  <option value="<?php echo $row_ranks->id ?>"><?php echo $row_ranks->rank;?></option>
                                                
                                                <?php } ?> </optgroup> <?php } ?>
                                            </select>
                                        </div>
                                    </div>
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
                                            <img id="blah" src="images/photo_default.png" alt="Preview Will Show Here" style="height: 150px; width: 40%;" />
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="addUserBtn" class="btn btn-primary btn-xl">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-xl">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                    </form>
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