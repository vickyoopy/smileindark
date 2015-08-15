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
        <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
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

    
    <!-- display blog -->
    <?php
    echo
     '<div class="wrapper" style="text-align: center">'.
        '<div class="content-body">'; 
        try{
        $dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("set names 'utf8'");
        $sth = $dbh->prepare('SELECT * FROM posts Order by time desc');
        $sth->execute();
        $result = $sth->fetchAll();
        foreach($result as $row){
            echo
                '<article class="post">'.
                '<div class="entry-header">'.
                    '<h1 class="post-title"><a href="single.php">'.$row['title'].'</a></h1>'.
                    '<div class="entry-meta">'.$row['catagory'].'|'.$row['time'].'|Vicky </div>'.
                '</div>'.
                '<div class="entry-content clearfix" style="text-align: left">'.
                    '<p>'.$row['content'].'</p>'.
                    '<div class="read-more"><a href="single.php">Continue reading <span class="meta-nav">→</span></a></div>'.
                '</div>'.
                '</article>';}
        } 
        catch (PDOException $e){
        echo "连接服务器失败".$e->getMessage();
        }
        echo '</div></div>';
        ?>

        <!-- Footer -->
        <div class="footer-wrapper">
        copyright©2015 | <a href="mailto:yaopeng0802@gmail.com?subject=Hello,瓢瓢"> Contact Me</a> | <a href="../admin/index.php">Admin</a>
        </div>
        </body>
    </html> 




