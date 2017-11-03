<?php
include "check-login.php";
include "dblink.php";

if (isset($_POST['news_id'])) {
  $id = $_POST['news_id'];
  $news_topic= $_POST['news_topic'];
  $detail = $_POST['detail'];
  $news_date = $_POST['news_date'];
  $newstype_id = $_POST['newstype_id'];
  // $new_img = $_POST['new_img'];

  if (is_uploaded_file($_FILES['news_image']['tmp_name'])) { 
    //delele old image ลบรูปเก่าใน folder ออก
    $sql_select = "SELECT news_image FROM tbnews  WHERE news_id ='$id'";
    $result_image = mysqli_query($link,$sql_select);
    $row_image = mysqli_fetch_assoc($result_image);
    $image_old_folder = $row_image['news_image'];
    unlink("images/news/".$image_old_folder);
    //upload image ดึงนามสกุลรูปที่อัพโหลดมาเก็บใน $ext

    $ext = pathinfo(basename($_FILES['news_image']['name']),PATHINFO_EXTENSION);
    $new_image_name = 'ne'.uniqid().".".$ext;
    $image_path = "images/news/"; //ที่อยู่รูป
    $upload_path = $image_path.$new_image_name;
    $success = move_uploaded_file($_FILES['news_image']['tmp_name'],$upload_path);
    $news_image = $new_image_name;
  }

  $sql = "UPDATE tbnews SET news_topic = '$news_topic', detail = '$detail', news_date = '$news_date' , newstype_id = '$newstype_id' , news_image = '$news_image'
  WHERE news_id = '$id'";
  mysqli_query($link, $sql);
} else {
  $news_topic= $_POST['news_topic'];
  $detail = $_POST['detail'];
  $news_date = $_POST['news_date'];
  $newstype_id = $_POST['newstype_id'];
  
  $ext = pathinfo(basename($_FILES['news_image']['name']),PATHINFO_EXTENSION);
  $new_image_name = 'ne'.uniqid().".".$ext;
  $image_path = "images/news/"; //ที่อยู่รูป
  $upload_path = $image_path.$new_image_name;
  $success = move_uploaded_file($_FILES['news_image']['tmp_name'],$upload_path);
  $news_image = $new_image_name;

  $sql = "INSERT INTO tbnews
  VALUES ('', '$news_topic', '$detail', '$news_date', '$newstype_id', '$news_image')";
  mysqli_query($link, $sql);
}

  mysqli_close($link);

  header('Location: news.php');
  ?>
