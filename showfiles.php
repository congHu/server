<?php
$dir=dirname(__FILE__)."/uploads/";//这里输入其它路径
//PHP遍历文件夹下所有文件
$handle=opendir($dir.".");
//定义用于存储文件名的数组
$array_file = array();
while (false != ($file = readdir($handle)))
{
if ($file != "." && $file != "..") {
$array_file[] = $file; //输出文件名
}
}
closedir($handle);
foreach ($array_file as $key => $value) {
	echo "<a href='uploads/".$value."'>".$value."</a><br>";
}
?>