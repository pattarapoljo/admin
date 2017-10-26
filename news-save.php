<?php
include "check-login.php";
include "dblink.php";

if (isset($_POST['news_id'])) {
  $news_topic= $_POST['news_topic'];
  $detail = $_POST['detail'];
  $news_date = $_POST['news_date'];
  $newstype_id = $_POST['newstype_id'];
  // $new_img = $_POST['new_img'];

  $id = $_POST['news_id'];
  $sql = "UPDATE tbnews SET news_topic = '$news_topic', detail = '$detail', news_date = '$news_date' , newstype_id = '$newstype_id'
  WHERE news_id = '$id'";
  mysqli_query($link, $sql);
} else {
  $news_topic= $_POST['news_topic'];
  $detail = $_POST['detail'];
  $news_date = $_POST['news_date'];
  $newstype_id = $_POST['newstype_id'];
  // $new_img = $_POST['new_img'];

  $sql = "INSERT INTO tbnews
  VALUES ('', '$news_topic', '$detail', '$news_date', '$newstype_id')";
  mysqli_query($link, $sql);
}

  mysqli_close($link);

  header('Location: news.php');
  ?>
