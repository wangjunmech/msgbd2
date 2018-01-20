<?php defined('SITEDIR') || exit('No right to access!');?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles/styles.css" rel="stylesheet" type="text/css" /> 

		<style>
		</style>



</head>
<title>品冠留言板</title>
<body style="overflow-y:hidden">
		<script src="./js/jquery.js"></script>
		<script src="./js/func_list.js"></script>
	<div id='main'>	
			<form id='msgform' name='msgform' method="post" action="msgmanager.php">	
			<div id="left">
			<div><p>请选择收件人：</p></div>
			<?php
			require_once './config/database-config.php';
			require_once './userhandler.class.php';
			$res= new userhandler();
			$data=$res->showusers($dbh);

			// //从数据库获取用户数据
			// // 打印出来看看：
			// echo '<pre>';
			// print_r($data);
			// echo '<pre>';

			for($i=0;$i<count($data);$i++){
				// echo $data[$i]['id'].'===='.$data[$i]['username'].'<br>';
			echo '<input type="checkbox" id="'.$data[$i]['id'].'" name="names" user="'.$data[$i]['username'].'"onclick="checkedThis(this,'."'names'".')"><label for="'.$data[$i]['id'].'">'.$data[$i]['username'].'</label><br>';

			};


				?>	
			</div>

	<div id="mainright">
		<div id="right-top">
			<p><font color='#0000FF' size=4><b>亲爱的：</b></font><font color='green' size=5><strong><?=$_SESSION['sess_username'];?></strong></font>
				<script language="JavaScript">
				//--根据时间问候
				var consoling="";
				document.write("<font color='#0000FF' size=4><b>")
				day = new Date( )
				hr = day.getHours( )
				if (( hr >= 0 ) && (hr <= 4 ))
				consoling="已经夜深了，请注意休息哦！"
				if (( hr >= 4 ) && (hr < 7))
				consoling="早上好，这么早就起来了？ "
				if (( hr >= 7 ) && (hr < 12))
				consoling="上午好，祝您保持心情愉快！"
				if (( hr >= 12) && (hr <= 13))
				consoling="现在是午饭时间，你做什么好吃的了吗？"
				if (( hr >= 13) && (hr <= 17))
				consoling="下午好，该休息一会儿了，希望您能够劳逸结合！ "
				if (( hr >= 17) && (hr <= 18))
				consoling="今晚时分，天空好美！"
				if ((hr >= 18) && (hr <= 19))
				consoling="晚上好！"
				if ((hr >= 19) && (hr <= 23))
				consoling="一天又快过去了，你今天收获很多吧？"
				document.write(consoling)
				document.write("</b></font></center>")


			   //*************验证注册用户名				
				</script>
				<span>&nbsp;</span>
				<?php 		include 'roles/role_'.$_SESSION['sess_userrole'].'.php';?>
				<span>&nbsp;</span>
				<?php echo '<a href="logout.php">退出</a>';?>


				</p>
				<p id=>显示留言:<span id="A"></span></p>			 


			 	 <div id="right-middle"><!-- 显示留言 -->	
			 	 <?php


			 	 $str='<font color=red>展示内容，缩略，点击隐藏。</font>天又快过去了，你今天收获很多吧天又快过去了，你今天收获很多吧天又快过去了，你今天收获很多吧天又快过去了，你今天收获很多吧天又快过去了，你今天收获很多吧天又快过去了，你今天收获很多要牢牢把握全面贯彻落实党的十九大精神这条主线，紧紧围绕新时代党的建设总要求，以党的政治建设为统领，思想建党、纪律强党、制度治党同向发力，增强全面从严治党的系统性、创造性、实效性。要严明政治纪律和政治规矩，聚焦“七个有之”，严肃查处对党不忠诚不老实、阳奉阴违的“两面人”和违背党的政治路线、破坏党内政治生态问题，确保党中央政令畅通。要徙木立信、以上率下，锲而不舍落实中央八项规定精神，一个节点一个节点坚守，一个问题一个问题解决，抓具体、补短板、防反弹，重点纠正形式主义吧';
			 	 $str2='msglist[$i][usernamemsglist[$i][usernamemsglist[$i][usernamemsglist[$i][usernamemsglist[$i][usernamemsglist[$i][usernamemsglist[$i][usernamemsglist[$i][usernamemsglist[$i][usernamemsglist[$i][usernamemsglist[$i][username';

			 	 ?>

			 	 <table name="msgtable" id=1>	
			 	 <tr>
			 	 <td rowspan=2>序号示例</td>
				 	 <td>发件人：</td>
				 	 <td>'发件人'</td>
				 	 <td>收件人：</td>
				 	 <td>'收件人'</td>
				 	 <td>发送时间：</td>
				 	 <td>'发送时间'</td>
				 	 <td id="" rowspan="2"><p><a href="#" name="reply" id="'.$msglist[$i]['sender'].'" username='.$msglist[$i]['username'].'>回复</a></p>
				 	 <p id=""><a href="#" name="readmark" id="'.$msglist[$i]['sender'].'" username='.$msglist[$i]['username'].'>已读</p>
				 	 <p><a href="#" name="del">删除</p>
				 	 </td>
			 	 </tr>			 	 
			 	 <tr>
			 	 <td id="operation">消息内容：</td>
			 	 <td id='msgcontent' colspan="5">
			 	 <!-- 测试输出字符 -->
			 	 <span id='shorttxt'>

			 	 </span>
			 	 <span id='fulltxt'>

			 	 </span>

			 	 <script type="text/javascript">


