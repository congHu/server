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
            if ($friendlist[$toid] == null) {
                $err = array('error' => 423);
                echo json_encode($err);
            } else {
                unset($friendlist[$toid]);
                $friendlist = array_flip($friendlist);
                $friendlist = array_values($friendlist);
                $json = json_encode($friendlist);
                mysql_query("update user set friend='$json' where uid='$uid'");

                $resF = mysql_query("select friend from user where uid='$toid'");
                $friendFetch = mysql_fetch_array($resF);
                $friendList2 = json_decode($friendFetch["friend"]);
                $friendList2 = array_flip($friendList2);
                unset($friendList2[$uid]);
                $friendList2 = array_flip($friendList2);
                $friendList2 = array_values($friendList2);
                $jsonOutFriend = json_encode($friendList2);
                mysql_query("update user set friend='$jsonOutFriend' where uid='$toid'");

            }
        }
    }
}