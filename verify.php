<?php 
//调用此页面，如果下面的式子成立，则生成验证码图片 
$act = $_GET["action"];
if($act=="generate") 
{ 
    rand_create(); 
} 
if ($act=="verify") {
    rand_check();
}
//验证码图片生成 
function rand_create() 
{ 
    //通知浏览器将要输出PNG图片 
    Header("Content-type: image/PNG"); 
    //准备好随机数发生器种子  
    srand((double)microtime()*1000000); 
    //准备图片的相关参数   
    $im = imagecreate(62,20); 
    $black = ImageColorAllocate($im, 0,0,0);  //RGB黑色标识符 
    $white = ImageColorAllocate($im, 255,255,255); //RGB白色标识符 
    $gray = ImageColorAllocate($im, 200,200,200); //RGB灰色标识符 
    //开始作图     
    imagefill($im,0,0,$gray); 
    while(($randval=rand()%100000)<10000);{ 
        $_SESSION["login_check_num"] = $randval; 
        //将四位整数验证码绘入图片  
        imagestring($im, 5, 10, 3, $randval, $black); 
    } 
    //加入干扰象素    
    for($i=0;$i<200;$i++){ 
        $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255)); 
        imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); 
    } 
    //输出验证图片 
    ImagePNG($im); 
    //销毁图像标识符 
    ImageDestroy($im); 
} 
//检验验证码 
function rand_check() 
{ 
    if($_POST["reg_rand"] == $_SESSION["login_check_num"]){ 
        return true; 
    } 
    else{ 
        exit("验证码输入错误"); 
    } 
} 
?>