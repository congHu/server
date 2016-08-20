<?php
	$str=$_GET["str"];
	$sessSavePath = dirname(__FILE__).'/session/';
	if(is_writeable($sessSavePath) && is_readable($sessSavePath)){
		session_save_path($sessSavePath);
	}else{
		echo $sessSavePath;
	}
	session_start();
	echo $_SESSION["session_str"]."<br>";
	$_SESSION["session_str"]=$str;
	echo $_SESSION["session_str"];
?>
