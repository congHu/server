function reg(){
		var email = $("#email").val();
		var psw = $("#psw").val();
		var psw2 = $("#psw2").val();
		var verify = $("#verify").val();
		if (email!="") {
			var sp = email.split("@");
			if (sp.length==2) {
				if (psw!="") {
					if(psw.length>=6){
						if (psw==psw2) {
							if (verify!="") {
								postReg(email, psw, verify);
							}else{
								$("#msg").html("请输入验证码，点击图片可刷新");
							}
						}else{
							$("#msg").html("两次输入的密码不一致");
						}
					}else{
						$("#msg").html("密码长度需要6位以上");
					}
				}else{
					$("#msg").html("请输入密码");
				}
			}else{
				$("#msg").html("输入的邮箱地址不合法");
			}
		}else{
			$("#msg").html("请输入邮箱地址");
		}
		return false;
	}
	function postReg(emailUser, psw, verify){
		$.post("register.php",{email:emailUser,password:psw,verify:verify},function(data, status){
			var returndata = JSON.parse(data);
			if (returndata.error!=null) {
				regError(returndata.error);
			}else{
				regSuccess();
			}
			
		})
		
	}
	function regSuccess(){
		//window.location.href = "../index.php";
		//注册成功的跳转

		//维护模式输出
		document.write("");
		alert("注册成功！请查收激活邮件");
	}
	function regError(err){
		switch(err){
			case 111:
				$("#msg").html("用户名已存在");
				break;
			case 103:
				$("#msg").html("验证码错误，点击图片可刷新");
				break;
			default:
				$("#msg").html("发生错误: " + err);
				break;
		}
		$("#verify").val("");
		refreshVerify();
		
	}
	function refreshVerify(){
		$("#verifyImg").html("<a href='javascript:refreshVerify()'><img src='captcha.php'></a>");
	}