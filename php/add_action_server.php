<?php

if(isset($_POST['addActionBtn'])){

    $action_name=$_POST['action_name'];
    $status=$_POST['status'];

    $sql="INSERT INTO action_list(name, status) VALUES(:action_name, :status)";
      $query = $db->prepare($sql);
      $query->bindParam(':action_name',$action_name,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $db->lastInsertId();
    if($lastInsertId){
        $msg="Action added successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>