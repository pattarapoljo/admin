<?php
include "check-login.php";
include "dblink.php";


$pay_id = $_GET['pay_id'];
$order_id = $_GET['order_id'];

$sql = "UPDATE payments SET confirm = 'yes' WHERE pay_id = '$pay_id'";
mysqli_query($link, $sql);

$sql = "UPDATE orders SET paid = 'yes' WHERE order_id = '$order_id'";
mysqli_query($link, $sql);

mysqli_close($link);

header('Location: payment.php');
?>
