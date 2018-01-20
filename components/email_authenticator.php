<?php
header('content-type:text/html;charset=utf-8');
// 如果有邮箱传过来;
    if(!empty($_POST['email'])){
      $email = $_POST['email'];
        }



//如果有邮箱参数，检查验证用户名是否存在
    if (!empty($email)) {
            require_once './../config/database-config.php';
       $sql = 'SELECT * FROM users WHERE email=:email';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':email'=>$email));
         while($row=$stmt->fetch(PDO::FETCH_OBJ)) {
                $temp= $row->email;
                // echo $row->password;
                // var_dump($row);
            }

            if (empty($temp)) {
            echo "<font color=green style='font-size:16px;'><b>邮箱".$email."可以注册!</b></font>";
            } else {
            echo "<font color=red style='font-size:16px;'><b>邮箱".$email."已被注册，用此邮箱登录？？</b></font>";
            }
    } else {
    echo "<font color=red style='font-size:16px;'><b>请输入您要注册的邮箱.</b></font>";
    }             
                    

?>