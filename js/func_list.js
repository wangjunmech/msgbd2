//**打印javascript对象 
    function writeObj(obj){ 
     var description = ""; 
     for(var i in obj){ 
     var property=obj[i]; 
     description+=i+" = "+property+"\n"; 
     } 
     alert(description); 
    } 

//**根据验证用户名格式的结果显示返回相应提示
    function checkUsername() {
    var username = document.getElementById("username").value;


    if( username == "" || username == null ){
      // 如果未填写用户名：alert( "请先填写用户名！" );
      changeUsernamePrompt( "<font color=red style='font-size:16px;'><b>请填写用户名！</b></font>" );
      return false;
    }


    switch( isUsername( username ) ){
      case 0: {
        changeUsernamePrompt( "" );
        break;}
      case 1: {
       changeUsernamePrompt( "<font color=red style='font-size:16px;'><b>您选择的用户名‘"+username+"’格式不正确，用户名不能以数字开头</b></font>" );
       return false;
      }
      case 2: {
       changeUsernamePrompt( "<font color=red style='font-size:16px;'><b>您选择的用户名‘"+username+"’字符长度有误，合法长度为6-20个字符</b></font>" );
       return false;
      }
      case 3: {
       changeUsernamePrompt( "<font color=red style='font-size:16px;'><b>您选择的用户名‘"+username+"’含有非法字符，用户名只能包含_,英文字母，数字</b></font>" );
       return false;
      }
      case 4: {
       changeUsernamePrompt( "<font color=red style='font-size:16px;'><b>您选择的用户名‘"+username+"’格式不正确，用户名只能包含_,英文字母，数字</b></font>" );
       return false;
      }
    }
    return true;
    }

//**输出提示到id="failinfo"的容器
    function changeUsernamePrompt(cnt){
        document.getElementById( "failinfo" ).innerHTML = cnt;
        // document.getElementById( "failinfo" ).style.display = "";
    }

//**根据id名选择    
  // function chooseThis(name) {
  //   document.getElementById( "username" ).value = name;
  // }

//**验证用户名格式是否正确
function isUsername( username ){
if( /^\d.*$/.test( username ) ){
  return 1;
}
if(! /^.{6,20}$/.test( username ) ){
  return 2;
}
if(! /^[\w_]*$/.test( username ) ){
  return 3;
}
if(! /^([a-z]|[A-Z])[\w_]{5,19}$/.test( username ) ){
  return 4;
}
return 0;
}

//**验证邮箱格式是否正确
function checkemail(email){
  // alert('开始验证！');
        var reg_mail=/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
              if(reg_mail.test(email) ){
                return 1;
              }else{
                return 0;
              }
}

//**验证两次密码输入是否一致
//参数说明
// @pwd1 密码1
// @pwd2 密码2
function checkpwd(pwd1,pwd2){
              if(pwd1==pwd2){
                return 1;
              }else{
                return 0;
              }
}


//** 复先框单选功能 
// @obj数组对象，选择一个复先框集合
// @cname属性名，根据cname选择
function checkedThis(obj,cname){ 
       var boxArray = document.getElementsByName(cname); 
       for(var i=0;i<=boxArray.length-1;i++){ 
            if(boxArray[i]==obj && obj.checked){ 
               boxArray[i].checked = true; 
            }else{ 
               boxArray[i].checked = false; 
            } 
       } 
    } 

//**省略字符，将长字符修剪后返回
///**参数说明：
 // 根据长度截取先使用字符串，超长部分追加…
 // str 对象字符串
 // len 目标字节长度
 // tip 省略号后的提示文本
 // 返回值： 处理结果字符串
 
function elideString(str, len, tip) {
  //length属性读出来的汉字长度为1
  if(str.length*2 <= len) {
    return str;
  }
  var strlen = 0;
  var s = "";
  for(var i = 0;i < str.length; i++) {
    s = s + str.charAt(i);
    if (str.charCodeAt(i) > 128) {
      strlen = strlen + 2;
      if(strlen >= len){
        return s.substring(0,s.length-1) + "......<a href='#' id='elid'>"+tip+"</a>";
      }
    } else {
      strlen = strlen + 1;
      if(strlen >= len){
        return s.substring(0,s.length-2) +  "......<a href='#' id='elid'>"+tip+"</a>";
      }
    }
  }
  return s;
}

//**设置标签Hover颜色
// @item Dom元素
// @color1 移动颜色
// @color2 移出后的颜色
// 
function hoverColorSet(item,color1,color2){
  item.hover(function(){
      $(this).css("background-color",color1);
  },function(){
      $(this).css("background-color",color2);
  });
}


//**alert打印对象
    function writeObj(obj){ 
       var description = ""; 
       for(var i in obj){ 
       var property=obj[i]; 
       description+=i+" = "+property+"\n"; 
       } 
       alert(description); 
      } 


