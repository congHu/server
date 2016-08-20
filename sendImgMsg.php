<?php
$uid = $_POST["uid"];
$acode = $_POST["acode"];
$toid = $_POST["toid"];

$msgtype = "image";
//$body = $_POST["body"];
$imgPv = $_FILES["img"];
$imgFull = $_FILES["img_full"];

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
                if ((($imgPv["type"] == "image/gif")|| ($imgPv["type"] == "image/jpeg")|| ($imgPv["type"] == "image/pjpeg")|| ($imgPv["type"] == "image/png"))&& ($imgPv["size"] < 1000000)) {
                    if ($imgPv["error"] > 0) {
                        $err = array('error' => $imgPv["error"]);
                        echo json_encode($err);
                    } else {
                        $filename = $imgPv["name"];
                        move_uploaded_file($imgPv["tmp_name"], "./chat_img/" . $filename);


                        if ((($imgFull["type"] == "image/gif") || ($imgFull["type"] == "image/jpeg") || ($imgFull["type"] == "image/pjpeg") || ($imgFull["type"] == "image/png"))) {
                            if ($imgFull["error"] > 0) {
                                $err = array('error' => $imgFull["error"]);
                                echo json_encode($err);
                            } else {
                                $filenameFull = $imgFull["name"];
                                move_uploaded_file($imgFull["tmp_name"], "./chat_img/" . $filenameFull);
                                mysql_query("insert into chat$toid (send_from,fromid,type,body,time) values ('user','$uid','$msgtype','$filename',now())");
                                $err = array('success' => 200);
                                echo json_encode($err);
                            }
                        } else {
                            $err = array('error' => 343);
                            echo json_encode($err);
                        }
                    }
                }
            }
        }
    }
}