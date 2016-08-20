<?php
$input = $_GET["input"];
$result = array();
$sql = mysql_connect("127.0.0.1","root","");
if(!$sql) {
    $err = array('error' => 775);
    echo json_encode($err);
    exit(1);
}else {
    mysql_select_db("notecloud", $sql);
    $query1 = mysql_query("select uid,uname,gender,area,birthday,age_privacy from user where email='$input'");
    while ($item1 = mysql_fetch_array($query1)){
        if (!empty($userExist["birthday"])){
            if ($item1["age_privacy"] != "1"){
                $now = date("Y");
                $ymd = explode("-" ,$item1["birthday"]);
                $birthYear = $ymd[0];
                $age = $now - $birthYear;
                $month = date("n");
                $day = date("j");
                if ($age != 0){
                    if ($month == $ymd[1]){
                        if ($day < $ymd[2]){
                            $age--;
                        }
                    }elseif ($month < $ymd[1]){
                        $age--;
                    }
                }
                $item1["age"] = $age;
            }
        }
        unset($item1["birthday"]);
        unset($item1["4"]);
        $result[] = $item1;
    }
    $query2 = mysql_query("select uid,uname,gender,area,birthday,age_privacy from user where uname='$input'");
    while ($item2 = mysql_fetch_array($query2)){
        if (!empty($userExist["birthday"])){
            if ($item2["age_privacy"] != "1"){
                $now = date("Y");
                $ymd = explode("-" ,$item2["birthday"]);
                $birthYear = $ymd[0];
                $age = $now - $birthYear;
                $month = date("n");
                $day = date("j");
                if ($age != 0){
                    if ($month == $ymd[1]){
                        if ($day < $ymd[2]){
                            $age--;
                        }
                    }elseif ($month < $ymd[1]){
                        $age--;
                    }
                }
                $item2["age"] = $age;
            }
        }

        unset($item2["birthday"]);
        unset($item2["4"]);
        $result[] = $item2;
    }
    echo json_encode($result);
}