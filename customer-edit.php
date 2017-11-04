<?php
include "top.php";
$cust_id = $_GET['cust_id'];
$sql = "SELECT * FROM customers WHERE cust_id =".$cust_id;
$result = mysqli_query($link, $sql);
$custs = mysqli_fetch_array($result);

?>


<div class="row">
	<div class="col">
		<form method="post" action="customer-save.php">
			<input name="cust_id" type="hidden" value="<?php echo $custs['cust_id'] ?>">
			<div class="form-group">
				<label for="">ชื่อ</label>
				<input name="firstname" type="text" class="form-control" value="<?php echo $custs['firstname'] ?>">
				<label for="">นามสกุล</label>
				<input name="lastname" type="text" class="form-control" value="<?php echo $custs['lastname'] ?>">
				<label for="">ที่อยู่</label>
				<textarea name="address" class="form-control" ><?php echo $custs['address'] ?></textarea>
				<label for="">เบอร์โทร</label>
				<input name="phone" type="text" class="form-control" value="<?php echo $custs['phone'] ?>">
				<label for="">อีเมลล์</label>
				<input name="email" type="text" class="form-control" value="<?php echo $custs['email'] ?>">
			</div>

			<button type="submit" class="btn btn-success">บันทึก</button>
			<a href="customer.php" class="btn btn-danger">ยกเลิก</a>
		</form>
	</div>
</div>


<?php include "footer.php"; ?>
