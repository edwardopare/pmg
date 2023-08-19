<?php

if(isset($_POST['addVisitorBtn'])){

    $inmate_id=$_POST['inmate_id'];
    $fullname=$_POST['fullname'];
    $contact=$_POST['contact'];
    $relation=$_POST['relation'];

    $sql="INSERT INTO visit_list(inmate_id, fullname, contact, relation) VALUES(:inmate_id, :fullname, :contact, :relation)";
      $query = $db->prepare($sql);
      $query->bindParam(':inmate_id',$inmate_id,PDO::PARAM_STR);
      $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
      $query->bindParam(':contact',$contact,PDO::PARAM_STR);
      $query->bindParam(':relation',$relation,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $db->lastInsertId();
    if($lastInsertId){
        $msg="Visitor added successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>