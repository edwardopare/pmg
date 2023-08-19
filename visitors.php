<?php 
  session_start();
if(empty($_SESSION['user'])) {
    echo "<script> location.href='logout.php';</script>";
}else{
 ?>
<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>
<?php include 'php/add_visitor_server.php'; ?>
<?php include 'php/edit_visitor_server.php'; ?>
<?php

if(isset($_GET['vis_id'])){

    $vis_id=$_GET['vis_id'];
    $sql="DELETE FROM visit_list WHERE id = '$vis_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Visitor record deleted successfully.";
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
                                <h3 class="title-5 m-b-35">VISITOR LIST</h3>
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
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addCrimeModal">
                                            <i class="zmdi zmdi-plus"></i>add record</button>
                                        
                                    </div>
                                </div>
                                <div class="">
                                    <table class="table table-striped" id="prison_table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>DATE</th>
                                                <th>INMATE</th>
                                                <th>VISITOR</th>
                                                <th>CONTACT</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
                    $i = 1;
                        $qry = $db->prepare("SELECT v.*, i.code, concat(i.lastname,', ', i.firstname, coalesce(concat(' ', i.middlename), '')) as `inmate` from `visit_list` v inner join inmate_list i on v.inmate_id = i.id order by abs(unix_timestamp(v.date_created)) desc");
                        $qry->execute();
                        $results=$qry->fetchAll(PDO::FETCH_OBJ);
                        foreach($results as $result){ 
                        
                    ?>
                                            <tr class="">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo date("Y-m-d H:i",strtotime($result->date_created)) ?></td>
                                                <td>
                                                    <div style="line-height:1em">
                                                        <div><b><?php echo $result->inmate; ?></b></div>
                                                        <div>Inmate - <?php echo $result->code; ?></div>
                                                    </div>      
                                                </td>
                                                <td>
                                                    <div style="line-height:1em">
                                                        <div><b><?php echo $result->fullname; ?></b></div>
                                                        <div>Inmate - <?php echo $result->relation; ?></div>
                                                    </div>      
                                                </td>
                                                <td><?php echo $result->contact; ?></td>

                                                <td align="center">
                                                 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        Action
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                  </button>
                                                  <div class="dropdown-menu" role="menu">
                                                    
                                                    <a class="dropdown-item edit-data" href="javascript:void(0)" data-toggle="modal" data-target="#edit<?php echo $result->id; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_data" href="visitors.php?vis_id=<?php echo $result->id; ?>" onclick="return confirm('Are you sure you want to delete this visiting record?')"><span class="fa fa-trash text-danger"></span> Delete</a>
                                                  </div>
                                            </td>
                                            </tr>
    <div class="modal fade" id="edit<?php echo $result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT VISITOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="visitor_id" value="<?php echo $result->id; ?>">
                    <div class="col-12 col-md-12">
                        <label for="inmate_id " class=" form-control-label">Inmate:</label>
                       <select name="inmate_id" id="inmate_id" class="form-control" required>
                        <option value="<?php echo $result->inmate_id; ?>"><?php echo $result->code; ?></option>
                            <?php 
                            $inmate_qry = "SELECT * FROM inmate_list WHERE delete_flag = 0 AND visiting_privilege=1";
                            $inmate_qry = $db -> prepare($inmate_qry);
                            $inmate_qry->execute();
                            $inmate_data=$inmate_qry->fetchAll(PDO::FETCH_OBJ);
                            
                            if($inmate_qry->rowCount() > 0)
                            {
                            foreach($inmate_data as $inmate_row){   ?>
                                                                        
                            <option value="<?php echo htmlentities($inmate_row->id);?>"><?php echo htmlentities($inmate_row->code);?></option>
                            <?php }} ?>
                        </select>
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="fullname" class=" form-control-label">Visitor's Name:</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Visitor's Name"  class="form-control" value="<?php echo $result->fullname; ?>" required>
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="contact" class=" form-control-label">Contact:</label>
                        <input type="text" id="contact" name="contact" placeholder="Contact"  class="form-control" value="<?php echo $result->contact; ?>" required>
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="relation" class=" form-control-label">Relation:</label>
                        <input type="text" id="relation" name="relation" placeholder="Relation"  class="form-control" value="<?php echo $result->relation; ?>" required>
                    </div><br>
                <div class="modal-footer">
                <button type="submit" name="editVisitorBtn" class="btn btn-primary">Update</button>
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
        <div class="modal fade" id="addCrimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD VISITOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    <div class="col-12 col-md-12">
                        <label for="inmate_id " class=" form-control-label">Inmate:</label>
                       <select name="inmate_id" id="inmate_id" class="form-control" required>
                            <?php 
                            $inmate_qry = "SELECT * FROM inmate_list WHERE delete_flag = 0 AND visiting_privilege=1";
                            $inmate_qry = $db -> prepare($inmate_qry);
                            $inmate_qry->execute();
                            $inmate_data=$inmate_qry->fetchAll(PDO::FETCH_OBJ);
                            
                            if($inmate_qry->rowCount() > 0)
                            {
                            foreach($inmate_data as $inmate_row){   ?>
                                                                        
                            <option value="<?php echo htmlentities($inmate_row->id);?>"><?php echo htmlentities($inmate_row->code);?></option>
                            <?php }} ?>
                        </select>
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="fullname" class=" form-control-label">Visitor's Name:</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Visitor's Name"  class="form-control" required>
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="contact" class=" form-control-label">Contact:</label>
                        <input type="text" id="contact" name="contact" placeholder="Contact"  class="form-control" required>
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="relation" class=" form-control-label">Relation:</label>
                        <input type="text" id="relation" name="relation" placeholder="Relation"  class="form-control" required>
                    </div><br>
                <div class="modal-footer">
                <button type="submit" name="addVisitorBtn" class="btn btn-primary">Add</button>
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

  <script>
        /*$(document).ready(function() {
            $('#inmate_id').select2({
            closeOnSelect: false
            });
        });*/
  </script>

  <?php } ?>