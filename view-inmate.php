<?php 
  session_start();
if(empty($_SESSION['user'])) {
    echo "<script> location.href='logout.php';</script>";
}else{
 ?>
<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>
<?php include 'php/edit_inmate_action_server.php'; ?>
<?php include 'php/add_inmate_action_server.php'; ?>
<?php

if(isset($_GET['inm_id'])){

    $inm_id=$_GET['inm_id'];
    $sql="UPDATE inmate_list SET delete_flag=1 WHERE id = '$inm_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       //$msg="Inmate deleted successfully.";
       echo "<script>
       alert('Inmate deleted successfully.');
       location.href='inmate.php';
       </script>";
    }
    else {
        echo "<script>
       alert('Something went wrong. Try again.');
       location.href='view-inmate.php';
       </script>";
      //$error="Something went wrong. Try again";
    }
}

if (isset($_POST['updatePrivilegeBtn'])) {
            
    if(isset($_POST['pri_check'])){
         $pri_check = 1;
      }else{
         $pri_check = 0;
      }

      $inmate_id = $_POST['inmate_id'];
       $sql="UPDATE inmate_list SET visiting_privilege='$pri_check' WHERE id = '$inmate_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Inmate privilege set successfully.";
    }
    else {
      $error="Something went wrong. Try again";
    }
}

if(isset($_GET['record_id'])){

    $record_id=$_GET['record_id'];
    $sql="DELETE FROM record_list WHERE id = '$record_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Record deleted successfully.";
    }
    else {
      $error="Something went wrong. Try again";
    }
}
 ?>

<style type="text/css">
    #printHeader {display: none;}
    @media print {
      #cimg {
        width: 150px;
      }
      .card-block {
        display: block;
        position: relative;
      }
      #printHeader {display: block;}

      .bg-gradient-secondary {background-color: #000; color: #fff; font-weight: bold; text-transform: uppercase;}

        html, body{
        min-height:unset !important;
      }
    }
