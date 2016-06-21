<?php

	// 对邮件地址进行中文的UTF-8编码转化  
function format_mail_address($address){  
  if(preg_match("|<([^<]+)>|", $address, $matches)){  
    $name = mb_substr($address, 0, strpos($address, '<'));  
    $name = trim($name);  
    $mail = $matches[1];  
    $address = "=?UTF-8?B?".base64_encode($name)."?= " . "<$mail>";  
  }  
  return $address;  
}  
  
// 发送html格式的邮件  
function html_mail($from, $to, $subject, $body){  
  if(preg_match("|<([^<]+)>|", $from, $matches)){  
    $from_name = mb_substr($from, 0, strpos($from, '<'));  
    $from_mail = $matches[1];  
    $from = "=?UTF-8?B?".base64_encode($from_name)."?= " . "<$from_mail>";  
  }else{  
    $from_mail = $from;  
  }  
  $headers[] = "From: $from";  
  $headers[] = "X-Mailer: PHP";  
  $headers[] = "MIME-Version: 1.0";  
  $headers[] = "Content-type: text/html; charset=utf8";  
  $headers[] = "Reply-To: $from_mail";  
  $subject = "=?UTF-8?B?".base64_encode($subject)."?=";  
  if(is_array($to)){  
    foreach($to as $mail)  
      $to_mails[] = format_mail_address($mail);  
    $to = join(", ", $to_mails);  
  }  
  mail($to, $subject, $body, join("\r\n", $headers), "-f $from_mail");
  echo "send success";  
}  

html_mail(  
    "HCD <admin@hcdstudio.com>",  
    array(  
        "用户A <850476264@qq.com>",  
        "用户B <hcdstudio@126.com>"),  
    "这是一封测试邮件",  
    "<html><body><h1 style='color:red'>  
      这是一封测试邮件，包括中文字符 and english. 
    </h1></body></html>"  
); 

?>