<?php
//连接数据库conn;
function conn(){
        $database = 'msgbd';
        $host = 'localhost';
        $user = 'root';
        $pass = '111111';
        $dbh = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);
        return $dbh;
};

//截取字符串，长度超过指定的自动显示为省略
function thumStr($str,$len){
	  $one=0;
	  $partstr='';
	  for($i=0;$i<$len;$i++)
	{ $sstr=substr($str,$one,1);
	 if(ord($sstr)>224){
	 $partstr.=substr($str,$one,3);
	 $one+=3;
	 }elseif(ord($sstr)>192){
	 $partstr.=substr($str,$one,2);
	 $one+=2;
	 }elseif(ord($sstr)<192){
	 $partstr.=substr($str,$one,1);
	 $one+=1;
	 }
	}
	if(strlen($str)<$one){
	   return $partstr;}else{
	return $partstr.'....';
	}
	};

