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
		.btn{
				background:#cccccc;
				width:80%;
				height:40px;
				text-align:center;
				margin-left: auto;
				margin-right: auto;
				line-height: 40px;
				border: none;
				-webkit-appearance:none;
		}
		/*
		#add_btn{
			display: none;
			background: #3598db;
			color: white;
		}
		#save_btn{
			display: none;
			background: #27ad61;
			color: white;
		}
		*/
	</style>
</head>
<body>
	<div id="title">表: <?php echo $tname;?></div>
	<br>
	<form id="tablename" method="post" name="tablename">
		<input type="text" name="tname_post" id="tname"></input>
		<br>
		<br>
		<input type="submit" value="提交" id="submit_btn" class="btn">
	</form>
	<!--
	<a href="javascript:addList()"><div class="btn" id="add_btn">添加</a>
	<div class="table" id="item"></div>
	<a href="javascript:addList()"><div class="btn" id="save_btn">保存</a>
	
	<script type="text/javascript">
		var list = Array();
		function startEdit(){
			document.getElementById('tablename').style.display = 'none';
			document.getElementById('title').innerHTML = '表: $tname';
			document.title = '创建表:$tname';
			//document.getElementById("add_btn").style.display = "block";
			//document.getElementById("save_btn").style.display = "block";
		}
		function addList(){
			//document.getElementById("item").innerHTML
		}
	</script>
	-->
	<?php
		
		if (isset($tname)) {
			//echo "<script>startEdit();</script>";
			startEdit();
		}
		$tname = $_POST["tname_post"];
		if (isset($tname) {
			
			//echo "<script>startEdit();</script>";
			startEdit();
		}
		function startEdit(){
			echo "<script>document.getElementById('tablename').style.display = 'none';
			document.getElementById('title').innerHTML = '表: $tname';
			document.title = '创建表:$tname';</script>";
		}
		
	?>

</body>
</html>