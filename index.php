<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yao Peng</title>
    <link rel="shortcut icon" href="../favicon.ico"> 
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jquery-letterfx.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
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
            <li><a href="blog/index.php"><img src="imgs/blog.png"><span class="nav-label">Blog</span></a></li>
            <li><a href="photography/index.php"><img src="imgs/photo.png"><span class="nav-label">Photos</span></a></li>
            <li><a href="#"><img src="imgs/home.png" style="bottom: -2em"><span class="nav-label">Home</span></a></li>
            <li><a href="admin/index.php"><img src="imgs/admin.png"> <span class="nav-label">Admin</span> </a></li>
            <li><a href="contact/index.php"><img src="imgs/contact.png"><span class="nav-label">Contact</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- Begin Wrapper -->
    <section id="section1" class="cd-section">
        <h1>- SMILE IN DARK -</h1><br>
        <a href="#section2" class="cd-scroll-down cd-img-replace" onclick="s2load()">scroll down</a>
    </section>

    <section id="section2" class="cd-section">
        <p id="s2">If you don't fail, you are not even trying.</p>
    </section>


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
    <script src="js/jquery-1.12.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery-letterfx.min.js"></script>
    <script type="text/javascript">
        s2load=function(){
        $("#s2").letterfx({"fx":"swirl"});
        }
    </script>

</body>
</html>