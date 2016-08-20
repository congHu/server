<?php
$uid = $_GET["uid"];
$sql = mysql_connect("127.0.0.1","root","");



if(!$sql) {
    $err = array('error' => 775);
    echo json_encode($err);
    exit(1);
}else {
    mysql_select_db("notecloud", $sql);
    $res = mysql_query("select uname,gender,area,description,birthday,age_privacy from user where uid='$uid'");
    $userExist = mysql_fetch_array($res);
    if (!$userExist) {
        $err = array('error' => 101);
        echo json_encode($err);
    } else {
    	if (!empty($userExist["birthday"])) {

        	if ($userExist["age_privacy"] != "1"){
            	$now = date("Y");
            	$ymd = explode("-" ,$userExist["birthday"]);
            	$birthYear = $ymd[0];
            	$age = $now - $birthYear;
            	$month = date("n");
            	$day = date("j");
            	if ($age != 0){
                	if ($month == $ymd[1]){
                    	if ($day < $ymd[2]){
                        	$age--;
                    	}
                	}elseif ($month < $ymd[1]){
                    	$age--;
                	}
            	}
            	$userExist["age"] = $age;
        	}
			if ($userExist["age_privacy"] != "0"){
				unset($userExist["birthday"]);
				unset($userExist["4"]);
			}
    	}
        
        echo json_encode($userExist);
    }
}
mysql_close();