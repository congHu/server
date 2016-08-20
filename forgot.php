<?php
	
	$email = $_POST['email'];
	$valid = $_POST["valid"];

	session_start();
	if ($valid==$_SESSION["authnum_session"]) {
		$sql = mysql_connect("127.0.0.1","root","");
		if (!$sql) {
			die(mysql_error());
		}
		mysql_select_db("notecloud", $sql);
		$res = mysql_query("select uid from user where email='$email'");
		$exist = mysql_fetch_array($res);
		if (!$exist) {
			$err = array('error' => 101);
			echo json_encode($err);
		}else{
			$charset = '1234567890';
			$code = "";
 			for ($i=0;$i<6;$i++) {
   				$code .= $charset[mt_rand(0,strlen($charset)-1)];
 			}
 			$arr = explode("@", $email);
 			$_SESSION["validCode"] = $code;

 			require "./mail.class.php";
  			$mail = new cs_smtp();
 			if ($mail->errstr) //如果连接出错
      		  	die($mail->errstr);
    		if (!$mail->login('hcdstudio@126.com','alsldlhcd'))
        		die($mail->errstr);
 			$mail->send($email,"NoteCloud账号验证	","<html><body>你好，$arr[0]<br><br>您的验证码为:
 				<br><font style='font-size:36px;color: blue;'>$code</font><br><br>请尽快使用该验证码完成验证操作，请勿将验证码暴露给他人。<br>如非本人操作，请忽略本邮件。<br>此邮件由系统发出，请勿回复。</body></html>" );
 			$err = array('success' => 200);
			echo json_encode($err);
		}
		mysql_close($sql);
	}else{
		$err = array('error' => 103);
		echo json_encode($err);
	}

	
	
?>