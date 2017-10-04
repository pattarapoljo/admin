<?php
include "check-login.php";
 ?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ระบบจำหน่ายอะไหล่รถจักรยานยนต์</title>
<style>
	@import "global.css";
	td:nth-child(1) {
		width: 150px;
	}
	td:nth-child(2) {
		width: 100px;
		text-align: left !important;
	}
	td:nth-child(3) {
		width: 130px;
		text-align: left !important;
	}
	td:nth-child(4) {
		width: 80px;
	}
	td:nth-child(5) {
		width: 200px;
		text-align: center;
	}
	td:nth-child(6) {
		width: 200px;
		text-align: left !important;
	}
	td:nth-child(7) {
		width: 150px;
	}
  tr:nth-of-type(odd) {
    background:  whitesmoke;
  }
  tr:nth-of-type(even) {
    background: whitesmoke;
  }
	td a:hover {
		color: red;
	}
  td {
    vertical-align: top;
    padding: 3px 0px 3px 5px;
    border-right: solid 1px white;
  }
  td:first-child, td:last-child {
    text-align: center;
  }
	#dialog {
		display: none;
		font-size: 14px !important;
	}
	#form-sup [type=text],  #form-sup textarea{
		width: 370px;
		background: lavender;
		border: solid 1px gray;
		padding: 3px;
		margin-bottom: 3px;
		font-size: 14px;
	}
	#form-sup textarea {
		resize: none;
		overflow: auto;
	}
	td:last-child a {
		font-size: 11px;
		border: solid 1px #999;
		display: inline-block;
		padding: 2px;
		text-decoration: none;
		color:blue;
		border-radius: 3px;
	}
	td:last-child a:hover {
		color:red;
		background: #ffc;
	}
	td img {
		height: 16px;
		vertical-align: top;
	}
	form {
		float: right;
	}
	form button {
		float: none !important;
		font-size: 13px;
		background: steelblue;
		color: white;
		border-radius: 5px;
	}
	a.disable {
		cursor: default;
		background: whitesmoke !important;
		color: silver !important;
	}
	a.disable:hover {
		background: whitesmoke !important;
	}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<link href="js/jquery-ui.min.css" rel="stylesheet">

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

<body>
<?php include "top.php"; ?>
<article>
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
</article>
</body>
</html>
