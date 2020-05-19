<?php include "admin/html/includes/db-helper.php";
$dbHelper = DBHelper::getInstance();
?>

<?php
$result = [];
if (isset($_POST['name']) && isset($_POST['id'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $result = $dbHelper->inner($id, $name);
} else if (isset($_POST['min_value']) && isset($_POST['max_value']) && isset($_POST['id'])) {
    $result = $dbHelper->filterItemsByCategoryIdAndPrice($_POST['id'], $_POST['min_value'], $_POST['max_value']);
}
?>
<section class="lattest-product-area pb-40 category-list">
    <div class="row">
        <?php
        while ($productSearch = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
                <div class="content">
                    <div class="content-overlay"></div>
                    <img class="content-image img-fluid d-block mx-auto"
                         src="<?= 'admin/html/category/' . $productSearch['name'] . '/' . $productSearch['image_pro'] ?>"
                         alt="">
                    <div class="content-details fadeIn-bottom">
                        <div class="bottom d-flex align-items-center justify-content-center">
                            <a href="single.php?id=<?=$productSearch['id']?>"><span class="lnr lnr-layers"></span></a>

                        </div>
                    </div>
                </div>
                <div class="price">
                    <h5><?= $productSearch['name_pro']; ?></h5>
                    <h3>&dollar;<?= $productSearch['price']; ?></h3>
                </div>
            </div>
        <?php } ?>

    </div>
</section>

