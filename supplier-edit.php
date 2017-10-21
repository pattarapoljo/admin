<?php
include "top.php";
$sup_id = $_GET['sup_id'];
$sql = "SELECT * FROM suppliers WHERE sup_id =".$sup_id;
$result = mysqli_query($link, $sql);
$sups = mysqli_fetch_array($result);

?>


<br><div class="row">
	<div class="col">
		<form method="post" action="supplier-save.php">
			<input name="sup_id" type="hidden" value="<?php echo $sups['sup_id'] ?>">
			<div class="form-group">
				<label for="">ชื่อบริษัท</label>
				<input name="sup_name" type="text" class="form-control" value="<?php echo $sups['sup_name'] ?>">
				<label for="">ที่อยู่</label>
				<input name="address" type="text" class="form-control" value="<?php echo $sups['address'] ?>">
				<label for="">เบอร์โทร</label>
				<input name="phone" type="text" class="form-control" value="<?php echo $sups['phone'] ?>">
				<label for="">บุคคลในการติดต่อ</label>
				<input name="contact_name" type="text" class="form-control" value="<?php echo $sups['contact_name'] ?>">
				<label for="">เว็บไซต์</label>
				<input name="website" type="text" class="form-control" value="<?php echo $sups['website'] ?>">
			</div>

			<button type="submit" class="btn btn-success">บันทึก</button>
			<a href="supplier.php" class="btn btn-danger">ยกเลิก</a>
		</form>
	</div>
</div>


<?php include "footer.php"; ?>
