<?php include "../includes/db-helper.php";
$dbHelper = DBHelper::getInstance();
?>
<?php include "../includes/header.php";?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Show Order Page</h4>
            </div>
            <a href="logout.php"  class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Logout</a>

        </div>
        <!-- /.row -->
        <!-- .row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">Order</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th>Product Name </th>
                                    <th>Quantity</th>
                                    <th>Toatal</th>
                                    <th><a href="index.php">Back TO order Page</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = $dbHelper->innerJoinOrderProduct($_GET['id']);
                                while ($order_detals = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?=$order_detals['name_pro']?></td>
                                        <td><?=$order_detals['quantity']?></td>
                                        <td><?=$order_detals['sub_total']?></td>

                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <?php include "../includes/footer.php";?>
