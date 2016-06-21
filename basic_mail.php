<?php
	require "./mail.class.php";
	$mail = new cs_smtp();
	if ($mail->errstr) //如果连接出错
        die($mail->errstr);
    if (!$mail->login('hcdstudio@126.com','alsldlhcd'))
        die($mail->errstr);
    $mail->send("850476264@qq.com","测试邮件","<html><body><h1 style='color:red'>  
      这是一封测试邮件，包括中文字符 and english. 
    </h1></body></html>" );
?>