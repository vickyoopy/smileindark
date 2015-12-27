<?php

define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );
	try{
		$dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("set names 'utf8'");
		
		$name=stripslashes(trim($_POST['name']));
		$email=stripslashes(trim($_POST['email']));
		$message=stripslashes(trim($_POST['message']));
		
		$sth = $dbh->prepare("INSERT INTO `comments` (`id`, `time`, `name`,`email`, `message`) VALUES (NULL,CURRENT_TIME(), ? , ?, ?);");
		$result = $sth->execute(array($name,$email,$message));
		
		if($result) echo "瓢酱已收到评论(⊙o⊙)";
		else echo "OMG, sth went wrong";
	} 
	catch (PDOException $e){
		echo "连接服务器失败".$e->getMessage();
	}
?>