<?php
	require 'dbh.php';	
?>

<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>Password Reset</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="no-sidebar">
		<div id="page-wrapper">

			<!-- Header -->
			<div id="header-wrapper">
				<div id="header" class="container">

					<!-- Logo -->
					<h1 id="logo"><a href="index.html">Password Reset</a></h1>

					<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a class="icon fa-home" href="index.html"><span>Home</span></a></li>
							<li><a href="#" class="icon fa-bar-chart-o"><span>Dropdown</span></a>
								<ul>
								<li><a href="#">Lorem ipsum dolor</a></li>
									<li><a href="#">Magna phasellus</a></li>
									<li><a href="#">Etiam dolore nisl</a></li>
									<li><a href="#">Phasellus consequat</a>
										<ul>
											<li><a href="#">Magna phasellus</a></li>
											<li><a href="#">Etiam dolore nisl</a></li>
											<li><a href="#">Phasellus consequat</a></li>
										</ul>
									</li>
									<li><a href="#">Veroeros feugiat</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>

			<!-- Main -->
			<div id="main-wrapper">
				<div id="main" class="container">
					<div id="content">
						<?php 
							if (isset($_GET['code'])) {
								$get_email = $_GET['email'];
								$get_code = $_GET['code'];
	
								$sql = "SELECT password_reset, email FROM user_details WHERE email ='$get_email'";
								$query = mysqli_query($connect,$sql);
								$row = mysqli_fetch_array($query);

								if(sizeof($row) > 0) {
									$db_code = $row[0];
									$db_email = $row[1];
								}
				
								if($get_email == $db_email && $get_code == $db_code) {
									echo  "
										<form action='reset_pass.php?code=$get_code' method='POST'>
											Enter your new password<br><input type='password' name='newpass'><p>
											Re-enter your new password<br><input type='password' name='newpass1'><p>
											<input type='hidden' value='$db_email' name='email'>
											<input type='submit' value='Update Password'>
										</form>
									";
								}
							}
							
							if (isset($_POST['Submit'])) {
								$email = $_POST['email']; 
	
								// Searches for email entered by user
								$sql = "SELECT email FROM user_details WHERE email ='$email'";
								$query = mysqli_query($connect,$sql);
								$row = mysqli_fetch_array($query);
	
								if (sizeof($row) > 0) {
									$db_email = $row[0];
				
									// Creates a random code 
									if ($email == $db_email) {
										$code = rand(10000, 10000000);
				
										// Email sent to user. Link generated includes random unique code generated and email given
										$to = $db_email;
										$subject = "Password Reset";
										$body = "
											This is an automated email. Please DO NOT reply to this email.

											You have requested to have your account password reset. To do this, please
											click on the link below or copy and paste it into your browser.
	
					
											Link:
											https://cs-4014-project.000webhostapp.com/recover.php?code=$code&email=$email
										";
					
										// Updates the password_reset variable in the database for the account
										$sql = "UPDATE user_details SET password_reset='$code' WHERE email='$email'";
										mysqli_query($connect,$sql);
										mail($to,$subject, $body);

										echo "
											<h2><strong>Password Reset email sent</strong></h2>
											A password rest request has been sent to your email inbox.
										";
									}
								}
								
								// If email provided by user is found not to be in the database
								else {
									echo "
										<h2><strong>Incorrect email given</strong></h2>
										No account with the email provided exists on our servers. Please click <a href='recoverForm.html'>here</a> and try again.
									";
								}
							}	
						?>
					</div>
				</div>
			</div>
		
			<!-- Footer -->
			<div id="footer-wrapper">
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