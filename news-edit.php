<?php
include "top.php";
// ข่าว
$news_id = $_GET['news_id'];
$sql = "SELECT * FROM tbnews
				LEFT JOIN tbnewstype USING (newstype_id)
			WHERE news_id =" .$news_id;
$query = mysqli_query($link, $sql);
$News = mysqli_fetch_array($query);

// รายการข่าว
$sql = "SELECT * FROM tbnewstype ";
$NewsType = mysqli_query($link,$sql);

?>

<div class="row">
	<div class="col">
	<form method="post" action="news-save.php" enctype="multipart/form-data">
			<input name="news_id" type="hidden" value="<?php echo $News['news_id'] ?>">
			<div class="form-group">
				<label for="">หัวข้อข่าว</label>
				<input name="news_topic" type="text" class="form-control" value="<?php echo $News['news_topic'] ?>">
				<label for="">รายละเอียด</label>
				<input name="detail" type="text" class="form-control" value="<?php echo $News['detail'] ?>">
				<label for="">วันที่่</label>
				<input name="news_date" type="date" class="form-control" value="<?php echo $News['news_date'] ?>">

				<label for="">เลือกประเภทข่าว</label>
				<select name="newstype_id" class="form-control">

					<?php foreach ($NewsType as $key => $value): ?>
						<?php if ($value['newstype_id'] == $News['newstype_id']): ?>
							<option value="<?php echo $value['newstype_id'] ?>" selected><?php echo $value['newstype_detail'] ?></option>
							<?php else: ?>
								<option value="<?php echo $value['newstype_id'] ?>" ><?php echo $value['newstype_detail'] ?></option>
						<?php endif; ?>

					<?php endforeach; ?>

        </select>

				<label for="">รูปภาพ</label>   
				<input name="news_image" type="file" class="form-control" value="<?php echo $News['news_image'] ?>">

			</div>

			<button type="submit" class="btn btn-success">บันทึก</button>
			<a href="news.php" class="btn btn-danger">ยกเลิก</a>
		</form>

	</div>
</div>


<?php include "footer.php"; ?>
