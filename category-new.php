<?php include "top.php"; ?>

<div class="row">
	<div class="col">
		<form method="post" action="category-save.php">
			<div class="form-group" ><br>
				<label for="">ชื่อหมวดหมู่</label>
				<input name="cat_name" type="text" class="form-control">
			</div>
			<button type="submit" class="btn btn-success">บันทึก</button>
			<a href="category.php" class="btn btn-danger">ยกเลิก</a>
		</form>
	</div>
</div>

<?php include "footer.php"; ?>
