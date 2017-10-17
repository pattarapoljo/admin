<?php
include "top.php";
$cat_id = $_GET['cat_id'];
$sql = "SELECT * FROM categories WHERE cat_id =".$cat_id;
$result = mysqli_query($link, $sql);
$cats = mysqli_fetch_array($result);

?>


<div class="row">
	<div class="col">
		<form method="post" action="category-save.php">
			<input name="cat_id" type="hidden" value="<?php echo $cats['cat_id'] ?>">
			<div class="form-group">
				<label for="">ชื่อหมวดหมู่</label>
				<input name="cat_name" type="text" class="form-control" value="<?php echo $cats['cat_name'] ?>">
			</div>

			<button type="submit" class="btn btn-success">บันทึก</button>
			<a href="category.php" class="btn btn-danger">ยกเลิก</a>
		</form>
	</div>
</div>


<?php include "footer.php"; ?>
