<?php

if(isset($_GET['inm_id'])){

    $inm_id=$_GET['inm_id'];
    $sql="UPDATE inmate_list SET delete_flag=1 WHERE id = '$inm_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Inmate deleted successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>