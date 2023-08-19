<?php

if(isset($_POST['EditActionBtn'])){

    $action_name=$_POST['action_name'];
    $status=$_POST['status'];
    $a_id=$_POST['a_id'];
    $sql="UPDATE action_list SET name=:action_name, status=:status WHERE id = '$a_id'";
      $query = $db->prepare($sql);
      $query->bindParam(':action_name',$action_name,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
    if($query){
       $msg="Action updated successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>