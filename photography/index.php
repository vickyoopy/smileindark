<!DOCTYPE HTML>
<html lang="ch">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <title>Photos</title>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/media-queries.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,700,700italic|Open+Sans+Condensed:300,700' rel="stylesheet" type='text/css'>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>  
        <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
        <script type="text/javascript" src="js/photostyle.js"></script>
        <script type="text/javascript">
             $.backstretch("../imgs/1.jpg");
        </script>
     </head>

    <body>
    <!-- Begin Header -->
    <div class="header-wrapper opacity">
    <div class="header">
        <div class="logo"><a href="index.html"><img src="../imgs/logo.png" alt="" /></a></div>
        <div id="menu-wrapper">
            <div id="menu" class="menu">
                <ul id="tiny">
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="../index.html">Blog</a></li>
                    <li class="active"><a href="index.html">Photos</a></li>
                    <li><a href="../game/index.html">Games</a>
                        <ul>
                            <li><a href="../game/pacman.html">Pacman</a></li>
                        </ul>
                    </li>
                    <li><a href="../login/index.html">Log in</a>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        <!-- End Menu -->
    </div>
</div>
<!-- End Header -->


<!-- Begin Wrapper -->
<div class="wrapper">
<div id="imageFlow">

        <div class="bank">
            <a rel="imgs/1.jpg" title="光绘_py@12 May 2013" href="imgs/1.jpg" target="_blank">intro:haha</a>
            <a rel="imgs/2.jpg" title="光绘_happy@12 May 2013" href="imgs/2.jpg" target="_blank">intro:哈哈</a>
            
        </div>    

  <div class="text"> 
    <div class="title">Loading...</div><div class="legend">图片有点大,请耐心等候,或直接点击链接查看原图</div>
  </div>
        
  <div class="scrollbar"> <img class="track" src="sb.gif" alt=""> <img class="arrow-left" src="sl.gif" alt=""> 
    <img class="arrow-right" src="sr.gif" alt=""> <img class="bar" src="sc.gif" alt=""> 
  </div>
</div> 
</div>
<!-- end Wrapper -->

<!-- Begin Footer -->
<div class="footer-wrapper">        
    copyright©<?php echo date("Y")?> | <a href="mailto:yaopeng0802@gmail.com?subject=Hello,瓢瓢"> Contact Me</a>
</div>
<!-- End Footer --> 



</body>
</html>