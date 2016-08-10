<?php
$fileName = $_GET["filename"];
$filePath = "./chat_img/".$fileName;
if (file_exists($filePath)){
    $handle=fopen($filePath,"r");//使用打开模式为r
    $content=fread($handle,filesize($filePath));//读为二进制
    //$img = array('img' => $content);
    header("Content-type:image/jpg");
    echo $content;
}else{
    $err = array('error' => 343);
    echo json_encode($err);
}