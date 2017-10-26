<?php
include "check-login.php";
include "dblink.php";


$news_id = $_GET['news_id'];

$sql = "DELETE FROM tbnews WHERE news_id = '$news_id'";
mysqli_query($link, $sql);
if (mysqli_query($link, $sql)) {
  header('Location: news.php');
} else {
  echo "Fail";
}
mysqli_close($link);

header('Location: news.php');
?>
