<?php include "top.php";
$sql = "SELECT * FROM tbnewstype ";
$result = mysqli_query($link,$sql);
?>

<div class="row">
  <div class="col">
    <form method="post" action="news-save.php">
      <div class="form-group">
        <label for="">หัวข้อข่าว</label>
        <input name="news_topic" type="text" class="form-control">
				<label for="">รายละเอียด</label>
				<input name="detail" type="text" class="form-control">
				<label for="">วันที่สร้าง</label>
				<input name="news_date" type="date" class="form-control">

        <label for="">เลือกประเภทข่าว</label>
        <select name="newstype_id" class="form-control">

          <?php foreach ($result as $key => $value): ?>
              <option value="<?php echo $value['newstype_id'] ?>" ><?php echo $value['newstype_detail'] ?></option>
          <?php endforeach; ?>

        </select>

      </div>
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="news.php" class="btn btn-danger">ยกเลิก</a>
    </form>
  </div>
</div>

<?php include "footer.php"; ?>
