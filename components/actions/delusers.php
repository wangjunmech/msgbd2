<?php
header('content-type:text/html;charset=utf-8');
($_SERVER['HTTP_REFERER']) || exit('You have no right to access this page, please contact administrator!');

    // $username = $_POST['username'];

    if(!empty($_POST['idarr'])){
      $userdarr = $_POST['idarr'];
      $idarr=explode(',',$userdarr);//将js传过来的字串拆为数组
      // var_dump($idarr);
        }



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



//如果有多条ID，执行操作修改user表中对应id的
    if (!empty($idarr)) {
       for($i=0;$i<count($idarr);$i++)
          {
            $arr[$i] = intval($idarr[$i]);
          }
       $num=count($arr);

       // var_dump($arr);
       $arrstr=implode("','",$arr); 
       // var_dump($arrstr);            
       $sql = "delete from msg where id in('{$arrstr}')";       
       $stmt = $dbh->prepare($sql);
       // $stmt->execute();        
       $res=$stmt->rowCount();
       echo '选择了'.$num.'条用户,删除了'.$res.'条记录！'  ; 
    } 



