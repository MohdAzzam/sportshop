<?php
require("../includes/db-helper.php");
$dbHelper = DBHelper::getInstance();
?>
<?php

$product = $dbHelper->getProudctbyID($_GET['id']);
$path = "../category/";
if (isset($_POST['update'])) {
    $name           = $_POST['name'];
    $price          = $_POST['price'];
    $quantity       = $_POST['quantity'];
    $image          = $_FILES['image']['name'];
    $tmp_name       = $_FILES['image']['tmp_name'];
    $desc           = $_POST['description'];
    $id             = $_POST['id'];
    $category_id    = $_POST['category_id'];
    $arr            = explode('/', $category_id);
    $id_cat          = $arr[0];
    $name_cat        = $arr[1];

    if ($_FILES['image']['error'] == 0) {

        move_uploaded_file($tmp_name,$path.$name_cat.'/'.$image);


        $dbHelper->updateProduct($name, $price, $image, $desc,$quantity, $id_cat, $id);

        header("location:index.php");
    } else {
        $dbHelper->updateProduct1($name, $price, $desc,$quantity, $id_cat, $id);
        header("location:index.php");
    }




}

?>
<?php include("../includes/header.php"); ?>
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Product Page</h4>
        </div>
    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value=<?php echo $_GET['id'] ?>>
                    <div class="form-group">
                        <label class="col-md-12">Name</label>
                        <div class="col-md-12">
                            <input type="text" name="name" required
                                   value="<?=$product['name_pro'];?>" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Price</label>
                        <div class="col-md-12">
                            <input type="text" name="price" required value="<?=$product['price'];?>"
                                   class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Quantity</label>
                        <div class="col-md-12">
                            <input type="text" name="quantity" required value="<?=$product['quantity'];?>"
                                   class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Description</label>
                        <div class="col-md-12">
                            <input type="text" name="description" required value="<?=$product['description'];?>"
                                   class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Image</label>
                        <div class="col-md-12">
                            <input type="file" name="image"  class="form-control form-control-line">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Category</label>
                        <div class="col-md-12">
                            <select name="category_id">
                                <?php
                                $result = $dbHelper->getAllCategories();
                                while ($category = mysqli_fetch_assoc($result)) {
                                    if ($product['cat_id'] == $category['id']) {
                                        echo "<option selected value='{$category['id']}/{$category['name']}'>{$category['name']}</option>";
                                    } else {
                                        echo "<option value='{$category['id']}/{$category['name']}'</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-lg btn-info center-block" id="save" name="update">
                                Update Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
<?php include "../includes/footer.php"; ?>