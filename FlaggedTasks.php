<!DOCTYPE HTML>
<!-- Code written by William O'Leary -->
<?php
    // calling the database handler and the tasksorter
    include 'dbh.php';
    include 'sortList.php';
    include 'cookieCheck.php';
	//function that prints out the relevant tasks for the user 
    function taskPrinter() {
	    include 'dbh.php';
	    /*calls to the sorter file which arranges the tasks by 
		date closest to present time and figures out which tasks
		are out of date*/
		$status = 3;
		$task = sorter($status);
	    //if the variable task Not empty print the tasks
		if(!($task == NULL)) {
	        //for loop dealing with each task respectively
			for($i = 0; $i < sizeof($task);$i++) {
				$sql = "SELECT * from tasks WHERE task_id = $task[$i]";
	            $result = mysqli_query($connect,$sql);
	            $row = mysqli_fetch_assoc($result);
	            /*calling filter function to weed out any tasks created by the user
				or any tasks the user has not subscribed too*/
				
	                ?>
	                <!-- template for each task section with important information being filled 
					in by php variables as seen below, this template will be printed off as many
					times as required by the tasks-->
					<section>
					
					<br>
					
					<h2> task: <?php print($row['title']);?> </h2>
					<h3> Type: <?php print($row['task_type'])?>
					
					<br>
					
					Claim by: <?php print($row['claim_by_date'])?> </h3>
					<p>Basic info about task: <?php print($row['text_description'])?>
					
					<br>
					
					Number of pages: <?php print($row['no_of_pages'])?>
					
					<br>
					
					Number of words: <?php print($row['no_of_words'])?></p>
					<form action="taskDetails.php" method ="post">
					<input type = "hidden" name ="text" value = "<?php print($row['task_id'])?>">
					<input type="submit" value="View details">
					</form>
					</section>
          <?php 
	        } 
	    /*if they're no tasks to print then the message below will inform the user
		that there is tasks available*/
		}else {
           ?>
	        <h2>NO TASKS TO SHOW</h2>
           <?php
	    }
    }
?>



<html>
	<head>
		<title>Flagged stream</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="left-sidebar" onload ="displayTags()">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"><a href="index.html">Flagged Tasks</a></h1>
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon fa-cog" href="userProfile.php"><span>Profile</span></a></li>
									<li><a class="icon fa-cog" href="CreateTask.php"><span>Create Task</span></a></li>
									<li><a class="icon fa-retweet" href="logout.php"><span>Log out</span></a></li>
								</ul>
                            </nav>
					</div>
				</div>
               
			<!-- Main -->
				<div id="main-wrapper">
					<div id="main" class="container">
						<div class="row">
                            <!-- Content -->
									<div id="content" class="8u 12u(mobile) important(mobile)">
                                        <?php
										    taskPrinter();
										?>
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