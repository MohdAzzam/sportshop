<?php
session_start();
include "admin/html/includes/db-helper.php";
$dbHelper = DBHelper::getInstance();

?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Shop</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.css"/>
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<!-- Start Header Area -->
<header class="default-header">
    <div class="menutop-wrap">
        <div class="menu-top container">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="list">
                    <li><a href="tel:+12312-3-1209"></a></li>
                    <li><a href="mailto:support@colorlib.com"></a></li>
                </ul>
                <ul class="list">
                    <?php if (!isset($_SESSION['user']['id'])) {
                        echo '<li><a href="login.php" class="fa fa-sign-in"> login</a></li>';
                    } else {
                        echo '<li><a href="profile.php" class="fa fa-user"> Profile</a></li>';
                        echo '<li><a href="logout.php" class="fa fa-sign-out"> logout</a></li>';
                    }
                    ?>


                </ul>
            </div>

        </div>
    </div>

    <nav class="navbar navbar-expand-lg  navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li><a href="#home">Home</a></li>

                    <li><a href="#latest">latest</a></li>
                    <li><a href="#seller">Top Seller</a></li>
                    <!-- Dropdown -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Category
                        </a>
                        <div class="dropdown-menu">
                            <?php $result = $dbHelper->getAllCategories();
                            while ($catSet = mysqli_fetch_assoc($result)) {
                                ?>
                                <a class="dropdown-item"
                                   href="category.php?id=<?= $catSet['id']; ?>"><?= $catSet['name'] ?></a>
                            <?php } ?>
                        </div>
                    </li>
                    <li>

                        <div class="shopping-item">
                            <a href="cart.php">Cart - <span class="cart-amunt"><?php if (isset($_SESSION['product'])) {
                                        echo count($_SESSION['product']);
                                    }
                                    ?></span> <i class="fa fa-shopping-cart"></i>
                                <span class="product-count"></span></a>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- End Header Area -->

