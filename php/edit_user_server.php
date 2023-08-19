<?php

if(isset($_POST['editUserBtn'])){
    
    $userId=$_POST['userId'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $username=$_POST['username'];
    $type=$_POST['type'];
    $rank=$_POST['rank'];
    if (empty($_POST['middlename'])) {
      $middlename= "";
    }else{
      $middlename= $_POST['middlename'];
    }

    if (empty($_FILES['img']['name'])) {
      
      $sql="UPDATE users SET firstname=:firstname, middlename=:middlename, lastname=:lastname, username=:username, type=:type, rank=:rank WHERE id='$userId'";
      $query = $db->prepare($sql);
      $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
      $query->bindParam(':middlename',$middlename,PDO::PARAM_STR);
      $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
      $query->bindParam(':username',$username,PDO::PARAM_STR);
      $query->bindParam(':type',$type,PDO::PARAM_STR);
      $query->bindParam(':rank',$rank,PDO::PARAM_STR);
      $query->execute();
    if($query){
        $msg="User updated successfully.";
    }
    else {
      $error="Error. Try again";
    }

    }else{
       $uploaddir = 'uploads/user/';
     $uploadfile = $uploaddir . basename($_FILES['img']['name']);

    if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {

          $sql="UPDATE users SET firstname=:firstname, middlename=:middlename, lastname=:lastname, username=:username, avatar=:uploadfile, type=:type, rank=:rank WHERE id='$userId'";
            $query = $db->prepare($sql);
            $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
            $query->bindParam(':middlename',$middlename,PDO::PARAM_STR);
            $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
            $query->bindParam(':username',$username,PDO::PARAM_STR);
            $query->bindParam(':uploadfile',$uploadfile,PDO::PARAM_STR);
            $query->bindParam(':type',$type,PDO::PARAM_STR);
            $query->bindParam(':rank',$rank,PDO::PARAM_STR);
            $query->execute();
          if($query){
              $msg="User updated successfully.";
          }
          else {
            $error="Error. Try again";
          }
        }else{
          $error="File attack. Try again";
        }
    }
    
    
}
 ?>