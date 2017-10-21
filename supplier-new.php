<?php include "top.php"; ?>

<div class="row">
  <div class="col">
    <form method="post" action="supplier-save.php">
      <div class="form-group"><br>
        <label for="">ชื่อผู้จัดส่ง</label>
        <input name="sup_name" type="text" class="form-control">
				<label for="">ที่อยู่</label>
				<input name="address" type="text" class="form-control">
				<label for="">เบอร์โทร</label>
				<input name="phone" type="text" class="form-control">
				<label for="">บุคคลในการติดต่อ</label>
				<input name="contact_name" type="text" class="form-control">
        <label for="">เว็บไซต์</label>
				<input name="website" type="text" class="form-control">
      </div>
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="supplier.php" class="btn btn-danger">ยกเลิก</a>
    </form>
  </div>
</div>

<?php include "footer.php"; ?>
