<?php
header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL & ~E_NOTICE);	

($_SERVER['HTTP_REFERER']) || exit('You have no right to access this page, please contact administrator!');
session_start();
($_SESSION['permited'])||exit('禁止未登录的操作！')
?>

<!DOCTYPE html>
<html>
<head>
	<title>用户管理</title>
		<meta charset="utf-8">
		<link href="./../styles/styles.css" rel="stylesheet" type="text/css" /> 

		<style type="text/css">
		input[type=submit]{
		    width:500px;
		}
.left-form input[type=text], input[type=password] {
	background: lightblue;
	
	float: auto;

		}

/*图片加载中div图层，用于遮挡页面*/
.loadingdiv { 
  position:absolute; 
  text-align:center; 
  left:0px; 
  top:0px; 
  z-index:70; 
  background-color:#000000; 
  opacity: 0.7;/*透明#CCCCCC*/
  display:none; 
  }   
/*加载中图片*/
.loadingdiv img 
{ 
  position:absolute; 
  left:0px; 
  top:0px; 
  z-index:80; 
  }
		</style>
		<script src="./../js/jquery.js"></script>
		<script src="./../js/func_list.js"></script>

</head>
<body>
	<div id='main'>	
			<div id="left">			
			<div><p><input type="button" id='delusers' name="" value="多选批量删除"></p></div>
			<?php
			require_once './../config/database-config.php';
			require_once './../userhandler.class.php';
			$res= new userhandler();
			$data=$res->showusers($dbh);
			echo '<pre>';
			// var_dump($data);
			echo '</pre>';
?>


	<div id='users'>
		<?php
			for($i=0;$i<count($data);$i++){
			echo '<input type="checkbox" id="'.$data[$i]['id'].'" name="users" user="'.$data[$i]['username'].'"><label for="'.$data[$i]['id'].'">'.$data[$i]['username'].'</label><br>';

			};
		?>	
	</div>


			</div>
			<div id="left">
			<div><p><input type="button" name="" value="单选用户修改"></p></div>

	<div id='user'>
		<?php
			for($i=0;$i<count($data);$i++){
			echo '<input type="checkbox" id="b'.$data[$i]['id'].'" name="names" user="'.$data[$i]['username'].'"onclick="checkedThis(this,'."'names'".')" ><label for="b'.$data[$i]['id'].'">'.$data[$i]['username'].'</label><br>';

			};
		?>	
	</div>
			</div>


<script type="text/javascript">
	//****Ajax获取数据============根据发件人选择
$('input[name=names]').bind("click",function(){ 

var selected_id=$(this).attr('id');
selected_id=(selected_id.slice(1));//去除id前缀标识
// alert(selected_id);

	 $.ajax({
            type: "post",
            url: "./actions/getUser.php",
            data: "id=" + selected_id,
            success: function(msg) {
            	// alert(msg);
				var obj=eval('('+msg+')');
				// alert(obj.id+obj.username+obj.role+obj.email+obj.tel+obj.wechat+obj.qq+obj.autho);
				$("#hid").val(obj.id);
				$("#email").val(obj.email);
				$("#username").val(obj.username);
				$("#tel").val(obj.tel);
				$("#qq_id").val(obj.qq);
				$("#wechat_id").val(obj.wechat);
				$("#autho").val(obj.autho);

            }
        });	



});
	

//多选框加事件设置为checked
$('input[name=users]').bind("click",function(){
	if($(this).attr("checked")=="checked"){
		$(this).next().attr("style","");//移除for标签背景
	$(this).attr("checked",false);}else{
	    $(this).attr("checked",true);//加亮for标签黄色背景
	$(this).next().attr("style","background-color: yellow");	
	}
})


//点击多选批量删除操作
$('#delusers').bind("click",function(){ 
	var selarr=Array();
	 $('input[name=users]').each(function(){	 	
	 	if ($(this).attr('checked') == "checked") {
	 		       var uids=($(this).attr('id'));
	 		selarr.push(uids);
	 	        }	 	
	 });

	con=confirm("确定要删除选中的用户吗？");
	if(con){
		alert(selarr);
	}
	
	 $.ajax({
            type: "post",
            url: "./actions/delusers.php",
            data: "idarr=" + selarr,
            success: function(msg) {
            	alert(msg);
		
            }
        });	



});


</script>


		<div id="mainright">

		<p id='test'> 
<?php

////提交修改信息数据处理
if($_POST){
	// var_dump($_POST);
	if($_POST["userupdate"]){

		$arr= array(
			'id' =>$_POST["hid"], 
			'username' =>$_POST["username"], 
			'email' =>$_POST["email"], 
			'password' =>$_POST["pwd"], //需要MD5加密
			'tel' =>$_POST["tel"], 
			'wechat' =>$_POST["wechat_id"], 
			'qq' =>$_POST["qq_id"], 
			'autho' =>$_POST["autho"]		
			);
// echo '<pre>';
// 		print_r($arr);
// echo '</pre>';

		$updt = new Userhandler();
		$result=$updt->updateuser($dbh,'users',$arr);
		if($result){
			echo '<script type="text/javascript"> alert("修改操作成功！");</script>';
		}else{
			echo '<script type="text/javascript"> alert("修改操作失败！");</script>';
		};

	}
}
?>
		</p>
		<div id="right-top">
		<?php ?>

		<div class="main">
		<?php //**************************************************************PHP
		// var_dump($_SESSION);
		?>

				<form action="#" method="POST" >
				 <input type="hidden" id="hid" name="hid" value=""> 
				<ul class="left-form">
					<h2><span class="text_danger"><br>修改用户信息</span></h2>
					<li><label>用户名</label>
						<input type="text" id='username' name='username'  placeholder="请填写用户名" required/>
						<div class="clear"> </div>
					</li> 
					<li><label>邮箱</label>
						<input type="text" id='email' name='email'  placeholder="邮箱" />
						<div class="clear"> </div>						
					</li> 
					<div id="emailcheck">  </div>
					<li><label><b>指定密码</b></label>
						<input type="text" id='pwd' name='pwd'  placeholder="密码" />
						<div class="clear">  </div>
					</li> 				
					<li><label>手机号</label>
						<input type="text" id='tel' name='tel'  placeholder="手机号" />
						<div class="clear"> </div>
					</li> 
					<li><label>微信号</label>
						<input type="text" id='wechat_id' name='wechat_id'   placeholder="微信号" />
						<div class="clear"> </div>
					</li> 
					<li><label>QQ号</label>
						<input type="text" id='qq_id' name='qq_id' placeholder="QQ号" />
						<div class="clear"> </div>
					</li> 
					
					<li><label>操作权（1=禁止）</label>
						<input type="text" id='autho' name='autho' placeholder="操作权" />
						<div class="clear"> </div>
					</li> 
					
					<input type="submit" name="userupdate" value="提交修改">
						<div class="clear"> </div>
				</ul>
				</form>
				
				<div class="clear"> </div>	
			
			
		</div>

		</div>
		</div>

	
	</div>
</body>
</html>