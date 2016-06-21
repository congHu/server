<?php
	require "./mail.class.php";
  $mail = new cs_smtp();
  if ($mail->errstr) //如果连接出错
        die($mail->errstr);
    if (!$mail->login('hcdstudio@126.com','alsldlhcd'))
        die($mail->errstr);
    $email = $_GET["email"];
    $sql = mysql_connect("127.0.0.1","root","");
	if (!$sql) {
		die(mysql_error());
	}
	mysql_select_db("notecloud", $sql);
	$res = mysql_query("select uid from user where email='$email'");
	$exist = mysql_fetch_array($res);
	if ($exist) {
		$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$code = "";
 		for ($i=0;$i<16;$i++) {
   			$code .= $charset[mt_rand(0,strlen($charset)-1)];
 		}
 		
		$arr = explode("@", $email);
		mysql_query("update user set activecode='$code',activetime=now(),isActive=0 where email='$email'");
    	$mail->send($email,"欢迎使用NoteCloud","<html><head></head><body>你好，$arr[0]<br><br>感谢你注册并使用NoteCloud，请点击以下链接完成激活。<br>激活完成后，你将可以使用该邮箱进行找回密码等操作。<br><br><a href='http://119.29.225.180/notecloud/activeEmail.php?email=$email&activecode=$code'>http://119.29.225.180/notecloud/activeEmail.php?email=$email&activecode=$code</a><br><br>若无法直接点击链接，请把链接复制到浏览器的地址栏里访问。该链接24小时内有效。<br><br>此邮件由系统发出，请勿回复。</body></html>" );
	}
	mysql_close($sql);
?>