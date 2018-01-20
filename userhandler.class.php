<?php
header("Content-type: text/html; charset=utf-8");
//error_reporting(E_ALL & ~E_NOTICE);

class Userhandler{


  function __construct(){
    # code...
    // echo '构造函数中的输出;';
  }

  //插入用户
  // @$pdo 数据连接PDO对象
  // @$table 表名
  // @$data数据数据
  public function dtInsert($pdo,$table,$data){
    #插入数据(PDO对象，表名，数据)
    $sql="INSERT into ".$table."(username, password,role, email, tel, wechat,qq,question,answer) values (:username,:password,:role,:email,:tel,:wechat,:qq,:question,:answer)";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute ($data);  
    return($pdo -> lastInsertId());     
  }

  //显示用户
  // @$pdo 数据连接PDO对象
  // @从用户表中获取id和name字段
  public function showusers($pdo){
    #获取用户(PDO对象，表名)
			$stmt = $pdo -> prepare("SELECT id, username  from users order by id asc");
			//$stmt = $dbh -> prepare("select id, username from users order by id desc");
			$stmt -> execute();
			//把结果绑定到变量
			$stmt -> bindColumn("id", $id);
			$stmt -> bindColumn("username", $username);

			//可以设置结果的模式, 以下的代码使用fetch()或fetchAll()都是使用这个方面设置的数组的格式
			$stmt -> setFetchMode(PDO::FETCH_ASSOC);
			// $userlist=$stmt ->fetchAll(PDO::FETCH_NUM);
			$userlist=$stmt->fetchAll();//获取全部记录集
			return $userlist;			
		
  }
  //更新写入用户信息
  // @$pdo 数据连接PDO对象
  // @$data 关联数组
  public function updateuser($pdo,$table,$data){
			$stmt = $pdo -> prepare("UPDATE ".$table." set username=:username,email=:email,password=:password,tel=:tel,wechat=:wechat,qq=:qq,autho=:autho WHERE id=:id");
			$res=$stmt -> execute($data);
			return $res;			
		
  }

}


?>
