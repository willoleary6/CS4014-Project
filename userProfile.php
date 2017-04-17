<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
	Bernard Steemers - 15182819
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
 					include 'cookieCheck.php';
 					
 					$email = $_COOKIE['email'];
	 				$password = $_COOKIE['password'];
 					
 					$sql = "SELECT * FROM user_details Where email = '$email' AND password = '$password'";
 					$comments = mysqli_query($connect, $sql);
 					
 					while($row = $comments->fetch_assoc()) 
 					{
  						$user_id = htmlspecialchars($row['user_id'],ENT_QUOTES);
  						$first_name = htmlspecialchars($row['first_name'],ENT_QUOTES);
 						$last_name = htmlspecialchars($row['last_name'],ENT_QUOTES);
  						$student_staff_id = htmlspecialchars($row['student_staff_id'],ENT_QUOTES);
  						$email = htmlspecialchars($row['email'],ENT_QUOTES);
  						$subject_id = htmlspecialchars($row['subject_id'],ENT_QUOTES);
  						$password = htmlspecialchars($row['password'],ENT_QUOTES);
  						$reputation_score = htmlspecialchars($row['reputation_score'],ENT_QUOTES);
  					}
  						
  						//$sql = "SELECT subject_name FROM 'major_subjects' Where subject_id = '$subject_id'";
  						$result = mysqli_query($connect, $sql);
  						$row = $comments->fetch_assoc();
  						
  						$subject_name = $row['subject_name'];
  						$subject_name = htmlspecialchars($row['subject_name'],ENT_QUOTES);
  						
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
									<li><a class="icon fa-cog" href="Edit.php"><span>Edit profile</span></a></li>
									<li><a class="icon fa-cog" href="task stream.php"><span>Task stream</span></a></li>
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
							
							<?php
  						
  						echo "  <div style='margin:30px 0px;'>
   								 		User ID: $user_id<br /><br >
   								 		User Name: $first_name $last_name<br />
   								 		Student/Staff ID: $student_staff_id<br >
										Email: $email<br />
										Subject: $subject_name<br />
										User Password: $password<br />
								</div>";
 							?>
												<p>&nbsp;</p>
							<!-- User Tasks -->
								<div id="content" class="8u 12u(mobile) important(mobile)">
								<h2>Your Created Tasks</h2>
                                <?php
								$sql = "SELECT * from tasks WHERE user_id = $user_id";
								$result = mysqli_query($connect,$sql);
								While($row = mysqli_fetch_assoc($result))
								{
								?>
								<section>
                                <br>
								<h2> task: <?php print($row['title']);
                                ?> </h2>
								<h3> Type: <?php print($row['task_type'])?>
								<br>
								Claim by: <?php print($row['claim_by_date'])?> </h3>
								<p>Basic info about task: <?php print($row['text_description'])?> 
								<br>
								Number of pages: <?php print($row['no_of_pages'])?>
								<br>
								Number of words: <?php print($row['no_of_words'])?><p>
								<form action="taskDetails.php" method ="post">
								<input type = "hidden" name ="text" value = "<?php print($row['user_id'])?>">
							    <input type="submit" value="View details">
							    </form>
								</section>
								<?php 
								}?>
									
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