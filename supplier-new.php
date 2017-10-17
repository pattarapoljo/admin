<?php include "top.php"; ?>

<div class="row">
  <div class="col">
    <form method="post" action="supplier-save.php">
      <div class="form-group">
        <label for="">ชื่อผู้จัดส่ง</label>
        <input name="cat_name" type="text" class="form-control">
      </div>
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="supplier.php" class="btn btn-danger">ยกเลิก</a>
    </form>
  </div>
</div>

<?php include "footer.php"; ?>
