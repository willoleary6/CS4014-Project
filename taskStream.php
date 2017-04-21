<!DOCTYPE HTML>
<!-- Code written by William O'Leary -->
<?php
    // calling the database handler and the tasksorter
    include 'dbh.php';
    include 'sortList.php';
    include 'cookieCheck.php';
	

    // function to find the text of each tag id provided
    function findTag($tag_id) {
        include 'dbh.php';
	    $sql = "SELECT * from tags WHERE tag_id = $tag_id";
	    $resultTag = mysqli_query($connect,$sql);
	    $tagRow = mysqli_fetch_assoc($resultTag);
	    return $tagRow["text"];
	}

    /* function that checks both if the tasks were not created by the user and 
    if the tags the user has subscribed to are in each 
    of the unclaimed tasks and if so will print them*/ 	
    function filter($row) {
       include 'dbh.php';
       if($row['user_id'] == $_COOKIE['userID']) {
	       return false;
        }
        $tagList = array("tag_1","tag_2","tag_3","tag_4");
        // getting the text of each of the tags (only tag ids were provided)
        for($k = 0; $k < sizeof($tagList);$k++) {
	        $tagList[$k] = findTag($row[$tagList[$k]]);
        }
        $cookie_name = 'tags';
        // check if the cookie "tags" has been set, if so then the filter will go to work
        if(!isset($_COOKIE[$cookie_name])) {
            return true;
	    }else {
		    //split the tags into an array with ","
		    $subscribedTags =  explode(",", $_COOKIE[$cookie_name]);
		    for($i = 0; $i < sizeof($subscribedTags);$i++) {
	            for($j = 0; $j < sizeof($tagList); $j++) {
		            //if one of the tasks tags matches a subscribed tag return true
				    if($subscribedTags[$i] === $tagList[$j]) {
				        return true;
				    }
			    }
		    }
		    //if there is no match, return false
		    return false;
	    }	
    }
    //function that prints out the relevant tasks for the user 
    function taskPrinter() {
	    include 'dbh.php';
	    /*calls to the sorter file which arranges the tasks by 
		date closest to present time and figures out which tasks
		are out of date*/
		$status = 1;
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
				if(filter($row)) {
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
          <?php }
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
<script>
//javascript to clear the subscribed list
function clear() {
	document.cookie = "tags=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    //reload page once cookie is cleared
	location.reload();
}
//javascript to show to the user all the tags he/she has subscribed too
function displayTags() {
	var tags = readCookie('tags');
	if(tags) {
	
	document.getElementById("ClearBtn").style.visibility = "visible";
	var array = tags.split(",");
	var container = document.getElementById("container");
	for (i=0;i<array.length;i++) {
					// Append a node with a tag text
					container.appendChild(document.createTextNode(array[i]));
			        // Append a line break 
					container.appendChild(document.createElement("br"));
		}
	}
	else {
		//if the user isn't subscribed to any tags dont show the clear button
		document.getElementById("ClearBtn").style.visibility = "hidden";
	}
 
}

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
//javascript to add a tag to the subscribed list
function addTag() {
	//get a current time stamp for the expirey date
	var d = new Date();
    d.setTime(d.getTime() + (3*365*24*60*60*1000));
	//expires 3 years from now
	var expires = "expires ="+ d.toGMTString();
	//get the tag the user has just subscribed too
	var newTag = document.getElementById("tag").value;
	var tags = readCookie('tags'); 
	//if the cookie "tags" is not set, create it and add the users tag too it
	if(!tags) {
		document.cookie = "tags = "+newTag+",;"+expires+";";
	    location.reload();
	}else {
	    //otherwise concat the the new tag to the rest of the tags
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

							<!-- Sidebar -->
								<div id="sidebar" class="4u 12u(mobile)">
                                    <section>
                                        <p> Want to see tasks more personalised to you're experience? <br>
									     Subscribe to tasks 
									    <form action = "JavaScript:addTag()">
									       Filter:
										   
										   <br>
										   
										   <input list="fields" id = "tag" name="tags" required><br>
									       <datalist id="fields">
									       <?php
										        //php to get a list of all the tags in the database
												$numberOfFields = 0;
												$sql = "SELECT text FROM `tags`";
												$result = mysqli_query($connect,$sql);
												$numberOfFields = mysqli_num_rows($result);						  
												$names = mysqli_fetch_array($result);
												for($i = 0; $i <$numberOfFields;$i++) {	
                                            ?>
									                <!--Dropdown menu for the user to select from containing all tags-->
									                <option value ="<?php echo $names[0]; ?>" >
                                                    <?php  $names = mysqli_fetch_array($result); 
											    }
										            ?>
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