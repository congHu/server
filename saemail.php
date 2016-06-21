<?php
$mail = new SaeMail();
$ret = $mail->quickSend("850476264@qq.com", "这是一封测试邮件", "邮件内容就是一封SAE测试邮件", "hcdstudio@126.com", "alsldlhcd");

//发送失败时输出错误码和错误信息
if ($ret === false) {
    var_dump($mail->errno(), $mail->errmsg());
}

$mail->clean(); //重用此对象
$ret = $mail->quickSend("mztkn53@163.com", "这是一封测试邮件", "邮件内容就是一封SAE测试邮件", "hcdstudio@126.com", "alsldlhcd");

//发送失败时输出错误码和错误信息
if ($ret === false) {
    var_dump($mail->errno(), $mail->errmsg());
}
?>