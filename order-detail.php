<?php
include "top.php";

// บิลขาย
$order_id = $_GET['order_id'];
$sql = "SELECT * FROM orders WHERE order_id = '$order_id'";
$result = mysqli_query($link, $sql);
$order = mysqli_fetch_array($result);

// รายการสินค้า

$sql = "SELECT * FROM order_details
      LEFT JOIN products USING (pro_id)
      WHERE order_id = '$order_id'";
$order_details = mysqli_query($link, $sql);

// รายละเอียดลูกค้า
$cust_id = $order['cust_id'];
$sql = "SELECT * FROM customers WHERE cust_id = '$cust_id'";
$result = mysqli_query($link, $sql);
$customers = mysqli_fetch_array($result);

?>

<div class="row">
  <div class="col-1">
    <h5>ชื่อ:</h5>
  </div>
  <div class="col-11">
    <h5><?php echo $customers['firstname'] . "  " . $customers['lastname'];?></h5>
  </div>
</div>

<div class="row">
  <div class="col-1">
    <h5>ที่อยู่:</h5>
  </div>
  <div class="col-11">
    <h5><?php echo $customers['address'];?></h5>
  </div>
</div>

<div class="row">
  <div class="col-1">
    <h5>โทร:</h5>
  </div>
  <div class="col-11">
    <h5><?php echo $customers['phone'];?></h5>
  </div>
</div>

<div class="row">
  <div class="col-1">
    <h5>อีเมลล์:</h5>
  </div>
  <div class="col-11">
    <h5>
      <a href="mailto:<?php echo $customers['email'];?>">
        <?php echo $customers['email'];?>
      </a>
      </h5>
  </div>
</div>

<div class="row">
  <div class="col">
    <h5>วันที่: <?php echo $order['order_date'];?> รหัสการสั่งซื้อ: <?php echo $order['order_id'];?></h5>
  </div>
</div>
<hr>
<div class="row">
  <div class="col">
    <a href="order-delivery.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-danger" >จัดส่งสินค้า</a>
  </div>
  <div class="col text-right">
    <a href="invoice.php?order_id=<?php echo $order['order_id']; ?>" target="_blank" class="btn btn-info" >พิมพ์</a>
  </div>
</div>
<hr>
<div class="row">
  <div class="col table-responsive">
    <table class="CTable table table-striped table-bordered">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่อสินค้า</th>
      <th>คุณลักษณะ</th>
      <th>ราคา</th>
      <th>จำนวน</th>
      <th>รวม</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php
    $index = 0;
    $sum = 0;
     foreach ($order_details as $key => $value): ?>
     <tr>

      <td><?php echo $index+1; ?></td>
      <td><?php echo $value['pro_name']; ?></td>
      <td><?php echo $value['attribute']; ?></td>
      <td><?php echo $value['price']; ?></td>
      <td><?php echo $value['quantity']; ?></td>
      <td><?php echo $value['quantity']*$value['price']; ?></td>
    </tr>
    <?php
    $index++;
    $sum += $value['quantity'] * $value['price'];
  endforeach; ?>
    </tr>

    <tr>
      <td colspan="5" class="text-right">รวม</td>
      <td><?php echo $sum; ?></td>
    </tr>
  </tbody>

</table>

</div>
</div>
