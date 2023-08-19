<?php

/*rank title serveer -----------------------------------------*/
if(isset($_POST['addRankTitleBtn'])){

    $rankTitle=$_POST['rankTitle'];

    $sql="INSERT INTO rank_title(rank_title) VALUES(:rankTitle)";
      $query = $db->prepare($sql);
      $query->bindParam(':rankTitle',$rankTitle,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $db->lastInsertId();
    if($lastInsertId){
        $msg="Rank Title added successfully.";
    }
    else {
      $error="Error. Try again";
    }
}


if(isset($_POST['EditRankTitleBtn'])){

    $rankTitle=$_POST['rankTitle'];
    $status=$_POST['status'];
    $rank_title_id=$_POST['rank_title_id'];
    $sql="UPDATE rank_title SET rank_title=:rankTitle, status=:status WHERE id = '$rank_title_id'";
      $query = $db->prepare($sql);
      $query->bindParam(':rankTitle',$rankTitle,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
    if($query){
       $msg="Rank Title updated successfully.";
    }
    else {
      $error="Error. Try again";
    }
}

if(isset($_GET['rank_title_id'])){

    $c_id=$_GET['rank_title_id'];
    $sql="DELETE FROM rank_title WHERE id = '$c_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Rank Title deleted successfully.";
    }
    else {
      $error="Error. Try again";
    }
}

 ?>
