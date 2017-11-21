<?php
include "check-login.php";
include "dblink.php";

if (isset($_POST['pro_id'])) {
  $id = $_POST['pro_id'];
  $cat_id= $_POST['cat_id'];
  $sup_id = $_POST['sup_id'];
  $pro_name = $_POST['pro_name'];
  $detail = $_POST['detail'];
  $color = $_POST['color'];
  $size = $_POST['size'];
  $price = $_POST['price'];
  $balance = $_POST['balance'];

  if (is_uploaded_file($_FILES['pro_image']['tmp_name'])) { 
    //delele old image ลบรูปเก่าใน folder ออก
    $sql_select = "SELECT pro_image FROM products  WHERE pro_id ='$id'";
    $result_image = mysqli_query($link,$sql_select);
    $row_image = mysqli_fetch_assoc($result_image);
    $image_old_folder = $row_image['pro_image'];
    unlink("images/products/".$image_old_folder);
    //upload image ดึงนามสกุลรูปที่อัพโหลดมาเก็บใน $ext

    $ext = pathinfo(basename($_FILES['pro_image']['name']),PATHINFO_EXTENSION);
    $new_image_name = 'pr'.uniqid().".".$ext;
    $image_path = "images/products/"; //ที่อยู่รูป
    $upload_path = $image_path.$new_image_name;
    $success = move_uploaded_file($_FILES['pro_image']['tmp_name'],$upload_path);
    $pro_image = $new_image_name;
  }
  
  $sql = "UPDATE products SET cat_id = '$cat_id', sup_id = '$sup_id', pro_name = '$pro_name' , detail = '$detail' , color = '$color' , size = '$size' , price = '$price' , balance = '$balance' , pro_image = '$pro_image'
  WHERE pro_id = '$id'";
  mysqli_query($link, $sql);
  
} else {
  $cat_id= $_POST['cat_id'];
  $sup_id = $_POST['sup_id'];
  $pro_name = $_POST['pro_name'];
  $detail = $_POST['detail'];
  $color = $_POST['color'];
  $size = $_POST['size'];
  $price = $_POST['price'];
  $balance = $_POST['balance'];
  
  $ext = pathinfo(basename($_FILES['pro_image']['name']),PATHINFO_EXTENSION);
  $new_image_name = 'pr'.uniqid().".".$ext;
  $image_path = "images/products/"; //ที่อยู่รูป
  $upload_path = $image_path.$new_image_name;
  $success = move_uploaded_file($_FILES['pro_image']['tmp_name'],$upload_path);
  $pro_image = $new_image_name;

  $sql = "INSERT INTO products
  VALUES('', '$cat_id', '$sup_id', '$pro_name', '$detail', '$color', '$size', '$price', '$balance', '$pro_image')";
  mysqli_query($link, $sql);
}

mysqli_close($link);

header('Location: product.php');
?>
