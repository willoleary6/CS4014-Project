<!DOCTYPE HTML>
<!-- Code written by Aaron Dunne and William O'Leary -->
<?php
  if(isset($_COOKIE['email'])){
	header("location: login.php");
	}else{
    ?>
	<script>
	function passwordValidation() { 
		// Boolean array to check if the password meets all criteria 
		var valid = [false,false,false];
		// Getting the submitted passwords
		var password = document.getElementById("password").value;
		var confPassword = document.getElementById("cpassword").value;
		var character;
		var i;
		/* For loop checking each character of the password
		to be sure it meets the minimum requirements
		(at least 1 lowercase, 1 uppercase letter, 1 number 
		and at least 8 characters) */
		for(i = 0; i < password.length; i++) {
			character = password.charAt(i);
			if(!isNaN(character)) {
				valid[0] = true;
			}else if(character == character.toLowerCase()) {
				valid[1] = true;
			}else if(character == character.toUpperCase()) {
				valid[2] = true;
			}
		}
		/* Checks if all criteria are met, 
		if not throws an appropriate error message */
		if(valid[0] == true && valid[1] == true && valid[2] == true) {
			if(password.length >= 8) {
				if(password == confPassword){
					document.register.submit();
				}else{
					alert("Error: Password and confirm password do not match");
				}
			}else{
				alert("Error: Password must be at least 8 characters long");
			}            
		}else{
			alert("Error: Password must contain at least one uppercase, one lowercase letter and a number");
		}
	}
	</script>
	<html>
		<head>
			<title>CS4014 Group 8</title>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
			<link rel="stylesheet" href="assets/css/main.css" />
			<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
			<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
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
										<h2><strong>Login</strong></h2>
										<?php if (isset($_GET['NotActive'])) { ?>
											<b>*Login failed. Account has not been activated yet.</b><br>
										<?php } ?>
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
										<header>
											<h2><strong>Sign up today</strong></h2>
										</header>
										<form action = "register.php" name = "register" method ="POST" >
											Firstname:<br>
											<input type="text" name="firstName" required><br>
											LastName:<br>
											<input type="text" name="lastName" required><br>
											Student/Staff ID number:<br>
											<input type="number" name="idNumber" required><br>
											E-mail:<br>
											<input type="email" name="email" autocomplete="off" required>
											<?php if (isset($_GET['EmailFail'])) { 
											?>
											<b>*Must have the domain 'studentmail.ul.ie' or 'ul.ie'</b><br>
											<?php 
												}else if(isset($_GET['EmailInUse'])){
											?>	 
												 <b>*Email already in use.</b><br>
											<?php    
												}
											?>
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
												$names = mysqli_fetch_assoc($result);
												for($i = 0; $i <$numberOfFields;$i++) {	
											?>
													<option value ="<?php echo htmlspecialchars($names['subject_name'], ENT_QUOTES);?>">
													<?php  $names = mysqli_fetch_assoc($result); 
												}
											?>
											</datalist>
											<?php if (isset($_GET['FieldFail'])) { ?>
											<b>*Error you have not chosen a valid field</b><br>
											<?php } ?>
											Password:<br>
											<input type="password" name = "password" id ="password" required><br>
											Confirm Password:<br>
											<input type="password" name = "cpassword" id ="cpassword" required><br>
											<!--<div class="g-recaptcha" data-sitekey="6Lfinh4UAAAAAA5YbGp0Tsbpl97a7rtgBm3qhaGF"></div>-->
												
											<br>
														
											<button type="button" onclick = "javascript:passwordValidation();">Register</button>
											<?php 
												/*if (isset($_GET['CaptchaFail'])) { 
											?>
													<b>*Could not register. Captcha failed</b><br>
											<?php 
												} */
											?>
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
<?php 
	}
?>