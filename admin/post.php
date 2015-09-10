<?php

define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );

$isLogin = false;

if(empty($_COOKIE['username']) || empty($_COOKIE['token'])){  
	// 没有登录
}else{  
	// 有cookie信息，进行验证
	try{
		$dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("set names 'utf8'");

		$username = $_COOKIE['username'];
		$token = $_COOKIE['token'];
		$sth = $dbh->prepare('SELECT id, username, token FROM userinfo WHERE username=? AND token=?');
		$sth->execute(array($username,$token));
		$result = $sth->fetchAll();
		$length = count($result);
		if($length>0) $isLogin = true;
	} catch (PDOException $e){
		echo "连接服务器失败".$e->getMessage();
	}
}
if($isLogin){
	try{
		$dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("set names 'utf8'");
		
		$title=stripslashes(trim($_POST['title']));
		$catagory=stripslashes(trim($_POST['catagory']));
		$content=stripslashes(trim($_POST['content']));
		$posturl=stripslashes(trim($_POST['posturl']));
		
		$sth = $dbh->prepare("INSERT INTO `posts` (`id`, `title`, `time`, `catagory`, `content`, `posturl`) VALUES (NULL, ?, CURRENT_DATE(), ?, ?, ?);");
		$result = $sth->execute(array($title,$catagory,$content,$posturl));
		if($result) echo "保存成功";
		else echo "保存失败";
	} catch (PDOException $e){
		echo "连接服务器失败".$e->getMessage();
	}
}else{
	echo "登录状态异常,保存失败";
}
?>