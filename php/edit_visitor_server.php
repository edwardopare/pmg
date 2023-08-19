<?php

if(isset($_POST['editVisitorBtn'])){
    
    $visitor_id=$_POST['visitor_id'];
    $inmate_id=$_POST['inmate_id'];
    $fullname=$_POST['fullname'];
    $contact=$_POST['contact'];
    $relation=$_POST['relation'];

    $sql="UPDATE visit_list SET inmate_id=:inmate_id, fullname=:fullname, contact=:contact, relation=:relation WHERE id ='$visitor_id'";
      $query = $db->prepare($sql);
      $query->bindParam(':inmate_id',$inmate_id,PDO::PARAM_STR);
      $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
      $query->bindParam(':contact',$contact,PDO::PARAM_STR);
      $query->bindParam(':relation',$relation,PDO::PARAM_STR);
      $query->execute();
    if($query){
        $msg="Visitor updated successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>