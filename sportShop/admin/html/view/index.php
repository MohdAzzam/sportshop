<?php
require("../includes/db-helper.php");
$dbHelper = DBHelper::getInstance();
?>
<?php
if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dbHelper->addAdmin($name, $email, $password);
    header("location:index.php");

}
if (isset($_POST['delete'])) {
    $dbHelper->deleteAdmin($_POST['admin_id']);
    header("location:index.php");
}
if (isset($_POST['update'])) {
    $id = $_POST['modal_admin_id'];
    $name = $_POST['modal_admin_name'];
    $email = $_POST['modal_admin_email'];
    $password = $_POST['modal_admin_password'];
    $dbHelper->updateAdmin($id, $name, $email, $password);
    header("location:index.php");

}


?>
<?php include("../includes/header.php"); ?>
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Admin Page</h4>
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
                        <label class="col-md-12">Full Name</label>
                        <div class="col-md-12">
                            <input type="text" name="name"
                                   class="form-control form-control-line"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input type="email"
                                   class="form-control form-control-line" required name="email"
                                   id="admin-email">
                            <span id="la" style="color: red;visibility:hidden "><i class="fa-minus-square"></i>Email ALredy Taken</span>
                            <span style=" color: green;visibility:hidden " id="s7"><i class="fa-check-square"></i>Go A Head</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Password</label>
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-lg btn-info center-block" id="save" name="add">
                                Add Admin
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
                    <h3 class="box-title">Admin</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = $dbHelper->getAdmins();
                            while ($admin = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $admin['id']; ?></td>
                                    <td><?= $admin['name']; ?></td>
                                    <td><?= $admin['email']; ?></td>

                                    <td>
                                        <button class="btn btn-info update-admin"
                                                data-target="#myModal"
                                                data-toggle="modal"
                                                data-admin-id="<?= $admin['id']; ?>"
                                                data-admin-name="<?= $admin['name']; ?>"
                                                data-admin-email="<?= $admin['email']; ?>"
                                                data-admin-password="<?= $admin['password'] ?>">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input name="delete"
                                                   class="btn btn-danger"
                                                   value="Delete"
                                                   type="submit"/>
                                            <input type="hidden" name="admin_id"
                                                   value="<?= $admin['id'] ?>"/>
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
                    <h5 class="modal-title" id="smallmodalLabel">Manage Admin</h5>
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
                                        <input type="hidden" name="modal_admin_id" id="modal_admin_id"/>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input type="text" id="modal_admin_name" class="form-control"
                                                   name="modal_admin_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input type="text" id="modal_admin_email" class="form-control"
                                                   name="modal_admin_email">
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Password</label>
                                            <input type="text" id="modal_admin_password" class="form-control"
                                                   name="modal_admin_password">
                                        </div>


                                        <div>
                                            <button id="modal_submit_btn" type="submit"
                                                    class="btn btn-lg btn-info btn-block " name="update">Update
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