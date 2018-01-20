<?php 
 $_SESSION['permited']=1 || exit('You have no right to access this page, please contact administrator!');
    $role=$_SESSION['sess_userrole'];
    print_r($role);
?>
