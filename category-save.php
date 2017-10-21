<?php
include "check-login.php";
include "dblink.php";

if (isset($_POST['cat_id'])) {
  $name = $_POST['cat_name'];
	$id = $_POST['cat_id'];
	$sql = "UPDATE categories SET cat_name = '$name' WHERE cat_id = '$id'";
	mysqli_query($link, $sql);
} else {
  $name = $_POST['cat_name'];
	$sql = "INSERT INTO categories VALUES('', '$name')";
	mysqli_query($link, $sql);
}

mysqli_close($link);

header('Location: category.php');
?>
