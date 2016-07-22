<?php
  require "./mail.class.php";
  $mail = new cs_smtp();
  if ($mail->errstr) //如果连接出错
        die($mail->errstr);
    if (!$mail->login('hcdstudio@126.com','alsldlhcd'))
        die($mail->errstr);
    

	$email = $_POST['email'];
	$password = $_POST['password'];
	$verify = $_POST['verify'];
	session_start();
	if ($verify==$_SESSION['authnum_session']) {
		$sql = mysql_connect("127.0.0.1","root","");
		if (!$sql) {
			die(mysql_error());
		}
		mysql_select_db("notecloud", $sql);
		$res = mysql_query("select uid from user where email='$email'");
		$exist = mysql_fetch_array($res);
		if ($exist) {
			$err = array('error' => 111);
			echo json_encode($err);
		}else{
			$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$code = "";
 			for ($i=0;$i<16;$i++) {
   				$code .= $charset[mt_rand(0,strlen($charset)-1)];
 			}
 		
			$arr = explode("@", $email);
			//注册
			mysql_query("insert into user (email,password,uname,activecode,activetime,friend) values ('$email',password('$password'),'$arr[0]','$code',now(),'[8]')");
			//激活邮件
    		$mail->send($email,"欢迎使用NoteCloud","<html><head></head><body>你好，$arr[0]<br><br>感谢你注册并使用NoteCloud，请点击以下链接完成激活。<br>激活完成后，你将可以使用该邮箱进行找回密码等操作。<br><br><a href='http://119.29.225.180/notecloud/activeEmail.php?email=$email&activecode=$code'>http://119.29.225.180/notecloud/activeEmail.php?email=$email&activecode=$code</a><br><br>若无法直接点击链接，请把链接复制到浏览器的地址栏里访问。该链接24小时内有效。<br><br>此邮件由系统发出，请勿回复。</body></html>" );
			//获取uid
    		$res = mysql_query("select uid from user where email='$email'");
			$exist = mysql_fetch_array($res);
			$uid = $exist["uid"];
			//消息表
			$sqlquery = "CREATE TABLE chat$uid (send_from varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,fromid int(11) NOT NULL,type varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,body text COLLATE utf8mb4_unicode_ci NOT NULL,time datetime NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
			mysql_query($sqlquery);
			//默认好运
			mysql_query("update user set friend='[8]' where uid=$uid");
			//输出
			$userinfo = array();
			$userinfo["uid"] = $uid;
			$userinfo["activecode"] = $activecode;
    		echo json_encode($userinfo);
    		mysql_close($sql);
		}
	}else{
		$err = array('error' => 103);
		echo json_encode($err);
	}
	
	
	
?>