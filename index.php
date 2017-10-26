<?php
session_start();
$msg = "";
if($_POST) {
 	$login = $_POST['login'];
	$pw = $_POST['pswd'];
	if(($login != "admin") && ($pw != "admin")) {
		$msg = 'Login หรือ Password ไม่ถูกต้อง';
	}
	else {
		$_SESSION['admin'] = "admin";
		header("location: product.php");
		exit;
	}
}
?>
<!doctype html>
<html>
<head>
<title>ระบบจำหน่ายอะไหล่รถจักรยานยนต์</title>
<style>
	@imports "global.css";

	body {
		margin-top: 50px;
		text-align: center;
	}

	img {
		height: 300px;
	}
</style>
</head>

<body>
<img src="images/index.jpg"><br>
<div class="warn"><?php echo $msg; ?></div>
<form method="post">
<input type="text" name="login" placeholder="Login" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">เข้าสู่ระบบ</button>
</form>
</body>
</html>
