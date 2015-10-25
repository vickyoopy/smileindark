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
	
	//上传文件到服务器
	if $_FILES["file"]["size"] < 10240)
	{
		  if ($_FILES["file"]["error"] > 0)
		  {
		    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		  }
		  else
		    {
		    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		    echo "Type: " . $_FILES["file"]["type"] . "<br />";
		    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
			    if (file_exists("photography/imgs/" . $_FILES["file"]["name"]))
			      {
			      echo $_FILES["file"]["name"] . " already exists. ";
			      }
			    else
			      {
			      move_uploaded_file($_FILES["file"]["tmp_name"],
			      "photography/imgs/" . $_FILES["file"]["name"]);
			      echo "Stored in: " . "photography/imgs/" . $_FILES["file"]["name"];
			      }
	    	}
	}
	else
	{echo "Invalid file";}

	//保存文件信息到数据库
		$title=stripslashes(trim($_FILES["file"]["name"]));
		$description=stripslashes(trim($_FILES["file"]["name"]));
		$filepath=stripslashes(trim($_FILES["file"]["name"]));
		$sth = $dbh->prepare("INSERT INTO `photos` (`id`, `title`, `description`, `filepath`) VALUES (NULL, ?, ?, ?);");
		$result = $sth->execute(array($title,$description,$filepath));
		if($result) echo "保存成功";
		else echo "保存失败";
}


catch (PDOException $e){
		echo "连接服务器失败".$e->getMessage();
	}
}else{
	echo "登录状态异常,保存失败";
}
?>









