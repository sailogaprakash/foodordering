<?php
require 'db.php';
session_start();
$total = 0;
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
    exit();
} else {
    $sql = "delete from tbl_cart where user_id= $_SESSION[user_id] ";
    mysqli_query($con, $sql);
    header("location:order.php");
    exit();
}
