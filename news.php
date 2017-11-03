<?php
include "top.php";

$sql = "SELECT * FROM tbnews LEFT JOIN tbnewstype USING (newstype_id)";
$result = mysqli_query($link,$sql);
?>

<div class="row">
  <div class="col">
        <a href="news-new.php" class="btn btn-success">เพิ่มข่าว</a>
  </div>
</div>

<div class="row">
  <div class="col table-responsive">
    <table class="CTable table table-striped table-bordered">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>หัวข้อข่าว</th>
          <th>รายละเอียด</th>
          <th>วันที่่</th>
          <th>รูปภาพข่าว</th>
          <th>ประเภทข่าว</th>
          <th>ตัวเลือก</th>
        </tr>
      </thead>
    <tbody>
      <?php foreach ($result as $key => $value): ?>
        <tr>
          <td><?php echo $value['news_id'];?></td>
          <td><?php echo $value['news_topic'];?></td>
          <td><?php echo $value['detail'];?></td>
          <td><?php echo $value['news_date']; ?></td>
          <td><img src="images/news/<?php echo $value['news_image']; ?>" width="100px" height="100px"></td>
          <td><?php echo $value['newstype_detail']; ?></td>
          <td>
            <a class="btn btn-warning" href="news-edit.php?news_id=<?php echo $value['news_id']; ?>">แก้ไข</a>
            <a class="btn btn-danger" href="news-del.php?news_id=<?php echo $value['news_id']; ?>">ลบ</a>
          </td>
        </tr>
        <?php endforeach; ?>

    </tbody>
    </table>

  </div>
</div>

<?php include "footer.php"; ?>
