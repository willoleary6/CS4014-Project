<?php
    //written by Aidan Cleere
	include 'dbh.php';
	$target_dir = "userFiles/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
	if($uploadOk == 0) {
	    echo "Sorry your file was not uploaded";
	}
	else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		    $TaskTitle = 	mysqli_real_escape_string($connect,strip_tags($_POST['TaskTitle']));
	        $NumOfPages = 	mysqli_real_escape_string($connect,strip_tags($_POST['NumOfPages']));
	        $TaskType =		mysqli_real_escape_string($connect,strip_tags($_POST['TaskType']));
	        $NumOfWords = 	mysqli_real_escape_string($connect,strip_tags($_POST['NumOfWords']));
	        $tags = 		mysqli_real_escape_string($connect,strip_tags($_POST['Tags']));
	        $Description = 	mysqli_real_escape_string($connect,strip_tags($_POST['Description']));
	        $ClaimBy = 		mysqli_real_escape_string($connect,strip_tags($_POST['ClaimBy']));
	        $Completion =	mysqli_real_escape_string($connect,strip_tags($_POST['Completion']));
	        //$FileType = 	strip_tags($_POST['FileType']);
	        $id_1 = 1;
	        $id_2 = 1;
	        $id_3 = 1;
	        $id_4 = 1;
	        if($tags >= 1) {
		        $Tags1 = 	mysqli_real_escape_string($connect,strip_tags($_POST['Tags1']));
		        $sql = "INSERT INTO tags(text)
				     VALUES ('$Tags1')";
		        $result = mysqli_query($connect,$sql);
		        $sql = "Select tag_id from tags
				     where text = '$Tags1' ";
		        $result = mysqli_query($connect,$sql);
		        $row = mysqli_fetch_row($result);
		        $id_1 = htmlspecialchars($row[0], ENT_QUOTES);
	        }
	        if($tags >= 2) {
		        $Tags2 = 		mysqli_real_escape_string($connect,strip_tags($_POST['Tags2']));
		        $sql = "INSERT INTO tags(text)
				     VALUES ('$Tags2')";
		        $result = mysqli_query($connect,$sql);
		        $sql = "Select tag_id from tags
				     where text = '$Tags2' ";
		        $result = mysqli_query($connect,$sql);
		        $row = mysqli_fetch_row($result);
		        $id_2 = $row[0];
	        }
	        if($tags >= 3) {
		        $Tags3 = 	mysqli_real_escape_string($connect,strip_tags($_POST['Tags3']));
		        $sql = "INSERT INTO tags(text)
				    VALUES ('$Tags3')";
		        $result = mysqli_query($connect,$sql);
		        $sql = "Select tag_id from tags
				    where text = '$Tags3' ";
		        $result = mysqli_query($connect,$sql);
		        $row = mysqli_fetch_row($result);
		        $id_3 = $row[0];
	        }
	        if($tags == 4) {
		        $Tags4 = 	mysqli_real_escape_string($connect,strip_tags($_POST['Tags4']));
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
	        $sql = "SELECT user_id FROM `user_details` 
			     WHERE email = '$email' AND password = '$password'";
	        $result = mysqli_query($connect,$sql);
	        if(!$row = mysqli_fetch_array($result)) {
                 echo '<script type="text/javascript">alert("couldnt get user id")</script>';
				 header("location: CreateTask.php");
		    }else{
	            //inserting details of the task itself
			    $userId = $row[0]; 
			    $sql = "INSERT INTO tasks(user_id, title, text_description, task_type, Attached_files, no_of_pages,
				no_of_words, Deadline, claim_by_date, file_type, tag_1, tag_2, tag_3, tag_4)
			    VALUES ('$userId', '$TaskTitle','$Description','$TaskType','$target_file','$NumOfPages',
				'$NumOfWords','$Completion','$ClaimBy','$FileType', '$id_1','$id_2','$id_3','$id_4')";			
	            if($result = mysqli_query($connect,$sql)) {
			        //if insertion works this code will find its id number
				    $sql = "SELECT task_id from tasks WHERE user_id = '$userId' AND
				    title = '$TaskTitle' AND Deadline = '$Completion' AND claim_by_date = '$ClaimBy'";
					$result = mysqli_query($connect,$sql);
					if(!$row = mysqli_fetch_array($result)) {
						echo '<script type="text/javascript">alert("couldnt get task ")</script>';
				        header("location: CreateTask.php");
					}else {
						//once complete code will insert a default claim which sets the claimaint as 0 and insert the task id
						$taskId = $row[0];
						$sql = "INSERT INTO task_claims(user_id, task_id)
						VALUES ('1','$taskId')";
						if($result = mysqli_query($connect,$sql)) {
							// code to find the newly created task claim
							$sql = "SELECT claim_id from task_claims WHERE task_id = '$taskId'";
							$result = mysqli_query($connect,$sql);
							if(!$row = mysqli_fetch_array($result)) {
							    echo '<script type="text/javascript">alert("couldnt get a claim")</script>';
				                header("location: CreateTask.php");
							}else {
								//inserts the claim id and the status of the task into the taskStatus table
								$claimId = $row[0];
								$sql = "INSERT INTO taskStatus(status_id, claim_id)
								VALUES ('1','$claimId')";
								if($result = mysqli_query($connect,$sql)) {
									header("location: taskStream.php");  
								}else {
									echo '<script type="text/javascript">alert("Something went wrong")</script>';
				                    header("location: CreateTask.php");
								}
							}
						} 
					}
				}
		    }
		} else {
			 echo '<script type="text/javascript">alert("Sorry, there was an error uploading your file, Please try again")</script>';
		     header("location: CreateTask.php");
		}
	}
?>