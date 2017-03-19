<?php
	include 'dbh.php';
	$TaskTitle = 	strip_tags($_POST['TaskTitle']);
	$NumOfPages = 	strip_tags($_POST['NumOfPages']);
	$TaskType =		strip_tags($_POST['TaskType']);
	$NumOfWords = 	strip_tags($_POST['NumOfWords']);
	$tags = 		strip_tags($_POST['Tags']);
	$Description = 	strip_tags($_POST['Description']);
	$ClaimBy = 		strip_tags($_POST['ClaimBy']);
	$Completion =	strip_tags($_POST['Completion']);
	$FileType = 	strip_tags($_POST['FileType']);
	$SampleFile = 	strip_tags($_POST['SampleFile']);
	$id_1 = 1;
	$id_2 = 1;
	$id_3 = 1;
	$id_4 = 1;
	if($tags >= 1){
		$Tags1 = 		strip_tags($_POST['Tags1']);
		$sql = "INSERT INTO tags(text)
				VALUES ('$Tags1')";
		$result = mysqli_query($connect,$sql);
		$sql = "Select tag_id from tags
				where text = '$Tags1' ";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_row($result);
		$id_1 = $row[0];
	}
	if($tags >= 2){
		$Tags2 = 		strip_tags($_POST['Tags2']);
		$sql = "INSERT INTO tags(text)
				VALUES ('$Tags2')";
		$result = mysqli_query($connect,$sql);
		$sql = "Select tag_id from tags
				where text = '$Tags2' ";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_row($result);
		$id_2 = $row[0];
	}
	if($tags >= 3){
		$Tags3 = 		strip_tags($_POST['Tags3']);
		$sql = "INSERT INTO tags(text)
				VALUES ('$Tags3')";
		$result = mysqli_query($connect,$sql);
		$sql = "Select tag_id from tags
				where text = '$Tags3' ";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_row($result);
		$id_3 = $row[0];
	}
	if($tags == 4){
		$Tags4 = 		strip_tags($_POST['Tags4']);
		$sql = "INSERT INTO tags(text)
				VALUES ('$Tags4')";
		$result = mysqli_query($connect,$sql);
		$sql = "Select tag_id from tags
				where text = '$Tags4' ";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_row($result);
		$id_4 = $row[0];
	}

	$sql = "INSERT INTO tasks(user_id, title, text_description, task_type, Attached_files, no_of_pages, no_of_words, Deadline, claim_by_date, file_type, tag_1, tag_2, tag_3, tag_4)
			VALUES ('1', '$TaskTitle','$Description','$TaskType','$SampleFile','$NumOfPages','$NumOfWords','$Completion','$ClaimBy','$FileType', '$id_1','$id_2','$id_3','$id_4')";			
	$result = mysqli_query($connect,$sql);
	header("location: CreateTask.html");
?>