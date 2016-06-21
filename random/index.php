<?php
	$tname = $_GET["tname"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<script src="http://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
		<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" /> 
		<title><?php if(isset($tname)) echo "纠结终结器 - ".$tname; else echo "纠结终结器" ?></title>
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
			#tname{
				width:80%;
				margin-left: auto;
				margin-right: auto;
			}
			#content{
				text-align: center;
				margin-left: auto;
				margin-right: auto;
				width: 640px;
				font-size: 100%;
				display: none;
			}
			@media(max-width: 640px){
				#content{
					width:100%;
				}
			}
		</style>
		


	</head>
	<body>
		<div id="title">请输入表格名称</div>
		<br>
		<form id="tablename" method="get" name="tablename">
			<input type="text" name="tname" id="tname"></input>
			<br>
			<br>
			<input type="submit" value="提交" id="submit_btn" class="btn">
		</form>
		<div id='content'>null</div>

<script type="text/javascript">
			var list = Array();
			var rolling = false;
			var time = 0;
			
			function roll_click(){
				if (!rolling) {
					rolling = true;
					document.getElementById("roll_btn").style.display = "none";
					time = 0;
					roll();
				}
				
			}
			function roll(){
				var r = parseInt(Math.random()*list.length);
				var text = list[r];
				$("#content").css("font-size", $("#content").width()/(text.length+1));
				document.getElementById("content").innerHTML = text;
				time++;
				if (time < 30) {
					setTimeout("roll()", 100);
				}else{
					rolling = false;
					document.getElementById("roll_btn").style.display = "block";
				}
			}
			
		</script>

		<?php
			
			if (isset($tname)) {
				$sql = mysql_connect("127.0.0.1","root","");
				if (!$sql) {
					die(mysql_error());
				}
				mysql_select_db("randomeal",$sql);
				mysql_query("set names utf8");
				$res = mysql_query("select * from $tname");
				$exist = mysql_fetch_array($res);
				$ary = array();
				while ($row=mysql_fetch_array($res)) {
					$ary[] = $row;
				}
			}
		?>

		<script type="text/javascript">
			function selectTable(){

				var jsary = eval('<?php echo json_encode($ary); ?>');
				for (var i = 0; i < jsary.length - 1; i++) {
					list[i] = jsary[i]["row"];
				}
				var r = parseInt(Math.random()*list.length);
				var text = list[r];
				$("#content").css("font-size", $("#content").width()/(text.length+1));

				var content = document.getElementById("content");
				content.innerHTML = text;
				content.style.display = "block";
				document.getElementById("title").innerHTML = "表: <?php echo $tname;?>";
				document.getElementById("tablename").style.display = "none";
					
				
			}
		</script>

		<?php
			if (isset($tname)) {
				if ($exist) {
					echo "<script>selectTable();</script>";
					echo "<a href='javascript:roll_click()'><div id='roll_btn' class='btn'>抽！</div></a>";

				}else{
					echo "<script>var content = document.getElementById('content');content.innerHTML = '列表为空';content.style.display = 'block';</script>";
				}
			}
			mysql_close($sql);
			
		?>
		
	</body>
</html>