<?php

define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );

$isLogin = false;

if(empty($_COOKIE['username']) || empty($_COOKIE['token'])){  
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
		echo $e->getMessage();
	}
	return false;
}  
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Photo</title>
    <link rel="shortcut icon" href="../favicon.ico"> 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/simditor.css" />
    <link rel="stylesheet" href="css/index.css" type="text/css">
</head>

<body style="background-color: black">
<!-- Begin Header -->
<div class="header">
    <div class="logoimg"><img src="../imgs/logo.png"></div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
        <ul class="navbar-nav">
                <li><a href="../index.php">Home</a></li>
                <li ><a href="../blog/">Blog</a></li>  
                <li><a href="index.php">Photos</a></li>   
                <li><a href="../about/">About</a>         
        </ul>  
        </div>
    </div>
</div>
</div>

<div class="container">

<?php
if($isLogin)
	echo 
//upload 
	'<div class="col-sm-3">'.
		'<form id="uploadForm" enctype="multipart/form-data">'.
			'<div class="form-group">'.
				'<label for="exampleInputDesc">图片描述</label>'.
				'<input type="text" class="form-control" id="exampleInputDesc" name="desc" placeholder="...">'.
			'</div>'.
			'<div class="form-group">'.
				'<label for="exampleInputFile">上传文件</label>'.
				'<input type="file" id="exampleInputFile" name="upload_file">'.
				'<p class="help-block">允许大小：20M，允许类型：jpg, png, gif</p>'.
			'</div>'.
		'</form>'.
		'<button id="uploadBtn" class="btn btn-primary">点此上传</button>'.
	'</div>'.
//image list 
	'<div class="col-sm-9">'.
		'<label>图片列表</label>'.
		'<div id="imgList" class="row">'.
			
		'</div>'.
	'</div>';
?>
<?php
if(!$isLogin)
	echo 

	'	<form action="photoadmin.php" method="post">'.
	'		<div><input type="text" name="username" class="username" placeholder="Username" autocomplete="off"/></div>'.
	'		<div><input type="password" name="password" class="password" placeholder="Password" oncontextmenu="return false" onpaste="return false" /></div>'.
	'		<button id="submit" type="submit">Sign in</button>'.
	'	</form> ';
?>



</div>
<!-- Footer -->
<div class="footer-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            copyright©2015 | <a href="mailto:yaopeng0802@gmail.com?subject=Hello,瓢瓢"> Contact Me</a> | <a href="photoadmin.php">Upload</a> 
            </div>
        </div>
    </div>
</div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/jquery-1.7.2.min.js"></script> 
<script src="js/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="upload.js"></script>
</body>
</html>