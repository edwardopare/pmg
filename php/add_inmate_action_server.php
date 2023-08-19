<?php

if(isset($_POST['AddReportActionBtn'])){

    $action=$_POST['action'];
    $action_date=$_POST['action_date'];
    $remark=$_POST['remark'];
    $inmate_id=$_POST['inmate_id'];

    $sql="INSERT INTO record_list(inmate_id, action_id, remarks, date) VALUES(:inmate_id, :action, :remark, :action_date)";
      $query = $db->prepare($sql);
      $query->bindParam(':inmate_id',$inmate_id,PDO::PARAM_STR);
      $query->bindParam(':action',$action,PDO::PARAM_STR);
      $query->bindParam(':remark',$remark,PDO::PARAM_STR);
      $query->bindParam(':action_date',$action_date,PDO::PARAM_STR);
      $query->execute();
    if($query){
       $msg="Record added successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>