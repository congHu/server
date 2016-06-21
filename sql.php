<?php
	$sql = mysql_connect("127.0.0.1","root","");
	if (!$sql) {
		die('Could not connect: ' . mysql_error());
	}
	echo "success";
	mysql_close($sql);
?>