<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
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
					$id = $_POST['id'];
  						?>

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"> TaskCompletion </h1><br>
							<p>.</p>

					</div>
				</div>

			<!-- Main -->
				<div id="main-wrapper">
					<div id="main" class="container">
						<div id="content">
												<p>&nbsp;</p>
							<!-- User Tasks -->
								<div id="content" class="8u 12u(mobile) important(mobile)">
								<form action="comp&cancel.php" method ="post">
								Description of work done:<br>
                                <textarea type="textarea" name="Description" rows="5" required></textarea><br>
								<input type = "hidden" name = "identifier" value = "1">
								<input type = "hidden" name = "task_id" value = "<?php print $id?>">
								<input type="submit" value="Submit">
							    </form>
								</section>	
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