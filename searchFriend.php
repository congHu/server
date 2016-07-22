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
    $query1 = mysql_query("select * from user where email=$input");
    while ($item1 = mysql_fetch_array($query1)){
        $result[] = $item1;
    }
    $query2 = mysql_query("select * from user where uname=$input");
    while ($item2 = mysql_fetch_array($query2)){
        $result[] = $item2;
    }
    echo json_encode($result);
}