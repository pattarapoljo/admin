<?php
include "top.php";
?>

<body style="padding-top:70px">
  <?php include "top.php"; ?>
  <div class="container">
    <?php
    include "dblink.php";
    include "lib/pagination.php";

    $sql = "SELECT * FROM suppliers";
    $result = page_query($link, $sql, 20);
    $first = page_start_row();
    $last = page_stop_row();
    $total = page_total_rows();
    if($total == 0) {
      $first = 0;
    }
    ?>
    <div align="right">
      <button id="add-sup">เพิ่มผู้จัดส่งสินค้า</button>
    </div>
    <table class="CTable">
      <colgroup><col id="c1"><col id="c2"><col id="c3"><col id="c4"><col id="c5"><col id="c6"></colgroup>
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อผู้จัดส่งสินค้า</th>
          <th>ที่อยู่</th>
          <th>โทร</th>
          <th>บุคคลในการติดต่อ</th>
          <th>คำสั่ง</th>
        </tr>
      </thead>
      <?php
      $row = $first;
      while($sup = mysqli_fetch_array($result)) {
        if(!empty($sup['website'])) {
          $sup['sup_name'] = "<a href=\"{$sup['website']}\" target=\"_blank\">{$sup['sup_name']}</a>";
        }
        ?>
        <tr>
          <td><?php echo $row; ?></td>
          <td><?php echo $sup['sup_name']; ?></td>
          <td><?php echo $sup['address']; ?></td>
          <td><?php echo $sup['phone']; ?></td>
          <td><?php echo $sup['contact_name']; ?></td>
          <td>
            <button type="button" class="edit btn btn-primary btn-sm" data-id="<?php echo $sup['sup_id']; ?>">แก้ไข</button>
            <button type="button" class="del btn btn-danger btn-sm" data-id="<?php echo $sup['sup_id']; ?>">ลบ</button>
          </td>
        </tr>
        <?php
        $row++;
      }
      ?>
    </table>
    <?php
    if(page_total() > 1) { 	 //ให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ
      echo '<p id="pagenum">';
      page_echo_pagenums();
      echo '</p>';
    }
    ?>

    <div id="dialog">
      <form id="form-sup">
        <input type="hidden" name="action" id="action" value="">
        <input type="hidden" name="sup_id" id="sup-id" value="">
        <input type="text" name="sup_name" id="sup-name" placeholder="ชื่อบริษัทผู้จัดส่งสินค้า"><br>
        <textarea name="address" id="address" placeholder="ที่อยู่"></textarea><br>
        <input type="text" name="phone" id="phone" placeholder="โทร"><br>
        <input type="text" name="contact_name" id="contact-name" placeholder="บุคคลในการติดต่อ"><br>
        <input type="text" name="website" id="website" placeholder="เว็บไซต์"><br><br>

        <button type="button" id="send">ส่งข้อมูล</button>
      </form>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</body>
</html>
