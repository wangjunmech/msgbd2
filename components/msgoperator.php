<?php
header('content-type:text/html;charset=utf-8');
($_SERVER['HTTP_REFERER']) || exit('You have no right to access this page, please contact administrator!');
session_start();//开启会话
// var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
<head>
	<title>消息管理</title>
		<meta charset="utf-8">
		<link href="./../styles/styles.css" rel="stylesheet" type="text/css" /> 
		<script src="./../js/jquery.js"></script>
		<script src="./../js/func_list.js"></script>
<style type="text/css">		
.msgdelbtn{ position:absolute;
		background:yellow; 
		width:200px; 
		height:100px;font-size: 20px;
		text-align: center;
		line-height:100px;
		padding:10px; 
	    border: 2px solid green;
	    -moz-border-radius: 100px; 
	    -webkit-border-radius: 100px; 
	    border-radius:50px;
	    -moz-box-shadow:-1px 2px 20px #330F05, 2px 2px 5px #333333; -webkit-box-shadow:-1px 2px 20px #330F05, 2px 2px 5px #333333; box-shadow:-1px 2px 20px #330F05, 2px 2px 5px #333333;
	} 
</style>

</head>
<body>
	<div id='main'>	
			<form id='msgform' name='msgform' method="post" action="msgmanager.php">	
			<div id="left">
			<div><p>根据收件人选择：</p></div>
			<?php
			require_once './../config/database-config.php';
			require_once './../userhandler.class.php';
			$res= new userhandler();
			$data=$res->showusers($dbh);

			for($i=0;$i<count($data);$i++){
				// echo $data[$i]['id'].'===='.$data[$i]['username'].'<br>';
			echo '<input type="checkbox" id="'.$data[$i]['id'].'" name="names" user="'.$data[$i]['username'].'"onclick="checkedThis(this,'."'names'".')"><label for="'.$data[$i]['id'].'">'.$data[$i]['username'].'</label><br>';

			};

				?>	
			</div>
			
			<div id="left">
			<div><p>根据发件人选择：</p></div>
			<?php
			require_once './../config/database-config.php';
			require_once './../userhandler.class.php';
			$res= new userhandler();
			$data=$res->showusers($dbh);

			for($i=0;$i<count($data);$i++){
				// echo $data[$i]['id'].'===='.$data[$i]['username'].'<br>';
			echo '<input type="checkbox" id="b'.$data[$i]['id'].'" name="names2" user="'.$data[$i]['username'].'"onclick="checkedThis(this,'."'names2'".')"><label for="b'.$data[$i]['id'].'">'.$data[$i]['username'].'</label><br>';

			};

				?>	
			</div>
			<div id="msgdelbtn" class="msgdelbtn"> <a href="#" > <span id="aspan">删除选中的消息</span></a></div>
			<div id='marks'>
			<p id="SorR"></p>
			<p id="SorRid"></p>
			</div>
<div id="mainright">
	<div id="right-top" style="background: lightyellow">

<script type="text/javascript">
// $('#marks').hide();//隐藏所选记录
// $('#msgdelbtn').hide();
//****Ajax获取数据==========根据收件人选择消息
 $('input[name=names]').bind("click",function(){ 

 	selarr.length=0;//清空选择器
	var selected_id=$(this).attr('id');
	// alert(selected_id);
	//设置记录
 	$('#SorR').html("Receiver");
 	$('#SorRid').html(selected_id);

    $("#right-top").html($(this).attr('user')+'收到的消息：');
    		$.ajax({
                    type: "post",
                    url: "./actions/getMsgbyReceiver.php",
                    data: "id=" + selected_id,
                    success: function(msg) {
                        $("#right-top").html(msg);


                    }
                });
    		$('#msgdelbtn').hide();//先隐藏删除按钮
});

