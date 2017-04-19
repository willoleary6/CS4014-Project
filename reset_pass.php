<?php
	//code written by Aaron Dunne
	require 'dbh.php';	
?>

<!DOCTYPE HTML>
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
									<li>
										<a href="#" class="icon fa-bar-chart-o"><span>Dropdown</span></a>
										<ul>
											<li><a href="#">Lorem ipsum dolor</a></li>
											<li><a href="#">Magna phasellus</a></li>
											<li><a href="#">Etiam dolore nisl</a></li>
											<li>
												<a href="#">Phasellus consequat</a>
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
								// When user provides new password, all variables are called to verify if both passwords match
								$newpass = $_POST['newpass'];
								$newpass1 = $_POST['newpass1'];
								$post_email = $_POST['email'];
								$code = $_GET['code'];
                                // If passwords given match
								if($newpass == $newpass1) {
									$enc_pass = md5($newpass);
		                            // Updates account with new password in the database
									$sql = "UPDATE user_details SET password='$newpass' WHERE email='$post_email'";
									mysqli_query($connect,$sql);
		                            // Resets password_reset to 0 on account of changed password
									$sql = "UPDATE user_details SET password_reset='0' WHERE email='$post_email'";
									mysqli_query($connect,$sql);
		                            // Returns to the login page
									echo "<h2><strong>Password Reset successful</strong></h2>
										   Your password has been successfully updated.<p>To return to the login page,
										   <a href='index.php'>Click here</a>";
								}
								// If passwords do not match
								else {
									echo "<h2><strong>Password Reset unsuccessful</strong></h2>
										Passwords do not match. 
										<a href='recover.php?code=$code&email=$post_email'>
										Click here to return and try again.</a>";
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