<?php
require("../includes/db-helper.php");
$dbHelper = DBHelper::getInstance();
?>
<?php
$path= "../category/";
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity=$_POST['quantity'];
    $desc = $_POST['description'];
    $category_id = $_POST['category_id'];
    $arr = explode('/', $category_id);
    $id_cat = $arr[0];
    $name_cat = $arr[1];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $dbHelper->addProduct($name, $price, $image, $desc,$quantity, $id_cat);
    header("location:index.php");

    move_uploaded_file($tmp_name,$path.$name_cat.'/'.$image);


}
if (isset($_POST['delete'])) {

    $dbHelper->deleteProduct($_POST['pro_id']);
    header("location:index.php");
}


?>
<?php include("../includes/header.php"); ?>
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Product Page</h4>
        </div>
        <a href="../logout.php"  class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Logout</a>

    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-12">Name</label>
                        <div class="col-md-12">
                            <input type="text" name="name" required
                                   class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Price</label>
                        <div class="col-md-12">
                            <input type="text" name="price" required
                                   class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Quantity</label>
                        <div class="col-md-12">
                            <input type="text" name="quantity" required
                                   class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Description</label>
                        <div class="col-md-12">
                            <input type="text" name="description" required
                                   class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Image</label>
                        <div class="col-md-12">
                            <input type="file" name="image" required class="form-control form-control-line">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Category</label>
                        <div class="col-md-12">
                            <select name="category_id">
                                <?php
                                $result = $dbHelper->getAllCategories();
                                while ($category = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$category['id']}/{$category['name']}'> {$category['name']}</option>";

                                }


                                ?>


                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-lg btn-info center-block" id="save" name="add">
                                Add Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Product</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = $dbHelper->innerjoinprocat();
                            while ($product = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $product['id_pro']; ?></td>
                                    <td><?= $product['name_pro']; ?></td>
                                    <td><?=$product['price'];?></td>
                                    <td><?=$product['quantity'];?></td>
                                    <td><?=$product['description'];?></td>
                                    <td><img style="width: 75px;" src="<?= $path . $product['name'] . '/' . $product['image_pro']; ?>"/></td>
                                    <td><?=$product['name'];?></td>

                                    <td>
                                        <a href='edit.php?id=<?= $product['id_pro']; ?>'
                                           class='btn btn-info'>Edit</a>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input name="delete"
                                                   class="btn btn-danger"
                                                   value="Delete"
                                                   type="submit"/>
                                            <input type="hidden" name="pro_id"
                                                   value="<?= $product['id_pro']; ?>"/>

                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>


<?php include "../includes/footer.php"; ?>