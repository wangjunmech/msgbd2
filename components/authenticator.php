<?php
header('content-type:text/html;charset=utf-8');

    // $username = $_POST['username'];
    if(!empty($_POST['username'])){
      $username = $_POST['username'];
        }
    if(!empty($_POST['email'])){
      $email = $_POST['email'];
        }

    // $username = 'aaaaaa';


//如果有用户名参数，检查验证用户名是否存在
    if (!empty($username)) {
            require_once './../config/database-config.php';
       $sql = 'SELECT * FROM users WHERE username=:username';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':username'=>$username));
         while($row=$stmt->fetch(PDO::FETCH_OBJ)) {
                $temp= $row->username;
                // echo $row->password;
                // var_dump($row);
            }

            if (empty($temp)) {
            echo "<font color=green style='font-size:16px;'><b>恭喜恭喜,用户名".$username."可以注册!</b></font>";
            } else {
            echo "<font color=red style='font-size:16px;'><b>用户名".$username."已存在,请换一个试试!</b></font>";
            }
    } else {
    echo "<font color=red style='font-size:16px;'><b>请输入......!</b></font>";
    }  

// //如果有邮箱参数，检查验证用户名是否存在
//     if (!empty($email)) {
//        $dbh= conn();
//        $sql = 'SELECT * FROM users WHERE email=:email';
//         $stmt = $dbh->prepare($sql);
//         $stmt->execute(array(':email'=>$email));
//          while($row=$stmt->fetch(PDO::FETCH_OBJ)) {
//                 $temp= $row->email;
//                 // echo $row->password;
//                 // var_dump($row);
//             }

//             if (empty($temp)) {
//             echo "<font color=green style='font-size:16px;'><b>邮箱".$email."可以注册!</b></font>";
//             } else {
//             echo "<font color=red style='font-size:16px;'><b>邮箱".$email."已被注册，用此邮箱登录？？</b></font>";
//             }
//     } else {
//     echo "<font color=red style='font-size:16px;'><b>请输入您要注册邮箱.</b></font>";
//     }             
                    

?>