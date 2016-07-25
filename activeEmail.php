<?php
	$email = $_GET["email"];
	$activecode = $_GET["activecode"];
	$sql = mysql_connect("127.0.0.1","root","");
	if (!$sql) {
		die(mysql_error());
	}
	mysql_select_db("notecloud", $sql);
	$res = mysql_query("select activetime from user where email='$email' and isActive='0' and activecode='$activecode'");
	$valid = mysql_fetch_array($res);
	$timestr = $valid["activetime"];
	$exptime = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($timestr)));
	$nowtime = date("Y-m-d H:i:s");
	if ($nowtime<$exptime) { // TODO: 有问题
		mysql_query("update user set isActive='1' where email='$email'");
		echo "<meta charset='utf8'><script>alert('激活成功');</script>";
	}else{
		echo "<meta charset='utf8'><script>alert('激活失败');</script>";
	}
	mysql_close($sql);
?>