//****Ajax获取数据============根据发件人选择
$('input[name=names2]').bind("click",function(){ 
selarr.length=0;//清空选择器
var selected_id=$(this).attr('id');
selected_id=(selected_id.slice(1));//去除id前缀标识
	//设置记录
 	$('#SorR').html("Sender");
 	$('#SorRid').html(selected_id);

$("#right-top").html($(this).attr('user')+'发送的消息：');
	 $.ajax({
            type: "post",
            url: "./actions/getMsgbySender.php",
            data: "id=" + selected_id,
            success: function(msg) {	                    	
                $("#right-top").html(msg);
            }
        });
	 $('#msgdelbtn').hide();//先隐藏删除按钮				 

});
	
		//**检查元素是否已存在于数组中的方法
		Array.prototype.contains = function ( needle ) {
		  for (i in this) {
		    if (this[i] == needle) return true;
		  }
		  return false;
		}
		//**从数组中删除指定元素的方法
		Array.prototype.removeByValue = function(val) {
		  for(var i=0; i<this.length; i++) {
		    if(this[i] == val) {
		      this.splice(i, 1);
		      break;
		    }
		  }
		}
					 
					
//给ajax返回内容的id为ajaxtr的行添加事件，点击显示灰色表示被选中
						var selarr = new Array();;//声明空数组						
						$('body').on('click', '#ajaxtr', function(e){
							// alert($(this).html());
							$(this).css('background','gray');//设置已选中的行背景
							sel=($(this).find("a").html());
							$('#msgdelbtn').show();//显示删除按钮

							if(selarr.contains(sel)){
								var unsel;
								unsel=confirm ('要取消选择，请点确认！');
								if(unsel){
									//如果确认返回是，								
									selarr.removeByValue(sel);//则从数组中移除
									$(this).css('background','');//移除行背景
								}
							}else{
								selarr.push(sel);
								// alert(selarr.length);
							};						
						});
//设置删除消息按钮智能浮动的方法
function i_scroll(item){  
 var topH=100;//相对位置随值增加下移 
 var leftW=100; //相对位置随值增加右移 
 var sHeight,sWidth,cHeight; 
 //alert(document.documentElement.clientWidth); 
 (document.body.scrollLeft==0)?sWidth=document.documentElement.scrollLeft + document.documentElement.clientWidth - 360 :sWidth=document.body.scrollLeft+ document.documentElement.clientWidth - 360 ; 
 (document.body.scrollTop==0)?sHeight=document.documentElement.scrollTop+ document.documentElement.clientHeight - 360 :sHeight=document.body.scrollTop+ document.documentElement.clientHeight - 360; 
 document.getElementById(item).style.left=eval(sWidth+leftW) +"px"; 
 document.getElementById(item).style.top=eval(sHeight+topH) +"px"; 
} 
// setInterval("i_scroll('bar_float')",1); 
setInterval("i_scroll('msgdelbtn')",100); 


//**点击按钮删除操作
$('#msgdelbtn').bind("click",function(){
	// alert($("#SorR").html());
	// alert($("#SorRid").html());

	//**********删除操作请求
	var delcon;
		delcon=confirm ('确认要删除已被选中的'+selarr.length+'消息吗？');
		if(delcon){
		// alert(selarr.length);
		// alert('删除执行中');

		$.ajax({
            type: "post",
            url: "./actions/delmsg.php",
            data: "idarr=" + selarr,
            success: function(msg) {
            	 alert(msg );
            	 // alert('消息已删除！' );
            }
        });
 //******end****删除操作请求

		      if($("#SorR").html()=="Receiver"){
		      	// alert('Receiver刷新');

		      	   // //******刷新操作请求
		      	    $.ajax({
		                    type: "post",
		                    url: "./actions/getMsgbyReceiver.php",
		                    data: "id=" + $("#SorRid").html(),
		                    success: function(msg) {
		                        $("#right-top").html(msg);
		                  }
		                });
		          selarr.length=0;//清空选择器
		      	   //  //******刷新操作请求


		      }      
		      if($("#SorR").html()=="Sender"){
		      	// alert('sender刷新');


		      	   // //******刷新操作请求
		      	    $.ajax({
		                    type: "post",
		                    url: "./actions/getMsgbySender.php",
		                    data: "id=" + $("#SorRid").html(),
		                    success: function(msg) {
		                        $("#right-top").html(msg);
		                  }
		                });
		      	    selarr.length=0;//清空选择器
		      	   //  //******刷新操作请求


		      }
      }



})
</script>


	

			</div>

		</div>

	</form>
	</div>
</body>
</html>