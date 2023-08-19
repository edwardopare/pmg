<?php

if(isset($_POST['addUserBtn'])){

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $type=$_POST['type'];
    $rank=$_POST['rank'];
    if (empty($_POST['middlename'])) {
      $middlename= "";
    }else{
      $middlename= $_POST['middlename'];
    }
    
     $uploaddir = 'uploads/user/';
     $uploadfile = $uploaddir . basename($_FILES['img']['name']);

    if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {

    $sql="INSERT INTO users(firstname, middlename, lastname, username, password, avatar, type, rank, drug_permit, food_permit) VALUES(:firstname, :middlename, :lastname, :username, :password, :uploadfile, :type, :rank, 0, 0)";
      $query = $db->prepare($sql);
      $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
      $query->bindParam(':middlename',$middlename,PDO::PARAM_STR);
      $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
      $query->bindParam(':username',$username,PDO::PARAM_STR);
      $query->bindParam(':password',$password,PDO::PARAM_STR);
      $query->bindParam(':uploadfile',$uploadfile,PDO::PARAM_STR);
      $query->bindParam(':type',$type,PDO::PARAM_STR);
      $query->bindParam(':rank',$rank,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $db->lastInsertId();
    if($lastInsertId){
        $msg="User added successfully.";
    }
    else {
      $error="Error. Try again";
    }
  }
}
 ?>