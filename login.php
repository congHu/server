<?php

$email=$_POST["email"];
$password=$_POST["password"];
$verify=$_POST["verify"];
session_start();

function loginSuccess(){
	unset($_SESSION["isRequireCode"]);
	$userinfo = array();
	$userinfo["uid"] = $valid["uid"];
	$userinfo["localpsw"] = $valid["localpsw"];
	$userinfo["isActive"] = $valid["isActive"];
	echo json_encode($userinfo);
}

function loginError($code){
	$_SESSION["isRequireCode"] = 1;
	$err = array('error' => $code);
	echo json_encode($err);
}

function loginCheck($email, $password){
	$sql = mysql_connect("127.0.0.1","root","");
	if(!$sql) {
		loginError(775);
		exit(1);
	}else{
		mysql_select_db("notecloud",$sql);
		$res = mysql_query("select password,uid,localpsw,isActive from user where email='$email'");
		$userExist = mysql_fetch_array($res);
		if(!$userExist){
			loginError(101);
		}else{
			$psw = $userExist["password"];
			$input = mysql_query("select password('$password')");
			$inputpasw = mysql_fetch_array($input);
			if ($inputpasw[0] != $psw) {
				loginError(102);
			}else{
				loginSuccess();
			}
		}
	}
	mysql_close($sql);
}

	if (isset($_SESSION["isRequireCode"])) {
		if ($verify != $_SESSION['authnum_session']) {
			loginError(103);
		}else{
			loginCheck($email, $password);
		}
	}else{
		loginCheck($email, $password);
	}
	
?>
