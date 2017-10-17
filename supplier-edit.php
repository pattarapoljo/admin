<?php
include "top.php";
$sup_id = $_GET['sup_id'];
$sql = "SELECT * FROM suppliers WHERE sup_id =".$sup_id;
$result = mysqli_query($link, $sql);
$sups = mysqli_fetch_array($result);

?>


<div class="row">
	<div class="col">
		<form method="post" action="supplier-save.php">
			<input name="sup_id" type="hidden" value="<? echo $sups['sup_name'] ?>">
			<div class="form-group">
				<label for="">ชื่อผู้จัดส่ง่</label>
				<input name="sup_name" type="text" class="form-control" value="<? echo $sups['sup_name'] ?>">
			</div>

			<button type="submit" class="btn btn-success">บันทึก</button>
			<a href="supplier.php" class="btn btn-danger">ยกเลิก</a>
		</form>
	</div>
</div>


<?php include "footer.php"; ?>
