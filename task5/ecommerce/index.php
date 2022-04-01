<?php

use app\models\Brand;
use app\models\Product;

$title = 'Home';
include_once "layouts/header.php";
include_once "layouts/navbar.php";
$brandInstance = new Brand;
$brandsResult = $brandInstance->setStatus(ACTIVE)->getBrands();

$ProductInstance = new Product;
$recentProductResult = $ProductInstance->setStatus(ACTIVE)->recentProduct();
$mostRateProductResult = $ProductInstance->setStatus(ACTIVE)->mostRateProduct();
$mostOrderProductResult = $ProductInstance->setStatus(ACTIVE)->mostOrderProduct();
?>
<!-- Slider Start -->
<div class="slider-area">
    <div class="slider-active owl-dot-style owl-carousel">
        <div class="single-slider ptb-240 bg-img" style="background-image:url(assets/img/slider/slider-1.jpg);">
            <div class="container">
                <div class="slider-content slider-animated-1">
                    <h1 class="animated">Want to stay <span class="theme-color">healthy</span></h1>
                    <h1 class="animated">drink matcha.</h1>
                    <p>Lorem ipsum dolor sit amet, consectetu adipisicing elit sedeiu tempor inci ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="single-slider ptb-240 bg-img" style="background-image:url(assets/img/slider/slider-1-1.jpg);">
            <div class="container">
                <div class="slider-content slider-animated-1">
                    <h1 class="animated">Want to stay <span class="theme-color">healthy</span></h1>
                    <h1 class="animated">drink matcha.</h1>
                    <p>Lorem ipsum dolor sit amet, consectetu adipisicing elit sedeiu tempor inci ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Slider End -->
<!-- Product Area Start -->
<div class="product-area bg-image-1 pt-100 pb-95">
    <div class="container">
        <div class="row">
            <?php if ($brandsResult->num_rows >= 1) {
                $brands = $brandsResult->fetch_all(MYSQLI_ASSOC);
                foreach ($brands as  $brand) { ?>
                    <div class="col-3">
                        <div class="product-img">
                            <a href="shop.php?brand=<?= $brand['id'] ?>">
                                <img alt="" src="assets/img/brands/<?= $brand['image'] ?>">
                            </a>
                        </div>
                        <div class="product-content text-left">
                            <div class="product-hover-style">
                                <div class="product-title">
                                    <h4>
                                        <a href="shop.php?brand=<?= $brand['id'] ?>"><?= $brand['name_en'] ?></a>
                                    </h4>
                                </div>

                            </div>

                        </div>
                    </div>
            <?php }
            } ?>


        </div>
    </div>
</div>
<!-- Product Area End -->
<!-- Banner Star
!-- New task  Start1 most recent -->

<div class="product-area gray-bg pt-90 pb-65">
    <div class="container">
        <div class="product-top-bar section-border mb-55">
            <div class="section-title-wrap text-center">
<h3 class="section-title">most recent</h3>


<div class="grid-list-product-wrapper">
    <div class="product-grid product-view pb-20">
        <div class="row">
        <?php if ($recentProductResult->num_rows >= 1) {
                $recentProducts = $recentProductResult->fetch_all(MYSQLI_ASSOC);
                foreach ($recentProducts as  $recentProduct) { ?>

                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.php?id=<?= $recentProduct['products_id'] ?>">
                                <img alt="" src="assets/img/product/<?= $recentProduct['products_image'] ?>">
                            </a>
                            <!-- <span>-30%</span> -->
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
                                    <i class="ion-android-favorite-outline"></i>
                                </a>
                                <a class="action-cart" href="#" title="Add To Cart">
                                    <i class="ion-ios-shuffle-strong"></i>
                                </a>
                                <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-content text-left">
                            <div class="product-hover-style">
                                <div class="product-title">
                                    <h4>
                                        <a href="product-details.php?id=<?= $recentProduct['products_id'] ?>"><?= $recentProduct['products_name_en'] ?></a>
                                    </h4>
                                </div>
                                <div class="cart-hover">
                                    <h4><a href="product-details.php?id=<?= $recentProduct['products_id'] ?>">+ Add to cart</a></h4>
                                </div>
                            </div>
                            <div class="product-price-wrapper">
                                <span><?= $recentProduct['products_price'] ?> <strong> EGP </strong> </span>
                            </div>
                        </div>
                        <div class="product-list-details">
                            <h4>
                                <a href="product-details.php?id=<?= $recentProduct['products_id'] ?>"><?= $recentProduct['products_name_en'] ?></a>
                            </h4>
                            <div class="product-price-wrapper">
                                <span><?= $recentProduct['products_price'] ?> <strong> EGP </strong> </span>
                            </div>
                            <p><?= $recentProduct['products_desc_en'] ?></p>
                            <div class="shop-list-cart-wishlist">
                                <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }}?>

        </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    <!-- Banner End -->
    <!-- New task  Start2 mostRateProduct -->
    <div class="product-area gray-bg pt-90 pb-65">
    <div class="container">
        <div class="product-top-bar section-border mb-55">
            <div class="section-title-wrap text-center">
