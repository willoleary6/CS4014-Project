<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	include 'dbh.php';
	$id = $_POST['email'];
	$sql = "SELECT * from tasks WHERE task_id = $id";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
	$taskTitle = $row['title'];
	$user_id = $row['user_id'];
	$sql = "SELECT * from user_details WHERE user_id = $user_id";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
	$first_name_owner = $row['first_name'];
	$last_name_owner = $row['last_name'];
	$sql = "SELECT * from user_details WHERE email = '".$_COOKIE['email']."'";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
	$first_name_claimaint = $row['first_name'];
	$last_name_claimaint = $row['last_name'];
?>
<html>
	<head>
		<title>Email Template</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="left-sidebar">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"><a>Email Template</a></h1>
							

						<!-- Nav -->
							<nav id="nav">
								<ul>

							</nav>

					</div>
				</div>

			<!-- Main -->
				<div id="main-wrapper">
					<div id="main" class="container">
						<div class="row">

							<!-- Sidebar -->
								<div id="sidebar" class="4u 12u(mobile)">

									<!-- Excerpts -->
										<section>
											<ul class="divided">
												<li>
                                                  <form action="task stream.php">
							                      <input type="submit" value="Back to task Stream">
							                      </form>
												</li>
												<li>
                                                  <form action="userProfile.php">
							                      <input type="submit" value="My profile">
							                      </form>
												</li>
												<li>
												<form action="CreateTask.php">
							                      <input type="submit" value="Create Task">
							                      </form>
												</li>
												<li>
												<form action="logout.php">
							                      <input type="submit" value="Log out">
							                      </form>
												</li>
												
											</ul>
										</section>

									

								</div>

							<!-- Content -->
								<div id="content" class="8u 12u(mobile) important(mobile)">
                                                 
													<section>
														<form action="userProfile.php" method = "POST">
														<textarea type="textarea" name="Description" rows="5" required>
Hello <?php print $first_name_owner?> <?php print $last_name_owner?>,
I would like to request a download of the full file for <?php print $taskTitle?>
as i have claimed the task and would like a better understanding of it.
regards <?php print $first_name_claimaint?> <?php print $last_name_claimaint?>
														</textarea><br>
														<input type="submit" value="send">
													</section>												  
									
								</div>

						</div>
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