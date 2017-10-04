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
  	caption {
  		text-align: left;
  		padding-bottom: 3px;
  	}
  	#c1 {
  		width: 50px;
  	}
  	#c2 {
  		width: 100px;
  	}
  	#c3 {
  		width: 100px;
  	}
  	#c4 {
  		width: 250px;
  	}
  	#c5 {
  		width: 100px;
  	}
  	#c6 {
  		width: 110px;
  	}
    #c7 {
  		width: 110px;
  	}
  	table th {
  		background: green;
  		color: yellow;
  		padding: 5px;
  		border-right: solid 1px white;
  		font-size:12px;
  	}
  	tr:nth-of-type(odd) {
  		background: lavender;
  	}
  	tr:nth-of-type(even) {
  		background: whitesmoke;
  	}
  	td {
  		vertical-align: top;
  		padding: 3px 0px 3px 5px;
  		border-right: solid 1px white;
  	}
  	td:first-child, td:last-child {
  		text-align: center;
  	}
  	td a:hover {
  		color: red;
  	}
  	p#pagenum {
  		width: 90%;
  		text-align: center;
  		margin: 5px;
  	}
  	#dialog {
  		display: none;
  		font-size: 14px !important;
  	}
  	#form-cust [type=text],  #form-cust textarea{
  		width: 370px;
  		background: lavender;
  		border: solid 1px gray;
  		padding: 3px;
  		margin-bottom: 3px;
  		font-size: 14px;
  	}
  	#form-cust textarea {
  		resize: none;
  		overflow: auto;
  	}
  </style>
  <link href="js/jquery-ui.min.css" rel="stylesheet">
  <script src="js/jquery-2.1.1.min.js"> </script>
  <script src="js/jquery-ui.min.js"> </script>
  <script src="js/jquery.blockUI.js"> </script>

<script>
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
<article>
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
<table>
  <caption>
  	<?php 	echo "ลูกค้าลำดับที่  $first - $last จากทั้งหมด $total"; ?>
  </caption>
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
        <button class="edit" data-id="<?php echo $cust['cust_id']; ?>">แก้ไข</button>
     		<button class="del" data-id="<?php echo $cust['cust_id']; ?>">ลบ</button>
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

</article>
</body>
</html>
