<?php
	session_start();
	if (isset($_SESSION["isRequireCode"])) {
		echo 1;
	}else{
		echo 0;
	}
?>