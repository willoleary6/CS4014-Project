<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>UL Website | Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					    <div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"><a href="index.html">Group - 8's Proofer</a></h1>
							<p>For all your proofreading needs.</p>
									
					</div>
				</div>
            <!-- log in -->
			      <div id="main-wrapper">
					<div id="main" class="container">
						<h1> Please login</h1>
					    <form method="post" action="login.php">
						<div class="row 50%">
							<div class="6u 12u(mobile)">
								<input name="email" placeholder="Email" type="email" >
							</div>
							<div class="6u 12u(mobile)">
								<input type="password"placeholder="password" name="password" > 
							</div>
						     
						</div>
						<br>
						<input type="submit" value="Login" > 
						</form>
					 
					<br>
					<br>
					 <h1> Not a member? register here!</h1>
			
						<div id="content">
                           <form action = "register.php" method ="POST">
                            Firstname:<br>
                            <input type="text" name="firstName"><br>
                            LastName:<br>
                            <input type="text" name="lastName"><br>
							Student/Staff ID number:<br>
                            <input type="number" name="idNumber"><br>
							E-mail:<br> 
							<input type="email" name="email" autocomplete="off"><br>
							Field:<br>
                            <input list="fields" name="browser"><br>
                            <datalist id="fields">
                             <?php
                              include 'dbh.php';
							  $numberOfFields = 0;
							  $sql = "SELECT subject_name FROM `major_subjects`";
							  $result = mysqli_query($connect,$sql);
                                                          $numberOfFields = mysqli_num_rows($result);						  
							  $names = mysqli_fetch_array($result);
                                                          for($i = 0; $i <$numberOfFields;$i++){	
                                                           ?>
							   <option value ="<?php echo $names[0]; ?>" >
                                                          <?php  $names = mysqli_fetch_array($result); }?>
							</datalist>
							 Password:<br>
                            <input type="password" name="password"><br>
							
                            
						
							<br>
							<input type="submit" value="Register">
							 </form>
                           
						</div>
					</div>
				</div>		
					
					
			     
			<!-- Footer -->
				<div id="footer-wrapper">
					<div id="footer" class="container">
						<header>
							<h2>Questions or comments? <strong>Get in touch:</strong></h2>
						</header>
						<div class="row">
							<div class="6u 12u(mobile)">
								<section>
									<form method="post" action="#">
										<div class="row 50%">
											<div class="6u 12u(mobile)">
												<input name="name" placeholder="Name" type="message-text" />
											</div>
											<div class="6u 12u(mobile)">
												<input name="email" placeholder="Email" type="message-text" />
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<textarea name="message" placeholder="Message"></textarea>
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<a href="#" class="form-button-submit button icon fa-envelope">Send Message</a>
											</div>
										</div>
									</form>
								</section>
							</div>
							<div class="6u 12u(mobile)">
								<section>
									<p>Erat lorem ipsum veroeros consequat magna tempus lorem ipsum consequat Phaselamet
									mollis tortor congue. Sed quis mauris sit amet magna accumsan tristique. Curabitur
									leo nibh, rutrum eu malesuada.</p>
									<div class="row">
										<div class="6u 12u(mobile)">
											<ul class="icons">
												<li class="icon fa-home">
													1234 Somewhere Road<br />
													Nashville, TN 00000<br />
													USA
												</li>
												<li class="icon fa-phone">
													(000) 000-0000
												</li>
												<li class="icon fa-envelope">
													<a href="#">info@untitled.tld</a>
												</li>
											</ul>
										</div>
										<div class="6u 12u(mobile)">
											<ul class="icons">
												<li class="icon fa-twitter">
													<a href="#">@untitled-tld</a>
												</li>
												<li class="icon fa-instagram">
													<a href="#">instagram.com/untitled-tld</a>
												</li>
												<li class="icon fa-dribbble">
													<a href="#">dribbble.com/untitled-tld</a>
												</li>
												<li class="icon fa-facebook">
													<a href="#">facebook.com/untitled-tld</a>
												</li>
											</ul>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
					<div id="copyright" class="container">
						<ul class="links">
							<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</div>
				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>