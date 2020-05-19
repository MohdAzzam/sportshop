<?php

require("../includes/db-helper.php");

$dbHelper = DBHelper::getInstance();


$row = $dbHelper->getCategoryByName($_GET['cat_name']);
echo $row['name'];


