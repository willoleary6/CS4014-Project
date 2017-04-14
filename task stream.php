<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
include 'dbh.php';
include 'sortList.php';
$sql = "SELECT claim_id FROM `taskStatus` WHERE status_id = '1'";
$result = mysqli_query($connect,$sql);
$index = 0;
if(mysqli_num_rows($result) > 0 ){
while($array = mysqli_fetch_array($result)){
   $claims[$index] = $array['claim_id'];
   $index++;
 }
}
function findTag($tag_id) {
	include 'dbh.php';
	$sql = "SELECT * from tags WHERE tag_id = $tag_id";
	$resultTag = mysqli_query($connect,$sql);
	$tagRow = mysqli_fetch_assoc($resultTag);
	return $tagRow["text"];
	}
function filter($row){
include 'dbh.php';
$template = array("tag_1","tag_2","tag_3","tag_4");
for($k = 0; $k < sizeof($template);$k++){
	 $template[$k] = findTag($row[$template[$k]]);
}
$cookie_name = 'tags';
if(!isset($_COOKIE[$cookie_name])) {
    return true;
}else{
	$tagsArray =  explode(",", $_COOKIE[$cookie_name]);
    for($i = 0; $i < sizeof($tagsArray);$i++){
		for($j = 0; $j < sizeof($template); $j++){
			if($tagsArray[$i] === $template[$j]){
				return true;
			}
		}
	}
	return false;
 }	
}
?>
<script>
function clear()
{
	document.cookie = "tags=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    location.reload();
}
function displayTags()
{
	var tags = readCookie('tags');
	if(tags){
	document.getElementById("ClearBtn").style.visibility = "visible";
	var array = tags.split(",");
	var container = document.getElementById("container");
	for (i=0;i<array.length;i++){
					// Append a node with a tag text
					container.appendChild(document.createTextNode(array[i]));
			        // Append a line break 
					container.appendChild(document.createElement("br"));
				}
	}
	else{
		document.getElementById("ClearBtn").style.visibility = "hidden";
	}
 
}

// copied readCookie from stack overflow
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

function addTag()
{
	
	var d = new Date();
    d.setTime(d.getTime() + (3*365*24*60*60*1000));
	var expires = "expires ="+ d.toGMTString();
	var newTag = document.getElementById("tag").value;
	var tags = readCookie('tags'); 
	if(!tags)
	{
		document.cookie = "tags = "+newTag+","+";"+expires+";";
	    tags = readCookie('tags'); 
	    location.reload();
	}else{
	 tags = tags+","+newTag;
     document.cookie = "tags = "+tags+";"+expires+";";
	 location.reload();	
  
	}
}
</script>
<html>
	<head>
		<title>Task stream</title>
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
												<form action="CreateTask.php">
							                      <input type="submit" value="Create task">
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
                                       <p> Want to see tasks more personalised to you're experience? <br>
									     Subscribe to tasks 
									   
									   <form action = "JavaScript:addTag()">
									   Filter:<br>
									   <input list="fields" id = "tag" name="tags" required><br>
									   
									   <datalist id="fields">
									   <?php
									   $numberOfFields = 0;
									   $sql = "SELECT text FROM `tags`";
									   $result = mysqli_query($connect,$sql);
                                                          $numberOfFields = mysqli_num_rows($result);						  
									   $names = mysqli_fetch_array($result);
                                                          for($i = 0; $i <$numberOfFields;$i++){	
                                                           ?>
									   <option value ="<?php echo $names[0]; ?>" >
                                                          <?php  $names = mysqli_fetch_array($result); }?>
									  </datalist>
									  
									   <input type="submit" value="Subscribe">	
							           <div id="container">
									    <p> List of subscribed tags</p>
									   </div>
									  </form>
									   <form action = "JavaScript:clear()">
									    <br>
					                   <input type="submit" id = "ClearBtn" value="Clear">	
									    </form>
									  
                                     </section>
								    
							</div>
							<!-- Content -->
								<div id="content" class="8u 12u(mobile) important(mobile)">
                                                 <?php
												  $task = sorter();
												  for($i = 0; $i < sizeof($task);$i++){
												  $sql = "SELECT * from tasks WHERE task_id = $task[$i]";
												  $result = mysqli_query($connect,$sql);
												  $row = mysqli_fetch_assoc($result);
												  
												  if(filter($row)){
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
													<input type = "hidden" name ="text" value = "<?php print($row['task_id'])?>">
							                        <input type="submit" value="View details">
							                        </form>
													</section>

												   <?php }
												   } ?>
									
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