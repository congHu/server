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
    $res = mysql_query("select activecode,friend,friend_comments from user where uid='$uid'");//
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
            $friendID = json_decode($userExist["friend"]);
            $friendComments = json_decode($userExist["friend_comments"],true);
            $friendList = array();
            foreach ($friendID as $friend){

                $query = mysql_query("select uname from user where uid='$friend'");
                $friendInfo = mysql_fetch_array($query);
                if (isset($friendComments[$friend])){
                    $friendInfo["uname"] = $friendComments[$friend];
                }
                $friendInfo["pinyin"] = Pinyin($friendInfo["uname"]);
                $friendInfo["uid"] = $friend;
                $friendList[] = $friendInfo;
            }
            echo json_encode($friendList);
        }
    }
}