//把长消息缩略显示
			 	 	var str='<?php echo $str; ?>';
			 	 	var elidestr=elideString(str,100,'显示更多');
			 	 	$('#shorttxt').html(elidestr);
			 	 	$('#msgcontent').on("click",function(){			 	 		
			 	 		if($('#shorttxt').is(':hidden')){//如果当前隐藏  
			 	 				$('#shorttxt').show();
						        $('#fulltxt').hide(); 
						       		 }else{  
						        $('#shorttxt').hide();
						        $('#fulltxt').html(str);
						        $('#fulltxt').show(); 
						        }  	 				

			 	 	});





			 	 </script>
			 	 



			 	 </td>
			 	 </tr> 
			 	 </table>
			 	 
		


			 	 <?php 
			 	 include './msghandler.class.php';
			 	 $msg=new msghandler();
			 	 // $msglist=$msg->showmsg($dbh);
			 	 // echo '<pre>';
			 	 // var_dump($msglist);
			 	 // echo '</pre>';

			 	 $msglist=$msg->msgShow($dbh,$_SESSION["sess_user_id"]);
			 	 echo '<pre>';
			 	 // var_dump($_SESSION["sess_user_id"]);
			 	 // var_dump($_SESSION);
			 	 // var_dump($msglist);
			 	 echo '</pre>';

			 	 $msgqty= (count($msglist));


			 	 // 循环输出留言消息表格
			 	 for($i=0;$i<$msgqty;$i++){
			 	 	$t=date("Y-m-d H:i:s",$msglist[$i]['time']);
			 	 	$num=$i+1;

			 	 echo'<table name="msgtable"  id='.$msglist[$i]['id'].' stat='.$msglist[$i]['status'].'>	
			 	 <tr>
			 	 <td rowspan=2>'.$num.'</td>
			 	 <td>发件人：</td>
			 	 <td>'.$msglist[$i]['username'].'</td>
			 	 <td>收件人：</td>
			 	 <td>'.$_SESSION["sess_username"].'</td>
			 	 <td>发送时间：</td>
			 	 <td>'.$t.'</td>
			 	 <td id="operation" rowspan="2">
			 	 <p><a href="#" name="reply" id="'.$msglist[$i]['sender'].'" username='.$msglist[$i]['username'].'>回复</a></p>
			 	 ';

			 	 if($msglist[$i]['status']!=0){//如果状态为已读不用输出标记
			 	 echo '<p><a href="#" name="readmark" id="'.$msglist[$i]['id'].'">标记已读</a> </p>';};

			 	echo '
			 	 <p><a href="#" name="del" id="'.$msglist[$i]['id'].'">删除</a></p>
			 	 </td>
			 	 </tr>			 	 
			 	 <tr>
			 	 <td id="operation">消息内容：</td>
			 	 <td colspan="5">'.$msglist[$i]['msg'].'</td>
			 	 </tr> 			 	 
			 	 </table>';		
			 	 }
			 	 ?>
			 	 <!-- Ajax获取的新消息，未刷新前写在这里 -->
			 	 <div id="ajaxmsg">
			 	 	
			 	 </div>

			 	 </div>



			 	 <div id='contents'>
			 	 
				 <p><a name="001" id="001" > </a>给<font color='#FFFF00' size=5><b><span id="receiver" name="receiver" style="color: red"></span></b></font><span id='replytip'></span>留言：

				 <span id='num'></span></p>
				  <input type="hidden" id ="receiver_input" name="receiver_input"> 
				  <input type="hidden" id ="receiver_id" name="receiver_id"> 
				  <input type="hidden" id ="detectorid" value="<?php echo $_SESSION["sess_user_id"];?>"> 

				  <div 'right-lower'>	
				 <textarea type="text" id="textinput" name='msg' rows='20' cols='60' placeholder="请在此输入留言！" autofocus></textarea>
				 <input id='msgsubmit' type="submit" name='msgsubmit' value="提交留言" onclick="return check(this.form)"> 
				 </div>

				 	
				 </div>
			 </div>	

			</div>
			</form>
</div>



<script type="text/javascript">
 
 //***********检查留言表单是否有收件人和留言内容
         function check(form) {
         	// alert($('#receiver').val());
       	  if($('#receiver_input').val()==''){
                alert("请在左边选择收件人!或在右边点击回复！");
                return false;
           }
          if(form.msg.value=='') {
                alert("请输入留言内容后再提交!");
                form.msg.focus();
                return false;
           }
         return true;
         }

