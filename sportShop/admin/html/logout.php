<?php
session_start();
unset($_SESSION['admin_id']);
header("location:Login_v2/login.php");