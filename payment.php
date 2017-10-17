<?php
include "top.php";
$sql = "SELECT * FROM payments";
$result = mysqli_query($link, $sql);

?>

<div class="row">
  <div class="col">
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

      </table>

    </div>

<?php include "footer.php"; ?>
