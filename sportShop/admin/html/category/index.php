<?php
require("../includes/db-helper.php");
$dbHelper = DBHelper::getInstance();
?>
<?php


if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $image = $_FILES['image']['name'];
    $image_kind = $_FILES['image']['type'];
    //list of allowed Image Type to upload
    $allowed_image_extension = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
    // Get image Extension
    //

    $image_extension = explode('.', $image);
//    print_r( $image_extension);die;
    if (!empty($image) && in_array($image_extension[1], $allowed_image_extension) && !is_dir($name)) {
        mkdir($name);
        $dbHelper->addCategory($name, $image);
        move_uploaded_file($tmp_name, $name . '/' . $image);

    } else {
        $error = "Please Insert Image Or Use a Valid Extension ";

    }

}

if (isset($_POST['update-cat'])) {

    $old_name = $_POST['old_cat_name'];
    $name_cat = $_POST['modal_cat_name'];
    $id = $_POST['modal_cat_id'];
    $tmp_name_cat = $_FILES['modal_cat_image']['tmp_name'];
    $image_cat = $_FILES['modal_cat_image']['name'];
    $image_old = $_POST['old_cat_image'];


    if (!is_file($name_cat) && $name_cat != $old_name) {
        mkdir($name_cat);
        move_uploaded_file($tmp_name_cat, $name_cat . '/' . $image_cat);
        unlink("$old_name/$image_old");
        rmdir($old_name);

    }
    else{
        move_uploaded_file($tmp_name_cat, $name_cat . '/' . $image_cat);
    }

    if ($_FILES['modal_cat_image']['error'] == 0) {
        if ($dbHelper->editCategory($id, $name_cat, $image_cat)) {
            header("location:index.php");
        }
    }
    if ($dbHelper->editCategory1($id, $name_cat)) {

        header("location:index.php");

    }


}
if (isset($_POST['delete'])) {
    $name=$_POST['name'];
    $image=$_POST['image'];
    $dbHelper->deleteCategory($_POST['cat_id']);
    unlink("$name/$image");
    rmdir($name);
    header("location:index.php");
}


?>
<?php include("../includes/header.php"); ?>
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Category Page</h4>
        </div>
        <a href="logout.php"  class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Logout</a>
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
                            <input type="text" name="name" required id="cat-name"
                                   class="form-control form-control-line">
                            <span id="same"
                                  style="color: red;visibility:hidden "><i></i>Category Can't Have Same Name</span>
                            <span style=" color: green;visibility:hidden " id="not"><i></i>Great Chose</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Image</label>
                        <div class="col-md-12">
                            <input type="file" name="image" required class="form-control form-control-line">
                            <?php
                            if (isset($error)) {
                                echo "<div class='alert alert-danger'> $error</div>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-lg btn-info center-block" id="save" name="add">
                                Add Category
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
                    <h3 class="box-title">Category</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = $dbHelper->getAllCategories();
                            while ($category = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $category['id']; ?></td>
                                    <td><?= $category['name']; ?></td>
                                    <td><img style="max-width: 90px; max-height: 70px;"
                                             src="<?= $category['name'] . '/' . $category['image'] ?>"></td>

                                    <td>
                                        <button class="btn btn-info update-cat"
                                                data-target="#myModal"
                                                data-toggle="modal"
                                                data-cat-id="<?= $category['id']; ?>"
                                                data-cat-name="<?= $category['name']; ?>"
                                                data-cat-image="<?= $category['image'] ?>">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input name="delete"
                                                   class="btn btn-danger"
                                                   value="Delete"
                                                   type="submit"/>
                                            <input type="hidden" name="cat_id"
                                                   value="<?= $category['id'] ?>"/>
                                            <input type="hidden" name="image" value="<?=$category['image']?>">
                                            <input type="hidden" name="name" value="<?=$category['name']?>">
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
    <!-- modal small -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Manage Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <!--                                <div id="modal_category_title" class="card-header">Update Admin</div>-->
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2"></h3>
                                    </div>
                                    <hr>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="modal_cat_id" id="modal_cat_id"/>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input type="text" id="modal_cat_name" class="form-control"
                                                   name="modal_cat_name">
                                            <input type="hidden" name="old_cat_name" id="old_cat_name">


                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Image</label>
                                            <input type="file" id="modal_cat_image" class="form-control"
                                                   name="modal_cat_image">
                                            <input type="hidden" name="old_cat_image" id="old_cat_image">
                                        </div>


                                        <div>
                                            <button id="modal_submit_btn" type="submit"
                                                    class="btn btn-lg btn-info btn-block " name="update-cat">Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal small -->


<?php include "../includes/footer.php"; ?>