<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img style="height: 500px;" class="d-block w-100" src="img/1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img style="height: 500px;" class="d-block w-100" src="img/2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img style="height: 500px;" class="d-block w-100" src="img/3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!-- End banner Area -->
<!-- Start category Area -->
<section class="category-area section-gap section-gap" id="catagory">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-40">
                <div class="title text-center">
                    <h1 class="mb-10">Shop from Your Favorite Liga</h1>
                    <p> Hala Madrid </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $result = $dbHelper->getAllCategories();
            while ($catSet = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-3 col-md-8 mb-4">
                    <div class="row category-bottom">
                        <div class="col-12">
                            <div class="content">
                                <a href="category.php?id=<?= $catSet['id']; ?>">
                                    <div class="content-overlay"></div>
                                    <img class="content-image img-fluid d-block mx-auto"
                                         src="<?= 'admin/html/category/' . $catSet['name'] . '/' . $catSet['image']; ?>"
                                         alt="">
                                    <div class="content-details fadeIn-bottom">
                                        <h3 class="content-title"><?= $catSet['name'] ?></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</section>
<!-- End category Area -->
<!-- Start men-product Area -->
<section class=" section-gap relative" id="latest">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-40">
                <div class="title text-center">
                    <h1 class="text mb-10">NEW ARRIVALS</h1>
                    <p class="text">Who are in extremely love with eco friendly system.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $ras = $dbHelper->lastProAdd();
            while ($last = mysqli_fetch_assoc($ras)) {
                ?>
                <div class="col-lg-3 col-md-6 single-product">
                    <div class="content">
                        <div class="content-overlay"></div>
                        <img class="content-image img-fluid d-block mx-auto"
                             src="<?= 'admin/html/category/' . $last['name'] . '/' . $last['image_pro']; ?>" alt="">
                        <div class="content-details fadeIn-bottom">
                            <div class="bottom d-flex align-items-center justify-content-center">
                                <a href="single.php?id=<?= $last['id_pro']; ?>"><span class="lnr lnr-layers"></span></a>


                            </div>
                        </div>
                    </div>
                    <div class="price">
                        <h5 class="text-white"><?= $last['name_pro']; ?></h5>
                        <h3 class="text-white">&dollar;<?= $last['price']; ?></h3>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End men-product Area -->
<section class=" section-gap relative" id="seller">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-40">
                <div class="title text-center">
                    <h1 class="text mb-10">Most Seller Product</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $top=$dbHelper->topSell();
            while ($sell=mysqli_fetch_assoc($top)){

                ?>
                <div class="col-lg-4 col-md-6 single-product">
                    <div class="content">
                        <div class="content-overlay"></div>
                        <img class="content-image img-fluid d-block mx-auto"
                             src="<?= 'admin/html/category/' . $sell['name'] . '/' . $sell['image_pro']; ?>" alt="">
                        <div class="content-details fadeIn-bottom">
                            <div class="bottom d-flex align-items-center justify-content-center">
                                <a href="single.php?id=<?= $sell['product_id']; ?>"><span class="lnr lnr-layers"></span></a>


                            </div>
                        </div>
                    </div>
                    <div class="price">
                        <h5 class="text-white"><?= $sell['name_pro']; ?></h5>
                        <h3 class="text-white">&dollar;<?= $sell['price']; ?></h3>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>


<!-- Start women-product Area -->

<div class="section-half"></div>

<!-- End women-product Area -->


<!-- Start brand Area -->
<section class="brand-area pb-100">
    <div class="container">
        <div class="title text-center">
            <h1 class="mb-10">Our Brand</h1>
        </div>
        <div class="row logo-wrap">
            <a class="col single-img" href="#">
                <img class="d-block mx-auto" style="width: 116px; height: 70px;" src="img/puma_logo1.gif" alt="">
            </a>
            <a class="col single-img" href="#">
                <img style="width: 116px; height: 70px;" class="d-block mx-auto" src="img/Adidas-Logo.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="d-block mx-auto" style="width: 116px; height: 70px;" src="img/Nike-Logo.png" alt="">
            </a>

        </div>
    </div>
</section>
<!-- End brand Area -->

<!-- start footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>About Us</h6>
                    <p>
                        Football Shop aims to provide the best football retailing product offerings/service experience
                        that a true football fan will value and appreciate. From when you visit our store, walk around
                        and see all our product offering, talk with our shop manager and leave the store,
                        we endeavour to make your retail experience memorable.
                        We ourselves are football fans, so we understand what it means to support your favourite
                        football team.
                    </p>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Newsletter</h6>
                    <p>Stay update with our latest</p>
                    <div class="" id="mc_embed_signup">

                        <form target="_blank" novalidate="true"
                              action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                              method="get" class="form-inline">

                            <div class="d-flex flex-row">

                                <input class="form-control" name="EMAIL" placeholder="Enter Email"
                                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                       required="" type="email">


                                <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right"
                                                                             aria-hidden="true"></i></button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                           type="text">
                                </div>

                                <!-- <div class="col-lg-4 col-md-4">
                                    <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                                </div>  -->
                            </div>
                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget mail-chimp">
                    <h6 class="mb-20">Instragram Feed</h6>
                    <ul class="instafeed d-flex flex-wrap">
                        <li><img src="img/i1.jpg" alt=""></li>
                        <li><img src="img/i2.jpg" alt=""></li>
                        <li><img src="img/i3.jpg" alt=""></li>
                        <li><img src="img/i4.jpg" alt=""></li>
                        <li><img src="img/i5.jpg" alt=""></li>
                        <li><img src="img/i6.jpg" alt=""></li>
                        <li><img src="img/i7.jpg" alt=""></li>
                        <li><img src="img/i8.jpg" alt=""></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Follow Us</h6>
                    <p>Let us be social</p>
                    <div class="footer-social d-flex align-items-center">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">

            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <p class="footer-text m-0">Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                        href="https://colorlib.com" target="_blank">Colorlib</a></p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </div>
    </div>
</footer>
<!-- End footer Area -->

<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/ion.rangeSlider.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>