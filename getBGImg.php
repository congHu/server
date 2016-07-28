<?php
$uid = $_GET["uid"];
$type = $_GET["type"];
$sql = mysql_connect("127.0.0.1","root","");
if(!$sql) {
    $err = array('error' => 775);
    echo json_encode($err);
    exit(1);
}else {
    mysql_select_db("notecloud", $sql);
    if ($type == "user") {
        $res = mysql_query("select bg_img from user where uid='$uid'");
        $userExist = mysql_fetch_array($res);
        if (!$userExist) {
            $err = array('error' => 101);
            echo json_encode($err);
        } else {
            if (!empty($userExist["bg_img"])){
                $fileName = "./bg_img/" . $userExist["avatar"];
                $handle = fopen($fileName, "r");//使用打开模式为r
                $content = fread($handle, filesize($fileName));//读为二进制
                //$img = array('img' => $content);
                header("Content-type:image/jpg");
                echo $content;
            }else{
                $err = array('error' => 378);
                echo json_encode($err);
            }

        }
    }
}