<?php
	//code written by Aaron Dunne - 15148602
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
		<title>Registration Success</title>
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
					<h1 id="logo"><a href="index.html">Registration</a></h1>
				</div>	
			</div>	
					
			<!-- Main -->
			<div id="main-wrapper">
				<div id="main" class="container">
					<div id="content">
						<?php
							$email = mysqli_real_escape_string($connect, strip_tags($_GET['email']));
							$code = mysqli_real_escape_string($connect, strip_tags($_GET['code']));
			
							$sql = "SELECT * FROM user_details WHERE email='$email'";
							$result = mysqli_query($connect,$sql);
							$row = mysqli_fetch_assoc($result);
							$db_email = $row['email'];
							$db_code = $row['confirm_code'];				
							// If the account email and code matches with on an account email and code in the database
							if ($email == $db_email && $code == $db_code) {
								// Set confirmed variable of that account to 1
								$sql = "UPDATE user_details SET confirmed='1' WHERE confirm_code=$code";
								$result = mysqli_query($connect,$sql);
								// Resets confirm_code variable of that account to 0
								$sql = "UPDATE user_details SET confirm_code='0' WHERE confirm_code=$code";
								$result = mysqli_query($connect,$sql);
					
								echo "
									<h2><strong>Registration Complete</strong></h2>
									Great! You have successfully completed your registration and now can access your account. <a href='index.php'>Click here</a> to return to the homepage and login.
								";
							} else {
								header("location: index.php");
							}
						?>
					</div>
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