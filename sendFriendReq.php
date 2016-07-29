<?php
$uid = $_POST["uid"];
$acode = $_POST["acode"];
$toid = $_POST["toid"];
$msg = $_POST["msg"];

$sql = mysql_connect("127.0.0.1","root","");
if(!$sql) {
    $err = array('error' => 775);
    echo json_encode($err);
    exit(1);
}else {
    mysql_select_db("notecloud", $sql);
    $res = mysql_query("select activecode,friend from user where uid='$uid'");
    $userExist = mysql_fetch_array($res);
    if (!$userExist) {
        $err = array('error' => 101);
        echo json_encode($err);
    } else {
        if ($acode != $userExist["activecode"]) {
            $err = array('error' => 174);
            echo json_encode($err);
        } else {
            $friendlist = json_decode($userExist["friend"]);
            $friendlist = array_flip($friendlist);
            if ($friendlist[$toid] != null) {
                $err = array('error' => 423);
                echo json_encode($err);
            } else {
                $newStr = "";
                for ($i=0; $i<strlen($msg); $i++){
                    $thisChar = $msg[$i];
                    if ($thisChar == "'"){
                        $thisChar = "\\'";
                    }elseif ($thisChar == "\\"){
                        $thisChar = "\\\\";
                    }
                    $newStr = $newStr.$thisChar;
                }
                mysql_query("insert into chat$toid (send_from,fromid,type,body,time) values ('user','$uid','req','$newStr',now())");
                $err = array('success' => 200);
                echo json_encode($err);
            }
        }
    }
}