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
	$creator = creatorDetails($row['user_id']);
	
	function findTag($tag_id) {
	include 'dbh.php';
	$sql = "SELECT * from tags WHERE tag_id = $tag_id";
	$resultTag = mysqli_query($connect,$sql);
	$tagRow = mysqli_fetch_assoc($resultTag);
	print(htmlspecialchars($tagRow['text'], ENT_QUOTES));
	}
	function creatorDetails($idNumber) {
		include 'dbh.php';
		$sql = "SELECT user_id, first_name, last_name from user_details WHERE user_id = $idNumber";
		$result = mysqli_query($connect,$sql);
		$creator = mysqli_fetch_assoc($result);
		return $creator;
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
		<title><?php print(htmlspecialchars($row['title'], ENT_QUOTES));?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="left-sidebar" onload ="isMod()">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"><a><?php print(htmlspecialchars($row['title'], ENT_QUOTES));?></a></h1>
							<br>
							<h2>Published by: <?php print(htmlspecialchars($creator['first_name'], ENT_QUOTES).' '.htmlspecialchars($creator['last_name'], ENT_QUOTES))?></h2>

						<!-- Nav -->
							<nav id="nav">
								<nav id="nav">
								<ul>
									<li><a class="icon fa-cog" href="userProfile.php"><span>Profile</span></a></li>
									<li><a class="icon fa-cog" href="taskStream.php"><span>Task stream</span></a></li>
									<li><a class="icon fa-retweet" href="logout.php"><span>Log out</span></a></li>
									<li><a class="icon fa-sitemap" href="CreateTask.php"><span>Create task</span></a></li>
								</ul>
							</nav>

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
							                      <input type="submit" value="Download Preview">
							                      </form>
												</li>
												<li>
												<form action="Claim.php" method = "POST">
												  <input type = "hidden" name = "claim" value = "<?php print($row['task_id'])?>">
							                      <input type="submit" value="Claim Task">
							                    </form>
												</li>
												<li>
												<form action="flag.php" method = "POST">
												  <input type = "hidden" name = "flag" value = "<?php print($row['task_id'])?>">
							                      <input type="submit" value="Flag Task">
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
													Type: <?php print(htmlspecialchars($row['task_type'], ENT_QUOTES))?>
													<br>
													Claim by: <?php print(htmlspecialchars($row['claim_by_date'], ENT_QUOTES))?> 
													<br>
													DeadLine Date: <?php print(htmlspecialchars($row['Deadline'], ENT_QUOTES))?></h3>
													<p>Description: <?php print(htmlspecialchars($row['text_description'], ENT_QUOTES))?> 
													<br>
													Number of pages: <?php print(htmlspecialchars($row['no_of_pages'], ENT_QUOTES))?>
													<br>
													Number of words: <?php print(htmlspecialchars($row['no_of_words'], ENT_QUOTES))?>
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
													File Type: <?php print(htmlspecialchars($row['file_type'], ENT_QUOTES))?><p>
											
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