<?php
 include "check-login.php";
 include "dblink.php";


 $pro_id = $_GET['pro_id'];

 $sql = "DELETE FROM products WHERE pro_id = '$pro_id'";
 mysqli_query($link, $sql);


 mysqli_close($link);

 header('Location: product.php');
  ?>
