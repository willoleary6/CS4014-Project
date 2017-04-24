<!DOCTYPE HTML>
<!--Code Written by bernard Steemers-->
<html>
	<head>
		<title>[User Profile]</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	
	<body class="no-sidebar">
		<div id="page-wrapper">
            <?php
 				include 'dbh.php';
 				include 'cookieCheck.php';
 				$email = $_COOKIE['email'];
	 			$password = $_COOKIE['password'];
				$reputation_score = $_COOKIE['RepScore'];
 				$user_id = $_COOKIE['userID']; 
				//getting the users name and reputation
				$sql = "SELECT * FROM user_details Where email = '$email' AND password = '$password'";
 				$comments = mysqli_query($connect, $sql);
 				while($row = $comments->fetch_assoc()) 
 				{
  					$first_name = htmlspecialchars($row['first_name'],ENT_QUOTES);
 					$last_name = htmlspecialchars($row['last_name'],ENT_QUOTES);
  				}
  		    ?>
  		    
            <!-- Header -->
			<div id="header-wrapper">
				<div id="header" class="container">
				
					<!-- Logo -->
					
						<h1 id="logo"> <?php echo "<div style = 'margin:30px 0px;'> $first_name $last_name </div>"; ?> </h1><br>
						<h2 id ="logo"> <?php echo "<div style = 'margin:30px 0px;'> Rep Score: $reputation_score </div>"; ?> </h2>
						<p>Your Account Will Be Deleted By Choosing Continue </p>
						
                        <!-- Nav -->
                        
							<nav id="nav">
								<ul>
									<li><a class="icon fa-cog" href="userProfile.php"><span>Profile</span></a></li>
									<li><a class="icon fa-cog" href="taskStream.php"><span>Task stream</span></a></li>
									<li><a class="icon fa-retweet" href="logout.php"><span>Log out</span></a></li>
									<li><a class="icon fa-sitemap" href="CreateTask.php"><span>Create task</span></a></li>
								</ul>
							</nav>
				</div>
			</div>
			
            <!-- Main -->
				<div id="main-wrapper">
					<div id="main" class="container">
						<div id="content">
							<div class="row">
							<!-- User Created Tasks -->
								<div class="6u 12u(mobile)">
									
									<form action = "delete.php" name = "delete" method ="POST">
									
									<button type="button";">Continue</button>
																		
									</form>
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