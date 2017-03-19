<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Left Sidebar - Strongly Typed by HTML5 UP</title>
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
							<h1 id="logo"><a href="index.html">Task Stream</a></h1>
							

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
                                                  <form action="userProfile.php">
							                      <input type="submit" value="My profile">
							                      </form>
												</li>
												<li>
												<form action="CreateTask.html">
							                      <input type="submit" value="Create task">
							                      </form>
												</li>
												<li>
												<form action="index.php">
							                      <input type="submit" value="Log out">
							                      </form>
												</li>
												
											</ul>
										</section>

									

								</div>

							<!-- Content -->
								<div id="content" class="8u 12u(mobile) important(mobile)">
                                                 <?php
												  for($i = 0; $i < 10; $i++){
												 ?>
													
												<section>
													<br>
													<h2> task <?php $display = $i + 1;
													echo "$display"; ?> </h2>
													<p>Basic info about task <?php echo "$display"; ?> </p>
													<form action="index.php">
							                        <input type="submit" value="View details">
							                        </form>
													</section>

												  <?php } ?>
									
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