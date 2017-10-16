<?php
include "top.php";
// include "CategoryAction.php";
$sql = "SELECT * FROM categories";
$result = mysqli_query($link, $sql);

?>

<div class="row">
  <div class="col">
    <a href="category-new.php" class="btn btn-success">เพิ่มหมวดหมู่</a>

  </div>
</div>
<div class="row">
  <div class="col">
    <table class="CTable table table-striped table-bordered">
      <thead>
        <tr>
          <th>รหัส</th>
          <th>ชื่อหมวดสินค้า</th>
          <th>คำสั่ง</th>
        </tr>
      </thead>
      <tbody>
        <?php while($cat = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $cat['cat_id']; ?></td>
            <td><?php echo $cat['cat_name']; ?></td>
            <td>
              <a class="btn btn-warning" href="category-edit.php?cat_id=<?php echo $cat['cat_id']; ?>">แก้ไข</a>
              <a class="btn btn-danger" href="category-del.php?cat_id=<?php echo $cat['cat_id']; ?>">ลบ</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>


<?php include "footer.php"; ?>
