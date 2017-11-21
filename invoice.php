<?php include "print-top.php" ?>
<?php
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

<page size="A4">
  <div class="container">
    <hr style="border:none; padding-top:20px">
    <div class="row">
      <div class="col text-center">
        <h1>ใบสั่งซื้อ</h1>
      </div>
    </div>
<hr>
    <div class="row">

      <div class="col">
        <div class="row">
          <div class="col">
            ชื่อ: <?php echo $customers['firstname'] . "  " . $customers['lastname'];?>
          </div>

        </div>

        <div class="row">
          <div class="col">
            ที่อยู่: <?php echo $customers['address'];?>
          </div>
        </div>

        <div class="row">
          <div class="col">
            โทร: <?php echo $customers['phone'];?>
          </div>

        </div>

        <div class="row">
          <div class="col">
            อีเมลล์: <?php echo $customers['email'];?>
          </div>

        </div>
      </div>

      <div class="col">
        <div class="row">
          <div class="col">
            รหัสการสั่งซื้อ: <?php echo $order['order_id'];?>
          </div>
        </div>
        <div class="row">
          <div class="col">
            วันที่: <?php echo $order['order_date'];?>
          </div>
        </div>
      </div>

    </div>



<hr>
  <div class="row">
    <div class="col table-responsive">
      <table class="CTable table table-bordered">
        <thead>
          <tr>
            <th>ลำดับ</th>
            <th>ชื่อสินค้า</th>
            <th>สี</th>
            <th>ขนาด</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>รวม</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            $sum = 0;
            foreach ($order_details as $key => $value): ?>
            <tr>

              <td><?php echo $index+1; ?></td>
              <td><?php echo $value['pro_name']; ?></td>
              <td><?php echo $value['color']; ?></td>
              <td><?php echo $value['size']; ?></td>
              <td><?php echo $value['price']; ?></td>
              <td><?php echo $value['quantity']; ?></td>
              <td><?php echo $value['quantity']*$value['price']; ?></td>
            </tr>
            <?php
            $index++;
            $sum += $value['quantity'] * $value['price'];
          endforeach; ?>


        <tr style="background-color:#f1f1f1">
          <td colspan="6" class="text-right">รวม</td>
          <td><?php echo $sum; ?></td>
        </tr>
      </tbody>

    </table>

    </div>
  </div>

  </div>

</page>


<?php include "print-footer.php" ?>
