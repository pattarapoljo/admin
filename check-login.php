<?php
if (!isset($_SESSION)) {
	session_start();
}

if(!isset($_SESSION['admin'])) {
	header("location: index.php");
	exit;
}
 ?>