</style>

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
                                <h3 class="title-5 m-b-35">INMATE INFO</h3>
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
        <div class="card rounded-0 shadow">
            <div class="card-header py-1 text-center">
                <div class="card-tools" style="float: right;">

                <button class="btn btn-flat btn-sm btn-light bg-gradient-light border" id="print" type="button" onclick="printDiv('inmate_print')"><i class="fa fa-print"></i>Print</button>

                <button class="btn btn-flat btn-sm btn-primary bg-gradient-primary border" id="update_privilege" data-toggle="modal" data-target="#updatePrivilegeModal" type="button">Update Privilege</button>

                <?php 
                if ($_SESSION['type'] == 1) { ?>
                    <a class="btn btn-flat btn-sm btn-danger bg-gradient-danger border" id="delete-inmate" href="view-inmate.php?inm_id=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to delete this Inmate?')"><i class="fa fa-trash"></i> Delete</a>
                <?php }else{}
                ?>

                <a class="btn btn-flat btn-sm btn-navy bg-gradient-navy border" href="edit-inmate.php?id=<?php echo $_GET['id']; ?>"><i class="fa fa-edit"></i> Edit</a>

                <a class="btn btn-flat btn-sm btn-light bg-gradient-light border" href="inmate.php"><i class="fa fa-angle-left"></i> Back to List</a>
                </div>
            </div>
        </div> 

        <div class="card rounded-0 shadow">
            <div class="card-header py-1 text-center">
                <div class="card-tools" style="float: right;">
                    <?php 
                    $view_inmate_id = $_GET['id'];
                     $qry_1 = $db->prepare("SELECT status, visiting_privilege FROM inmate_list WHERE id ='$view_inmate_id'");
                        $qry_1->execute();
                        $results_vi=$qry_1->fetchAll(PDO::FETCH_OBJ);
                        foreach($results_vi as $vi_data){ 
                            $status = $vi_data->status;
                            if ($status == 1) {
                                $stShow = "Active";
                                $scolor = "green";
                            }else{
                                $stShow = "Inactive";
                                $scolor = "red";
                            }

                            if ($vi_data->visiting_privilege == 1) {
                                $visiting = "Allowed";
                                $color = "green";
                            }else{
                                $visiting = "Reject";
                                $color = "red";
                            }
                        }

                    ?>
                    <div style="color: #000; font-weight: bold; text-transform: uppercase;">Inmate's Status:&nbsp; <span style="color: <?php echo $scolor; ?>"> <?php echo  $stShow; ?></span></div>
                    <div style="color: #000; font-weight: bold; text-transform: uppercase;">Visiting Status: &nbsp; <span style="color: <?php echo $color; ?>"> <?php echo  $visiting; ?></span></div>
                    
                  
                </div>
            </div>
        </div>
                 <div id="inmate_print" class="inmate_print">
                  <div class="card">
                    <div class="card-body card-block">
                        <div class="d-flex w-100 align-items-center printHeader">
                            <div class="col-4 text-center" id="printHeader">
                                <img src="images/pmslogo.png" alt="" class="rounded-circle border" style="width: 5em;height: 5em;object-fit:cover;object-position:center center; margin-left: 100px;">
                            </div>
                            <div class="col-8" id="printHeader">
                                <div style="line-height:1em; margin-left: -350px;">
                                    <div class="text-center font-weight-bold h5 mb-0"><large>GHANA PRISON MANAGEMENT SYSTEM</large></div>
                                    <div class="text-center font-weight-bold h5 mb-0"><large>INMATE's DETAILS</large></div>
                                </div>
                            </div>
                        </div><br><br>
                    <!-- ------------------- -->
                    <?php 
                     $i = 1;
                        $view_inmate_id = $_GET['id'];

                        $stmt = $db->prepare("SELECT inmate_crimes.cid, crime_list.name AS crimeName FROM crime_list JOIN inmate_crimes ON inmate_crimes.crime_id=crime_list.id JOIN inmate_list ON inmate_list.id=inmate_crimes.inmate_id WHERE inmate_list.id='$view_inmate_id'");
                        $stmt->execute(array());
                        

                        $qry = $db->prepare("SELECT inmate_list.*, cell_list.name AS cellName FROM inmate_list JOIN cell_list ON cell_list.id=inmate_list.cell_id WHERE inmate_list.id ='$view_inmate_id'");
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
                    <div class="row align-items-center" style="color: #000;">
                        <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                            <img src="<?php echo $result->image_path; ?>" alt="Inmate image" class="img-thumbnail rounded-0 bg-gradient-dark border p-0 border-4 border-dark" id="cimg">
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">
                            <div class="d-flex w-100">
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Inmate Code</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->code; ?></div>
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Cell Block</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->cellName; ?></div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Name</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->firstname.' '.$result->middlename.', '.$result->lastname; ?></div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Sex</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->sex; ?></div>
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Birthday</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo date("F d, Y", strtotime($result->dob)); ?></div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Address</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->address; ?></div>
                            </div>
                            <div class="d-flex w-100">
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Marital Status</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->marital_status; ?></div>
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Complexion</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->complexion; ?></div>
                                <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Eye Color</div>
                                <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->eye_color; ?></div>
                            </div>
                        </div>
                    </div>
                    <fieldset class="border px-2 pb-2" style="color: #000;">
                        <legend class="w-auto mx-3 px-2">Case Details</legend>
                        <div class="d-flex w-100">
                            <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Crimes Committed</div>
                            <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php 
                            while($row = $stmt->fetch()) {
                              echo $row['crimeName'].', ';
                            }
                             ?></div>
                             <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Court </div>
                            <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->court; ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Sentence</div>
                            <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->sentence; ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Time Serve Starts</div>
                            <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo date("M d, Y", strtotime($result->date_from)) ?></div>
                            <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Time Serve Ends</div>
                            <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo date("M d, Y", strtotime($result->date_to)) ?></div>
                        </div>
                    </fieldset>
                    <fieldset class="border px-2 pb-2" style="color: #000;">
                        <legend class="w-auto mx-3 px-2">Emergency Contact Details</legend>
                        <div class="d-flex w-100">
                            <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Name</div>
                            <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->emergency_name; ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Relation</div>
                            <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->emergency_relation; ?></div>
                            <div class="col-auto m-0 border bg-gradient-secondary btn btn-info">Contact #</div>
                            <div class="col-auto m-0 border flex-shrink-1 flex-grow-1"><?php echo $result->emergency_contact; ?></div>
                        </div>
                    </fieldset>
                <?php } ?>
                    </div>
                    </div>
                    </div>

           <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                <div class="card-title" style="color: #000; text-transform: uppercase;"><b>Inmate's History Record</b></div>
            </div>
            <div class="col-sm-6">
                <div class="card-tools" style="float: right;">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addRecordModal">
                                            <i class="zmdi zmdi-plus"></i>add Record</button>
                </div>
            </div>
                </div>
            </div>
        </div>
                    <table class="table table-striped" id="prison_table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>DATE</th>
                                                <th>ACTION</th>
                                                <th>REMARK</th>
                                                <th>ACTIVITY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
                        $i = 1;
                        $qry = $db->prepare("SELECT r.*,a.name as `action` FROM `record_list` r inner join `action_list` a on r.action_id = a.id where r.`inmate_id` ='{$view_inmate_id}' order by date(r.`date`) asc, abs(unix_timestamp(r.date_created)) asc");
                        $qry->execute();
                        $results=$qry->fetchAll(PDO::FETCH_OBJ);
                        foreach($results as $row){ 
                            
                    ?>
                                            <tr class="">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo date("M d, Y", strtotime($row->date)) ?></td>
                                                <td><?php echo $row->action; ?></td>
                                                <td><?php echo $row->remarks; ?></td>
                                                <td align="center">
                                                 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        Action
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                  </button>
                                                  <div class="dropdown-menu" role="menu">
                                                    
                                                    <a class="dropdown-item edit-data" href="javascript:void(0)" data-toggle="modal" data-target="#edit<?php echo $row->id; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_data" href="view-inmate.php?record_id=<?php echo $row->id; ?>&view_inmate&id=<?php echo $view_inmate_id; ?>" onclick="return confirm('Are you sure you want to delete this record?')"><span class="fa fa-trash text-danger"></span> Delete</a>
                                                  </div>
                                            </td>
                                            </tr>
    <div class="modal fade" id="edit<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT ACTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="record_id" value="<?php echo $row->id; ?>">
                    <div class="col-12 col-md-12">
                        <label for="action_date" class=" form-control-label">Date:</label>
                        <input type="date" id="action_date" name="action_date" value="<?php echo $row->date; ?>" class="form-control">
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="action" class=" form-control-label">Select Action:</label>
                        <select name="action" id="action" class="form-control">
                            <option value="<?php echo $row->action_id; ?>"><?php echo $row->action; ?></option>
                            <?php 
                                $report_fe = $db->prepare("SELECT * FROM `action_list` where delete_flag = 0 and `status` = 1 order by `name` asc ");
                                $report_fe->execute();
                                $rep_results=$report_fe->fetchAll(PDO::FETCH_OBJ);
                                    foreach($rep_results as $val){ 
                                ?>
                                <option value="<?php echo($val->id) ?>"><?php echo $val->name; ?></option>
                                <?php } ?>
                        </select>
                    </div><br>

                    <div class="col-12 col-md-12">
                        <label for="remark" class=" form-control-label">Remark:</label>
                        <textarea rows="5" class="form-control" name="remark" id="remark" required="required"><?php echo $row->remarks; ?></textarea>
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

    <div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD RECORD ACTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="inmate_id" value="<?php echo $view_inmate_id; ?>">
                    <div class="col-12 col-md-12">
                        <label for="action_date" class=" form-control-label">Date:</label>
                        <input type="date" id="action_date" name="action_date" class="form-control">
                    </div><br>
                    <div class="col-12 col-md-12">
                        <label for="action" class=" form-control-label">Select Action:</label>
                        <select name="action" id="action" class="form-control">
                            <?php 
                                $action_re = $db->prepare("SELECT * FROM `action_list` WHERE delete_flag = 0 AND `status` = 1 ORDER BY `name` ASC ");
                                $action_re->execute();
                                $act_results=$action_re->fetchAll(PDO::FETCH_OBJ);
                                    foreach($act_results as $act_val){ 
                                ?>
                                <option value="<?php echo($act_val->id) ?>"><?php echo $act_val->name; ?></option>
                                <?php } ?>
                        </select>
                    </div><br>

                    <div class="col-12 col-md-12">
                        <label for="remark" class=" form-control-label">Remark:</label>
                        <textarea rows="5" class="form-control" name="remark" id="remark" required="required"></textarea>
                    </div>
                <div class="modal-footer">
                <button type="submit" name="AddReportActionBtn" class="btn btn-primary">Save changes</button>
              </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>

        <!-- privilege modal ---------------------------- -->
        <div class="modal fade" id="updatePrivilegeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">UPDATE INMATE PRIVILEGE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="inmate_id" value="<?php echo $view_inmate_id; ?>">
                    <div class="col-12 col-md-12">
                        <label class="switch switch-text switch-success">
                          <input type="checkbox" name="pri_check" class="switch-input" checked="true">
                          <span data-on="On" data-off="Off" class="switch-label"></span>
                          <span class="switch-handle"></span>
                        </label>
                    </div><br>
                <div class="modal-footer">
                <button type="submit" name="updatePrivilegeBtn" class="btn btn-primary">Save changes</button>
              </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
     

<?php include 'include/footer.php'; ?>
<script>
        $(document).ready(function(){
            $('#crime_ids').select2({
            })
        })
  </script>

  <script>
        $(document).ready(function () {
           $('#prison_table').DataTable();
        });
    
  </script>

 <script type="text/javascript">
        function printDiv(divName) {
             var printContents = document.getElementById(divName).innerHTML;
             var originalContents = document.body.innerHTML;

             document.body.innerHTML = printContents;

             window.print();

             document.body.innerHTML = originalContents;
        }
    </script>

  <?php } ?>