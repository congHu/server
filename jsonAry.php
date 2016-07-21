<?php
	$jsonStr = "[2,5,7,9,1,12,20,16,14]";
	$jsonAry = json_decode($jsonStr);
	$jsonAry = array_flip($jsonAry);
	unset($jsonAry[12]);
	$jsonAry = array_flip($jsonAry);
	$jsonAry = array_values($jsonAry);
	$newJson = "[";
	for ($i=0; $i < count($jsonAry); $i++) { 
		$newJson = $newJson.$jsonAry[$i];
		if ($i < count($jsonAry) - 1) {
			$newJson = $newJson.",";
		}
	}
	$newJson = $newJson."]";
	echo $newJson;
?>