<?php
include "top.php";
$sql = "SELECT * from orders ORDER BY order_date DESC ";
$result = mysqli_query($link, $sql);
?>

<div class="row">
  <div class="col table-responsive">
    <table class="CTable table table-striped table-bordered">
  <thead>

    <tr>
      <th>วันที่</th>
      <th>รหัสการสั่งซื้อ</th>
      <th>การชำระเงิน</th>
      <th>การจัดส่งสินค้า</th>
      <th>ตัวเลือก</th>
    </tr>

  </thead>
  <tbody>
    <?php foreach ($result as $key => $value): ?>
      <tr>
        <td><?php echo $value['order_date']; ?></td>
        <td><?php echo $value['order_id']; ?></td>
        <td>
          <?php if ($value['paid'] == 'yes'): ?>
            <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i> ชำระแล้ว</span>
          <?php else: ?>
            <span class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i> ยังไม่ชำระ</span>
          <?php endif; ?>
        </td>
        <td>
        <?php if ($value['delivery'] == 'yes'): ?>
          <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i> จัดส่งสินค้าแล้ว</span>
        <?php else: ?>
          <span class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i> ยังไม่จัดส่ง</span>
        <?php endif; ?>
      </td>
      <td>
        <a href="order-detail.php?order_id=<?php echo $value['order_id'];  ?>" class="btn btn-warning">รายละเอียด</a>
        <a class="btn btn-danger" href="order-delete.php?itam_id=<?php echo $item['itam_id']; ?>">ลบ</a>
      </td>
      </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</div>
</div>


<?php
mysqli_close($link);
?>
</body>

<?php include "footer.php"; ?>
