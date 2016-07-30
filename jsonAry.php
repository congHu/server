<?php
	$jsonStr = "[2,5,7,9,1,12,20,16,14]";
	$jsonAry = json_decode($jsonStr);
	$jsonAry = array_flip($jsonAry);
	$jsonAry = array_flip($jsonAry);
	$jsonAry[] = 99;
	$jsonAry = array_values($jsonAry);
	echo json_encode($jsonAry);
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