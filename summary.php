<?php
include "top.php";
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


<form method="get" action="summary.php">
  <div class="form-row ">
    <div class="col-sm-3">
      <label for="">ค้นหาจากวันที่</label>
      <input name="from_date" type="date" class="form-control" value="<?php echo $from_date ?>">
    </div>
    <div class="col-sm-3">
      <label for="">ถึงวันที่</label>
      <div class="input-group mb-2 mb-sm-0">
        <input name="to_date" type="date" class="form-control" value="<?php echo $to_date ?>">
      </div>
    </div>
    <div class="col-sm-6">
      <button type="submit" class="btn btn-primary">ค้นหา</button>
    </div>

    <div class="col text-right">
    <a href="summary-print.php?from_date=<?php echo $from_date ?>&to_date=<?php echo $to_date ?>" target="_blank" class="btn btn-info" >พิมพ์</a>
    </div>
  </div>
</form>

<div class="row">
  <div class="col table-responsive">
    <table class=" table table-striped table-bordered">
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
        <td><?php echo $value['order_date']; ?></td>
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

    </tbody>
    <tfoot>
      <tr>
        <th colspan="6" class="text-right">รวม</th>
        <th><?php echo $sum; ?></th>
      </tr>
    </tfoot>
</table>
</div>
</div>
<?php include "footer.php"; ?>
