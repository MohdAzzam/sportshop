<?php
include "admin/html/includes/db-helper.php";
$dbHelper = DBHelper::getInstance();
session_start();
$deliver = date('y-m-d', strtotime("+7 days"));
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    $_SESSION['url-back'] = "checkout";
}
$productCart = array();
foreach ($_SESSION['product'] as $pro_id) {
    $result = $dbHelper->getProudctbyID2($pro_id);
    while ($row = mysqli_fetch_assoc($result)) {
        $productCart[] = $row;
    }

}
if (isset($_POST['add-order'])) {
    $user_id = $_SESSION['user']['id'];
    $tot = $_SESSION['sum'];
    $created_date = date("y-m-d h:m:s");

    $order = $dbHelper->orderInsert($user_id, $tot, $created_date,$deliver);
    foreach ($productCart as $singleProduct) {
        $subtotal=($singleProduct['price']*$_SESSION['qty'][$singleProduct['id_pro']]);
        $dbHelper->orderInsertDetails($singleProduct['id_pro'],$tot,$_SESSION['qty'][$singleProduct['id_pro']],$user_id,$created_date,$subtotal);

    }
    foreach ($productCart as $singleProduct) {
        $quantity=$singleProduct['quantity']-$_SESSION['qty'][$singleProduct['id_pro']];
        $dbHelper->updateQty($quantity,$singleProduct['id_pro']);

    }
    unset($_SESSION['qty']);
    unset($_SESSION['product']);
    $_SESSION['sum']=0;

    header("location:confirmation.php");
}
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
    <link rel="stylesheet" href="css/owl.carousel.css">
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
                    <li><a href="tel:+12312-3-1209">+12312-3-1209</a></li>
                    <li><a href="mailto:support@colorlib.com">support@colorlib.com</a></li>
                </ul>
                <ul class="list">
                    <li><a href="#">login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#catagory">Category</a></li>
                    <!-- Dropdown -->

                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- End Header Area -->

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h1>Product Checkout</h1>
                <nav class="d-flex align-items-center justify-content-start">
                    <a href="index.html">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="checkout.html">Product Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<div class="container">
    <form action="#" class="billing-form" method="post">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="order-wrapper mt-50">
                    <h3 class="billing-title mb-10">Your Order</h3>
                    <div class="order-list">
                        <div class="list-row d-flex justify-content-between">
                            <div>Product</div>
                            <div>Total</div>
                        </div>
                        <?php
                        $sum = 0;
                        $subtotal = 1;
                        foreach ($productCart as $singleProduct) {
                            $subtotal = $singleProduct['price'] * $_SESSION['qty'][$singleProduct['id_pro']];
                            $sum += $subtotal; ?>
                            <div class="list-row d-flex justify-content-between">
                                <div><?= $singleProduct['name_pro'] ?></div>
                                <div>x<?= $_SESSION['qty'][$singleProduct['id_pro']]; ?></div>

                                <div><?= $subtotal ?></div>
                            </div>
                        <?php } ?>
                        <div class="list-row d-flex justify-content-between">
                            <h6>Total</h6>
                            <div class="total"><?= $sum; ?></div>
                            <?php $_SESSION['sum'] = $sum; ?>
                        </div>
                        <button name="add-order" class="view-btn color-2 w-100 mt-20"><span>Proceed to Checkout</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Billing Details Form -->

<div class="section-half">

</div>


<!-- start footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>About Us</h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore dolore magna aliqua.
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
<script src="js/main.js"></script>
</body>
</html>