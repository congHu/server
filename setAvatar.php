<?php
	$uid = $_POST["uid"];
	$acode = $_POST["acode"];
	$sql = mysql_connect("127.0.0.1","root","");
	if(!$sql) {
		$err = array('error' => 775);
		echo json_encode($err);
		exit(1);
	}else{
		mysql_select_db("notecloud",$sql);
		$res = mysql_query("select activecode from user where uid='$uid'");
		$userExist = mysql_fetch_array($res);
		if(!$userExist){
			$err = array('error' => 101);
			echo json_encode($err);
		}else{
			if ($acode != $userExist["activecode"]) {
				$err = array('error' => 174);
				echo json_encode($err);
			}else{
				if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg")|| ($_FILES["file"]["type"] == "image/png"))&& ($_FILES["file"]["size"] < 1000000)){
  					if ($_FILES["file"]["error"] > 0){
    					$err = array('error' => $_FILES["file"]["error"]);
						echo json_encode($err);
    				}else{
						$filename = "user".$uid.".jpg";
						move_uploaded_file($_FILES["file"]["tmp_name"],"./avatar/".$filename);


						if ((($_FILES["full"]["type"] == "image/gif")|| ($_FILES["full"]["type"] == "image/jpeg")|| ($_FILES["full"]["type"] == "image/pjpeg")|| ($_FILES["full"]["type"] == "image/png"))&& ($_FILES["full"]["size"] < 1000000)){
							if ($_FILES["full"]["error"] > 0){
								$err = array('error' => $_FILES["full"]["error"]);
								echo json_encode($err);
							}else{
								$filenameFull = "user".$uid."_full.jpg";
								move_uploaded_file($_FILES["full"]["tmp_name"],"./avatar/".$filenameFull);
								mysql_query("update user set avatar='$filename' where uid='$uid'");
								$err = array('success' => 200);
								echo json_encode($err);
							}
						}else{
							$err = array('error' => 343);
							echo json_encode($err);
						}
    				}
  				}else{
  					$err = array('error' => 343);
					echo json_encode($err);
  				}
			}
		}
		mysql_close();
	}
?>