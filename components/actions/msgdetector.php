<?php
header('content-type:text/html;charset=utf-8');
($_SERVER['HTTP_REFERER']) || exit('You have no right to access this page, please contact administrator!');

    // $username = $_POST['username'];
    if(!empty($_POST['maxMsgid'])){
      $maxMsgid = $_POST['maxMsgid'];//页面最大消息ID
      $userid = $_POST['userid'];

        };

// //连接数据库conn;
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
    if (!empty($maxMsgid)) {
        $sql = 'select * from msg where receiver='.$userid.' and id >'.$maxMsgid;
      
       $sql='SELECT msg.id,msg.sender,msg.receiver,users.username,msg.msg,msg.time,msg.status from msg left join users on msg.sender=users.id where msg.id>'.$maxMsgid.' and msg.receiver='.$userid;


        // $sql = 'select * from msg where receiver=8';;
        $stmt = $dbh->query($sql); 
        //echo "结果行数=".($stmt->rowCount());
        // var_dump($stmt->rowCount());
        $num=$stmt->rowCount(); 
        $res=$stmt->fetchAll(PDO::FETCH_ASSOC);

    } ;


        if($num>0){
            //如果有记录，循环输出
                for($i=0;$i<$num;$i++){
                    $t=date("Y-m-d H:i:s",$res[$i]['time']);
                    $num=$i+1;

                 echo'<table name="msgtable"  id='.$res[$i]['id'].' stat='.$res[$i]['status'].'>    
                 <tr>
                 <td rowspan=2>'.$num.'</td>
                 <td>发件人：</td>
                 <td>'.$res[$i]['username'].'</td>
                 <td>收件人：</td>
                 <td>'.$res[$i]['receiver'].'</td>
                 <td>发送时间：</td>
                 <td>'.$t.'</td>
                 <td id="operation" rowspan="2">
                 <p><a href="#" name="reply" id="'.$res[$i]['sender'].'" username='.$res[$i]['username'].'>回复</a></p>
                 ';

                 if($res[$i]['status']!=0){//如果状态为已读不用输出标记
                 echo '<p><a href="#" name="readmark" id="'.$res[$i]['id'].'">标记已读</a> </p>';};

                echo '
                 <p><a href="#" name="del" id="'.$res[$i]['id'].'">删除</a></p>
                 </td>
                 </tr>               
                 <tr>
                 <td id="operation">消息内容：</td>
                 <td colspan="5">'.$res[$i]['msg'].'</td>
                 </tr>               
                 </table>';     
                 }        

                 // print_r($res);
        } 



    

  



?>






