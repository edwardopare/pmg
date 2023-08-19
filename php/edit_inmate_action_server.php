<?php

if(isset($_POST['EditActionBtn'])){

    $action=$_POST['action'];
    $action_date=$_POST['action_date'];
    $remark=$_POST['remark'];
    $record_id=$_POST['record_id'];

    $sql="UPDATE record_list SET action_id =:action, remarks=:remark, date=:action_date WHERE id = '$record_id'";
      $query = $db->prepare($sql);
      $query->bindParam(':action',$action,PDO::PARAM_STR);
      $query->bindParam(':remark',$remark,PDO::PARAM_STR);
      $query->bindParam(':action_date',$action_date,PDO::PARAM_STR);
      $query->execute();
    if($query){
       $msg="Record updated successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>