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
<header>
<div id="menu" class="nav">                 
                    <ul>
                        <li>
                            <a href="#">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-home"></i>
                                </span>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="blog/index.php">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-blog"></i>
                                </span>
                                <span>Blog</span>
                            </a>
                        </li>
                        <li>
                            <a href="photography/index.php">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-portfolio"></i>
                                </span>
                                <span>Photos</span>
                            </a>
                        </li>
                        <li>
                            <img src="imgs/logo.png">
                        </li>
                      <li>
                            <a href="http://vicky-peng.tumblr.com/">
                                <span class="icon"> 
                                    <i aria-hidden="true" class="icon-services"></i>
                                </span>
                                <span>Tumblr</span>
                            </a>
                        </li>
                    
                        
                        <li>
                            <a href="admin/index.php">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-team"></i>
                                </span>
                                <span>Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="contact/index.php">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-contact"></i>
                                </span>
                                <span>Contact</span>
                            </a>
                        </li>
                    </ul>
</div>
</header>

<!-- Begin Wrapper -->
    <nav id="cd-vertical-nav">
        <ul>
            <li>
                <a href="#section1" data-number="1">
                    <span class="cd-dot"></span>
                    <span class="cd-label">Dark.s1</span>
                </a>
            </li>
            <li>
                <a href="#section2" data-number="2" onclick="s2load()">
                    <span class="cd-dot"></span>
                    <span class="cd-label">Bright.s1</span>
                </a>
            </li>
            <li>
                <a href="#section3" data-number="3" onclick="s3load()">
                    <span class="cd-dot"></span>
                    <span class="cd-label">Dark.s2</span>
                </a>
            </li>
            <li>
                <a href="#section4" data-number="4" onclick="s4load()">
                    <span class="cd-dot"></span>
                    <span class="cd-label">Bright.s2</span>
                </a>
            </li>
            <li>
                <a href="#section5" data-number="5" onclick="s5load()">
                    <span class="cd-dot"></span>
                    <span class="cd-label">Dark.s3</span>
                </a>
            </li>
            <li>
                <a href="#section6" data-number="6" onclick="s6load()">
                    <span class="cd-dot"></span>
                    <span class="cd-label">Bright.s3</span>
                </a>
            </li>
        </ul>
    </nav>
    <a class="cd-nav-trigger cd-img-replace">Open navigation<span></span></a>


    <section id="section1" class="cd-section">
    <h1>- SMILE IN DARK -</h1><br>
    <p id="s1">Open the prologue of Darkness</p>
    <a href="#section2" class="cd-scroll-down cd-img-replace" onclick="s2load()">scroll down</a>
    </section>

    <section id="section2" class="cd-section">
    <p id="s2">If you don't fail, you are not even trying.</p>
    </section>

    <section id="section3" class="cd-section">
        <p id="s3">We ascribe beauty to that which is simple, which has no superfluous parts, which exactly answers its end, which stands related to all things, which is the mean of many extremes. - Ralph Waldo Emerson</p>
    </section>

    <section id="section4" class="cd-section">
        <p id="s4">There is some good in this world worth fighting for!</p>
    </section>

    <section id="section5" class="cd-section">
        <p id="s5">l'enfer, c'est les autres.<br>
        </p>
    </section>

    <section id="section6" class="cd-section">
        <p id="s6">勝手にやって来て,<br>
        勝手に去って行く</p>
    </section>

    <!-- Footer -->
    <div class="footer-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            copyright©2014-2025| Vicky.P.Y | <a href="mailto:vickypy0802@gmail.com?subject=Hello,Vicky"> Email Me</a> 
            </div>
        </div>
    </div>
    </div>
   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <script src="js/main.js"></script>
    <script src="js/tuxsudo.min.js"></script>
    <script src="js/jquery-letterfx.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $("#s2").letterfx({"fx":"swirl"});
    $("#s3").letterfx({"fx":"fall","words":true,"timing":1000});  
    $("#s4").letterfx({"fx":"swirl"});
    $("#s5").letterfx({"fx":"fall","words":true,"timing":1000});  
    $("#s6").letterfx({"fx":"swirl"});
});
s2load=function(){
$("#s2").letterfx({"fx":"swirl"});
}
s3load=function(){
$("#s3").letterfx({"fx":"fall","words":true,"timing":1000}); 
}  
s4load=function(){
$("#s4").letterfx({"fx":"swirl"});
} 
s5load=function(){
 $("#s5").letterfx({"fx":"fall","words":true,"timing":1000});  
} 
s6load=function(){
  $("#s6").letterfx({"fx":"swirl"});
}  
</script>

</body>
</html>