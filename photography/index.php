<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos</title>
    <link rel="shortcut icon" href="../favicon.ico">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
    <link href="css/photo.css" rel="stylesheet">
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
            <li><a href="../blog/index.php"><img src="../imgs/blog.png"><span class="nav-label">Blog</span></a></li>
            <li><a href="index.php"><img src="../imgs/photo.png"><span class="nav-label">Photos</span></a></li>
            <li><a href="../index.php"><img src="../imgs/home.png"><span class="nav-label">Home</span></a></li>
            <li><a href="../admin/index.php"><img src="../imgs/admin.png"> <span class="nav-label">Admin</span> </a></li>
            <li><a href="../contact/index.php"><img src="../imgs/contact.png"><span class="nav-label">Contact</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- Begin Wrapper -->
<main class="main">

<div class="container"><div class="row"><div class="col-sm-12">
<div id="div1">
<p>TRAVEL PHOTOGRAPGY</p>
<ul>
    <div id="travellist"></div>
</ul></div>
</div></div></div>

<div class="container"><div class="row"><div class="col-sm-12">
<div id="div2">
<p>DAILY SNAPSHOT</p>
<ul>
    <div id="dailylist"></div>
</ul></div>
</div></div></div>

<div class="container"><div class="row"><div class="col-sm-12">
<div id="div3">
<p>DESIGN STUDIO</p>
<ul>
    <div id="designlist"></div>
</ul></div>
</div></div></div>

<div class="container"><div class="row"><div class="col-sm-12">
<button><a href="photoadmin.php">upload photos</a></button>
</div></div></div>
</main>
<!-- end Wrapper -->

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
<script src="upload.js"></script>  
<script src="../js/modernizr.custom.js"></script>

</body>
</html>
</body>
</html>