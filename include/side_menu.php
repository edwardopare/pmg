<style type="text/css">
    
</style>
<aside class="menu-sidebar3 js-spe-sidebar">
                                <nav class="navbar-sidebar2 navbar-sidebar3">
                                    <ul class="list-unstyled navbar__list" style="background-color: #eaeded; color: #000;">
                                        <li class="active has-sub">
                                            <a href="./dashboard.php">
                                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="./inmate.php">
                                                <i class="fas fa-user"></i>Inmate</a>
                                        </li>
                                        <li> 
                                            <a href="./visitors.php">
                                                <i class="fas fa-file"></i>Visitors</a>
                                        </li>

                                        <?php 
                                        if ($drug_permit == 1) { ?>
                                            <hr>
                                         <li>
                                            <a href="./drug-store.php">
                                                <i class="fas fa-ambulance"></i>Drug Store</a>
                                        </li>

                                        <li>
                                            <a href="./drug-request.php">
                                                <i class="fas fa-list"></i>Drug Request</a>
                                        </li>
                                    <hr>
                                        <?php } ?>
                                        <?php 
                                        if ($food_permit == 1) { ?> 
                                        <li>
                                            <a href="./food-store.php">
                                                <i class="fas fa-hamburger"></i>Food Store</a>
                                        </li>

                                        <li>
                                            <a href="./food-request.php">
                                                <i class="fas fa-list"></i>Food Request</a>
                                        </li>
                                        <?php } ?>

                                        <?php 
                                        if ($request_drug_permit == 1) { ?> 
                                            <hr>
                                        <li>
                                            <a href="./request-drug.php">
                                                <i class="fas fa-ambulance"></i>Request Drug</a>
                                        </li>
                                        <?php } ?>

                                        <?php 
                                        if ($request_food_permit == 1) { ?> 
                                            <hr>
                                        <li>
                                            <a href="./request-food.php">
                                                <i class="fas fa-hamburger"></i>Request Food</a>
                                        </li>
                                        <?php } ?>

                                        <?php 
                                        if ($_SESSION['type'] == 1) { ?>

                                        <p>&nbsp;&nbsp; ACTION</p>
                                        <li>
                                            <a href="./rank-title.php">
                                                <i class="fas fa-header"></i>Rank Title</a>
                                        </li>
                                        <li>
                                            <a href="./rank.php">
                                                <i class="fas fa-star"></i>Rank</a>
                                        </li>
                                        <li>
                                            <a href="./users.php">
                                                <i class="fas fa-users"></i>Users</a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </nav>
                            </aside>