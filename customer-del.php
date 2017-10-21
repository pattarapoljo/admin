<?php
include "check-login.php";
include "dblink.php";


$cust_id = $_GET['cust_id'];

$sql = "DELETE FROM customers WHERE cust_id = '$cust_id'";
mysqli_query($link, $sql);

mysqli_close($link);

header('Location: customer.php');
?>
