<?php
define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link rel="shortcut icon" href="../favicon.ico"> 
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    
</head>
  
<body style="background-color: black">
<!-- Begin Header -->
<div class="header">
    <div class="logoimg"><img src="../imgs/logo.png"></div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
        <ul class="nav navbar-nav">
                <li><a href="../index.php">Home</a></li>
                <li class="active"><a href="index.php">Blog</a></li>  
                <li><a href="../photography/">Photos</a></li>   
                <li><a href="../about/">About</a>         
        </ul>  
        </div>
    </div>
</div>
</div>

<main class="main" role="main">

<!-- single post -->
<div class="container">
<div class="row">
<div class="col-xs-12">
        <?php
            try{
            $dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("set names 'utf8'");
            //判断传入参数
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sth = $dbh->prepare('SELECT * FROM posts where id = ?');
                $sth->bindParam(1, $id, PDO::PARAM_STR);
                $sth->execute();
                $result = $sth->fetch();
            }
            else if (isset($_GET['posturl'])) {
                $posturl=$_GET['posturl'];
                $sth = $dbh->prepare('SELECT * FROM posts where posturl = ?');
                $sth->bindParam(1, $posturl, PDO::PARAM_STR);
                $sth->execute();
                $result = $sth->fetch();
            }
            echo
                '<article class="post">'.
                '<div>'.
                    '<h1 class="post-title">'.$result['title'].'</h1>'.
                    '<div class="entry-meta">'.$result['catagory'].'|'.$result['time'].'|Vicky </div>'.
                '</div>'.
                '<div class="entry-content clearfix">'.
                    '<p>'.$result['content'].'</p>'.
                '</div>'.
                '</article>';
            }
            catch (PDOException $e){
                echo "连接服务器失败".$e->getMessage();
            }
        ?>
    </div>
    </div>
    </div>

<!-- Comment Wrapper -->
<div class="container">
<div class="row"> <div class="col-xs-12"> <h1 class="page-title">Comment here.</h1></div></div>
<form action="#" method="post" class="contact-form">
    <div class="row"> <div class="col-xs-12">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" rows="7" placeholder="Your Message" required></textarea>
                <button class="btn-send">Drop Me a Line</button>     
    </div>  </div>
</form>        
</div>
</main>

<!-- Footer -->
    <div class="footer-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            copyright©2015 | <a href="mailto:yaopeng0802@gmail.com?subject=Hello,瓢瓢"> Contact Me</a> | <a href="../admin/index.php">Admin</a>
            </div>
        </div>
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>  
    <script src="js/pace.min.js"></script>
    <script src="js/modernizr.custom.js"></script>       
</body>
</html> 