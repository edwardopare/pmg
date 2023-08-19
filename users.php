<?php 
  session_start();
if(empty($_SESSION['user'])) {
    echo "<script> location.href='logout.php';</script>";
}else{
 ?>
<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>
<?php include 'php/add_cell_server.php'; ?>
<?php include 'php/edit_cell_server.php'; ?>
<?php include 'php/delete_cell_server.php'; ?>

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
      $error="Something went wrong. Try again";
    }
}

/*permission --------------------*/
if (isset($_POST['updatePermissionBtn'])) {
            
    if(isset($_POST['drug'])){
         $drug = 1;
      }else{
         $drug = 0;
      }

      if(isset($_POST['food'])){
         $food = 1;
      }else{
         $food = 0;
      }

      if(isset($_POST['requestfood'])){
         $requestfood = 1;
      }else{
         $requestfood = 0;
      }

       if(isset($_POST['requestdrug'])){
         $requestdrug = 1;
      }else{
         $requestdrug = 0;
      }

      $user_id = $_POST['user_id'];
       $sql="UPDATE users SET drug_permit='$drug', food_permit='$food', request_drug_permit='$requestdrug',  request_food_permit='$requestfood' WHERE id = '$user_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Permission updated successfully."; 
    }
    else {
      $error="Something went wrong. Try again";
    }
}

