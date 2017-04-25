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
							<p>Create a task to be peer reviewed</p>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon fa-home" href="taskStream.php"><span>Task Stream</span></a></li>
									<li><a class="icon fa-cog" href="userProfile.php"><span>Profile</span></a></li>
									<li><a class="icon fa-retweet" href="logout.php"><span>Log out</span></a></li>
									
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
								<input type="number" name="NumOfPages" required><br>
							
								Number of words in document:<br>
								<input type="number" name="NumOfWords" required><br>
							
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