<h3 class="section-title">most RateProduct</h3>


<div class="grid-list-product-wrapper">
    <div class="product-grid product-view pb-20">
        <div class="row">
        <?php if ($mostRateProductResult->num_rows >= 1) {
                $RateProducts = $mostRateProductResult->fetch_all(MYSQLI_ASSOC);
                foreach ($RateProducts as  $RateProduct) { ?>

                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.php?id=<?= $RateProduct['products_id'] ?>">
                                <img alt="" src="assets/img/product/<?= $RateProduct['products_image'] ?>">
                            </a>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
                                    <i class="ion-android-favorite-outline"></i>
                                </a>
                                <a class="action-cart" href="#" title="Add To Cart">
                                    <i class="ion-ios-shuffle-strong"></i>
                                </a>
                                <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-content text-left">
                            <div class="product-hover-style">
                                <div class="product-title">
                                    <h4>
                                        <a href="product-details.php?id=<?= $RateProduct['products_id'] ?>"><?= $RateProduct['products_name_en'] ?></a>
                                    </h4>
                                </div>
                                <div class="cart-hover">
                                    <h4><a href="product-details.php?id=<?= $RateProduct['products_id'] ?>">+ Add to cart</a></h4>
                                </div>
                            </div>
                            <div class="product-price-wrapper">
                                <span><?= $RateProduct['products_price'] ?> <strong> EGP </strong> </span>
                            </div>
                        </div>
                        <div class="product-list-details">
                            <h4>
                                <a href="product-details.php?id=<?= $RateProduct['products_id'] ?>"><?= $RateProduct['products_name_en'] ?></a>
                            </h4>
                            <div class="product-price-wrapper">
                                <span><?= $RateProduct['products_price'] ?> <strong> EGP </strong> </span>
                            </div>
                            <p><?= $RateProduct['products_desc_en'] ?></p>
                            <div class="shop-list-cart-wishlist">
                                <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }}?>

        </div>
    </div>

    </div>
    </div>
    </div>
    </div>

    <!-- New task  Start3 mostRateProduct -->
    <div class="product-area gray-bg pt-90 pb-65">
    <div class="container">
        <div class="product-top-bar section-border mb-55">
            <div class="section-title-wrap text-center">
<h3 class="section-title">most OrderProduct</h3>


