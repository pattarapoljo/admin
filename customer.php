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
    $('#add-cust').click(function() {  //คลิกปุ่ม "เพิ่มผู้จัดส่งสินค้า"
    $('#form-cust')[0].reset();
    $('#action').val('add');
    showDialog();
  });

  $('#send').click(function() {		//คลิกปุ่ม "ส่งข้อมูล" ที่อยู่ในไดอะล็อก
  var data = $('#form-cust').serializeArray();
  ajaxSend(data);
});

$('button.edit').click(function() {
  var tr = $(this).parent().parent();		//parent() ครั้งแรกจะได้ <td> ที่บรจจุปุ่มที่ถูกคลิก parent() ครั้งที่สอง จะได้ <tr> ที่เกิดอีเวนต์
  $('#firstname').val(tr.children(':eq(1)').text());  //อ่านค่าจากเซลล์(<td>) ที่ 2 (อันแรกเป็น 0) ของแถวที่เกิดอีเวนต์
  $('#lastname').val(tr.children(':eq(2)').text());
  $('#address').val(tr.children(':eq(3)').text());
  $('#phone').val(tr.children(':eq(4)').text());
  $('#email').val(tr.children(':eq(5)').text());

  $('#cust-id').val($(this).attr('data-id'));
  $('#action').val('edit');
  showDialog();
});

$('button.del').click(function() {
  if(!(confirm("ยืนยันการลบลูกค้ารายนี้"))) {
    return;
  }
  var id = $(this).attr('data-id');
  ajaxSend({'action': 'del', 'cust_id': id});
});

});

function showDialog() {
  $('#dialog').dialog({
    title: 'ลูกค้า',
    width: 'auto',
    modal: true,
    position: { my: "center top", at: "center top", of: $('nav')}
  });
}
function ajaxSend(dataJSON) {
  $.ajax({
    url: 'customer-action.php',
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

<body><?php include "top.php"; ?>
  <div class="container">
    <?php
    include "dblink.php";
    include "lib/pagination.php";

    $sql = "SELECT * FROM customers";
    $result = page_query($link, $sql, 20);
    $first = page_start_row();
    $last = page_stop_row();
    $total = page_total_rows();
    if($total == 0) {
      $first = 0;
    }
    ?>
    <table class="CTable">
      <colgroup><col id="c1"><col id="c2"><col id="c3"><col id="c4"><col id="c5"><col id="c6"><col id="c7"></colgroup>
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>ที่อยู่</th>
          <th>โทร</th>
          <th>อีเมล</th>
          <th>คำสั่ง</th>
        </tr>
      </thead>
      <?php
      $row = $first;
      while($cust = mysqli_fetch_array($result)) {
        ?>
        <tr>
          <td><?php echo $row; ?></td>
          <td><?php echo $cust['firstname'];?></td>
          <td><?php echo $cust['lastname'];?></td>
          <td><?php echo $cust['address']; ?></td>
          <td><?php echo $cust['phone']; ?></td>
          <td><a href="mailto:<?php echo $cust['email']; ?>"><?php echo $cust['email']; ?></a></td>
          <td>
            <button type="button" class="btn btn-warning" data-id="<?php echo $cust['cust_id']; ?>">แก้ไข</button>
            <button type="button" class="btn btn-danger" data-id="<?php echo $cust['cust_id']; ?>">ลบ</button>
          </td>
        </tr>
        <?php
        $row++;
      }
      ?>
    </table>
    <div id="dialog">
      <form id="form-cust">
        <input type="hidden" name="action" id="action" value="">
        <input type="hidden" name="cust_id" id="cust-id" value="">
        <input type="text" name="firstname" id="firstname" placeholder="ชื่อ"><br>
        <input type="text" name="lastname" id="lastname" placeholder="นามสกุล"><br>
        <textarea name="address" id="address" placeholder="ที่อยู่"></textarea><br>
        <input type="text" name="phone" id="phone" placeholder="โทร"><br>
        <input type="text" name="email" id="email" placeholder="อีเมล"><br>

        <button type="button" id="send">ส่งข้อมูล</button>
      </form>
    </div>
  </div>
</body>
</html>
