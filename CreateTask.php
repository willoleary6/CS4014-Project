<!DOCTYPE HTML>
<!-- code written by Aidan Cleer -->
<?php 
    include 'cookieCheck.php';
?>
<script type='text/javascript'>
function addFields(){
            // Number of inputs to create
            var number = document.getElementById("tag").value;
			if(number > 0 && number < 5)
			{
				var container = document.getElementById("container");
				// Clear previous contents of the container
				while (container.hasChildNodes()) {
					container.removeChild(container.lastChild);
				}
				for (i=0;i<number;i++){
					// Append a node with a random text
					container.appendChild(document.createTextNode("Tag " + (i+1)));
					// Create an <input> element, set its type and name attributes
					var input = document.createElement("input");
					input.type = "text";
					input.name = "Tags" + (i + 1);
					container.appendChild(input);
					// Append a line break 
					container.appendChild(document.createElement("br"));
				}
			}
        }
    </script>
<html>
	<head>
		<title>Create task</title>
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
							<h1 id="logo"><a>Create Task</a></h1>
							<p>Create that Task Son!!!!</p>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon fa-home" href="task stream.php"><span>Task Stream</span></a></li>
									<li>
										<a href="#" class="icon fa-bar-chart-o"><span>Dropdown</span></a>
										<ul>
											<li><a href="userProfile.php">User Profile</a></li>
											<li><a href="#">....</a></li>
											<li><a href="#">Etiam dolore nisl</a></li>
											
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
                           <!-- Users fill out this form when they wish to create a task -->
						   <form action = "Task.php" method ="POST" enctype="multipart/form-data">
						    
							    Task Title:<br>
								<input type="text" name="TaskTitle" required><br>
							
								Enter Type of task:<br>
								<input type="text" name="TaskType" required><br>
							
								Number of pages in document:<br>
								<input type="text" name="NumOfPages" required><br>
							
								Number of words in document:<br>
								<input type="text" name="NumOfWords" required><br>
							
								Enter number of tags you would like to add(Max: 4):<br>
								<input type="number" id="tag" name="Tags" min="0" max="4" ><br>
								<div id="container">
									<button href="#" id="filldetails" onclick="addFields()">Add Tags</button>	
								</div>
								<br>
							
								Description:<br>
								<textarea type="textarea" name="Description" rows="5" required></textarea><br>	
                
								Enter Claim By Deadline:<br>
								<input type="datetime-local" name="ClaimBy" min="2017-03-01"><br>
								<br>
							
								Enter Completion Deadline:<br>
								<input type="datetime-local" name="Completion" min="2017-03-01"><br>
								<br>
							
								Please Specify file type eg(.docx,.pdf):<br>
								<input type="text" name="FileType" required><br>
								<br>
                            
								Choose Sample File
								<input id="fileToUpload" name="fileToUpload" type="file" required><br>
						
								<br>
								<!-- On submission the details will be sent to Task.php for processing-->
								<input type="submit" value="Submit">
								<p>&nbsp;</p>
							</form>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<div id="footer-wrapper">
					<div id="footer" class="container">
						<header>
							<h2>Questions or comments? <strong>Get in touch:</strong></h2>
						</header>
						<div class="row">
							<div class="6u 12u(mobile)">
								<section>
									<form method="post" action="#">
										<div class="row 50%">
											<div class="6u 12u(mobile)">
												<input name="name" placeholder="Name" type="text" />
											</div>
											<div class="6u 12u(mobile)">
												<input name="email" placeholder="Email" type="text" />
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<textarea name="message" placeholder="Message"></textarea>
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<a href="#" class="form-button-submit button icon fa-envelope">Send Message</a>
											</div>
										</div>
									</form>
								</section>
							</div>
							<div class="6u 12u(mobile)">
								<section>
									<p>Erat lorem ipsum veroeros consequat magna tempus lorem ipsum consequat Phaselamet
									mollis tortor congue. Sed quis mauris sit amet magna accumsan tristique. Curabitur
									leo nibh, rutrum eu malesuada.</p>
									<div class="row">
										<div class="6u 12u(mobile)">
											<ul class="icons">
												<li class="icon fa-home">
													1234 Somewhere Road<br />
													Nashville, TN 00000<br />
													USA
												</li>
												<li class="icon fa-phone">
													(000) 000-0000
												</li>
												<li class="icon fa-envelope">
													<a href="#">info@untitled.tld</a>
												</li>
											</ul>
										</div>
										<div class="6u 12u(mobile)">
											<ul class="icons">
												<li class="icon fa-twitter">
													<a href="#">@untitled-tld</a>
												</li>
												<li class="icon fa-instagram">
													<a href="#">instagram.com/untitled-tld</a>
												</li>
												<li class="icon fa-dribbble">
													<a href="#">dribbble.com/untitled-tld</a>
												</li>
												<li class="icon fa-facebook">
													<a href="#">facebook.com/untitled-tld</a>
												</li>
											</ul>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
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