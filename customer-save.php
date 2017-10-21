<?php
include "check-login.php";
include "dblink.php";

if (isset($_POST['cust_id'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  $id = $_POST['cust_id'];
  $sql = "UPDATE customers SET firstname = '$firstname', lastname = '$lastname',  address = '$address', phone = '$phone', email = '$email'
  WHERE cust_id = '$id'";
  mysqli_query($link, $sql);
} else {
  $email = $_POST['email'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];

  $sql = "INSERT INTO customers
  VALUES('', '$email', '$firstname', '$lastname', '$address', '$phone')";
  mysqli_query($link, $sql);
}

mysqli_close($link);

header('Location: customer.php');
?>
