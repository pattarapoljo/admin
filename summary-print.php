<?php include "print-top.php" ?>
<?php
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];


$sql = "SELECT * from orders
          LEFT JOIN order_details USING (order_id)
          LEFT JOIN products USING (pro_id)
          LEFT JOIN categories USING (cat_id)
          WHERE order_date >= '$from_date' AND order_date <= '$to_date'
          ORDER BY order_date DESC ";
$result = mysqli_query($link, $sql);


?>

<page size="A4">
  <div class="container">
    <hr style="border:none; padding-top:20px">
    <div class="row">
      <div class="col text-center">
        <h1>รายงานสรุปยอดขายจำแนกสินค้า</h1>
      </div>
    </div>
    <div class="row">
      <div class="col text-center">
        <p>ผลการค้นหาจากวันที่ <?php echo $from_date ?> ถึงวันที่ <?php echo $to_date ?> </p>
      </div>
    </div>
  <div class="row">
    <div class="col table-responsive">
      <table class="CTable table table-bordered" style="font-size:12px">
        <thead>
          <tr>
            <th>วันที่</th>
            <th>รหัสการสั่งซื้อ</th>
            <th>ประเภทสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>รวม</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sum = 0;
            foreach ($result as $key => $value): ?>
              <tr>
                <td><?php echo date( 'j/m/y', strtotime($value['order_date']) ); ?></td>
                <td><?php echo $value['order_id']; ?></td>
                <td><?php echo $value['cat_name']; ?></td>
                <td><?php echo $value['pro_name']; ?></td>
                <td><?php echo $value['price']; ?></td>
                <td><?php echo $value['quantity']; ?></td>
                <td><?php echo $value['quantity']*$value['price']; ?></td>
              </tr>
            <?php
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
