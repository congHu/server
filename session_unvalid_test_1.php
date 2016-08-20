<?php
	session_start();
	echo "load session ".$_SESSION["dataToSave"];
	$_SESSION["dataToSave"] = null;
?>