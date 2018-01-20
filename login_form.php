<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<link href="styles/styles.css" rel="stylesheet" type="text/css" /> 

</head>
<title>品冠留言板</title>
    <script type = "text/javascript"> 


    </script>
<body>

	<div class="main">
		<div class="header" >
			<h1>欢迎注册使用品冠留言板!</h1>
		</div>
				<div class="main">
				<form action="register.php" method="POST" >
				<ul class="left-form">
					<h2><span class="text_danger"><br>新用户请注册</span></h2>
					<li>
						<input type="text" id='username' name='username'  placeholder="请填写用户名" required/>

						<div class="clear"> </div>
					</li> 
					<div id="usernamecheck">  </div>
					<div id="failinfo">  </div>


					<li>
						<input type="text" id='email' name='email'  placeholder="邮箱" />
						<div class="clear"> </div>						
					</li> 
					<div id="emailcheck">  </div>
					<li>
						<input type="password" name='pwd1'  placeholder="密码" />
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="password"  name='pwd2'  placeholder="确认密码" />
						<div class="clear"> </div>
					</li> 
					<div id='pwdcheck'></div>
					<li>
						<input type="text" name='tel'  placeholder="手机号" />
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="text" name='wechat_id'   placeholder="微信号" />
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="text" name='qq_id' placeholder="QQ号" />
						<div class="clear"> </div>
					</li>  
					<li>
						<input type="text" name='question' placeholder="自定义找回密码问题" />
						<div class="clear"> </div>
					</li>  
					<li>
						<input type="text" name='answer' placeholder="自定义找回密码的答案" />
						<div class="clear"> </div>
					</li> 
					<label class="checkbox">
					<input type="checkbox" id="checkbox" name="checkbox" >
					我已认真阅读了<a href="#" id="agreement">《站点协议》!</a></label>




					<input type="submit" id="submit" name="register" value="注册" >
						<div class="clear"> </div>
				</ul>
				</form>





				<form action="login.php" method="POST" >
				<ul class="right-form">
					<h3><span class="text_pass">已注册用户请登录:</span></h3>
					<h4><span class="text_danger">
					<?php
					  $errors = array(
               				1=>"用户名或密码错误，请重新尝试！"                
           					   );
			            $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;

            		if ($error_id == 1) {
	                    echo $errors[$error_id];
	                }

					?>
						
					</span></h4>
					<div class="clear"> </div>

					<div>
						<li><input type="text" id="username" name="username"  placeholder="用户名" required autofocus /></li>
						<li> <input type="password" id="password" name="password"  placeholder="用户密码" required/></li>
						<h4><span class="text_warning">忘记密码??? <a href="retrievepass.php">请点此找回!</a></span></h4>
							<input type="submit" name="login" value="登录" role="form" >
					</div>
					<div class="clear"> </div>
				</ul>
				<div class="clear"> </div>
					
			</form>
			
		</div>
	</div>
</body>
</html>