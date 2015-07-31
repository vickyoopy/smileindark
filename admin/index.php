<?php

define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );

$isLogin = false;

if(empty($_COOKIE['username']) || empty($_COOKIE['password'])){  
	// 没登录
}else{  
	// 有cookie信息，进行验证
	$isLogin = check(0);
}

if(isset($_POST['username'])&&isset($_POST['password'])){
	$isLogin = check(1);
}

function check($mode){
	try{
		$dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("set names 'utf8'");

		if($mode==0){ // cookie验证
			$username = $_COOKIE['username'];
			$token = $_COOKIE['token'];
			$sth = $dbh->prepare('SELECT id, username, token FROM userinfo WHERE username=? AND token=?');
			$sth->execute(array($username,$token));
			$result = $sth->fetchAll();
			$length = count($result);
			if($length>0) return true;
		} 
		if($mode==1){ // 表单验证
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sth = $dbh->prepare('SELECT id, username FROM userinfo WHERE username=? AND password=?');
			$sth->execute(array($username, $password));
			$result = $sth->fetchAll();
			$length = count($result);
			if($length>0){
				$token = md5("a_random_salt".$username); // 生成token
				$sth = $dbh->prepare('UPDATE userinfo SET token = ? WHERE username=?');
				if($sth->execute(array($token, $username))){
					setcookie('username',$username,time() + 604800,"/");
					setcookie('token',$token,time() + 604800,"/");
				}
				return true;
			}
		}
	} catch (PDOException $e){
		// 发生了连接错误
	}
	return false;
}
  
?>
<!DOCTYPE html>
<html lang="ch">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<title>Log in</title>
	<link rel="shortcut icon" href="../favicon.ico"> 
	<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/media-queries.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,700,700italic|Open+Sans+Condensed:300,700' rel="stylesheet" type='text/css'>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>  
	<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
	<script type="text/javascript">
		$.backstretch("../imgs/1.jpg");
	</script>
</head>

<body>
<!-- Header -->
<div class="header-wrapper opacity">
	<div class="header">
		<div class="logo"><a href="index.html"><img src="../imgs/logo.png" alt="" /></a></div>
		<div id="menu-wrapper">
			<div id="menu" class="menu">
				<ul id="tiny">
					<li><a href="../index.html">Home</a></li>
					<li><a href="../blog/">Blog</a></li>
					<li><a href="../photography/">Photos</a></li>
					<li><a href="../about/">About Me</a></li>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- Login -->
<?php
if(!$isLogin)
	echo 
	'<div class="wrapper">'.
	'	<form action="index.php" method="post">'.
	'		<div><input type="text" name="username" class="username" placeholder="Username" autocomplete="off"/></div>'.
	'		<div><input type="password" name="password" class="password" placeholder="Password" oncontextmenu="return false" onpaste="return false" /></div>'.
	'		<button id="submit" type="submit">Sign in</button>'.
	'	</form> '.
	'</div>  '.
	'<div class="alert" style="text-align: center">'.
	'	<h2>Alert</h2>'.
	'	<div class="alert_con">'.
	'		<p id="ts"></p>'.
	'		<p style="line-height:70px"><a class="btn">OK</a></p>'.
	'	</div>'.
	'</div>';
?>
<!-- Admin -->
<?php
if($isLogin)
	echo '<p>Assume this is an editor.</p>';
?>
<!-- Footer -->
<div class="footer-wrapper">
	copyright©2015 | <a href="mailto:yaopeng0802@gmail.com?subject=Hello,瓢瓢"> Contact Me</a>
</div>
<script src="http://apps.bdimg.com/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
<script src="js/supersized.3.2.7.min.js"></script>
<script src="js/supersized-init.js"></script>

</body>
</html> 