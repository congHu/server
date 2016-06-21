<?php
	$e = $_POST["eml"];
	$p = $_POST["pswd"];
	$verify = $_POST["verify"];
	session_start();
	if ($verify==$_SESSION["validCode"]) {
		$sql = mysql_connect("127.0.0.1","root","");
		if (!$sql) {
			die(mysql_error());
		}
		mysql_select_db("notecloud", $sql);
		$res = mysql_query("select uid from user where email='$e'");
		$exist = mysql_fetch_array($res);
		if (!$exist) {
			$err = array('error' => 101);
			echo json_encode($err);
		}else{
			mysql_query("update user set password=password('$p') where email='$e'");
			$err = array('success' => 200);
			echo json_encode($err);
		}
	}else{
		$err = array('error' => 103);
		echo json_encode($err);
	}
	
?>