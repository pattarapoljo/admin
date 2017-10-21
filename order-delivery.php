<?php
include "check-login.php";
include "dblink.php";

$order_id = $_GET['order_id'];
$sql = "UPDATE orders SET delivery = 'yes' WHERE order_id = '$order_id'";
mysqli_query($link, $sql);

//ลบจำนวนคงเหลือของสินค้าแต่ละชนิดเท่ากับจำนวนที่ส่งออกไป
$sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
$result = mysqli_query($link, $sql);
while($item = mysqli_fetch_array($result)) {
	$pro_id = $item['pro_id'];
	$balance = $item['balance'];
	$sql = "UPDATE products SET balance = balance - $balance WHERE pro_id = '$pro_id'";
	mysqli_query($link, $sql);
}

mysqli_close($link);

header('Location: order.php');
?>
