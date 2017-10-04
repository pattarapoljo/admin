<?php
include "check-login.php";
if(!$_POST) {
	exit;
}
include "dblink.php";
if($_POST['action'] == "add") {
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];

	$sql = "REPLACE INTO customers
	 		 	VALUES('', '$email', '$firstname', '$lastname', '$address', '$phone')";
	mysqli_query($link, $sql);
}
if($_POST['action'] == "edit") {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$id = $_POST['cust_id'];
	$sql = "UPDATE customers SET firstname = '$firstname', lastname = '$lastname',  address = '$address', phone = '$phone', email = '$email'
	 			WHERE cust_id = $id";
	mysqli_query($link, $sql);
}
if($_POST['action'] == "del") {
	$id = $_POST['cust_id'];
	$sql = "DELETE FROM customers WHERE cust_id = $id";
	mysqli_query($link, $sql);
}
mysqli_close($link);
?>
