<?php 
  session_start();
if(empty($_SESSION['user'])) {
    echo "<script> location.href='logout.php';</script>";
}else{
 ?>
<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>
<?php include 'php/edit_inmate_server.php'; ?>
<?php include 'php/edit_cell_server.php'; ?>
<?php include 'php/delete_cell_server.php'; ?>

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


             <?php 
                     $i = 1;
                        $view_inmate_id = $_GET['id'];

                        $stmt = $db->prepare("SELECT inmate_crimes.cid, crime_list.name AS crimeName FROM crime_list JOIN inmate_crimes ON inmate_crimes.crime_id=crime_list.id JOIN inmate_list ON inmate_list.id=inmate_crimes.inmate_id WHERE inmate_list.id='$view_inmate_id'");
                        $stmt->execute(array());
                        

                        $qry = $db->prepare("SELECT inmate_list.*, cell_list.name AS cellName FROM inmate_list JOIN cell_list ON cell_list.id=inmate_list.cell_id WHERE inmate_list.id ='$view_inmate_id'");
                        $qry->execute();
                        $results=$qry->fetchAll(PDO::FETCH_OBJ);
                        foreach($results as $val){ 
                            $status = $val->status;
                            if ($status == 1) {
                                $stShow = "Active";
                                $color = "green";
                            }else{
                                $stShow = "Inactive";
                                $color = "red";
                            }
                    ?>
                  <div class="card">
                    <div class="card-body card-block">
                    <form action="" method="post" id="inmate-form" enctype="multipart/form-data">
                        <input type="hidden" name="inmateId" value="<?php echo($val->id) ?>">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="code" class="control-label">Code</label>
                                    <input type="text" class="au-input au-input--full" name="code" id="code" value="<?php echo($val->code); ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="cell_id" class="control-label">Prison & Cell Block</label>
                                        <select class="form-control" name="cell_id" id="cell_id" required="required">
                                            <option value="<?php echo($val->cell_id); ?>"><?php echo($val->cellName); ?></option>
                                            <?php 
                                            $cells = $db->prepare("SELECT c.*, p.name as `prison` FROM `cell_list` c inner join prison_list p on c.prison_id = p.id where c.delete_flag = 0 and c.`status` = 1 order by c.`name` asc ");
                                            $cells->execute();
                                            $results=$cells->fetchAll(PDO::FETCH_OBJ);
                                            foreach($results as $result){ 
                                            ?>
                                            <option value="<?php echo($result->id) ?>"><?php echo $result->prison . " - " . $result->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="firstname" class="control-label">First Name</label>
                                    <input type="text" class="au-input au-input--full" name="firstname" id="firstname" value="<?php echo($val->firstname); ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="middlename" class="control-label">Middle Name</label>
                                    <input type="text" class="au-input au-input--full" name="middlename" id="middlename" value="<?php echo($val->middlename); ?>" placeholder="optional">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="lastname" class="control-label">Last Name</label>
                                    <input type="text" class="au-input au-input--full" name="lastname" id="lastname" value="<?php echo($val->lastname); ?>" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="dob" class="control-label">Birthday</label>
                                    <input type="date" class="au-input au-input--full" value="<?php echo($val->dob); ?>" name="dob" id="dob" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="sex" class="control-label">Sex</label>
                                    <select class="form-control" name="sex" id="sex" required="required">
                                        <option value="<?php echo($val->sex); ?>"><?php echo($val->sex); ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="address" class="control-label">Address</label>
                                    <textarea rows="2" class="form-control" name="address" id="address" required="required"><?php echo($val->address); ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="court" class="control-label">Court</label>
                                    <select class="form-control" name="court" id="court" required="required">
                                    <option value="Circuit_court">Circuit Court</option>
                                    <option value="High_court">High Court</option>
                                    <option value="Supreme_court">Supreme Court</option>
                                    <option value="Mangoase_court">Mangoase Court</option>
                                    <option value="District_court">District Court</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="marital_status" class="control-label">Marital Status</label>
                                    <select class="form-control" name="marital_status" id="marital_status" required="required">
                                        <option value="<?php echo($val->marital_status); ?>"><?php echo($val->marital_status); ?></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widower">Widower</option>
                                    <option value="Widow">Widow</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="complexion" class="control-label">Complexion</label>
                                    <input type="complexion" class="au-input au-input--full" name="complexion" value="<?php echo($val->complexion); ?>" id="complexion" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="eye_color" class="control-label">Eye Color</label>
                                    <input type="text" class="au-input au-input--full" value="<?php echo($val->eye_color); ?>" name="eye_color" id="eye_color" required>
                                </div>
                            </div>
                        </div>
                        <fieldset class="border px-2 py-2">
                            <legend class="w-auto mx-3" >Case Details</legend>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="crime_ids" class="control-label">Crime Committed</label>
                                        <select class="form-control" name="crime_ids[]" id="crime_ids" required="required" multiple>
                                            <?php 
                                             while($row_1 = $stmt->fetch()) {
                                            $crimes = $db->prepare("SELECT * FROM `crime_list` where delete_flag = 0 and `status` = 1 order by `name` asc ");
                                            $crimes->execute();
                                            $results=$crimes->fetchAll(PDO::FETCH_OBJ);
                                                foreach($results as $row){ 
                                                    if ($row_1['crimeName'] == $row->name) { ?>
                                                        <option value="<?php echo($row->id) ?>" selected><?php echo $row->name; ?></option>
                                                   <?php }else{ ?>
                                                         <option value="<?php echo($row->id) ?>"><?php echo $row->name; ?></option>
                                                  <?php }  } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="sentence" class="control-label">Sentence</label>
                                        <input type="sentence" class="au-input au-input--full" name="sentence" id="sentence" value="<?php echo($val->sentence); ?>" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="date_from" class="control-label">Time Serve Start</label>
                                        <input type="date" class="au-input au-input--full" name="date_from" id="date_from" value="<?php echo($val->date_from); ?>" required="required">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="date_to" class="control-label">Time Serve Ends</label>
                                        <input type="date" class="au-input au-input--full" value="<?php echo($val->date_to); ?>" name="date_to" id="date_to">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border px-2 py-2">
                            <legend class="w-auto mx-3" >Emergency Contact Detials</legend>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_name" class="control-label">Name</label>
                                        <input type="emergency_name" class="au-input au-input--full" name="emergency_name" id="emergency_name" value="<?php echo($val->emergency_name); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_relation" class="control-label">Relation</label>
                                        <input type="text" class="au-input au-input--full" name="emergency_relation" id="emergency_relation" value="<?php echo($val->emergency_relation); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_contact" class="control-label">Contact #</label>
                                        <input type="text" class="au-input au-input--full" name="emergency_contact" id="emergency_contact" value="<?php echo($val->emergency_contact); ?>">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border px-2 py-2">
                            <legend class="w-auto mx-3" >Image</legend>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="control-label">Inamate Image</label>
                                        <div class="custom-file custom-file-sm rounded-0">
                                            <input type="file" class="form-control-file" id="customFile1" name="inmate_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                            <label class="custom-file-label rounded-0" for="customFile1">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <img id="blah" src="<?php echo($val->image_path); ?>" alt="Preview Will Show Here" style="height: 150px; width: 40%;" />
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="card-footer">
                                        <button type="submit" name="editInmateInfoBtn" class="btn btn-primary btn-xl">
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
        $(document).ready(function(){
            $('#crime_ids').select2({
            })
        })
  </script>

  <?php } ?>