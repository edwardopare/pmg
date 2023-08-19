<?php include 'db.php'; ?>
<?php include 'include/head.php'; ?>

<?php 
session_start();
if (isset($_POST['loginBtn'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $check = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password' AND status=1 ");
   if($check->rowCount() > 0){

  $query = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

  if($query->rowCount() > 0){
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach($result as $data){

        if ($data->type == 1) {

            $_SESSION['id'] = $data->id;
            $_SESSION['user'] = $data->username;
            $_SESSION['type'] = $data->type;
            $_SESSION['firstname'] = $data->firstname;
            echo "<script>
                      location.href='dashboard.php';
                 </script>";
        }else{
            
             $_SESSION['id'] = $data->id;
            $_SESSION['user'] = $data->username;
            $_SESSION['type'] = $data->type;
            $_SESSION['firstname'] = $data->firstname;
            echo "<script>
                      location.href='dashboard.php';
                 </script>";
        }
           
           
    }
    }else{
      echo "<script>
      alert('Invalid credentials');
      document.getElementsById('password').value='';
      </script>";
    }
        
  }else{
      echo "<script>
      alert('Your account has been blocked. Contact the administrator.');
      document.getElementsById('password').value='';
      </script>";
    }
}
?>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            
                                <img src="images/pmslogo.png" alt="pms" style="width: 20%;">
                            
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group"> 
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="forgotpassword.php">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="loginBtn" type="submit">sign in</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    

</body>

</html>
<!-- end document-->