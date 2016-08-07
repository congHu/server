<?php
$uid = $_POST["uid"];
$acode = $_POST["acode"];
$toid = $_POST["toid"];
$comm = $_POST["comment"];
$sql = mysql_connect("127.0.0.1","root","");
if(!$sql) {
    $err = array('error' => 775);
    echo json_encode($err);
    exit(1);
}else {
    mysql_select_db("notecloud", $sql);
    $res = mysql_query("select activecode,friend,friend_comments from user where uid='$uid'");
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
                $comments = json_decode($userExist["friend_comments"],true);
                if ($comm == ""){
                    unset($comments[$toid]);
                }else{
                    $comments[$toid] = $comm;
                }

                $json = json_encode($comments);

                $newStr = "";
                for ($i=0; $i<strlen($json); $i++){
                    $thisChar = $json[$i];
                    if ($thisChar == "'"){
                        $thisChar = "\\'";
                    }elseif ($thisChar == "\\"){
                        $thisChar = "\\\\";
                    }
                    $newStr = $newStr.$thisChar;
                }

                mysql_query("update user set friend_comments='$newStr' where uid='$uid'");
                $err = array('success' => 200);
                echo json_encode($err);


            }
        }
    }
}