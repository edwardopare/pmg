<?php

if(isset($_GET['a_id'])){

    $a_id=$_GET['a_id'];
    $sql="DELETE FROM action_list WHERE id = '$a_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Action deleted successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>