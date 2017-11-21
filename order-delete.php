<?php
include "check-login.php";
include "dblink.php";

$order_id = $_GET['order_id'];

$sql = "DELETE FROM orders WHERE order_id = '$order_id'";
mysqli_query($link, $sql);

mysqli_close($link);
header('Location: order.php');
?>
