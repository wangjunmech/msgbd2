<?php 

require_once './config/database-config.php';

 session_start();

 $username = "";
 $password = "";
 
 if(isset($_POST['username'])){
  $username = $_POST['username'];
 }
 if (isset($_POST['password'])) {
  $password = $_POST['password'];
  $password =md5($password );//登录密码加密
// 
 }
 

 $q = 'SELECT * FROM users WHERE username=:username AND password=:password';

 $query = $dbh->prepare($q);

 $query->execute(array(':username' => $username, ':password' => $password));


 if($query->rowCount() == 0){
    // header('Location: roles/role_'.$_SESSION['sess_userrole'].'.php');

  header('Location: index.php?err=1');
 }else{

  $row = $query->fetch(PDO::FETCH_ASSOC);

  setcookie('login','1',time()+3600*2);//设置客户端2小时过期的cookie
  session_regenerate_id();
  $_SESSION['sess_user_id'] = $row['id'];
  $_SESSION['sess_username'] = $row['username'];
  $_SESSION['sess_userrole'] = $row['role'];
  $_SESSION['permited']=1;

        // echo $_SESSION['sess_userrole'];

  session_write_close();
  // var_dump($_SESSION);


header('Location: index.php');


  
  
 }


