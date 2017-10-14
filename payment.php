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

  $(function() {
    $(document).ready(function(){
      $('.CTable').DataTable();
    });

    $('a.enable').click(function() {
      ajaxSend($(this), 'confirm');
    });
    $('a.delete').click(function() {
      ajaxSend($(this),'delete');
    });
  });

  function ajaxSend(a, action) {
    if(!confirm('ยืนยันการกระทำนี้')) {
      return;
    }
    var payID = a.attr('data-id');
    var orderID = a.attr('data-order');
    var custID = a.attr('data-cust');
    var d = {'action':action, 'order_id':orderID, 'pay_id':payID, 'cust_id':custID};
    $.ajax({
      url: 'payment-action.php',
      data: d,
      dataType: 'html',
      type: 'post',
      beforeSend: function() {
        $.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
      },
      success: function(result) {
        location.reload();
      },
      complete: function() {
        $.unblockUI();
      }
    })	;
  }
  </script>
</head>

<body style="padding-top:70px">
  <?php include "top.php"; ?>
  <div class="container">
    <?php
    include "dblink.php";
    include "lib/pagination.php";

    $sql = "SELECT payments.*, customers.email
    FROM payments LEFT JOIN customers ON payments.cust_id = customers.cust_id ORDER BY pay_id DESC";
    $result = page_query($link, $sql, 20);
    $first = page_start_row();
    $last = page_stop_row();
    $total = page_total_rows();
    if($total == 0) {
      $first = 0;
    }
    ?>
    <table class="CTable">
      <thead>
        <tr>
          <th>รหัสการสั่งซื้อ</th>
          <th>ธนาคาร</th>
          <th>สถานที่โอน</th>
          <th>จำนวน</th>
          <th>วันเวลา</th>
          <th>อีเมลผู้โอน</th>
          <th>คำสั่ง</th>
        </tr>
      </thead>
      <?php
      while($pay = mysqli_fetch_array($result)) {
        $class = 'enable';
        $img_pay = "images/no.png";
        if($pay['confirm']=='yes') {
          $class = 'disable';
          $img_pay = "images/yes.png";
        }
        ?>
        <tr>
          <td><?php echo $pay['order_id'];; ?></td>
          <td><?php echo $pay['bank']; ?></td>
          <td><?php echo $pay['location']; ?></td>
          <td><?php echo $pay['amount']; ?></td>
          <td><?php echo $pay['transfer_date']; ?></td>
          <td><a href="mailto:<?php echo $pay['email']; ?>"><?php echo $pay['email']; ?></a></td>
          <td>
            <img src="<?php echo $img_pay; ?>">
            <a href="#" class="<?php echo $class; ?>"
              data-id="<?php echo $pay['pay_id']; ?>"
              data-order="<?php echo $pay['order_id']; ?>">ได้รับแล้ว</a>
              <a href="#" class="delete" data-id="<?php echo $pay['pay_id']; ?>">ลบ</a>
            </td>
          </tr>
          <?php
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
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
  </html>
