<?php
	$verify = $_POST["verify"];
	session_start();
	if ($verify==$_SESSION["validCode"]) {
		echo "true";
	}else{
		echo "false";
	}

?>