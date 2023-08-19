<?php 
  session_start();
if(empty($_SESSION['user'])) {
    echo "<script> location.href='logout.php';</script>";
}else{
 ?>
<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>
<?php include 'php/add_action_server.php'; ?>
<?php include 'php/edit_action_server.php'; ?>
<?php include 'php/delete_action_server.php'; ?>
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
                                <h3 class="title-5 m-b-35">ACTION LIST</h3>
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
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addActionModal">
                                            <i class="zmdi zmdi-plus"></i>add action</button>
                                        
                                    </div>
                                </div>
                                <div class="">
                                    <table class="table table-striped" id="prison_table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NAME</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
                    $i = 1;
                        $qry = $db->prepare("SELECT * FROM action_list WHERE delete_flag = 0 ORDER BY name ASC");
                        $qry->execute();
                        $results=$qry->fetchAll(PDO::FETCH_OBJ);
                        foreach($results as $result){ 
                            $status = $result->status;
                            if ($status == 1) {
                                $stShow = "Active";
                                $color = "green";
                            }else{
                                $stShow = "Inactive";
                                $color = "red";
                            }
                    ?>
                                            <tr class="">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result->name; ?></td>
                                                <td>
                                                    <div style="color:<?php echo $color;?>"> <?php echo htmlentities($stShow);?></div>
                                                </td>
                                                <td align="center">
                                                 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        Action
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                  </button>
                                                  <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item edit-data" href="javascript:void(0)" data-toggle="modal" data-target="#edit<?php echo $result->id; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_data" href="action.php?a_id=<?php echo $result->id; ?>" onclick="return confirm('Are you sure you want to delete this action?')"><span class="fa fa-trash text-danger"></span> Delete</a>
                                                  </div>
                                            </td>
                                            </tr>
    <div class="modal fade" id="edit<?php echo $result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT CRIME</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="a_id" value="<?php echo $result->id; ?>">
                    <div class="col-12 col-md-12">
                        <label for="action_name" class=" form-control-label">Name:</label>
                        <input type="text" id="action_name" name="action_name" value="<?php echo $result->name; ?>" placeholder="Action Name"  class="form-control">
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="status" class=" form-control-label">Select Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="<?php echo $result->status; ?>"><?php echo $stShow; ?></option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                <div class="modal-footer">
                <button type="submit" name="EditActionBtn" class="btn btn-primary">Save changes</button>
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
        <div class="modal fade" id="addActionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD ACTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    <div class="col-12 col-md-12">
                        <label for="action_name" class=" form-control-label">Name:</label>
                        <input type="text" id="action_name" name="action_name" placeholder="Action Name"  class="form-control">
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
                <button type="submit" name="addActionBtn" class="btn btn-primary">Add</button>
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