<?php
   // define database related variables
   $database = 'msgbd';
   $host = 'localhost';
   $user = 'root';
   $pass = '111111';

   // try to conncet to database
   $dbh = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);

   if(!$dbh){
      $pdo_status=0;
   }else{
	   $pdo_status=1;
	   }
   
?>