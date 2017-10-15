<?php
include "top.php";

$sql = "SELECT * FROM categories";
$result = mysqli_query($link, $sql);
?>

<div class="row">
  <div class="col">
    <button id="add-cat" class="btn btn-success">เพิ่มหมวดหมู่</button>
  </div>
</div>
<div class="row">
  <div class="col">
    <table class="CTable table table-striped table-bordered">
      <colgroup><col id="c1"><col id="c2"><col id="c3"></colgroup>
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
              <button type="button" class="btn btn-warning" data-id="<?php echo $cat['cat_id']; ?>">แก้ไข</button>
              <button type="button" class="btn btn-danger" data-id="<?php echo $cat['cat_id']; ?>">ลบ</button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php include "footer.php"; ?>
