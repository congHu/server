<?php
$uid = $_POST["uid"];
$acode = $_POST["acode"];
$sql = mysql_connect("127.0.0.1","root","");
if(!$sql) {
    $err = array('error' => 775);
    echo json_encode($err);
    exit(1);
}else {
    mysql_select_db("notecloud", $sql);
    $res = mysql_query("select activecode,black_list from user where uid='$uid'");//
    $userExist = mysql_fetch_array($res);
    if (!$userExist) {
        $err = array('error' => 101);
        echo json_encode($err);
    } else {
        if ($acode != $userExist["activecode"]) {
            $err = array('error' => 174);
            echo json_encode($err);
        } else {
            include "./pinyin/pinyinConvert.php";
            $blacklist = json_decode($userExist["black_list"]);
            $blacklistOut = array();
            foreach ($blacklist as $item){
                $que = mysql_query("select uname from user where uid='$item'");
                $fetchInfo = mysql_fetch_array($que);
                if ($fetchInfo){
                    $fetchInfo["pinyin"] = Pinyin($fetchInfo["uname"]);
                    $fetchInfo["uid"] = $item;
                    $blacklistOut[] = $fetchInfo;
                }
            }
            echo json_encode($blacklistOut);
        }
    }
}