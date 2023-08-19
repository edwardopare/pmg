 <?php 
 $query = $db->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");

  if($query->rowCount() > 0){
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach($result as $data){
        $myImage = $data->avatar;
        $drug_permit = $data->drug_permit;
        $food_permit = $data->food_permit;
        $request_drug_permit = $data->request_drug_permit;
        $request_food_permit = $data->request_food_permit;
    }
}
 ?>
 <!-- HEADER DESKTOP-->
        <header class="header-desktop4">
            <div class="container">
                <div class="header4-wrap">
                    <div class="header__logo">
                        <a href="dashboard.php">
                            <img src="images/pmslogo.png" alt="pms" style="width: 15%; margin-left: 100px;">
                        </a>
                    </div>
                    <div class="header__tool">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                    <img src="<?php echo($myImage); ?>" alt="profile" />
                                </div> 
                                <div class="content">
                                    <a class="js-acc-btn" href="javascript:;"><?php echo $_SESSION['firstname']; ?></a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="./my-profile.php">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="./change-password.php">
                                                <i class="zmdi zmdi-settings"></i>Change Password</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="./logout.php">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP -->