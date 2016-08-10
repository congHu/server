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
    $res = mysql_query("select activecode,friend_comments from user where uid='$uid'");
    $userExist = mysql_fetch_array($res);
    if (!$userExist) {
        $err = array('error' => 101);
        echo json_encode($err);
    } else {
        if ($acode != $userExist["activecode"]) {
            $err = array('error' => 174);
            echo json_encode($err);
        } else {
            $fileName = $_POST["filename"];
            $imgReceiver = 
            $filePath = "./chat_img/".$fileName;
            if (file_exists($filePath)){
                if (unlink($filePath)){ //
                    $err = array('success' => 200);
                    echo json_encode($err);
                }else{
                    $err = array('error' => 383);
                    echo json_encode($err);
                }

            }else{
                $err = array('error' => 343);
                echo json_encode($err);
            }
        }
    }
}

