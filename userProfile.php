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
						<p>Welcome, please view any tasks you have created or claimed here.</p>
						
                        <!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon fa-cog" href="editDetails.php"><span>Edit profile</span></a></li>
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
									
									<section>
										<h2>User Details</h2>
									<section>
									
									<?php 
										
										$sql = "SELECT * FROM user_details where user_id = '$user_id'";
  										$result = mysqli_query($connect,$sql);
  										if($row = $result->fetch_assoc())
  										{
  											$student_staff_id = $row['student_staff_id'];
  											$subject_id = $row['subject_id'];
  										}
										
										$sql = "SELECT subject_name FROM major_subjects where subject_id = '$subject_id'";
  										$result = mysqli_query($connect,$sql);
  										if($row = $result->fetch_assoc())
  										{
  											$subject_name = $row['subject_name'];
  										}
										
									?>
									
									<section>
										<h3>First Name: <?php echo "$first_name" ?>
										<br>
										Last Name: <?php echo "$last_name" ?>
										<br>
										Student/Staff ID: <?php echo "$student_staff_id" ?>
										<br>
										Email: <?php echo "$email" ?>
										<br>
										Field: <?php echo "$subject_name " ?>
										<br>
										<h3>
									<section>
										
										
									<section>
										<h2>Your Created Tasks</h2>
									</section>
									
									<?php
										// selecting all the information from the tasks the user has created
										$sql = "SELECT * from tasks WHERE user_id = $user_id";
										$result = mysqli_query($connect,$sql);
										While($row = mysqli_fetch_assoc($result))
										{
									     $id = $row['task_id'];
										 $sql = "SELECT status 
										         FROM status a 
												 JOIN taskStatus b 
												 ON a.status_id = b.status_id 
												 JOIN task_claims c 
												 ON b.claim_id = c.claim_id 
												 where c.task_id = $id ";
										$CurStat = mysqli_query($connect,$sql);
										$Status = mysqli_fetch_assoc($CurStat);
												 
									?>
											<section>
											<br>
											<h2> task: <?php print(htmlspecialchars($row['title'], ENT_QUOTES));
											 ?> </h2>
											<h3> Type: <?php print(htmlspecialchars($row['task_type'], ENT_QUOTES))?>
											<br>
											Current Status: <?php print($Status['status'])?>
											<br>
											Claim by: <?php print(htmlspecialchars($row['claim_by_date'], ENT_QUOTES))?> </h3>
											<p>Basic info about task: <?php print(htmlspecialchars($row['text_description'], ENT_QUOTES))?> 
											<br>
											Number of pages: <?php print(htmlspecialchars($row['no_of_pages'], ENT_QUOTES))?>
											<br>
											Number of words: <?php print(htmlspecialchars($row['no_of_words'], ENT_QUOTES))?><p>
											<form action="claimedTasks.php" method ="post">
											<input type = "hidden" name ="text" value = "<?php print(htmlspecialchars($row['task_id'], ENT_QUOTES))?>">
											<input type="submit" value="View details">
											</form>
											</section>
									<?php 
										}
									?>
								</div>
								
								<!-- User Claimed Tasks -->
								<div class="6u 12u(mobile)">
								
									<section>
									<h2>Your Claimed Tasks</h2>
									</section>
									
								<?php
									// selecting all the information from the tasks the user has created
									$sql = "SELECT claim_id from taskStatus WHERE status_id = 2";
									$result = mysqli_query($connect,$sql);
									$i = 0;
									While($claimIDS = $result->fetch_assoc())
									{
										$claim_ids[$i] = htmlspecialchars($claimIDS['claim_id'],ENT_QUOTES);
										$i++;
									}
								    for($b = 0; $b < sizeof($claim_ids);$b++)
								    {
										$sql = "SELECT task_id from task_claims Where user_id = '$user_id' AND claim_id = '$claim_ids[$b]'";
										$result = mysqli_query($connect,$sql);
										$row = $result->fetch_assoc();
										$taskClaim_ids[$b] = htmlspecialchars($row['task_id'],ENT_QUOTES);
									}
									for($n = 0; $n < sizeof($taskClaim_ids); $n++)
									{
										$sql = "SELECT * FROM tasks WHERE task_id = '$taskClaim_ids[$n]'";
										$result = mysqli_query($connect,$sql);
										While($row = mysqli_fetch_assoc($result))
										{
								        $id = $row['task_id'];
										$sql = "SELECT status 
										         FROM status a 
												 JOIN taskStatus b 
												 ON a.status_id = b.status_id 
												 JOIN task_claims c 
												 ON b.claim_id = c.claim_id 
												 where c.task_id = $id ";
										$CurStat = mysqli_query($connect,$sql);
										$Status = mysqli_fetch_assoc($CurStat);
								 
								?>
											<section>
											<br>
											<h2> task: <?php print(htmlspecialchars($row['title'], ENT_QUOTES));
											 ?> </h2>
											Current Status: <?php print($Status['status'])?>
											<br>
											<h3> Type: <?php print(htmlspecialchars($row['task_type'], ENT_QUOTES))?>
											<br>
											Claim by: <?php print(htmlspecialchars($row['claim_by_date'], ENT_QUOTES))?> </h3>
											<p>Basic info about task: <?php print(htmlspecialchars($row['text_description'], ENT_QUOTES))?> 
											<br>
											Number of pages: <?php print(htmlspecialchars($row['no_of_pages'], ENT_QUOTES))?>
											<br>
											Number of words: <?php print(htmlspecialchars($row['no_of_words'], ENT_QUOTES))?><p>
											<form action="claimedTasks.php" method ="post">
											<input type = "hidden" name ="text" value = "<?php print(htmlspecialchars($row['task_id'], ENT_QUOTES))?>">
											<input type="submit" value="View details">
											</form>
											</section>
								<?php	
										}
									}
								?>
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