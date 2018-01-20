<?php
header("content-type:text/html;charset=UTF-8");
// echo '<script src="/js/jquery.js"></script>';
require_once './config/database-config.php';
require_once 'msghandler.class.php';
 session_start();
 
 if(isset($_POST['msgsubmit'])){
  // print_r($_SESSION);
  //将表单输入赋给数组
  if(!$_SESSION['sess_user_id']){
    echo '<script>alert("您已退出请重新登录！");<script>';
    header('Location: index.php');
  }
  $data=array(
  'sender'=>$_SESSION['sess_user_id'],
  'receiver'=>$_POST['receiver_id'],
  'time'=>time(),
  'msg'=>$_POST['msg'],
  'status'=>1,
  );
// var_dump($data);
// die();
try {
    $msghandler= new Msghandler();
    $lastid=$msghandler->msgInsert($dbh,'msg',$data);
    if($lastid){
      // echo '<script>alert("留言成功！！！");</script>';
      header('Location: index.php?wmsg=1');
    };
} catch (Exception $e) {
    echo '<script>alert("留言失败！！！");</script>';
    print_r($e->getMessage()) ;  
    exit();
}
 }