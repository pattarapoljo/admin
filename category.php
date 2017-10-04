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
	#c1 {
		width: 100px;
	}
	#c2 {
		width: 300px;
	}
	#c3 {
		width: 100px;
	}
  tr:nth-of-type(odd) {
    background:  whitesmoke;
  }
  tr:nth-of-type(even) {
    background: whitesmoke;
  }
  td:first-child, td:last-child {
    text-align: center;
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
$(document).ready(function(){
  $('.CTable').DataTable();
});

$(function() {
	$('#add-cat').click(function() {
		var cat = prompt("กรุณากำหนดชื่อหมวด", "");
		if(cat) {
		 	ajaxSend({'action': 'add', 'cat':cat});
		}
	});

	$('button.edit').click(function() {
		var cat = prompt("กรุณากำหนดชื่อใหม่สำหรับหมวดนี้", "");
		if(cat) {
			var id = $(this).attr('data-id');
			ajaxSend({'action': 'edit', 'cat':cat, 'cat_id': id});
		}
	});

	$('button.del').click(function() {
		if(confirm("ยืนยันที่ัจะลบหมวดนี้")) {
			var id = $(this).attr('data-id');
			ajaxSend({'action': 'del', 'cat_id': id});
		}
	});

});
function ajaxSend(dataJSON) {
	$.ajax({
		url: 'category-action.php',
		data: dataJSON,
		type: 'post',
		dataType:"html",
		beforeSend: function() {
			$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
		},
		success: function(result) {

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

<article>
<?php
include "dblink.php";
include "lib/pagination.php";

$sql = "SELECT * FROM categories";
$result = page_query($link, $sql, 20);
$first = page_start_row();
$last = page_stop_row();
$total = page_total_rows();
if($total == 0) {
	$first = 0;
}
?>
<table>
<div align="right">
	<button id="add-cat">เพิ่มหมวดหมู่</button>
</div>
<table class="CTable">
<colgroup><col id="c1"><col id="c2"><col id="c3"></colgroup>
<thead>
<tr>
  <th>รหัส</th>
  <th>ชื่อหมวดสินค้า</th>
  <th>คำสั่ง</th>
</tr>
</thead>
<?php
while($cat = mysqli_fetch_array($result)) {
?>
<tr>
 	<td><?php echo $cat['cat_id']; ?></td>
    <td><?php echo $cat['cat_name']; ?></td>
    <td>
        <button type="button" class="edit btn btn-primary btn-sm" data-id="<?php echo $cat['cat_id']; ?>">แก้ไข</button>
     		<button type="button" class="del btn btn-danger btn-sm" data-id="<?php echo $cat['cat_id']; ?>">ลบ</button>
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
