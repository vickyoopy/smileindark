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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
    <link href="css/photo.css" rel="stylesheet">
</head>

<body style="background-color: black">
<!-- Begin Header -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- large screen display-->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav row">
            <li class="col-sm-2"><a href="../blog/index.php"><img src="../imgs/blog.png"><span class="nav-label">Blog</span></a></li>
            <li class="col-sm-2"><a href="index.php"><img src="../imgs/photo.png"><span class="nav-label">Photos</span></a></li>
            <li class="col-sm-2"><a href="../index.php"><img src="../imgs/home.png" style="bottom: -3em"><span class="nav-label">Home</span></a></li>
            <li class="col-sm-2"><a href="../admin/index.php"><img src="../imgs/admin.png"> <span class="nav-label">Admin</span> </a></li>
            <li class="col-sm-2"><a href="../contact/index.php"><img src="../imgs/contact.png"><span class="nav-label">Contact</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">

<?php
if($isLogin)
	echo 
//upload 
	'<div class="col-sm-3">'.
		'<form id="uploadForm" enctype="multipart/form-data">'.
			'<div class="form-group">'.
				'<label for="exampleInputDesc">Add to Album:</label>'.
				'<input type="text" class="form-control" id="exampleInputAlbum" name="album" placeholder="travel/daily/design">'.
			'</div>'.
            '<div class="form-group">'.
                '<label for="exampleInputDesc">Description:</label>'.
                '<input type="text" class="form-control" id="exampleInputDesc" name="desc" placeholder="描述信息">'.
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
    '<div class="wrapper">'.
    '<h2>Welcome, Yao</h2>'.
    '   <form action="photoadmin.php" method="post">'.
    '       <div><input type="text" name="username" class="username" placeholder="Username" autocomplete="off"/></div>'.
    '       <div><input type="password" name="password" class="password" placeholder="Password" oncontextmenu="return false" onpaste="return false" /></div>'.
    '       <button id="login-button" type="submit">Log in</button>'.
    '   </form> '.
    '</div>';   
?>



</div>
<!-- Footer-->
    <div class="footer-wrapper">
    <div class="container">
        <div class="row">
             <div class="col-sm-12">
            copyright©2014-2025 | Vicky.P.Y | <a href="mailto:vickypy0802@gmail.com?subject=Hello,Vicky"> Email Me</a> 
            </div>
        </div>
    </div>
    </div> 

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
 <script src="../js/bootstrap.min.js"></script>
 <script src="http://malsup.github.com/jquery.form.js"></script>
 <script src="upload.js"></script>
 <script src="../js/modernizr.custom.js"></script>
</body>
</html>