<?php
include "top.php";
$sql = "SELECT * FROM payments";
$result = mysqli_query($link, $sql);
<<<<<<< HEAD
?>

<div class="row">
  <div class="col table-responsive">
=======

?>

<div class="row">
  <div class="col">
>>>>>>> 4f5a45a68b39bc72444aaf0b58aead4a45d7a45e
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
<<<<<<< HEAD
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
=======
      <?php
      while($pay = mysqli_fetch_array($result)) {
        $class = 'enable';
        $img_pay = "images/no.png";
        if($pay['confirm']=='yes') {
          $class = 'disable';
          $img_pay = "images/yes.png";
        }
        ?>
        <tr>
          <td><?php echo $pay['order_id'];; ?></td>
          <td><?php echo $pay['bank']; ?></td>
          <td><?php echo $pay['location']; ?></td>
          <td><?php echo $pay['amount']; ?></td>
          <td><?php echo $pay['transfer_date']; ?></td>
          <td><?php echo $cus['email']; ?></a></td>
          <td>
            <img src="<?php echo $img_pay; ?>">
            <a href="#" class="<?php echo $class; ?>"
              data-id="<?php echo $pay['pay_id']; ?>"
              data-order="<?php echo $pay['order_id']; ?>">ได้รับแล้ว</a>
              <a class="btn btn-danger" href="payment-del.php?cat_id=<?php echo $pay['pay_id']; ?>">ลบ</a>
            </td>
          </tr>
          <?php  } ?>

>>>>>>> 4f5a45a68b39bc72444aaf0b58aead4a45d7a45e
      </table>

    </div>

<?php include "footer.php"; ?>
