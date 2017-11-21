<style type="text/css">
img.resize {
width: 100px;
height: 100px;
border: 0;
}
img:hover.resize {
width: 300px;
height: 300px;
border: 0;
}</style>


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
      <th>สถานะ</th>
      <th>รูปภาพการแจ้งโอน</th>
      <th>ตัวเลือก</th>
    </tr>

  </thead>
  <tbody>
    <?php foreach ($result as $key => $value): ?>
      <tr>
        <td><?php echo $value['order_date']; ?></td>
        <td><?php echo $value['order_id']; ?></td>
        <td>
        <?php if ($value['status'] == 'yes'): ?>
          <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i> ได้รับคำสั่งซื้อแล้ว กำลังจัดส่ง</span>
        <?php else: ?>
          <span class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i> ดำเนินการ</span>
        <?php endif; ?>
      </td>
      <td><img src="<?php echo $servUrl; ?>images/slips/<?php echo $value['slip']; ?>" width="100px" height="100px" class="resize"></td>
      <div class="clear"></div>
      <td>
        <a href="order-detail.php?order_id=<?php echo $value['order_id'];  ?>" class="btn btn-warning">รายละเอียด</a>
        <a class="btn btn-danger" href="order-delete.php?order_id=<?php echo $value['order_id']; ?>">ลบ</a>
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
