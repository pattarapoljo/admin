<?php
include "top.php";
$sql = "SELECT * FROM payments";
$result = mysqli_query($link, $sql);
?>

<div class="row">
  <div class="col table-responsive">
    <table class="CTable table table-striped table-bordered">
      <thead>
        <tr>
          <th>รหัสการสั่งซื้อ</th>
          <th>ธนาคาร</th>
          <th>สถานที่โอน</th>
          <th>จำนวน</th>
          <th>วันเวลา</th>
          <th>อีเมลผู้โอน</th>
          <th>คำสั่ง</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($result as $key => $value): ?>
          <tr>
            <td><?php echo $value['order_id'];; ?></td>
            <td><?php echo $value['bank']; ?></td>
            <td><?php echo $value['location']; ?></td>
            <td><?php echo $value['amount']; ?></td>
            <td><?php echo $value['transfer_date']; ?></td>
            <td></td>
            <td>
              
              <?php if ($value['confirm'] == 'yes'): ?>
                <span class="badge badge-secondary">ได้รับแล้ว</span>
              <?php else: ?>
                <a href="payment-confirm.php?pay_id=<?php echo $value['pay_id']; ?>" class="btn btn-success" >ยืนยัน</a>
                <a class="btn btn-danger" href="payment-del.php?cat_id=<?php echo $value['pay_id']; ?>">ลบ</a>
              <?php endif; ?>

              </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
      </table>

    </div>

<?php include "footer.php"; ?>
