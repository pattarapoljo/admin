<?php
include "top.php";
// สินค้า
$pro_id = $_GET['pro_id'];
$sql = "SELECT * FROM products 
            LEFT JOIN categories USING (cat_id)
            LEFT JOIN suppliers USING (sup_id)
            WHERE pro_id =".$pro_id;
$query = mysqli_query($link, $sql);
$prod = mysqli_fetch_array($query);

// รายการหมวดหมู่
$sql = "SELECT * FROM categories ";
$Categorie = mysqli_query($link,$sql);


// รายการผู้จัดส่ง
$sql = "SELECT * FROM suppliers ";
$Supplier = mysqli_query($link,$sql);

?>

<div class="row">
	<div class="col">
		<form method="post" action="product-save.php" enctype="multipart/form-data">		
			<input name="pro_id" type="hidden" value="<?php echo $prod['pro_id'] ?>">
			<div class="form-group">
				<label for="">ชื่อสินค้า</label>
				<input name="pro_name" type="text" class="form-control" value="<?php echo $prod['pro_name'] ?>">
				<label for="">สี</label>
           		<input name="color" type="text" class="form-control" value="<?php echo $prod['color'] ?>">
            	<label for="">ขนาด</label>
            	<input name="size" type="text" class="form-control" value="<?php echo $prod['size'] ?>">
				<label for="">รายละเอียด</label>
				<textarea name="detail" class="form-control" ><?php echo $prod['detail'] ?></textarea>
				<label for="">ราคา</label>
				<input name="price" type="text" class="form-control" value="<?php echo $prod['price'] ?>">
				<label for="">จำนวน</label>
				<input name="balance" type="text" class="form-control" value="<?php echo $prod['balance'] ?>">

				<label for="">เลือกหมวดหมู่</label>
				<select name="cat_id" class="form-control">

				<?php foreach ($Categorie as $key => $value): ?>
					<?php if ($value['cat_id'] == $prod['cat_id']): ?>
					<option value="<?php echo $value['cat_id'] ?>" selected><?php echo $value['cat_name'] ?></option>
					<?php else: ?>
						<option value="<?php echo $value['cat_id'] ?>" ><?php echo $value['cat_name'] ?></option>
					<?php endif; ?>

			<?php endforeach; ?>

        </select>

				<label for="">เลือกผู้จัดส่ง</label>
				<select name="sup_id" class="form-control">

				<?php foreach ($Supplier as $key => $value): ?>
					<?php if ($value['sup_id'] == $prod['sup_id']): ?>
					<option value="<?php echo $value['sup_id'] ?>" selected><?php echo $value['sup_name'] ?></option>
					<?php else: ?>
						<option value="<?php echo $value['sup_id'] ?>" ><?php echo $value['sup_name'] ?></option>
					<?php endif; ?>

			<?php endforeach; ?>

        </select>

				<label for="">รูปภาพ</label>   
				<input name="pro_image" type="file" class="form-control" value="<?php echo $prod['pro_image'] ?>">
				
			</div>

			<button type="submit" class="btn btn-success">บันทึก</button>
			<a href="product.php" class="btn btn-danger">ยกเลิก</a>
		</form>

	</div>
</div>


<?php include "footer.php"; ?>
