<?php

use app\models\Category;
use app\models\Subcategory;

define('ACTIVE',1);
define('NOT_ACTIVE',0);
$categoriesInstance = new Category;
$categoriesInstance->setStatus(ACTIVE);
$categoriesResult = $categoriesInstance->getCategories();
$subcategoryInstance = new Subcategory;
$subcategoryInstance->setStatus(ACTIVE);
?>
<!-- header start -->
<header class="header-area gray-bg clearfix">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="logo">
                        <a href="index.php">
                            <img alt="" src="assets/img/logo/logo.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-6">
                    <div class="header-bottom-right">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="top-hover"><a href="index.php">home</a>
                                    </li>
                                    <li class="mega-menu-position top-hover"><a href="shop.php">shop</a>
                                        <ul class="mega-menu">

                                        <?php 
                                            if($categoriesResult->num_rows >= 1){
                                                $categories = $categoriesResult->fetch_all(MYSQLI_ASSOC);
                                                foreach ($categories as $category) { ?>
                                                    <li>
                                                        <ul>
                                                            <li class="nav-link">
                                                                <a class=" h3 font-weight-bold" style="cursor: pointer;" href="shop.php?category=<?= $category['id'] ?>"><?= $category['name_en'] ?></a>
                                                            </li>
                                                            <?php 
                                                                $subcategoriesResult = $subcategoryInstance->setCategory_id($category['id'] )
                                                                ->getSubcategoriesByCategory_id();
                                                                if($subcategoriesResult->num_rows >= 1){
                                                                    $subcategories = $subcategoriesResult->fetch_all(MYSQLI_ASSOC);
                                                                    foreach ($subcategories as  $subcategory) { ?>
                                                                            <li><a href="shop.php?subcategory=<?= $subcategory['id'] ?>"><?= $subcategory['name_en'] ?></a></li>
                                                                    <?php }
                                                                }else{

                                                                }
                                                            ?>
                                                            
                                                           
                                                        </ul>
                                                    </li>
                                                <?php }
                                            }else{

                                            }
                                        ?>

                                            
                                            
                                        </ul>
                                    </li>
                                    <li><a href="about-us.php">about</a></li>
                                    <li><a href="contact.php">contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <?php
                        if (empty($_SESSION['user'])) { ?>
                            <div class="header-currency">
                                <span class="digit">Welcome <i class="ti-angle-down"></i></span>
                                <div class="dollar-submenu">
                                    <ul>
                                        <li><a href="signin.php">Sign in</a></li>
                                        <li><a href="signup.php">Sign up</a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="header-currency">
                                <span class="digit"><?= ucfirst("{$_SESSION['user']->first_name} {$_SESSION['user']->last_name}") ?> <i class="ti-angle-down"></i></span>
                                <div class="dollar-submenu">
                                    <ul>
                                        <li><a href="my-account.php">My Account</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="header-cart">
                            <a href="#">
                                <div class="cart-icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                            </a>
                            <div class="shopping-cart-content">
                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-1.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Phantom Remote </a></h4>
                                            <h6>Qty: 02</h6>
                                            <span>$260.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="ion ion-close"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Phantom Remote</a></h4>
                                            <h6>Qty: 02</h6>
                                            <span>$260.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="ion ion-close"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-total">
                                    <h4>Shipping : <span>$20.00</span></h4>
                                    <h4>Total : <span class="shop-total">$260.00</span></h4>
                                </div>
                                <div class="shopping-cart-btn">
                                    <a href="cart-page.php">view cart</a>
                                    <a href="checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="#">HOME</a>
                                <ul>
                                    <li><a href="index.php">home version 1</a></li>
                                    <li><a href="index-2.php">home version 2</a></li>
                                </ul>
                            </li>
                            <li><a href="shop.php"> Shop </a>
                                <ul>
                                    
                                    <li><a href="#">Categories 01</a>
                                        <ul>
                                            <li><a href="shop.php">Aconite</a></li>
                                            <li><a href="shop.php">Ageratum</a></li>
                                            <li><a href="shop.php">Allium</a></li>
                                            <li><a href="shop.php">Anemone</a></li>
                                            <li><a href="shop.php">Angelica</a></li>
                                            <li><a href="shop.php">Angelonia</a></li>
                                        </ul>
                                    </li>
                                   
                                </ul>
                            </li>
                            <li><a href="#">BLOG</a>
                                <ul>
                                    <li><a href="blog-masonry.php">Blog Masonry</a></li>
                                    <li><a href="#">Blog Standard</a>
                                        <ul>
                                            <li><a href="blog-left-sidebar.php">left sidebar</a></li>
                                            <li><a href="blog-right-sidebar.php">right sidebar</a></li>
                                            <li><a href="blog-no-sidebar.php">no sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Post Types</a>
                                        <ul>
                                            <li><a href="blog-details-standerd.php">Standard post</a></li>
                                            <li><a href="blog-details-audio.php">audio post</a></li>
                                            <li><a href="blog-details-video.php">video post</a></li>
                                            <li><a href="blog-details-gallery.php">gallery post</a></li>
                                            <li><a href="blog-details-link.php">link post</a></li>
                                            <li><a href="blog-details-quote.php">quote post</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="contact.php"> Contact us </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->