//***********设置未读消息字体加粗
//**Style中已定义的在这里不能设置，如下面这里设置背景无效font-style:italic;
// $("table[id='339'").css({"background-color":"yellow","fontWeight":"bold"});

// $("table[name=msgtable]").bind("click",function(){
// 	$(this).css({"background-color":"yellow","fontWeight":"bold"});
// })

// $("table[name=msgtable]").bind("click",function(){
// 	alert($(this).attr('stat'));
// 	// $(this).css({"background-color":"yellow","fontWeight":"bold"});
// });

$("table[name=msgtable]").each(function(i){
if($(this).attr('stat')=='1'){
$(this).css({"background-color":"yellow","fontWeight":"bold"});
$(this).css({"border-top" :"11px solid darkgreen"});
}
})





//***********操作链接加Hover
hoverColorSet($("a[name=reply]"),"yellow","#dcddc0");
hoverColorSet($("a[name=readmark]"),"yellow","#dcddc0");
hoverColorSet($("a[name=del]"),"yellow","#dcddc0");
       

//***********回复消息点击
         $('a[name=reply]').bind("click",function(){ 
			var selected_id=$(this).attr('id');
			// alert(selected_id);
		    $("#receiver").html($(this).attr('username'));//给收件人标签赋值
		    $("#receiver_input").val($(this).attr('username'));//给收件人标签赋值
		    $("#receiver_id").val($(this).attr('id'));//收件人的id
		    $("#replytip").text('回复');
		    document.all.textinput.focus();
		});
//***********标记已读消息点击
         $('a[name=readmark]').bind("click",function(){ 
         	con=confirm("你确定要标记此条消息为已读吗？"); //在页面上弹出确认对话框
			if(con==true){
				//确认要操作，使用AJAX操作
		         	var msgid=$(this).attr('id');
                	
							         	
		         	$.ajax({
		                    type: "post",
		                    url: "./components/actions/readmark.php",
		                    data: "id=" + msgid,
		                    success: function(msg) {
		                    	 alert('标记已读消息完成！' );
		                    	 //***取消未读加粗样式
		                    	  $("table[id="+msgid+"]").css({"fontWeight":"normal","border-top" :"11px solid gray"});                   	  
		                    	  $("a[name='readmark'][id="+msgid+"]").hide();
		                    }	
		                });
         	}       	

		});
//***********删除消息点击
         $('a[name=del]').bind("click",function(){ 
         con=confirm("此操作将彻底删除消息不可恢复，确定要删除吗？"); //在页面上弹出确认对话框
			if(con==true){
				//确认要操作，使用AJAX操作
		         	var msgid=$(this).attr('id');
		         	$.ajax({
		                    type: "post",
		                    url: "./components/actions/delmsg.php",
		                    data: "id=" + msgid,
		                    success: function(msg) {
		                    	 alert('消息已删除！' );
		                    }
		                });
         	}       	

		});

 

     //文本框事件//字符数统计并显示还能输入的字符数
     $('#textinput').keyup(function(){
     		// alert('检查文本');
     		var maxTxt=500;
     		var content = $(this).val();  
     		// 将换行符不计算为单词数  
            var value = content.replace(/\n|\r/gi,"");  
            var leftnum=maxTxt-value.length;
            if(value.length>0){
            $('#num').html('<font color=red><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您还可以输入'+leftnum+'个字符！</strong?</font>');
             }

     		if(value.length>maxTxt){
     			alert('输入留言不能超出'+maxTxt+'个字符！');
     		};
     	});


///////////**********实时消息提示***************
	//获取页面中表格的消息id
	var idlist=Array()
	$("table[name=msgtable]").each(function(i){
		idlist.push(parseInt($(this).attr("id")));
	})
	var maxMsgid=(Math.max.apply(null, idlist));
	// alert(maxMsgid);
	var userid=$("#detectorid").val();

	function pagerefresh()
	{
	       window.location.reload();
	};

	function msgdetect(maxMsgid,userid){
		// alert("检查消息");
		// 检查消息
     	$.ajax({
        type: "post",
        url: "./components/actions/msgdetector.php",
        data: "maxMsgid=" + maxMsgid+"&userid=" + userid,
        success: function(msg) {
        	$("#ajaxmsg").html(msg); 
        	// msg=parseInt(msg);       
        		// alert(typeof(msg));      
        		// alert(msg);      
        		// alert(msg.length);
        	if(msg.length>7){
        		//js刷新页面
        		// pagerefresh();
        		window.location.href="index.php";

        	}
			// pagerefresh();	
        	 // alert(msg);
        	 //***取消未读加粗样式
        	                     	  
        }	
    });
		//检查数据库记录总条数
		//如果有新消息提示出来
		//点击提示加载刷新页面

	};
	//定时调用检查消息的方法，5000代表每隔5秒调用一次
    setInterval(function(){msgdetect(maxMsgid,userid);}, 5000);

  ///////////**********实时消息提示end***************  






</script>







</body>
</html>


