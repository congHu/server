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
		$res = mysql_query("select activecode,friend_comments from user where uid='$uid'");
		$userExist = mysql_fetch_array($res);
		if(!$userExist){
			$err = array('error' => 101);
			echo json_encode($err);
		}else{
			if ($acode != $userExist["activecode"]) {
				$err = array('error' => 174);
				echo json_encode($err);
			}else{
				$msglist = mysql_query("select * from chat$uid order by time");
				$res = array();
				while ($msg = mysql_fetch_array($msglist)) {
					$fid = $msg["fromid"];
					if($msg["send_from"] == "user"){
						$friendComments = json_decode($userExist["friend_comments"],true);
						if (isset($friendComments[$fid])){
							$msg["chatname"] = $friendComments[$fid];
						}else{
							$chatroomname = mysql_query("select uname from user where uid='$fid'");
							$chatname = mysql_fetch_array($chatroomname);
							$msg["chatname"] = $chatname["uname"];
						}

					}elseif ($msg["send_from"] == "group") {
						//TODO: 改成了前缀模式
						$chatroomname = mysql_query("select * from chatroom where cid='$fid'");
						$chatname = mysql_fetch_array($chatroomname);	
						$msg["chatname"] = $chatname["roomname"];
					}
					
					$res[] = $msg;
				}
				$json = json_encode($res);
				//echo preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $json);
				echo $json;
				mysql_query("delete from chat$uid where 1");
			}
		}
	}
	mysql_close();
?>