<?php
$uid = $_POST["uid"];
$sql = mysql_connect("127.0.0.1","root","");
		if (!$sql) {
			die(mysql_error());
		}
		mysql_select_db("notecloud", $sql);

	$sqlquery = "CREATE TABLE chat$uid (send_from varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,fromid int(11) NOT NULL,type varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,body text COLLATE utf8mb4_unicode_ci NOT NULL,time datetime NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
	mysql_query($sqlquery);
	mysql_close();
?>