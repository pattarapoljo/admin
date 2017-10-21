<?php
include "check-login.php";
include "dblink.php";


$cat_id = $_GET['cat_id'];

$sql = "DELETE FROM categories WHERE cat_id = '$cat_id'";
mysqli_query($link, $sql);

mysqli_close($link);

header('Location: category.php');
 ?>
