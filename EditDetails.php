<!DOCTYPE HTML>
<!-- Code written by Bernard Steemers - 15182819 -->
<script type="text/javascript">
function checkForm(form) {
    // validation fails if the input is blank
  	if(form.inputfield.value == "") {
        alert("Error: Input is empty!");
		form.inputfield.focus();
		return false;
   	}  
	// regular expression to match only alphanumeric characters and spaces
    var re = /^[\w ]+$/;
    // validation fails if the input doesn't match our regular expression
   	if(!re.test(form.inputfield.value)) {
    	alert("Error: Input contains invalid characters!");
        form.inputfield.focus();
     	return false;
   	}
    // validation was successful
    return true;
}
</script>
<html>
	<head>
		<title>Edit Details</title>
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
 				//getting the info of the user from the cookies
				$email = $_COOKIE['email'];
	 			$password = $_COOKIE['password'];
 				$sql = "SELECT * FROM user_details Where email = '$email' AND password = '$password'";
 				$comments = mysqli_query($connect, $sql);
 				//setting the variables from the database
				if($row = $comments->fetch_assoc()) {	
  					$first_name = $row['first_name'];
 					$last_name = $row['last_name'];
  					$student_staff_id = $row['student_staff_id'];
  					$subject_id = $row['subject_id'];
  					$reputation_score = $row['reputation_score'];
  				}
  			?>

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"> <?php echo "<div style = 'margin:30px 0px;'> $first_name $last_name </div>"; ?> </h1><br>
							<h2 id ="logo"> <?php echo "<div style = 'margin:30px 0px;'> Rep Score: $reputation_score </div>"; ?> </h2>
							<p>Once Edited You Will Be Asked to Login With New Details</p>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon fa-cog" href="userProfile.php"><span>Profile</span></a></li>
									<li><a class="icon fa-cog" href="task stream.php"><span>Task stream</span></a></li>
									<li><a class="icon fa-retweet" href="logout.php"><span>Log out</span></a></li>
									<li><a class="icon fa-sitemap" href="CreateTask.php"><span>Create task</span></a></li>
								</ul>
							</nav>

					</div>
				</div>

			<!-- Main -->
				<div id="main-wrapper">
					<div id="main" class="container">
						<div id="content">
						
							
								<!-- input fields for the user to edit their information -->
                                <form action = "editProcess.php" method ="POST">
										Firstname:<?php echo ' '.$first_name;?><br>
										<input type="text" name="EditFN" required><br>
										LastName:<?php echo ' '.$last_name;?><br>
										<input type="text" name="EditLN" required><br>
										Student/Staff ID number:<?php echo ' '.$student_staff_id;?><br>
										<input type="number" name="EditSTID" required><br>
										E-mail:<?php echo ' '.$email;?><br>
										<input type="email" name="EditEmail" autocomplete="off" required>
										<?php if (isset($_GET['EmailFail'])) { ?>
										<b>*Must have the domain 'studentmail.ul.ie' or 'ul.ie'</b>
										<?php } ?>
										<br>
										Field:<br>
										<input list="fields" name="browser" required><br>
										<datalist id="fields">
										<?php
											include 'dbh.php';
										    $numberOfFields = 0;
											$sql = "SELECT subject_name FROM `major_subjects`";
											$result = mysqli_query($connect,$sql);
											$numberOfFields = mysqli_num_rows($result);						  
											$names = mysqli_fetch_array($result);
                                            for($i = 0; $i <$numberOfFields;$i++) {	
										?>
										        <option value ="<?php echo $names[0]; ?>" >
										        <?php  $names = mysqli_fetch_array($result); }?>
										        </datalist>
										        Password:<br>
										        <input type="password" name="EditPassword" required><br>
										        Confirm Password:<br>
										        <input type="password" name="cpassword" required><br>
										         <br>
										            
												<input type="submit" value="Submit" name="submit"><br>
										     
										        <p>&nbsp;</p>
									</form>
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