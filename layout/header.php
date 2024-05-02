<?php
require_once('cpanel/config/db.php');
?>

<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<!-- Header -->
<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <div class="topbar">
            <div class="topbar-social">
                <a href="https://www.facebook.com" class="topbar-social-item fa fa-facebook" target="_blank" rel="noopener noreferrer"></a>
                <a href="https://www.instagram.com" class="topbar-social-item fa fa-instagram" target="_blank" rel="noopener noreferrer"></a>
                <a href="https://www.pinterest.com" class="topbar-social-item fa fa-pinterest-p" target="_blank" rel="noopener noreferrer"></a>
                <a href="https://www.snapchat.com" class="topbar-social-item fa fa-snapchat-ghost" target="_blank" rel="noopener noreferrer"></a>
                <a href="https://www.youtube.com" class="topbar-social-item fa fa-youtube-play" target="_blank" rel="noopener noreferrer"></a>
            </div>

            <span class="topbar-child1">
                Announcement: Shop Verification is still FREE for a month!
            </span>
        </div>

        <div class="wrap_header">
            <!-- Logo -->
            <a href="index.php" class="logo">
                <img src="images/icons/logo.png" alt="MoneyWaste">
            </a>

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="index.php">Home</a>
                        </li>

                        <li class="sale-noti">
                            <a href="BuyPage.php?category=0">Buy</a>
                        </li>

                        <li class="sale-noti">
                            <a href="SellPage.php?category=0">Sell</a>
                        </li>

                        <li>
                            <a href="ContactUs.php">Contact Us</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">
                <ul class="main_menu">
                    <li>
                        <a href="login.php" class="header-wrapicon1 dis-block" style="border-bottom: 0px;">
                            <img src="images/icons/login_icon.png" class="header-icon1" alt="ICON">
                        </a>
                        <?php
                            if(isset($_SESSION['loggedin'])){
                                echo "<ul class='sub_menu'>";
                                echo "<li><a href='MyProfile.php'>My Profile</a></li>";
                                echo "<li><a href='Logout.php'>Logout</a></li>";
                            }
                        ?>
                        </ul>
                    </li>
                </ul>
                <?php 
                if(isset($_SESSION['loggedin'])){ ?>
                <span class="linedivide1"></span>
                    <div class="header-wrapicon2">
                        <a href="cart.php">
                            <img src="images/icons/cart_icon.png" class="header-icon1" alt="ICON">
                        </a>
                        <span class="header-icons-noti">
                            <?php
                                $cart->getNumberOfItemsInCart($_SESSION['user_id']);
                            ?>
                        </span>
                    </div>
                <?php 
                } ?>
            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="index.php" class="logo-mobile">
            <img src="images/icons/logo.png" alt="MoneyWays">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <a href="#" class="header-wrapicon1 dis-block">
                    <img src="images/icons/login_icon.png" class="header-icon1" alt="ICON">
                </a>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <img src="images/icons/cart_icon.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">0</span>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">

                <li class="item-menu-mobile">
                    <a href="index.php">Home</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="BuyPage.php">Buy</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="SellPage.php">Sell</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="ContactUs.php">Contact Us</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
