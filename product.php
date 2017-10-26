<?php
include "top.php";
$sql = "SELECT * FROM products
        LEFT JOIN categories USING (cat_id)
        LEFT JOIN suppliers USING (sup_id) ";
$result = mysqli_query($link, $sql);
?>

<div class="row">
  <div class="col">
        <a href="product-new.php" class="btn btn-success">เพิ่มสินค้า</a>
  </div>
</div>
<div class="row">
  <div class="col table-responsive">
    <table class="CTable table table-striped table-bordered">
      <?php
      include "lib/IMGallery/imgallery-no-jquery.php";
      while($pro = mysqli_fetch_array($result))
      ?>
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>รูปภาพ</th>
          <th>ชื่อสินค้า</th>
          <th>ราคา</th>
          <th>จำนวน</th>
          <th>หมวดหมู่</th>
          <th>ผู้จัดส่ง</th>
          <th>ตัวเลือก</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($result as $key => $value): ?>
        <tr>
          <td><?php echo $value['pro_id']; ?></td>
          <td>
        <span class="tag"></span><br>
        <?php
     		$sql = "SELECT * FROM images WHERE pro_id = {$pro['pro_id']}";
     		$r = mysqli_query($link, $sql);
     		if(($r) > 0) {
     			$src = "read-image.php?id=";
     			gallery_thumb_width(70);
     			while($img =mysqli_fetch_array($r)) {
     				gallery_echo_img($src . $img['img_id']);
     			}
     		}
     	?>
      </td>
          <td><?php echo $value['pro_name']; ?></td>
          <td><?php echo $value['price']; ?></td>
          <td><?php echo $value['balance']; ?></td>
          <td><?php echo $value['cat_name']; ?></td>
          <td><?php echo $value['sup_name']; ?></td>
          <td>
            <a class="btn btn-warning" href="product-edit.php?pro_id=<?php echo $value['pro_id']; ?>">แก้ไข</a>
            <a class="btn btn-danger" href="product-del.php?pro_id=<?php echo $value['pro_id']; ?>">ลบ</a>
          </td>
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>

    </div>
  </div>

  <?php include "footer.php"; ?>
