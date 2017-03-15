<?php
	include 'dbh.php';
	$TaskTitle = 	$_POST['TaskTitle'];
	$NumOfPages = 	$_POST['NumOfPages'];
	$TaskType =		$_POST['TaskType'];
	$NumOfWords = 	$_POST['NumOfWords'];
	$tags = 		$_POST['Tags'];
	$Description = 	$_POST['Description'];
	$ClaimBy = 		$_POST['ClaimBy'];
	$Completion =	$_POST['Completion'];
	$FileType = 	$_POST['FileType'];
	$SampleFile = 	$_POST['SampleFile'];
	$id_1 = NULL;
	$id_2 = NULL;
	$id_3 = NULL;
	$id_4 = NULL;
	if($tags >= 1){
		$Tags1 = 		$_POST['Tags1'];
		$sql = "INSERT INTO tags(text)
				VALUES ('$Tags1')";
		$result = mysqli_query($connect,$sql);
		$sql = "Select tag_id from tags
				where $Tags1 == text";
		$id_1 = mysqli_query($connect,$sql);
	}
	if($tags >= 2){
		$Tags2 = 		$_POST['Tags2'];
		$sql = "INSERT INTO tags(text)
				VALUES ('$Tags2')";
		$result = mysqli_query($connect,$sql);
		$sql = "Select tag_id from tags
				where $Tags2 == text";
		$id_2 = mysqli_query($connect,$sql);
	}
	if($tags >= 3){
		$Tags3 = 		$_POST['Tags3'];
		$sql = "INSERT INTO tags(text)
				VALUES ('$Tags3')";
		$result = mysqli_query($connect,$sql);
		$sql = "Select tag_id from tags
				where $Tags3 == text";
		$id_3 = mysqli_query($connect,$sql);
	}
	if($tags == 4){
		$Tags4 = 		$_POST['Tags4'];
		$sql = "INSERT INTO tags(text)
				VALUES ('$Tags4')";
		$result = mysqli_query($connect,$sql);
		$sql = "Select tag_id from tags
				where $Tags4 == text";
		$id_4 = mysqli_query($connect,$sql);
	}

	$sql = "INSERT INTO tasks(user_id, title, text_description, task_type, Attached_files, no_of_pages, no_of_words, Deadline, claim_by_date, file_type, tag_1, tag_2, tag_3, tag_4)
			VALUES ('1', '$TaskTitle','$Description','$TaskType','$SampleFile','$NumOfPages','$NumOfWords','$Completion','$ClaimBy','$FileType', '$id_1','$id_2','$id_3','$id_4')";			
	$result = mysqli_query($connect,$sql);
	header("location: CreateTask.html");
?>