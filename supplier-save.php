<?php
include "check-login.php";
include "dblink.php";

if (isset($_POST['sup_id'])) {
  $name = $_POST['sup_name'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $contact = $_POST['contact_name'];
  $website = $_POST['website'];

  $id = $_POST['sup_id'];
  $sql = "UPDATE suppliers SET sup_name = '$name', address = '$address', phone = '$phone', contact_name = '$contact', website = '$website'
  WHERE sup_id = '$id'";
  mysqli_query($link, $sql);
} else {
  $name = $_POST['sup_name'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $contact = $_POST['contact_name'];
  $website = $_POST['website'];

  $sql = "INSERT INTO suppliers
  VALUES('', '$name', '$address', '$phone', '$contact', '$website')";
  mysqli_query($link, $sql);
}

mysqli_close($link);

header('Location: supplier.php');
?>
