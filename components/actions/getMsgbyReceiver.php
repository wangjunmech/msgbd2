<?php
header('content-type:text/html;charset=utf-8');
($_SERVER['HTTP_REFERER']) || exit('You have no right to access this page, please contact administrator!');

    // $username = $_POST['username'];
    if(!empty($_POST['id'])){
      $receiverid = $_POST['id'];
        };


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
    if (!empty($receiverid)) {
       $sql = 'select * from msg where receiver='.$receiverid;
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id'=>$receiverid)); 
    };
    
//**************样式设置
echo "
<style>
/* Border styles */
#table-1 thead, #table-1 tr {
border-top-width: 1px;
border-top-style: solid;
border-top-color: rgb(230, 189, 189);
}
#table-1 {
border-bottom-width: 1px;
border-bottom-style: solid;
border-bottom-color: rgb(230, 189, 189);
}

/* Padding and font style */
#table-1 td, #table-1 th {
padding: 5px 10px;
font-size: 12px;
font-family: Verdana;
color: rgb(177, 106, 104);
}

/* Alternating background colors */
#table-1 tr:nth-child(even) {
background: rgb(238, 211, 210)
}
#table-1 tr:nth-child(odd) {
background: #FFF
}
#table-1,th,td
{
border:1px solid blue;
}

</style>
";
    echo 'Sender返回：';

    if(!($stmt->rowCount()>0)){
          echo '<font color="red">没有消息记录！</font>';
          die();
    }
        echo "<pre>";


    // var_dump($res);
        echo "</pre>";
//输出表格
    echo "<div>";
    echo "<table id='table-1'>";
        echo "<tr>";
        echo "<td><a id='ajaxtd' href='#'>消息编号</a></td>";
        echo "<td>发件人</td>";
        echo "<td>收件人</td>";
        echo "<td>发送时间</td>";
        echo "<td>消息内容</td>";
        echo "<td>状态</td>";
        echo "</tr>";
    while (list($id,$sender,$receiver,$time,$msg,$status)=$stmt->fetch()) {
        echo "<tr id='ajaxtr'>";
        echo "<td><a id='ajaxtd' href='#'>".$id."</a></td>";
        echo "<td>".$sender."</td>";
        echo "<td>".$receiver."</td>";
        echo "<td>".$time."</td>";
        echo "<td>".$msg."</td>";
        echo "<td>".$status."</td>";
        echo "</tr>";
         }
    echo "</table>";
    echo "</div>";



    ?>

