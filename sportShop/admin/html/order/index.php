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
            <a href="../logout.php"  class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Logout</a>

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
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Deliver Date</th>
                                    <th>Toatal</th>
                                    <th>Show Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = $dbHelper->innerJoinOrderCustomer();
                                while ($order = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?=$order['id']?></td>
                                        <td><?=$order['name']?></td>
                                        <td><?=$order['date']?></td>
                                        <td><?=$order['deliver_date']?></td>
                                        <td><?=$order['total']?></td>
                                        <td><a href="showorder.php?id=<?=$order['id']?>">Show</a></td>
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
