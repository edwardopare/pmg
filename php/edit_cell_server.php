<?php

if(isset($_POST['EditCellBtn'])){

    $prison_id=$_POST['prison_name'];
    $cell_name=$_POST['cell_name'];
    $status=$_POST['status'];
    $cell_id=$_POST['cell_id'];

    $sql="UPDATE cell_list SET prison_id=:prison_id, name=:cell_name, status=:status WHERE id = '$cell_id'";
      $query = $db->prepare($sql);
      $query->bindParam(':prison_id',$prison_id,PDO::PARAM_STR);
      $query->bindParam(':cell_name',$cell_name,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
    if($query){
       $msg="Cell updated successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>