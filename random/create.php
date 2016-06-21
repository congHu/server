<?php 
	$tname=$_GET["tname"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>创建表:<?php echo $tname;?></title>
	<meta charset="utf-8" />
	<script src="http://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
	<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" /> 
	<style type="text/css">
		a{
			text-decoration: none;
			color: black;
		}
		#title{
			text-align: center;
		}
		#tablename{
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="title">表: <?php echo $tname;?></div>
	<br>
	<form id="tablename" method="get" name="tablename">
		<input type="text" name="tname" id="tname"></input>
		<br>
		<br>
		<input type="submit" value="提交" id="submit_btn" class="btn">
	</form>
	<?php
		
		if (isset($tname)) {
			echo "<script>document.getElementById('tablename').style.display = 'none';document.getElementById('title').innerHTML = '表: $tname';document.title = '创建表:$tname';</script>";
		}
	?>
	
</body>
</html>