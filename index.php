<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>Landing page</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body class="no-sidebar">
		<div id="page-wrapper">

			<!-- Header -->
			<div id="header-wrapper">
				<div id="header" class="container">

					<!-- Logo -->
					<h1 id="logo"><a href="index.html">Welcome</a></h1>
					<p>Please login or register.</p>
				</div>
			</div>

			<!-- Main -->
			<div id="main-wrapper">
				<div id="main" class="container">
					<div id="content">
						<div class="row">
							<div class="6u 12u(mobile)">
								<section>
									<div id="features-wrapper">
										<h2><strong>Login</strong></h2>
									</div>
									<form method="post" action="login.php">
										E-mail<br>
										<input type="email" name="email" required><br>
										Password<br>
										<input type="password" name="password" required><br>
										<form action="test.html">
											<input type="submit" value="Login">
										</form>
										<a href='recoverForm.html'>Forgot your password?</a>
									</form>
								</section>
							</div>
							<div class="6u 12u(mobile)">
								<section>
									<div id="features-wrapper">
										<header>
											<h2><strong>Sign up today</strong></h2>
										</header>
									</div>
									<form action = "register.php" method ="POST" >
										Firstname:<br>
										<input type="text" name="firstName" required><br>
										LastName:<br>
										<input type="text" name="lastName" required><br>
										Student/Staff ID number:<br>
										<input type="number" name="idNumber" required><br>
										E-mail:<br>
										<input type="email" name="email" autocomplete="off" required>
										<?php if (isset($_GET['EmailFail'])) { ?>
										<b>*Must have the domain 'studentmail.ul.ie' or 'ul.ie'</b>
										<?php } ?>
										<br>
										Field:<br>
										<input list="fields" name="browser" required><br>
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
										<input type="password" name="password" required><br>
										Confirm Password:<br>
										<input type="password" name="cpassword" required><br>
										<div class="g-recaptcha" data-sitekey="6LeHgBoUAAAAADTe7a9J4JYYtsBgfVbaZjuBHlYT"></div><br>
										<input type="submit" value="Submit" name="submit"><br>
										<?php if (isset($_GET['CaptchaFail'])) { ?>
										<b>*Could not register. Captcha failed</b><br>
										<?php } ?>
										<p>&nbsp;</p>
									</form>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer -->
			<div id="copyright" class="container">
				<ul class="links">
					<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
				</ul>
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