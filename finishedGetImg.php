<?php
$fileName = $_GET["filename"];
$filePath = "./chat_img/".$fileName;
if (file_exists($filePath)){
    if (unlink($filePath)){
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