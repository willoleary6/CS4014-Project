<?php
	include 'dbh.php';
	$TaskTitle = 	$_POST['TaskTitle'];
	$NumOfPages = 	$_POST['NumOfPages'];
	$TaskType =		$_POST['TaskType'];
	$NumOfWords = 	$_POST['NumOfWords'];
	$tags = 		$_POST['Tags'];
	if($tags >= 1)
		$Tags1 = 		$_POST['Tags1'];
	if($tags >= 2)
		$Tags2 = 		$_POST['Tags2'];
	if($tags >= 3)
		$Tags3 = 		$_POST['Tags3'];
	if($tags == 4)
		$Tags4 = 		$_POST['Tags4'];
	$Description = 	$_POST['Description'];
	$ClaimBy = 		$_POST['ClaimBy'];
	$Completion =	$_POST['Completion'];
	$FileType = 	$_POST['FileType'];
	$SampleFile = 	$_POST['SampleFile'];
	$sql = "INSERT INTO tasks(Title, Text_description, Task_type, Attached_Files, NoOfPages, NoOfWords, Deadline, ClaimByDate, FileType)
			VALUES ('$TaskTitle','$Description','$TaskType','$SampleFile','$NumOfPages','$NumOfWords','$Completion','$ClaimBy','$FileType')";
	if($tags >= 1)
		$sql = "INSERT INTO Tags(Tag_text)
				VALUES ('£Tags1')";
	if($tags >= 2)
		$sql = "INSERT INTO Tags(Tag_text)
				VALUES ('£Tags2')";
	if($tags >= 3)
		$sql = "INSERT INTO Tags(Tag_text)
				VALUES ('£Tags3')";
	if($tags == 4)
		$sql = "INSERT INTO Tags(Tag_text)
				VALUES ('£Tags4')";
				
	$result = mysqli_query($connect,$sql);
?>