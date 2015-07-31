<?php

class Page {
    
    /* Check if user is logged in */
    public function checkLogin() {
        $isLogin = false;
        if(isset(isset($_COOKIE["uid"])) $uid = $_COOKIE["uid"];
        $isLogin = TRUE;
    }

    /* display header */
    public function displayHeader() {
        echo '<!doctype html>';
        ?>
        <html lang="ch">
        <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <title>Blog</title>
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
               
        <!-- Begin Header -->
        <div class="header-wrapper opacity">
        <div class="header">
        <div class="logo"><a href="index.html"><img src="../imgs/logo.png" alt="" /></a>
        <?php 
        if($isLogin)
            echo "welcome,Yao!"; 
        else          
            {$url="../login/index.html"; 
            echo "<script language=\"javascript\">"; 
            echo "location.href=\"$url\""; 
            echo "</script>"; }
        ?>
        </div>
        

        <div id="menu-wrapper">
            <div id="menu" class="menu">
                <ul id="tiny">
                    <li><a href="../index.html">Home</a></li>
                    <li class="active"><a href="index.php">Blog</a></li>
                    <li><a href="../photography/">Photos</a></li>   
                    <li><a href="../about/">About Me</a>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        </div>
        </div>
        <!-- End Header -->
        <?php
    }
  
    /* display posts */
    public function displayposts() {
        echo "haha";
    ?>  
    <?php
    }
            
    /* display footer */
    public function displayFooter() {
    ?>
        <div class="footer-wrapper">        
            copyright©2015 | <a href="mailto:yaopeng0802@gmail.com?subject=Hello,瓢瓢"> Contact Me</a>
        </div>
    </body>
    </html>  
    <?php  
    }
};

 
session_start();
$con = mysql_connect("localhost","admin","vz28yt90");
if (!$con)
  {die('Could not connect: ' . mysql_error());}
mysql_select_db("posts", $con);
$sql = "SELECT * FROM 'posts' ";
mysql_query($sql, $con);


$page = new Page();
$page->checkLogin();
$page->displayHeader();
$page->displayposts();
$page->displayFooter();
mysql_close($db);

?>

