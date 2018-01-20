<div id='#header'>
<p>
<font color='#0000FF' size=4><b>亲爱的：</b></font><font color='green' size=5><strong><?=$_SESSION['sess_username'];?></strong></font>
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
<?php 		include './../roles/role_'.$_SESSION['sess_userrole'].'.php';?>
<span>&nbsp;</span>
<?php echo '<a href="logout.php">退出</a>';?>
</p>
</div>