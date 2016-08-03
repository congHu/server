<?php
$uid = $_POST["uid"];
$acode = $_POST["acode"];

$attr = $_POST["attr"];
$value = $_POST["value"];

function slashStr($body){
    $newStr = "";
    for ($i=0; $i<strlen($body); $i++){
        $thisChar = $body[$i];
        if ($thisChar == "'"){
            $thisChar = "\\'";
        }elseif ($thisChar == "\\"){
            $thisChar = "\\\\";
        }
        $newStr = $newStr.$thisChar;
    }
    return $newStr;
}

$sql = mysql_connect("127.0.0.1","root","");
if(!$sql) {
    $err = array('error' => 775);
    echo json_encode($err);
    exit(1);
}else {
    mysql_select_db("notecloud", $sql);
    $res = mysql_query("select activecode from user where uid='$uid'");
    $userExist = mysql_fetch_array($res);
    if (!$userExist) {
        $err = array('error' => 101);
        echo json_encode($err);
    } else {
        if ($acode != $userExist["activecode"]) {
            $err = array('error' => 174);
            echo json_encode($err);
        } else {
            switch ($attr){
                case "uname":
                    $value = slashStr($value);
                    mysql_query("update user set uname='$value' where uid=$uid");
                    break;
                case "gender":
                    if ($value == "0" || $value == "1"){
                        mysql_query("update user set gender='$value' where uid=$uid");
                    }
                    break;
                case "area":
                    mysql_query("update user set area='$value' where uid=$uid");
                    break;
                case "description":
                    $value = slashStr($value);
                    mysql_query("update user set area='$value' where uid=$uid");
                    break;
                case "birthday":
                    $ymd = explode("-" ,$value);
                    if (count($ymd) == 3){
                        mysql_query("update user set birthday='$value' where uid=$uid");
                    }
                    break;
                case "age_privacy":
                    if ($value == "0" || $value == "1" || $value == "2"){
                        mysql_query("update user set age_privacy='$value' where uid=$uid");
                    }
                    break;
                default:
                    $err = array('error' => 862);
                    echo json_encode($err);
                    exit(1);
                    break;
            }
            $err = array('success' => 200);
            echo json_encode($err);
        }
    }
}
mysql_close();