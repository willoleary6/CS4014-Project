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
     $email = $_COOKIE['email'];
	 $password = $_COOKIE['password'];
	 $sql = "SELECT user_id FROM `user_details` WHERE email = '$email' AND password = '$password'";
	 $result = mysqli_query($connect,$sql);
	 if(!$row = mysqli_fetch_array($result)){
        echo 'couldnt get user id';
		}else{
	        //inserting details of the task itself
			$userId = $row[0]; 
			$sql = "INSERT INTO tasks(user_id, title, text_description, task_type, Attached_files, no_of_pages, no_of_words, Deadline, claim_by_date, file_type, tag_1, tag_2, tag_3, tag_4)
			VALUES ('$userId', '$TaskTitle','$Description','$TaskType','$SampleFile','$NumOfPages','$NumOfWords','$Completion','$ClaimBy','$FileType', '$id_1','$id_2','$id_3','$id_4')";			
	        if($result = mysqli_query($connect,$sql))
			{
			
				//if insertion works this code will find its id number
				$sql = "SELECT task_id from tasks WHERE user_id = '$userId' AND title = '$TaskTitle' AND Deadline = '$Completion' AND claim_by_date = '$ClaimBy'";
			    $result = mysqli_query($connect,$sql);
				if(!$row = mysqli_fetch_array($result))
				{
					echo 'couldnt get task id';
				}else{
				 //once complete code will insert a default claim which sets the claimaint as 0 and insert the task id
				 $taskId = $row[0];
				 $sql = "INSERT INTO task_claims(user_id, task_id)
			      VALUES ('1','$taskId')";
				 if($result = mysqli_query($connect,$sql))
				 {
				   // code to find the newly created task claim
				   $sql = "SELECT claim_id from task_claims WHERE task_id = '$taskId'";
				   $result = mysqli_query($connect,$sql);
				   if(!$row = mysqli_fetch_array($result))
				   {
					   echo ' couldnt get claim id';
				   }else{
					   //inserts the claim id and the status of the task into the taskStatus table
					   
					   $claimId = $row[0];
					   $sql = "INSERT INTO taskStatus(status_id, claim_id)
			           VALUES ('1','$claimId')";
					   if($result = mysqli_query($connect,$sql))
					   {
						 header("location: task stream.php");  
					   }else{
						   echo 'task status didnt work';
					   }
				   }
				 }
	            }
			}
		
	        
		}
		
		
		
?>