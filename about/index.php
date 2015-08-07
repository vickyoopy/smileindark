<!DOCTYPE HTML>
<html>
	<head>
		<title>About Me</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.poptrox.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
	</head>
	<body>

		<!-- Header -->
		<div class="header-wrapper opacity">
        <div class="header">
        <div class="logo"><a href="index.html"><img src="../imgs/logo.png" alt="" /></a>
        <?php 
        if($isLogin)
            echo "welcome,Yao!"; 
        else
            echo "welcome, guest."; 
        ?>
        </div>
        <div id="menu-wrapper">
            <div id="menu" class="menu">
                <ul id="tiny">
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="../blog/index.php">Blog</a></li>
                    <li><a href="../photography/">Photos</a></li>   
                    <li class="active"><a href="index.php">About Me</a>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        </div>
        </div>
			
		<!-- Intro -->
			<section id="intro" class="main style1 dark fullscreen">
				<div class="content container small">
					<header>
						<h2>Hey.</h2>
					</header>
					<p>Welcome to <strong>Big Picture</strong> a responsive site template designed
					by <a href="http://html5up.net">HTML5 UP</a>, built on <a href="http://skeljs.org">skelJS</a>,
					and released for free under the <a href="http://www.cssmoban.com/">Creative Commons Attribution 3.0 license</a>.</p>
					<footer>
						<a href="#one" class="button style2 down">More</a>
					</footer>
				</div>
			</section>
            <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >Website Template</a></div>
		
		<!-- One -->
			<section id="one" class="main style2 right dark fullscreen">
				<div class="content box style2">
					<header>
						<h2>What I Do</h2>
					</header>
					<p>Lorem ipsum dolor sit amet et sapien sed elementum egestas dolore condimentum. 
					Fusce blandit ultrices sapien, in accumsan orci rhoncus eu. Sed sodales venenatis arcu, 
					id varius justo euismod in. Curabitur egestas consectetur magna urna.</p>
				</div>
				<a href="#two" class="button style2 down anchored">Next</a>
			</section>
		
		<!-- Two -->
			<section id="two" class="main style2 left dark fullscreen">
				<div class="content box style2">
					<header>
						<h2>Who I Am</h2>
					</header>
					<p>Lorem ipsum dolor sit amet et sapien sed elementum egestas dolore condimentum. 
					Fusce blandit ultrices sapien, in accumsan orci rhoncus eu. Sed sodales venenatis arcu, 
					id varius justo euismod in. Curabitur egestas consectetur magna urna.</p>
				</div>
				<a href="#work" class="button style2 down anchored">Next</a>
			</section>
			
		<!-- Work -->
			<section id="work" class="main style3 primary">
				<div class="content container">
					<header>
						<h2>My Work</h2>
						<p>Lorem ipsum dolor sit amet et sapien sed elementum egestas dolore condimentum. 
						Fusce blandit ultrices sapien, in accumsan orci rhoncus eu. Sed sodales venenatis 
						arcu, id varius justo euismod in. Curabitur egestas consectetur magna vitae urna.</p>
					</header>
					
						<div class="container small gallery">
							<div class="row flush images">
								<div class="6u"><a href="images/fulls/01.jpg" class="image full l"><img src="images/thumbs/01.jpg" title="The Anonymous Red" alt="" /></a></div>
								<div class="6u"><a href="images/fulls/02.jpg" class="image full r"><img src="images/thumbs/02.jpg" title="Airchitecture II" alt="" /></a></div>
							</div>
							<div class="row flush images">
								<div class="6u"><a href="images/fulls/03.jpg" class="image full l"><img src="images/thumbs/03.jpg" title="Air Lounge" alt="" /></a></div>
								<div class="6u"><a href="images/fulls/04.jpg" class="image full r"><img src="images/thumbs/04.jpg" title="Carry on" alt="" /></a></div>
							</div>
							<div class="row flush images">
								<div class="6u"><a href="images/fulls/05.jpg" class="image full l"><img src="images/thumbs/05.jpg" title="The sparkling shell" alt="" /></a></div>
								<div class="6u"><a href="images/fulls/06.jpg" class="image full r"><img src="images/thumbs/06.jpg" title="Bent IX" alt="" /></a></div>
							</div>
						</div>

				</div>
			</section>
			
		<!-- Contact -->
			<section id="contact" class="main style3 secondary">
				<div class="content container">
					<header>
						<h2>Say Hello.</h2>
						<p>Lorem ipsum dolor sit amet et sapien sed elementum egestas dolore condimentum.</p>
					</header>
					<div class="box container small">
							<form method="post" action="#">
								<div class="row half">
									<div class="6u"><input type="text" name="name" placeholder="Name" /></div>
									<div class="6u"><input type="text" name="email" placeholder="Email" /></div>
								</div>
								<div class="row half">
									<div class="12u"><textarea name="message" placeholder="Message" rows="6"></textarea></div>
								</div>
								<div class="row">
									<div class="12u">
										<ul class="actions">
											<li><input type="submit" class="button" value="Send Message" /></li>
										</ul>
									</div>
								</div>
							</form>
					</div>
				</div>
			</section>
			
		<!-- Footer -->
			<footer id="footer">
				<!-- Menu -->
					<ul class="menu">
						<li>
						copyright©2015 | <a href="mailto:yaopeng0802@gmail.com?subject=Hello,瓢瓢"> Contact Me</a> | <a href="../admin/index.php">Admin</a>
						</li>
					</ul>	
			</footer>
	</body>
</html>