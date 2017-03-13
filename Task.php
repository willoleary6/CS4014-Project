<?php
	include 'dbh.php';
	$TaskTitle = 	$_POST['TaskTitle'];
	$NumOfPages = 	$_POST['NumOfPages'];
	$TaskType =		$_POST['TaskType'];
	$NumOfWords = 	$_POST['NumOfWords'];
	//$Tags1 = 		$_POST['Tags1'];
	//$Tags2 = 		$_POST['Tags2'];
	//$Tags3 = 		$_POST['Tags3'];
	//$Tags4 = 		$_POST['Tags4'];
	$Description = 	$_POST['Description'];
	$ClaimBy = 		$_POST['ClaimBy'];
	$Completion =	$_POST['Completion'];
	$FileType = 	$_POST['FileType'];
	$SampleFile = 	$_POST['SampleFile'];
	$sql = "INSERT INTO tasks(Title, Text_description, Task_type, Attached_Files, NoOfPages, NoOfWords, Deadline, ClaimByDate, FileType)
			VALUES ('$TaskTitle','$Description','$TaskType','$SampleFile','$NumOfPages','$NumOfWords','$Completion','$ClaimBy','$FileType')";
	$result = mysqli_query($connect,$sql);
?>