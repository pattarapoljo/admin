 <?php
 include "check-login.php";
 include "dblink.php";


 $sup_id = $_GET['sup_id'];

 $sql = "DELETE FROM suppliers WHERE sup_id = '$sup_id'";
 mysqli_query($link, $sql);

 mysqli_close($link);

 header('Location: supplier.php');
  ?>