if(isset($_GET['user_id'])){

    $user_id=$_GET['user_id'];
    $sql="DELETE FROM users WHERE id = '$user_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="User deleted successfully.";
    }
    else {
      $error="Something went wrong. Try again";
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
                            </section>
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
                            </section>
                         <?php } ?>
                         
                        
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a class="au-btn au-btn-icon au-btn--green au-btn--small" href="add-user.php">
                                            <i class="zmdi zmdi-plus"></i>add User</a>
                                        
                                    </div>
                                </div>
                                <div class="">
                                    <table class="table table-striped" id="prison_table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>DATE UPDATED</th>
                                                <th>AVATAR</th>
                                                <th>NAME</th>
                                                <th>USERNAME</th>
                                                <th>TYPE</th>
                                                <th>RANK</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                               <?php 
                                  $i = 1;
                                  $qry = $db->prepare("SELECT *, concat(firstname,' ', coalesce(concat(middlename,' '), '') , lastname) as `name`, users.id, ranks.rank AS rname from `users` JOIN ranks ON ranks.id=users.rank where users.id != '{$_SESSION['id']}' order by concat(firstname,' ', lastname) asc");
                                  $qry->execute();
                                  $results=$qry->fetchAll(PDO::FETCH_OBJ);
                                  foreach($results as $result){ 
                                      $img = '<img src="'.$result->avatar.'" style="width:50px;">';
                                      $status = $result->status;
                                      if ($status == 1) {
                                          $stShow = "Active";
                                          $color = "green";
                                      }else{
                                          $stShow = "Inactive";
                                          $color = "red";
                                      }

                                      if ($result->drug_permit == 1) {
                                          $drugchecked = "checked";
                                      }else{
                                           $drugchecked = "";
                                      }

                                      if ($result->food_permit == 1) {
                                          $foodchecked = "checked";
                                      }else{
                                           $foodchecked = "";
                                      }

                                       if ($result->request_drug_permit == 1) {
                                          $requestdrugchecked = "checked";
                                      }else{
                                           $requestdrugchecked = "";
                                      }

                                       if ($result->request_food_permit == 1) {
                                          $requestfoodchecked = "checked";
                                      }else{
                                           $requestfoodchecked = "";
                                      }
                              ?>
                                            <tr class="">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo date("Y-m-d H:i",strtotime($result->date_updated)) ?></td>
                                                <td><?php echo $img; ?></td>
                                                <td><?php echo $result->name; ?></td>
                                                <td><?php echo $result->username; ?></td>
                                                <td class="text-center">
                                                    <?php if($result->type == 1): ?>
                                                        Administrator
                                                    <?php elseif($result->type == 2): ?>
                                                        Staff
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo $result->rname; ?></td>
                                                <td>
                                                    <div style="color:<?php echo $color;?>"> <?php echo htmlentities($stShow);?></div>
                                                </td>
                                                <td align="center">
                                                 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        Action
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                  </button>
                                                  <div class="dropdown-menu" role="menu">

                                                    <a class="dropdown-item edit-data" href="javascript:void(0)" data-toggle="modal" data-target="#status<?php echo $result->id; ?>"><span class="fa fa-ban text-primary"></span> Status</a>

                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item edit-data" href="javascript:void(0)" data-toggle="modal" data-target="#permit<?php echo $result->id; ?>"><span class="fa fa-certificate text-primary"></span> Permission</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item edit-data" href="edit-user.php?user=<?php echo $result->id; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_data" href="users.php?user_id=<?php echo $result->id; ?>" onclick="return confirm('Are you sure you want to delete this user?')"><span class="fa fa-trash text-danger"></span> Delete</a>
                                                  </div>
                                            </td>
                                            </tr>
    <div class="modal fade" id="status<?php echo $result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT STATUS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <form action="" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $result->id; ?>">
                    <div class="col-12 col-md-12">
                        <label class="switch switch-text switch-success">
                          <input type="checkbox" name="status" class="switch-input" checked="true">
                          <span data-on="On" data-off="Off" class="switch-label"></span>
                          <span class="switch-handle"></span>
                        </label>
                    </div><br>
                <div class="modal-footer">
                <button type="submit" name="updateStatusBtn" class="btn btn-primary">Save changes</button>
              </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>

        <!-- permission ----- -->
        <div class="modal fade" id="permit<?php echo $result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PERMISSION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <form action="" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $result->id; ?>">
                    <div class="col-12 col-md-12">
                        <input class="form-check-input" name="drug"  <?php echo $drugchecked; ?> type="checkbox" value="" id="drug">
                      <label class="form-check-label" for="drug">
                        Permission to Drug Store
                      </label>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input class="form-check-input" name="food" <?php echo $foodchecked; ?> type="checkbox" value="" id="food">
                      <label class="form-check-label" for="food">
                        Permission to Food Store
                      </label>
                    </div>
                    <br>

                    <div class="col-12 col-md-12">
                        <input class="form-check-input" name="requestdrug"  <?php echo $requestdrugchecked; ?> type="checkbox" value="" id="requestdrug">
                      <label class="form-check-label" for="requestdrug">
                        Permit to Drug Request
                      </label>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input class="form-check-input" name="requestfood" <?php echo $requestfoodchecked; ?> type="checkbox" value="" id="requestfood">
                      <label class="form-check-label" for="requestfood">
                        Permit to Food Request
                      </label>
                    </div>

                <div class="modal-footer">
                <button type="submit" name="updatePermissionBtn" class="btn btn-primary">Save changes</button>
              </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
                                            <?php $i++; } ?>

                                        </tbody>
                                    </table>
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

        <!-- modal ----------------------------- -->
        <div class="modal fade" id="addPrisonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD CELL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                     <div class="col-12 col-md-12">
                        <label for="prison_name" class=" form-control-label">Select Prison:</label>
                        <select name="prison_name" id="prison_name" class="form-control">
                            <?php 
                    $prison_tb = "SELECT * FROM prison_list WHERE delete_flag = 0";
                    $prison_tb = $db -> prepare($prison_tb);
                    $prison_tb->execute();
                    $prison_data=$prison_tb->fetchAll(PDO::FETCH_OBJ);
                    
                    if($prison_tb->rowCount() > 0)
                    {
                    foreach($prison_data as $prison_row){   ?>
                                                                
                    <option value="<?php echo htmlentities($prison_row->id);?>"><?php echo htmlentities($prison_row->name);?></option>
                    <?php }} ?>
                        </select>
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="cell_name" class=" form-control-label">Name:</label>
                        <input type="text" id="cell_name" name="cell_name" placeholder="Prison Name"  class="form-control">
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="status" class=" form-control-label">Select Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Please Select Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                <div class="modal-footer">
                <button type="submit" name="addCellBtn" class="btn btn-primary">Add</button>
              </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
        <!-- modal end ------------------------------- -->

    </div>
     

<?php include 'include/footer.php'; ?>
<script>
        $(document).ready(function () {
           $('#prison_table').DataTable();
        });
    
  </script>

  <?php } ?>