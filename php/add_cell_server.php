<?php

if(isset($_POST['addCellBtn'])){

    $prison_name=$_POST['prison_name'];
    $cell_name=$_POST['cell_name'];
    $status=$_POST['status'];

    $sql="INSERT INTO cell_list(prison_id, name, status) VALUES(:prison_name, :cell_name, :status)";
      $query = $db->prepare($sql);
      $query->bindParam(':prison_name',$prison_name,PDO::PARAM_STR);
      $query->bindParam(':cell_name',$cell_name,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $db->lastInsertId();
    if($lastInsertId){
        $msg="Cell added successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>