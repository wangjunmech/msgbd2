<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles/styles.css" rel="stylesheet" type="text/css" /> 
		<script src="./js/jquery.js"></script>
		<script src="./js/func_list.js"></script>

</head>
<title>找回密码</title>
<body>
<div class="main">

<div class="header"><h1>通过下面的方式找回密码！</h1></div>
<div class="body ">
	<div class="mainbody">

	<div class="left-form ">
		<form action="#" method="POST" >
				<ul>
					<h2><span class="text_danger">1.根据问题和答案找回密码！请在下面输入注册时自定义的问题和答案：</span></h2>

					<li>
						<input type="text" name='question'  placeholder="请在此输入保密问题……！" value="<?php if(!empty($_POST['question'])){echo $_POST['question'];}?>" required/>
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="text" name='answer'  placeholder="请在此输入保密答案……！" value="<?php if(!empty($_POST['answer'])){echo $_POST['answer'];}?>" required />
						<div class="clear"> </div>
					</li> 

					<div class="right-form submit">
					<input type="submit" name="retrivbyanswer" value="找回密码">
						</div>
												<div class="clear"> </div>

				</ul>
				</form>
				<?php 
				// error_reporting(0);
				error_reporting(E_ALL & ~E_NOTICE);
				// error_reporting(0);
				if(!empty($_POST)){
				if ($_POST['retrivbyanswer']){
					    if(!empty($_POST['question'])){
					      $question = $_POST['question'];
					      $answer = $_POST['answer'];
					      if (!empty($question) && !empty($answer)) {
						    require_once './config/database-config.php';

						       // //query方法查询
						        // $sql="select * from users where question='qx' and answer='xq'";
						        // $stmt=$dbh -> query($sql);
						        // $res  =  $stmt -> fetchAll (PDO::FETCH_BOUND);
						        // echo '=======记录条数========'.$stmt->rowCount().'===============';

						        //预处理语句查询
						        $sql = "SELECT * from users where question = :question and answer = :answer";
						        $stmt=$dbh->prepare($sql);
						        $stmt-> execute(array( ':question'  => $question,  ':answer'  => $answer ));
						        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						        $resnum=$stmt->rowCount();

						// echo '<pre>';
						//         // var_dump($res);
						// echo '</pre>'; 
						if(!($resnum==1)){
							echo '<script type="text/javascript">alert("请重新填写注册时设置的问题和答案，填写正确才能找回哦!!！");
</script>';
							}}}
				}
				}


				?>
				<?php if($resnum==1){ ?>

				<div name="resetpwd">
					<form action="#" method="POST" >
				<ul>
					<h2><span class="text_danger">请设置新密码！</span></h2>

					<li>
						<input type="password" name='pwd1'  placeholder="请在此输入新密码！" required/>
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="password" name='pwd2'  placeholder="请再次输入新密码！" required />
						<div class="clear"> </div>
					</li> 
					<input type="hidden" name='uid' value="<?php if($res){echo $res[0]['id'];}?>" />

					<div class="right-form submit">
					<input type="submit" name="resetpass" value="重置密码">
						</div>
				</ul>
				</form>


				</div>

				<?php }; ?>


				<?php 
				if(!empty($_POST['resetpass'])){
					 // var_dump($_POST);
							$id = $_POST['uid'];						   
						    $password=$_POST['pwd2'];
					      if (!empty($id) && !empty($password)) {
						    require_once './config/database-config.php';
	
						        //预处理语句查询
						        $sql = "update users set password=:password where id = :id";
						        $stmt=$dbh->prepare($sql);
						        $affected_rows=$stmt-> execute(array( ':password'  => $password, ':id'  => $id ));
						        // echo '==受影响行数：'.$affected_rows;
						        echo '<font><p><h3><span class="text_danger">成功重置密码，<span id="sec">3</span>秒后自动跳转到登录</span></h3><p></font>';
								echo '  <script type="text/javascript">
								        var num = $("#sec");
								        var i = 3;
								        var interval = setInterval(function(){
								            num.text(i);
								            i--;
								            console.log("当前数值："+i);
								            if(i < 0){
								                clearInterval(interval);
								                window.location.href = "index.php";
								            }
								        },1000);
								      
										


								       </script>
								';

						    }}
					
				?>

				</div>



		<div class="right-form">
		<form action="#" method="POST" >
				<ul>
					<h2><span class="text_danger">2.根据保密邮箱找回密码！</span></h2>
					<li>
						<input type="text" name='username'  placeholder="请在此输入注册时填写的保密邮箱……！" required/>
					</li> 
					<div class="clear"> </div>			
				
					<div class="right-form submit">
					<input type="submit" name="retrivbymail" value="发验证邮件到我邮箱！" >
					</div>
				
					
				</ul>
				</form>

				<?php 
				if(!empty($_POST)){
				if ($_POST['retrivbymail']){
					echo "右边提交了邮箱！";
				}
			}


				?>

			</div>


			</div>
		</div>
	
	</div>
<script type="text/javascript">
	$("input[name=retrivbyanswer]").bind("click",function(){
		var q=$("input[name=question]").val();
		var a=$("input[name=answer]").val();
		$("input[name=answer]").html('999999');

	})

	$("input[name=pwd2]").bind("blur",function(){
		var p1=$("input[name=pwd1]").val();
		var p2=$("input[name=pwd2]").val();
		if(p1!==p2){
		alert('请确保两次输入的密码一致！');
		}
	})




</script>


</body>
</html>