<div class="grid-list-product-wrapper">
    <div class="product-grid product-view pb-20">
        <div class="row">
        <?php if ($mostOrderProductResult->num_rows >= 1) {
                $OrderProducts = $mostOrderProductResult->fetch_all(MYSQLI_ASSOC);
                foreach ($OrderProducts as  $OrderProduct) { ?>

                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.php?id=<?= $OrderProduct['products_id'] ?>">
                                <img alt="" src="assets/img/product/<?= $OrderProduct['products_image'] ?>">
                            </a>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
                                    <i class="ion-android-favorite-outline"></i>
                                </a>
                                <a class="action-cart" href="#" title="Add To Cart">
                                    <i class="ion-ios-shuffle-strong"></i>
                                </a>
                                <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-content text-left">
                            <div class="product-hover-style">
                                <div class="product-title">
                                    <h4>
                                        <a href="product-details.php?id=<?= $OrderProduct['products_id'] ?>"><?= $OrderProduct['products_name_en'] ?></a>
                                    </h4>
                                </div>
                                <div class="cart-hover">
                                    <h4><a href="product-details.php?id=<?= $OrderProduct['products_id'] ?>">+ Add to cart</a></h4>
                                </div>
                            </div>
                            <div class="product-price-wrapper">
                                <span><?= $OrderProduct['products_price'] ?> <strong> EGP </strong> </span>
                            </div>
                        </div>
                        <div class="product-list-details">
                            <h4>
                                <a href="product-details.php?id=<?= $OrderProduct['products_id'] ?>"><?= $OrderProduct['products_name_en'] ?></a>
                            </h4>
                            <div class="product-price-wrapper">
                                <span><?= $OrderProduct['products_price'] ?> <strong> EGP </strong> </span>
                            </div>
                            <p><?= $OrderProduct['products_desc_en'] ?></p>
                            <div class="shop-list-cart-wishlist">
                                <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }}?>

        </div>
    </div>

    </div>
    </div>
    </div>
    </div>
   
<!-- New Products End -->
<!-- Testimonial Area Start -->
<div class="testimonials-area bg-img pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="testimonial-active owl-carousel">
                    <div class="single-testimonial text-center">
                        <div class="testimonial-img">
                            <img alt="" src="assets/img/icon-img/testi.png">
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore</p>
                        <h4>Gregory Perkins</h4>
                        <h5>Customer</h5>
                    </div>
                    <div class="single-testimonial text-center">
                        <div class="testimonial-img">
                            <img alt="" src="assets/img/icon-img/testi.png">
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore</p>
                        <h4>Khabuli Teop</h4>
                        <h5>Marketing</h5>
                    </div>
                    <div class="single-testimonial text-center">
                        <div class="testimonial-img">
                            <img alt="" src="assets/img/icon-img/testi.png">
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore </p>
                        <h4>Lotan Jopon</h4>
                        <h5>Admin</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial Area End -->
<!-- News Area Start -->
<div class="blog-area bg-image-1 pt-90 pb-70">
    <div class="container">
        <div class="product-top-bar section-border mb-55">
            <div class="section-title-wrap text-center">
                <h3 class="section-title">Latest News</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="blog-single mb-30">
                    <div class="blog-thumb">
                        <a href="#"><img src="assets/img/blog/blog-single-1.jpg" alt="" /></a>
                    </div>
                    <div class="blog-content pt-25">
                        <span class="blog-date">14 Sep</span>
                        <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut labore et dolore</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-single mb-30">
                    <div class="blog-thumb">
                        <a href="#"><img src="assets/img/blog/blog-single-2.jpg" alt="" /></a>
                    </div>
                    <div class="blog-content pt-25">
                        <span class="blog-date">20 Dec</span>
                        <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut labore et dolore</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-single mb-30">
                    <div class="blog-thumb">
                        <a href="#"><img src="assets/img/blog/blog-single-3.jpg" alt="" /></a>
                    </div>
                    <div class="blog-content pt-25">
                        <span class="blog-date">18 Aug</span>
                        <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut labore et dolore</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- News Area End -->
<!-- Newsletter Araea Start -->
<div class="newsletter-area bg-image-2 pt-90 pb-100">
    <div class="container">
        <div class="product-top-bar section-border mb-45">
            <div class="section-title-wrap text-center">
                <h3 class="section-title">Join to our Newsletter</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 col-md-10 col-md-auto">
                <div class="footer-newsletter">
                    <div id="mc_embed_signup" class="subscribe-form">
                        <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll" class="mc-form">
                                <input type="email" value="" name="EMAIL" class="email" placeholder="Your Email Address*" required>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div class="mc-news" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                <div class="submit-button">
                                    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter Araea End -->
<?php

include_once "layouts/footer.php";
include_once "layouts/footer-scripts.php";
?>