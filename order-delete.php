<?php
include "check-login.php";
include "dblink.php";

$item_id = $_POST['item_id'];

$sql = "DELETE FROM order_details WHERE item_id = '$item_id'";
mysqli_query($link, $sql);

mysqli_close($link);
?>
