<?php

require("../includes/db-helper.php");

$dbHelper = DBHelper::getInstance();


$row = $dbHelper->getAdminByEmail($_GET['admin_email']);
echo $row['email'];


