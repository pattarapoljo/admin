<?php
include "top.php";
$sql = "SELECT * FROM customers";
$result = mysqli_query($link, $sql);
?>

<div class="row">
  <div class="col table-responsive">
    <table class="CTable table table-striped table-bordered">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>ที่อยู่</th>
          <th>โทร</th>
          <th>อีเมล</th>
          <th>คำสั่ง</th>
        </tr>
      </thead>
    <tbody>
      <?php foreach ($result as $key => $value): ?>
        <tr>
          <td><?php echo $value['cust_id'];?></td>
          <td><?php echo $value['firstname'];?></td>
          <td><?php echo $value['lastname'];?></td>
          <td><?php echo $value['address']; ?></td>
          <td><?php echo $value['phone']; ?></td>
          <td><a href="mailto:<?php echo $value['email']; ?>"><?php echo $value['email']; ?></a></td>
          <td>
            <a class="btn btn-warning" href="customer-edit.php?cust_id=<?php echo $value['cust_id']; ?>">แก้ไข</a>
            <a class="btn btn-danger" href="customer-del.php?cust_id=<?php echo $value['cust_id']; ?>">ลบ</a>
          </td>
        </tr>
        <?php endforeach; ?>

    </tbody>
    </table>
    
  </div>
</div>

<?php include "footer.php"; ?>
