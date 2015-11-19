<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photos</title>
    <link rel="shortcut icon" href="../favicon.ico">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
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
                <li ><a href="../blog/index.php">Blog</a></li>  
                <li><a href="index.php">Photos</a></li>   
                <li><a href="../about/index.php">About</a>         
        </ul>  
        </div>
    </div>
</div>
</div>


<!-- Begin Wrapper -->
<main class="main">


<div class="imgContainer">
    <!--大图-->
    <div class="detailImg" > 
        <a id="detailImg-pre">&lt;</a>
        <div id="detailImg-box" class="box"> </div>
        <a id="detailImg-next">&gt;</a> 
    </div>
    <!--小图-->
    <div class="smallImg"> 
        <a id="smallImg-pre"></a>
        <div id="smallImg-box" class="box">
            <ul id="smallImg-ul" class="imgUl">
            </ul>
        </div>
        <a id="smallImg-next"></a> 
    </div>
</div>


</main>
<!-- end Wrapper -->

<!-- Footer-->
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
<script src="js/jquery-2.1.1.min.js"></script>  
<script src="js/bootstrap.min.js"></script>
<script src="upload.js"></script>  

</body>
</html>
</body>
</html> 
