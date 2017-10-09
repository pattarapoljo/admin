<?php
include "check-login.php";
?>
<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>ระบบจำหน่ายอะไหล่รถจักรยานยนต์</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  <link href="js/jquery-ui.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <script src="js/jquery-2.1.1.min.js"> </script>
  <script src="js/jquery-ui.min.js"> </script>
  <script src="js/jquery.blockUI.js"> </script>
  <script src="js/datatables.min.js"> </script>

  <script>
  $(document).ready(function(){
    $('.CTable').DataTable();
  });

  $(function() {
    $('#add-sup').click(function() {  //คลิกปุ่ม "เพิ่มผู้จัดส่งสินค้า"
    $('#form-sup')[0].reset();
    $('#action').val('add');
    showDialog();
  });

  $('#send').click(function() {		//คลิกปุ่ม "ส่งข้อมูล" ที่อยู่ในไดอะล็อก
  var data = $('#form-sup').serializeArray();
  ajaxSend(data);
});

$('button.edit').click(function() {
  var tr = $(this).parent().parent();		//parent() ครั้งแรกจะได้ <td> ที่บรจจุปุ่มที่ถูกคลิก parent() ครั้งที่สอง จะได้ <tr> ที่เกิดอีเวนต์
  $('#sup-name').val(tr.children(':eq(1)').text());  //อ่านค่าจากเซลล์(<td>) ที่ 2 (อันแรกเป็น 0) ของแถวที่เกิดอีเวนต์
  $('#address').val(tr.children(':eq(2)').text());
  $('#phone').val(tr.children(':eq(3)').text());
  $('#contact-name').val(tr.children(':eq(4)').text());

  $('#website').val(tr.children(':eq(1)').find('a').attr('href')); //อ่านค่าแอตทริบิวต์ href ของลิงก์ที่อยู่ในเซลล์ที่ 2
  $('#sup-id').val($(this).attr('data-id'));
  $('#action').val('edit');
  showDialog();
});

$('button.del').click(function() {
  if(!(confirm("ยืนยันการลบผู้จัดส่งสินค้ารายนี้"))) {
    return;
  }
  var id = $(this).attr('data-id');
  ajaxSend({'action': 'del', 'sup_id': id});
});

});

function showDialog() {
  $('#dialog').dialog({
    title: 'ผู้จัดส่งสินค้า',
    width: 'auto',
    modal: true,
    position: { my: "center top", at: "center top", of: $('nav')}
  });
}
function ajaxSend(dataJSON) {
  $.ajax({
    url: 'supplier-action.php',
    data: dataJSON,
    type: 'post',
    dataType:"html",
    beforeSend: function() {
      $.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
    },
    complete: function() {
      $.unblockUI();
      location.reload();
    }
  });
}
</script>
</head>

<body>
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
</body>
</html>
