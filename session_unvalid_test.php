<?php
	session_start();
	$dataToSave = date("Y-m-d H:i:s");
	$_SESSION['dataToSave'] = $dataToSave;
	echo "session saved ".$dataToSave;
?>