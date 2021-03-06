var step = 0;
        var email = "";
        var validCode = "";
        window.onload = function(){
            $("#resendBtn").hide();
        }

        var sec = 60;
        function countDown(){
            sec--;
            if (sec>0) {
                $("#resendBtn").html("重新发送(" + sec + ")");
                setTimeout("countDown()", 1000);
            }else{
                $("#resendBtn").html("重新发送");
            }
        }

        function resendEmail(){
            if (sec<=0) {
                $("#stepper").html("重发验证邮件");
                $("#msg").html("");
                $("#verify").show();
                $("#email").val(email);
                $("#verify").val("");
                $("#verifyImg").show();
                refreshVerify();
                $("#email").attr("placeholder","请输入邮箱地址");
                $("#verify").attr("placeholder","验证码");
                $("#resendBtn").hide();
                $("#nextStepBtn").css("margin","auto");
                $("#nextStepBtn").css("float","none");
                step--;
                sec = 60;
            }
        }

        function nextStep() {
            switch (step) {
                case 0:
                    email = $("#email").val();
                    var verify = $("#verify").val();
                    if (email != "") {
                        if (verify != "") {
                            $.post("forgot.php", { email: email, valid: verify }, function (data, status) {
                                var returndata = JSON.parse(data);
                                if (returndata.error != null) {
                                    returnError(returndata.error);
                                }else {
                                    $("#stepper").html("第2/3步");
                                    $("#msg").html("");
                                    $("#verify").hide();
                                    $("#email").val("");
                                    $("#email").attr("placeholder", "请输入邮箱验证码");
                                    $("#verifyImg").hide();
                                    $("#resendBtn").show();
                                    $("#nextStepBtn").css("margin", null);
                                    $("#nextStepBtn").css("float", "left");
                                    step++;
                                    countDown();
                                }
                                
                            });
                        } else {
                            $("#msg").html("请输入验证码，点击图片可刷新验证码");
                        }

                    } else {
                        $("#msg").html("请输入邮箱地址");
                    }
                    break;
                case 1:
                    validCode = $("#email").val();
                    if (validCode != "") {
                        $.post("forgot2.php", {verify: validCode}, function(data, status){
                            if (data == "true") {
                                $("#stepper").html("第3/3步");
                                $("#msg").html("");
                                $("#verify").show();
                                $("#email").val("");
                                $("#verify").val("");
                                $("#email").attr("placeholder","新密码");
                                $("#verify").attr("placeholder","确认密码");
                                $("#email").attr("type","password");
                                $("#verify").attr("type","password");
                                $("#resendBtn").hide();
                                $("#nextStepBtn").css("margin","auto");
                                $("#nextStepBtn").css("float","none");
                                step++;
                            }else{
                                $("#msg").html("邮箱验证码不正确");
                            }
                        });
                    }

                    break;
                case 2:
                    var psw1 = $("#email").val();
                    var psw2 = $("#verify").val();
                    if (psw1.length >= 6) {
                        if (psw1 == psw2) {
                            $.post("forgot3.php", { eml: email, pswd: psw1, verify: validCode }, function (data, status) {
                                var returndata = JSON.parse(data);
                                if (returndata.error != null) {
                                    $("#msg").html("发生错误" + returndata.error);
                                } else {
                                    alert("密码修改成功");
                                    document.write("");
                                }
                            });
                        } else {
                            $("#msg").html("两次输入的密码不一致");
                        }
                    } else {
                        $("#msg").html("密码长度需要6位以上");
                    }
                    break;
                default:
                    break;
            }
            
            
            return false;
        }

        function returnError(err) {
            refreshVerify();
            switch (err) {
                case 101:
                    $("#msg").html("用户不存在，请注册");
                    break;
                case 103:
                    $("#msg").html("验证码不正确，点击图片可刷新");
                    break;
                default:
                    $("#msg").html("发生错误: " + err);
            }
        }

        function refreshVerify(){
            $("#verifyImg").html("<a href='javascript:refreshVerify()'><img src='captcha.php'></a>");
        }