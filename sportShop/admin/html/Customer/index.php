<?php include "../includes/db-helper.php";
$dbHelper = DBHelper::getInstance();
if (isset($_POST['delete'])) {
    $dbHelper->deleteCustomer($_POST['customer_id']);
    header("location:index.php");
}


?>
<?php include "../includes/header.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Show Customer Page</h4>
            </div>
            <a href="logout.php" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Logout</a>

        </div>
        <!-- /.row -->
        <!-- .row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">Customer</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Addres</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = $dbHelper->getAllCustomer();
                                while ($customer = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $customer['id']; ?></td>
                                        <td><?= $customer['name']; ?></td>
                                        <td><?= $customer['email'] ?></td>
                                        <td><?= $customer['address'] ?></td>
                                        <td>
                                            <form method="post">
                                                <input name="delete"
                                                       class="btn btn-danger"
                                                       value="Delete"
                                                       type="submit"/>
                                                <input type="hidden" name="customer_id"
                                                       value="<?= $customer['id'] ?>"/>
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
