<?php
$uid = $_POST["uid"];
$acode = $_POST["acode"];
$fid = $_POST["fid"];
$sql = mysql_connect("127.0.0.1","root","");
if(!$sql) {
    $err = array('error' => 775);
    echo json_encode($err);
    exit(1);
}else {
    mysql_select_db("notecloud", $sql);
    $res = mysql_query("select activecode,friend,black_list from user where uid='$uid'");
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
            if (array_key_exists($fid, $friendlist)){
                echo "1";
            }else{
                $blacklist = json_decode($userExist["black_list"]);
                $blacklist = array_flip($blacklist);
                if (array_key_exists($fid, $blacklist)){
                    echo "2";
                }else{
                    echo "0";
                }
            }
        }
    }
}
mysql_close();