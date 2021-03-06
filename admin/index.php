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
    <title>Admin</title>
    <link rel="shortcut icon" href="../favicon.ico"> 
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/simditor.css" />
    <link rel="stylesheet" href="../css/index.css" type="text/css">
    <link rel="stylesheet" href="css/admin.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
</head>
  
<body>
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
            <li class="col-sm-2"><a href="../photography/index.php"><img src="../imgs/photo.png"><span class="nav-label">Photos</span></a></li>
            <li class="col-sm-2"><a href="../index.php"><img src="../imgs/home.png" style="bottom: -3em"><span class="nav-label">Home</span></a></li>
            <li class="col-sm-2"><a href="index.php"><img src="../imgs/admin.png"> <span class="nav-label">Admin</span> </a></li>
            <li class="col-sm-2"><a href="../contact/index.php"><img src="../imgs/contact.png"><span class="nav-label">Contact</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- Login -->
<?php
if(!$isLogin)
	echo 
	'<div id="wrapper">'.
 	'<div id="login" class="animate form">'.
                            '<form  action="#" autocomplete="on"> '.
                                '<h1>Welcome, Yao</h1> '.
                                '<p> '.
                                    '<label for="username" class="uname" data-icon="u" > Your username </label>'.
                                    '<input id="username" name="username" required="required" type="text" placeholder="Vicky"/>'.
                                '</p>'.
                                '<p> '.
                                    '<label for="password" class="youpasswd" data-icon="p"> Your password </label>'.
                                   ' <input id="password" name="password" required="required" type="password" placeholder="Password" /> '.
                                '</p>'.
                                
                                '<p class="login button">'.
                                    '<input type="submit" value="Login" />'. 
								'</p>'.
                               
                            '</form>'.
                        '</div>'.
	'</div>';	
?>


<!-- Admin -->
<?php
if($isLogin)
	echo 
	
	'<div class="editor">'.
	'TITLE:<input id="title" type="text" name="post_name">'.
	'<br />'.
	'URL  :<input id="posturl" type="text" name="post_url">'.
	'<br />'.
	'<form>
		<select id="catagory" name="post_catagory">
		<option value="碎碎念">碎碎念</option>
		<option value="技术贴">技术贴</option>
		<option value="旅行志">旅行志</option>
		</select>
	</form>'.
	'<br />'.
	'<textarea id="editor" placeholder="" autofocus></textarea>'.
	'<br />'.
	'<button onclick="save()">发布</button>'.
	'<br />'.
	'</div>';
?>


 <!-- Footer -->
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
 <script src="../js/modernizr.custom.js"></script>
<!-- Simditor Dependence -->
<script src="js/supersized.3.2.7.min.js"></script>
<script src="js/supersized-init.js"></script>
<script src="js/handlers.js"></script>
<script src="js/index.js"></script>
<script src="js/swfupload.js"></script>
<script src="js/module.min.js"></script>
<script src="js/hotkeys.min.js"></script>
<script src="js/uploader.min.js"></script>
<script src="js/simditor.min.js"></script>
<script type="text/javascript">
var editor = new Simditor({
  textarea: $('#editor'),
  placeholder: '写点啥呢...'
});
var save = function(){
	var data = {
		title:$('#title').val(),
		catagory:$('#catagory').val(),
		content:editor.getValue()
	}
	var submitting = $.post("post.php",data);
	submitting.done(function(response){
		alert(response);
	})
};
</script>
</body>
</html> 