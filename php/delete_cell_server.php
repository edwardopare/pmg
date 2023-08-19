<?php

if(isset($_GET['c_id'])){

    $c_id=$_GET['c_id'];
    $sql="DELETE FROM cell_list WHERE id = '$c_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Cell deleted successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>