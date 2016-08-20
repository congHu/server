<?php
//	$jsonStr = "[8,4]";
$jsonStr = "{\"1\":\"adsf\",\"4\":\"ndsal\"}";
$jsonAry = json_decode($jsonStr, true);
unset($jsonAry[3]);
print_r($jsonAry);
//	$jsonAry = array_flip($jsonAry);
//	echo array_key_exists(8,$jsonAry);
//	echo ($jsonAry[3] == null);
//	$jsonAry = array_flip($jsonAry);
//	$jsonAry[] = 99;
//	$jsonAry = array_values($jsonAry);
//	echo json_encode($jsonAry);
//	$newJson = "[";
//	for ($i=0; $i < count($jsonAry); $i++) {
//		$newJson = $newJson.$jsonAry[$i];
//		if ($i < count($jsonAry) - 1) {
//			$newJson = $newJson.",";
//		}
//	}
//	$newJson = $newJson."]";
//	echo $newJson;
//$jsonAry = array();
//$jsonAry["6"] = "刘一鸣";
//$jsonStr = json_encode($jsonAry);
//$jsonStr = "{\"6\":\"刘一鸣\"}";
//$jsonDic = json_decode($jsonStr,true);
//if (isset($jsonDic["6"])){
//	echo $jsonDic["6"];
//}else{
//	echo "0";
//}