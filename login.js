var verifyRequire = false;
	window.onload=function(){
		$.get("isRequireValidCode.php", function(result){
			if (result == "1") {
				verifyRequire = true;
				refreshVerify();
			}else{
				$("#verify").hide();
				$("#verifyImg").hide();
			}
		});
	}
	
	function login(){
		var email = $("#email").val();
		var psw = $("#psw").val();
		var verify = $("#verify").val();
		if (email!="") {
			if (psw!="") {
				if(psw.length>=6){
					if (verifyRequire) {
						if (verify!="") {
							postLogin(email, psw, verify);
						}else{
							$("#msg").html("请输入验证码");
						}
					}else{
						postLogin(email,psw,verify);
					}
				}else{
					$("#msg").html("密码长度需要6位以上");
				}
			}else{
				$("#msg").html("请输入密码");
			}
			
		}else{
			$("#msg").html("请输入邮箱地址");
		}
		return false;
		
	}
	function postLogin(emailUser, psw, verifyCode){
		if (verifyRequire) {
			$.post("login.php",{email:emailUser,password:psw,verify:verifyCode},function(data, status){
				console.log(data);
				var returndata = JSON.parse(data);
				if (returndata.error!=null) {
					loginError(returndata.error);
				}else{
					loginSuccess();
				}
			})
		}else{
			$.post("login.php",{email:emailUser,password:psw},function(data, status){
			var returndata = JSON.parse(data);
			if (returndata.error!=null) {
				loginError(returndata.error);
			}else{
				loginSuccess();
			}
			
		})
		}
	}
	function loginSuccess(){
		//window.location.href = "../index.php";
		//写入cookie

		//维护模式输出
		document.write("");
		alert("登陆成功！");

	}
	function loginError(err){
		$("#verify").show();
		$("#verifyImg").show();
		refreshVerify();
		verifyRequire = true;
		$("#verify").val("");
		switch(err){
			case 101:
				$("#msg").html("用户名不存在，请注册");
				break;
			case 102:
				$("#msg").html("密码不正确，忘记密码？");
				break;
			case 103:
				$("#msg").html("密码不正确，忘记密码？");
				break;
			default:
				$("#msg").html("发生错误: " + err);
				break;
		}
		
	}
	function refreshVerify(){
		$("#verifyImg").html("<a href='javascript:refreshVerify()'><img src='captcha.php'></a>");
	}