<?php include "top.php"; 

// หมวดหมู่
$sql = "SELECT * FROM categories ";                
$cat = mysqli_query($link,$sql);

// ผู้จัดส่ง
$sql = "SELECT * FROM suppliers  ";
$sup = mysqli_query($link,$sql);
?>


<div class="row">
  <div class="col">
    <form method="post" action="product-save.php" enctype="multipart/form-data">
      <div class="form-group">
            <label for="">ชื่อสินค้า</label>
            <input name="pro_name" type="text" class="form-control">
            <label for="">สี</label>
            <input name="color" type="text" class="form-control">
            <label for="">ขนาด</label>
            <input name="size" type="text" class="form-control">
            <label for="">รายละเอียด</label>
            <textarea name="detail" type="text" class="form-control"></textarea>
            <label for="">ราคา</label>
            <input name="price" type="text" class="form-control">
            <label for="">จำนวน</label>
            <input name="balance" type="text" class="form-control">
            <label for="">เลือกหมวดหมู่สินค้า</label>
        <select name="cat_id" class="form-control">

          <?php foreach ($cat as $key => $value): ?>
              <option value="<?php echo $value['cat_id'] ?>" ><?php echo $value['cat_name'] ?></option>
          <?php endforeach; ?>

        </select>
        <label for="">เลือกผู้จัดส่ง</label>
        <select name="sup_id" class="form-control">

        <?php foreach ($sup as $key => $value): ?>
            <option value="<?php echo $value['sup_id'] ?>" ><?php echo $value['sup_name'] ?></option>
            <?php endforeach; ?>

        </select>
            
        <label for="">รูปภาพ</label>   
        <input name="pro_image" type="file" class="form-control"> 

      </div>
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="product.php" class="btn btn-danger">ยกเลิก</a>
    </form>
  </div>
</div>

<?php include "footer.php"; ?>
