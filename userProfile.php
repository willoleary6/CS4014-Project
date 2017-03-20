<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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
 					
 					$sql = "SELECT * FROM user_details Where user_id = 1";
 					$comments = mysqli_query($connect, $sql);
 					
 					while($row = $comments->fetch_assoc()) 
 					{
 						$user_id = $row['user_id'];
 						$first_name = $row['first_name'];
 						//$student/staff_id = $row['student/staff_id'];
  						$email = $row['email'];
  						$subject_id = $row['subject_id'];
  						$password = $row['password'];
  						$reputation_score = $row['reputation_score'];

  						
  						$user_id = htmlspecialchars($row['user_id'],ENT_QUOTES);
  						$first_name = htmlspecialchars($row['first_name'],ENT_QUOTES);
 						$last_name = htmlspecialchars($row['last_name'],ENT_QUOTES);
  						//$student/staff_id = htmlspecialchars($row['student/staff_id'],ENT_QUOTES);
  						$email = htmlspecialchars($row['email'],ENT_QUOTES);
  						$subject_id = htmlspecialchars($row['subject_id'],ENT_QUOTES);
  						$password = htmlspecialchars($row['password'],ENT_QUOTES);
  						$reputation_score = htmlspecialchars($row['reputation_score'],ENT_QUOTES);
  						}
  						?>

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"> <?php echo "<div style = 'margin:30px 0px;'> $first_name $last_name </div>"; ?> </h1><br>
							<h2 id ="logo"> <?php echo "<div style = 'margin:30px 0px;'> Rep Score: $reputation_score </div>"; ?> </h2>
							<p>Welcome, please view any tasks you have created or claimed here.</p>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon fa-cog" href="editProfile.html"><span>Edit profile</span></a></li>
									<li><a class="icon fa-retweet" href="index.php"><span>Log out</span></a></li>
									<li><a class="icon fa-sitemap" href="CreateTask.html"><span>Create task</span></a></li>
								</ul>
							</nav>

					</div>
				</div>

			<!-- Main -->
				<div id="main-wrapper">
					<div id="main" class="container">
						<div id="content">
							
							<?php
  						
  						echo "  <div style='margin:30px 0px;'>
   								 		User ID: $user_id<br />
   								 		User Name: $first_name $last_name<br />
										email: $email<br />
										subject_id: $subject_id<br />
										password: $password<br />
								</div>";
								 					
 					?>
 					
												<p>&nbsp;</p>
						</div>
					</div>
				</div>
				
				

			<!-- Footer -->
				<div id="footer-wrapper">
					<div id="footer" class="container">
						
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