<?php 
 $_SESSION['permited']=1 || exit('You have no right to access this page, please contact administrator!');
    $role=$_SESSION['sess_userrole'];
    echo "您的权限为：".($role);
    echo "&nbsp;&nbsp;&nbsp;<a href='./components/useroperator.php'>管理用户</a>";
    echo "&nbsp;&nbsp;&nbsp;<a href='./components/msgoperator.php'>管理消息</a>";
 
    



?>
