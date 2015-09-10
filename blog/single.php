<?php

define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );

?>
    <!DOCTYPE html>
    <html lang="ch">
        <head>
        <meta charset="utf-8"/>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blog</title>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/media-queries.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,700,700italic|Open+Sans+Condensed:300,700' rel="stylesheet" type='text/css'>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>  
        <!-- css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/ionicons.min.css">
        <link rel="stylesheet" href="css/pace.css">
        <link rel="stylesheet" href="css/custom.css">
        <!-- js -->
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/modernizr.custom.js"></script>
        </head>
        <body style="background-color: black">
       
        <!-- Begin Header -->
        <div class="header-wrapper opacity">
        <div class="header">
        <div class="logo"><a href="index.html"><img src="../imgs/logo.png" alt="" /></a>
        </div>
        <div id="menu-wrapper">
            <div id="menu" class="menu">
                <ul id="tiny">
                    <li><a href="../index.html">Home</a></li>
                    <li class="active"><a href="index.php">Blog</a></li>
                    <li><a href="../photography/">Photos</a></li>   
                    <li><a href="../about/">About</a>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        </div>
        </div>
        <!-- End Header -->

        <!-- single post -->
        <div class="wrapper">
        <div class="content-body">
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
            elseif (isset($_GET['posturl'])) {
                $id=$_GET['posturl'];
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
		<!-- Comment Wrapper -->
            <h1 class="page-title">Comment here.</h1>
                <form action="#" method="post" class="contact-form">
                    <div class="row">
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="text" name="subject" placeholder="Subject" required>
                        <textarea name="message" rows="7" placeholder="Your Message" required></textarea>
                        <button class="btn-send">Drop Me a Line</button>     
                    </div>  
                </form>        
        </div>
	    </div>


        <!-- Footer -->
        <div class="footer-wrapper">
        copyright©2015 | <a href="mailto:yaopeng0802@gmail.com?subject=Hello,瓢瓢"> Contact Me</a> | <a href="../admin/index.php">Admin</a>
        </div>
        </body>
    </html> 
