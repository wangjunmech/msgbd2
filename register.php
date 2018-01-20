<?php
header("content-type:text/html;charset=UTF-8");
require_once './config/database-config.php';

 session_start();

 $username = "";
 $password = "";
 
 if(isset($_POST['register'])){

  // $username = $_POST['username'];
  // $email = $_POST['email'];
  // $password1 = $_POST['pwd1'];
  // $password2 = $_POST['pwd2'];
  // $tel = $_POST['tel'];
  // $wechat_id = $_POST['wechat_id'];
  // $qq_id = $_POST['qq_id'];
  //将表单输入赋给数组
  $data=array(
    'username' => $_POST['username'], 
    'password' => md5($_POST['pwd1']),//需要加密写入数据库   
    // 'password' => $_POST['pwd1'],//需要加密写入数据库
    'role'=>'',
    'email' => $_POST['email'],     
    'tel' => $_POST['tel'],
    'wechat' => $_POST['wechat_id'],
    'qq' => $_POST['qq_id'],
    'question' => $_POST['question'],
    'answer' => $_POST['answer'],

  );
 }

 // var_dump($data);die();
/***********字段验证***********
待处理……
唯一性验证

/***********字段验证***********
 
/**用户处理类：

*/
require_once 'userhandler.class.php';

try {
    $Userhandler= new Userhandler();
    $lastid=$Userhandler->dtInsert($dbh,'users',$data);
    // echo $lastid;exit();
    
    
} catch (Exception $e) {
    print $e->getMessage();  
    exit();
}
header('Location: index.php?reg=1');





