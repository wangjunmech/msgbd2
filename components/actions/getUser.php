<?php
header('content-type:text/html;charset=utf-8');
($_SERVER['HTTP_REFERER']) || exit('You have no right to access this page, please contact administrator!');

    // $username = $_POST['username'];
    if(!empty($_POST['id'])){
      $userid = $_POST['id'];
        }
        // var_dump($userid );


//连接数据库conn;
// function conn(){
//         $database = 'msgbd';
//         $host = 'localhost';
//         $user = 'root';
//         $pass = '111111';
//         $dbh = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);
//         return $dbh;
// };

include "./../../config/database-config.php";

//如果有消息ID，执行操作修改MSG表中对应id的status字段值为0
    if (!empty($userid)) {
        // $sql = 'select * from user where id=?';
        $sql = 'select * from users where id='.$userid;
        $stmt = $dbh->query($sql);
        
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($res);       
        $json=(json_encode($res)); 
        echo $json;      
   

    } 

    

  



?>






