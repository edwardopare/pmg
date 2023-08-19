
 <?php 

 /*rank server -----------------------------------------*/
if(isset($_POST['addRankBtn'])){

    $rank_name=$_POST['rank_name'];
    $rank_title_code=$_POST['rank_title_code'];

    $sql="INSERT INTO ranks(rank, title_code) VALUES(:rank_name, :rank_title_code)";
      $query = $db->prepare($sql);
      $query->bindParam(':rank_name',$rank_name,PDO::PARAM_STR);
      $query->bindParam(':rank_title_code',$rank_title_code,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $db->lastInsertId();
    if($lastInsertId){
        $msg="Rank added successfully.";
    }
    else {
      $error="Error. Try again 2";
    }
}

 ?>

 <?php 

 if(isset($_POST['EditRankBtn'])){

    $rankTitle=$_POST['rankTitle'];
    $rank=$_POST['rank'];
    $status=$_POST['status'];
    $rank_id=$_POST['rank_id'];

    $sql="UPDATE ranks SET rank=:rank, title_code=:rankTitle, status=:status WHERE id = '$rank_id'";
      $query = $db->prepare($sql);
      $query->bindParam(':rank',$rank,PDO::PARAM_STR);
      $query->bindParam(':rankTitle',$rankTitle,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
    if($query){
       $msg="Rank updated successfully.";
    }
    else {
      $error="Error. Try again";
    }
}

if(isset($_GET['rank_id'])){

    $rank_id=$_GET['rank_id'];
    $sql="DELETE FROM ranks WHERE id = '$rank_id'";
      $query = $db->prepare($sql);
      $query->execute();
    if($query){
       $msg="Rank deleted successfully.";
    }
    else {
      $error="Error. Try again";
    }
}
 ?>