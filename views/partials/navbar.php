<div class="nav-bar">
    <div class="container">
        <div class="nav-container">
            <div>
                <a href="/index.php" class="site-title">Farming Assistant</a>
            </div>
            <ul class="menu-items">
                <?php if(Auth::isLoggedIn()) { ?>
                <?php if (Auth::getUser()->role == 'admin') { ?>
                    <li class="nav-item">
                        <a class="link" href="/views/admin/home.php"> Home </a>
                    </li>
                <?php } elseif (Auth::getUser()->role == 'seller') { ?>
                    <li class="nav-item">
                        <a class="link" href="/views/seller/home.php"> Home </a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="link" href="/views/farmer/home.php"> Home </a>
                    </li>
                <?php } ?>

                <?php } ?>

                <li class="nav-item">
                    <a class="link" href="/views/reports.php">Report </a>
                </li>
                <li class="nav-item">
                    <a class="link" href="/views/products.php"> Products </a>
                </li>


                <li class="nav-item">
                    <?php

                    if (Auth::isLoggedIn()) { ?>

                        <div class='dropdown'>
                            <button>Profile</button>
                            <div class='dropdown-content'>
                                <a class="nav-link" href="/views/profile.php">Profile</a>
                                <?php if (Auth::getUser()->role == 'farmer') { ?>
                                    <a href='/views/farmer/reports/my-reports.php'>My Reports</a>
                                    <a href="/views/farmer/my-orders.php">My Orders</a>
                                <?php } else if (Auth::getUser()->role == 'seller') { ?>
                                    <a href='/views/seller/my_products.php'>My Products</a>
                                <?php } ?>

                                <form action="/actions/logout.php" method="post">
                                    <button class="btn-as-anchor">Logout</button>
                                </form>
                            </div>
                        </div>

                    <?php } ?>

                </li>
            </ul>
        </div>
    </div>
</div>