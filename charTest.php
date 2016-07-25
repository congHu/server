<?php
$test = $_POST["test"];
$newStr = "";
for ($i=0; $i<strlen($test); $i++){
    $thisChar = $test[$i];
    if ($thisChar == "'"){
        $thisChar = "\\'";
    }elseif ($thisChar == "\\"){
        $thisChar = "\\\\";
    }
    $newStr = $newStr.$thisChar;
}
echo $newStr;