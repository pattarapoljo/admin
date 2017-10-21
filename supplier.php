<?php
include "top.php";
$sql = "SELECT * FROM suppliers";
$result = mysqli_query($link, $sql);
?>

<div class="row">
  <div class="col">
        <a href="supplier-new.php" class="btn btn-success">เพิ่มผู้จัดส่ง</a>
  </div>
</div>
<div class="row">
  <div class="col table-responsive">
    <table class="CTable table table-striped table-bordered">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อบริษัท</th>
          <th>ที่อยู่</th>
          <th>โทร</th>
          <th>บุคคลในการติดต่อ</th>
          <th>เว็บไซต์</th>
          <th>คำสั่ง</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($result as $key => $value): ?>
        <tr>
          <td><?php echo $value['sup_id']; ?></td>
          <td><?php echo $value['sup_name']; ?></td>
          <td><?php echo $value['address']; ?></td>
          <td><?php echo $value['phone']; ?></td>
          <td><?php echo $value['contact_name']; ?></td>
          <td><?php echo $value['website']; ?></td>
          <td>
            <a class="btn btn-warning" href="supplier-edit.php?sup_id=<?php echo $value['sup_id']; ?>">แก้ไข</a>
            <a class="btn btn-danger" href="supplier-del.php?sup_id=<?php echo $value['sup_id']; ?>">ลบ</a>
          </td>
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
    
    </div>
  </div>

  <?php include "footer.php"; ?>
