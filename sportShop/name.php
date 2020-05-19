<?php

require("admin/html/includes/db-helper.php");

$dbHelper = DBHelper::getInstance();


$row = $dbHelper->getUserByEmail($_GET['user_email']);
echo $row['email'];


