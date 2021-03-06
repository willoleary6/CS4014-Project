<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	include 'dbh.php';
	$id = $_POST['text'];
	$sql = "SELECT * from tasks WHERE task_id = $id";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
	
	function findTag($tag_id) {
	include 'dbh.php';
	$sql = "SELECT * from tags WHERE tag_id = $tag_id";
	$resultTag = mysqli_query($connect,$sql);
	$tagRow = mysqli_fetch_assoc($resultTag);
	print($tagRow['text']);
	}
?>
<script>
/* taken readCookie from stack overflow
http://stackoverflow.com/questions/10730362/get-cookie-by-name*/
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function isMod() {
	var rep = readCookie('RepScore');
	if(rep < 40) {
	var btn1 = document.getElementById('mod');
    btn1.style.visibility = 'hidden';
	
	}
}
</script>
<html>
	<head>
		<title><?php print($row['title']);?></title>
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
							<h1 id="logo"><a><?php print($row['title'])?></a></h1>
							

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
                                                  <form action="taskStream.php">
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
									 <section>
												 <form action="modFunctions.php" id = "mod" method = "POST">
                                                 <h2>MODERATOR FUNCTIONS</h2>
												 <input type="checkbox" id = "unPub" name ="unpublish" value=<?php echo 'unpublish,'.$row['task_id']?>> Unpublish Task<br>
                                                 <input type="checkbox" id = "ban" name ="ban" value=<?php echo 'ban,'.$row['user_id']?>>Ban User<br>
                                                 <input type="submit" value="Submit">
												 </form>
                                         </section>

									

								</div>

							<!-- Content -->
								<div id="content" class="8u 12u(mobile) important(mobile)">
                                                 
													<section>
													<h3>
													Type: <?php print($row['task_type'])?>
													<br>
													Claim by: <?php print($row['claim_by_date'])?> 
													<br>
													DeadLine Date: <?php print($row['Deadline'])?></h3>
													<p>Description: <?php print($row['text_description'])?> 
													<br>
													Number of pages: <?php print($row['no_of_pages'])?>
													<br>
													Number of words: <?php print($row['no_of_words'])?>
													<br>
													Tag no.1: <?php if($row['tag_1'] != "1")
																	findTag($row['tag_1']);
																	else print("No associated tag");?>
													<br>
													Tag no.2: <?php if($row['tag_2'] != "1")
																	findTag($row['tag_2']);
																	else print("No associated tag");?>
													<br>
													Tag no.3: <?php if($row['tag_3'] != "1")
																	findTag($row['tag_3']);
																	else print("No associated tag");?>
													<br>
													Tag no.4: <?php if($row['tag_4'] != "1")
																	findTag($row['tag_4']);
																	else print("No associated tag");?>
													<br>
													File Type: <?php print($row['file_type'])?><p>
											<ul class="divided">
												<li>
                                                  <form action="fileDownload.php" method = "POST">
												  <input type = "hidden" name = "download" value = "<?php print($row['task_id'])?>">
							                      <input type="submit" value="Download Preview">
							                      </form>
												</li>
												<li>
												<form action="emailTemplate.php" method = "POST">
												  <input type = "hidden" name = "email" value = "<?php print($row['task_id'])?>">
							                      <input type="submit" value="Full File Request">
							                    </form>
												</li>
												<li>
												<form action="completion.php" method ="POST">
												<!--the 1 is to tell the php script the task is to marked as complete -->
												  <input type = "hidden" name = "id" value = "<?php print($row['task_id'])?>">
							                      <input type="submit" value="Mark as Complete">
							                      </form>
												</li>
												<li>
												<form action="comp&cancel.php">
												  <!--the 2 is to tell the php script the task is to canceled -->
												  <input type = "hidden" name = "identifier" value = "2">
												  <input type = "hidden" name = "task_id" value = "<?php print($row['task_id'])?>">
							                      <input type="submit" value="Cancel task">
							                      </form>
												</li>
											</ul>
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