<?php header('content-type:text/html; charset=utf-8');
// ini_set('session.gc_maxlifetime', 0.1); //设置会话过期时间  
session_start();//开启会话
// //删除客户中cookie的sessionid，设置会话过期时间
// 	if(isset($_COOKIE[session_name()])) {
// 		setCookie(session_name(), "", time()-60, "/");
// 	}

if(!isset($_SESSION['permited'])){//如果没有会话记录显示注册登录界面
  include 'login_form.php';

}else{
if($_SESSION['permited']==1){
		define("SITEDIR", __dir__);//设置站点目录
		define("SITEINDEX",SITEDIR.'\index.php');//设置站点地址
		define("PERMITED",'有了权限！');
		//设置站点地址
		// function SITEDIR($str){
		// 		return SITEDIR.'\\'.$str;
		// 	}
 		$_SESSION['sitebase'] = SITEDIR;
 		// var_dump($_SESSION);

		include './components/messages.php';

		};//如果有记录显示退出链接
}

if(!empty($_GET['reg'])){//如果注册提交弹出提示
if(isset($_GET['reg'])||$_GET['reg']==1){
  echo '<script> alert("注册成功,请登录！"); </script>';
}};       

// echo $_SESSION['permited'];
// echo $_SESSION['sess_username'];
// echo $_SESSION['sess_userrole'];


if(!empty($_POST['submit'])){
if($_POST['submit']==1){
	echo '提交用户';
	// var_dump($_POST);
}
}

//根据URL返回参数提示
if(isset($_GET['wmsg'])){
if($_GET['wmsg']==1){
	echo '<script>alert("留言成功！！！");</script>';
}}

?>
<script src="./js/jquery.js"></script>
<script src="./js/func_list.js"></script>


<script type="text/javascript">
// alert("加载页面中！");
$(document).ready(function(){ 	
// alert("加载页面完成！");



	//*************	默认不能提交注册,选择站点协议后才能提交
	$("#submit").attr("disabled",true);
	$("#checkbox").change(function(){
        if($(this).is(':checked')==true){
            $("#submit").attr("disabled",false);
            $("#submit").css("background","#7FFF00");
            $("#checkbox").checked=false;
        }else{
            $("#submit").attr("disabled",true);
            $("#submit").css("background","#e5e5e5");
            $("#checkbox").checked=true;
        }
    });


	//*************显示用户选择清单
	obj=document.getElementsByName('names');
	$(obj).bind("click",function(){
		var selected_id=$(this).attr('id');
		// alert(selected_id);
		    $("#receiver").html($(this).attr('user'));//给收件人标签赋值
		    $("#receiver_input").val($(this).attr('user'));//给收件人标签赋值
		    $("#receiver_id").val($(this).attr('id'));
		    $("#replytip").text('');
		    

		});





	//*************验证注册用户名
	            $("#username").blur(function(){
	            	//调用用户名验证函数前端验证
	             if(checkUsername()){
	            		//后台验证用户是否已被占用
		                $.ajax({
		                    type: "post",
		                    url: "./components/username_authenticator.php",
		                    data: "username=" + $("#username").val(),
		                    success: function(msg) {
		                        $("#usernamecheck").html(msg);
		                    }
		                });
                    };
                });
	//*************验证注册用邮箱
	            $("#email").blur(function(){
	            	// alert'888');
	            	//调用邮箱验证函数前端验证
	            	// alert($("#email").val());
	              if(checkemail($("#email").val())){
	           		//后台验证邮箱是否已被占用
	           		$.ajax({
		                    type: "post",
		                    url: "./components/email_authenticator.php",
		                    data: "email=" + $("#email").val(),
		                    success: function(msg) {
		                        $("#emailcheck").html(msg);
		                    }
		                });
	                }else{
	            		// alert('请检查邮箱是否有误！');
	            		document.getElementById( "emailcheck" ).innerHTML = "<font color=red style='font-size:16px;'><b>请填写邮箱或检查邮箱输入是否有误！！！</b></font>";
	            	}
            });

	// //*************验证两次输入的密码是否一致
			$("input[name='pwd2']").blur(function(){
				var pwd1=$("input[name='pwd1']").val();
				var pwd2=$("input[name='pwd2']").val();
				
	             if(!checkpwd(pwd1,pwd2)){
	        		// alert('两次输入的密码不一致，请重新输入密码！');
	        		document.getElementById( "pwdcheck" ).innerHTML = "<font color=red style='font-size:16px;'><b>两次输入的密码不一致，请重新输入密码！！</b></font>";
	            }else{
	            	document.getElementById( "pwdcheck" ).innerHTML = "";
	            };
	        });



	//*************提交验证密码是否为空
			$("input[name='checkbox']").bind("click",function(){
				var pwd2=$("input[name='pwd2']").val();
				if(!$(this).attr("checked")){
					$(this).attr("checked",true);
						$("#submit").attr("disabled",false);

				}else{
					$(this).attr("checked",false);	
					$("#submit").attr("disabled",true);
				
				};

				if(pwd2==""){
					// alert('====空'+pwd2);
					document.getElementById( "pwdcheck" ).innerHTML = "<font color=red style='font-size:16px;'><b>请设置密码！！！！</b></font>";
				}


	        });



})

</script>



