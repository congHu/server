<?php
$uid = $_POST["uid"];
$acode = $_POST["acode"];
$toid = $_POST["toid"];

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
                $friendlist = array_flip($friendlist);
                $friendlist[] = $toid;
                $friendlist = array_values($friendlist);
                $jsonOut = json_encode($friendlist);
                mysql_query("update user set friend='$jsonOut' where uid='$uid'");

                // TODO: 同时更新对方好友列表
                $resF = mysql_query("select friend from user where uid='$toid'");
                $friendFetch = mysql_fetch_array($resF);
                $friendList2 = json_decode($friendFetch["friend"]);
                $friendList2[] = $uid;
                $friendList2 = array_values($friendList2);
                $jsonOutFriend = json_encode($friendList2);
                mysql_query("update user set friend='$jsonOutFriend' where uid='$toid'");
                mysql_query("insert into chat$toid (send_from,fromid,type,body,time) values ('user','$uid','string','我们已经成为好友啦，可以愉快地开始聊天啦!',now())");
                $err = array('success' => 200);
                echo json_encode($err);
            }
        }
    }
}