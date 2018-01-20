<?php
// header("Content-type: text/html; charset=utf-8");
//error_reporting(E_ALL & ~E_NOTICE);

class Msghandler{


  function __construct(){
    # code...
    // echo '构造函数中的输出;';
  }

  //插入留言消息
  // @$pdo 数据连接PDO对象
  // @$table 表名
  // @$data数据数组


  public function msgInsert($pdo,$table,$data){
    //插入数据(PDO对象，表名，数据)
    $stmt = $pdo -> prepare("insert into ".$table."(sender, receiver,time, msg, status) values (:sender,:receiver,:time,:msg,:status)");
    $stmt -> execute($data);  
    return($pdo -> lastInsertId());     
  }



  // 根据用户显示消息
  // @$pdo 数据连接PDO对象
  // @$table 表名
  // @$userid 用户收件人ID
  public function msgShow($pdo,$userid){
    #根据用户id获取消息(PDO对象，表名)
      // $stmt = $pdo -> prepare("select * from users inner join msg where users.id=msg.receiver and users.id=".$userid.";");

      $stmt = $pdo -> prepare("SELECT msg.id,msg.sender,users.username,msg.msg,msg.time,msg.status from msg left join users on msg.sender=users.id where msg.receiver=".$userid." ORDER BY time ASC;");
      $stmt -> execute();
      //绑定栏目
      $stmt -> bindColumn("id", $id);
      $stmt -> bindColumn("sender", $sender);
      $stmt -> bindColumn("time", $time);
      $stmt -> bindColumn("msg", $msg);
      $stmt -> bindColumn("status", $status);

      //可以设置结果的模式, 以下的代码使用fetch()或fetchAll()都是使用这个方面设置的数组的格式
      $stmt -> setFetchMode(PDO::FETCH_ASSOC);
      $msglist=$stmt->fetchAll();//获取全部记录集
      return $msglist; 
  }

  // 根据消息id修改对应留言的status字段
  // @$msgid 传入消息id
  public function msgMark($msgid){    
      try {
      $stmt = $pdo -> prepare("update msg set status=0 where id=".$msgid.";"); 
      $res=$stmt -> execute(); 
          }catch(PDOException $e) {
          echo "错误：".$e->getMessage();
          }
            return 1;      
  }


  // 根据消息id删除对应留言
  // @$msgid 传入消息id
  public function msgDel($msgid){    
      try {
      $stmt = $pdo -> prepare("delete from msg where id=".$msgid.";"); 
      $res=$stmt -> execute(); 
          }catch(PDOException $e) {
          echo "错误：".$e->getMessage();
          }
            return 1;      
  }

  




}


?>
