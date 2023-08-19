<?php

if(isset($_POST['addInmateInfoBtn'])){

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
    //$img=$_POST['img'];
    
    if (empty($_POST['middlename'])) {
      $middlename= "";
    }else{
      $middlename= $_POST['middlename'];
    }
    $uploaddir = 'uploads/avatars/';
    $uploadfile = $uploaddir . basename($_FILES['inmate_image']['name']);

    if (move_uploaded_file($_FILES['inmate_image']['tmp_name'], $uploadfile)) {

    $sql="INSERT INTO inmate_list(code, firstname, middlename, lastname, sex, dob, address, marital_status, eye_color, complexion, cell_id, sentence, date_from, date_to, emergency_name, emergency_contact, emergency_relation, image_path, court) VALUES('$code', '$firstname', '$middlename', '$lastname', '$sex', '$dob', '$address', '$marital_status', '$eye_color', '$complexion', '$cell_id', '$sentence', '$date_from', '$date_to', '$emergency_name', '$emergency_contact', '$emergency_relation', '$uploadfile', '$court')";
      $query = $db->prepare($sql);
      $query->execute();
      $lastInsertId = $db->lastInsertId();

      for($x = 0; $x < count($_POST['crime_ids']); $x++) {

        $crime_insert = $db->prepare("INSERT INTO inmate_crimes (inmate_id , crime_id) 
                VALUES ('$lastInsertId', '".$_POST['crime_ids'][$x]."')");
                $crime_insert->execute();
    }
    if($lastInsertId){
        $msg="Inmate added successfully.";
    }
    else {
      $error="Error. Try again";
    }
  }
}
 ?>