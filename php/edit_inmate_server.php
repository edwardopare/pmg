<?php

if(isset($_POST['editInmateInfoBtn'])){
     
    $inmateId=$_POST['inmateId'];
    $code=$_POST['code'];
    $cell_id=$_POST['cell_id'];
    $firstname=$_POST['firstname'];
    
    $lastname=$_POST['lastname'];
    $dob=$_POST['dob'];
    $sex=$_POST['sex'];
    $address=$_POST['address'];
    $marital_status=$_POST['marital_status'];
    $complexion=$_POST['complexion'];
    $eye_color=$_POST['eye_color'];
    $sentence=$_POST['sentence'];
    $date_from=$_POST['date_from'];
    $date_to=$_POST['date_to'];
    $emergency_name=$_POST['emergency_name'];
    $emergency_relation=$_POST['emergency_relation'];
    $emergency_contact=$_POST['emergency_contact'];
    $court = $_POST['court'];

    if (empty($_POST['middlename'])) {
      $middlename= "";
    }else{
      $middlename= $_POST['middlename'];
    }

    if (empty($_FILES['inmate_image']['name'])) {
        
            $sql="UPDATE inmate_list SET code='$code', firstname='$firstname', middlename='$middlename', lastname='$lastname', sex='$sex', dob='$dob', address='$address', marital_status='$marital_status', eye_color='$eye_color', complexion='$complexion', cell_id='$cell_id', sentence='$sentence', date_from='$date_from', date_to='$date_to', emergency_name='$emergency_name', emergency_contact='$emergency_contact', emergency_relation='$emergency_relation', court='$court' WHERE id ='$inmateId'";
          $query = $db->prepare($sql);
          $query->execute();

          $crime_delete = $db->prepare("DELETE FROM inmate_crimes WHERE inmate_id='$inmateId'");
                    $crime_delete->execute();

          for($x = 0; $x < count($_POST['crime_ids']); $x++) {

            $crime_insert = $db->prepare("INSERT INTO inmate_crimes (inmate_id , crime_id) 
                    VALUES ('$inmateId', '".$_POST['crime_ids'][$x]."')");
                    $crime_insert->execute();
        }
        if($query){
            $msg="Inmate updated successfully.";
        }
        else {
          $error="Error. Try again";
        }
    }else{
            $uploaddir = 'uploads/avatars/';
            $uploadfile = $uploaddir . basename($_FILES['inmate_image']['name']);

        if (move_uploaded_file($_FILES['inmate_image']['tmp_name'], $uploadfile)) {

        $sql="UPDATE inmate_list SET code='$code', firstname='$firstname', middlename='$middlename', lastname='$lastname', sex='$sex', dob='$dob', address='$address', marital_status='$marital_status', eye_color='$eye_color', complexion='$complexion', cell_id='$cell_id', sentence='$sentence', date_from='$date_from', date_to='$date_to', emergency_name='$emergency_name', emergency_contact='$emergency_contact', emergency_relation='$emergency_relation', image_path='$uploadfile' WHERE id ='$inmateId'";
          $query = $db->prepare($sql);
          $query->execute();

          $crime_delete = $db->prepare("DELETE FROM inmate_crimes WHERE inmate_id='$inmateId'");
                    $crime_delete->execute();

          for($x = 0; $x < count($_POST['crime_ids']); $x++) {

            $crime_insert = $db->prepare("INSERT INTO inmate_crimes (inmate_id , crime_id) 
                    VALUES ('$inmateId', '".$_POST['crime_ids'][$x]."')");
                    $crime_insert->execute();
        }
        if($query){
            $msg="Inmate updated successfully.";
        }
        else {
          $error="Error. Try again";
        }
      }
    }
    
}
 ?>