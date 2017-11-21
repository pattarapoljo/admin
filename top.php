<?php
include "check-login.php";
include "dblink.php";
?>
<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">

  <title>ระบบจำหน่ายอะไหล่รถจักรยานยนต์</title>

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Add Material CSS, replace Bootstrap CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<!-- <link rel="stylesheet" href="css/material.css"> -->
</head>

<body style="padding-top:70px">
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">ระบบจำหน่ายอะไหล่รถจักรยานยนต์</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="product.php">สินค้า </a>
      </li>
			<li class="nav-item">
        <a class="nav-link" href="category.php">หมวดหมู่</a>
      </li>
			<li class="nav-item">
        <a class="nav-link" href="supplier.php">ผู้จัดส่ง </a>
      </li>
			<li class="nav-item">
        <a class="nav-link" href="order.php">สั่งซื้อ </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="news.php">ข่าว </a>
      </li>
			<li class="nav-item">
        <a class="nav-link" href="customer.php">ลูกค้า </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="summary.php?from_date=<?php echo date("Y-m-d"); ?>&to_date=<?php echo date("Y-m-d"); ?>">สรุปยอดการสั่งซื้อ </a>
      </li>
			<li class="nav-item">
        <a class="nav-link" href="../shop/index.php">ไปที่ร้านค้า</a>
      </li>

    </ul>

  </div>
</nav>
<div class="container-fluid">
