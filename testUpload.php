<?php
	include 'dbh.php';
	$target_dir = "userFiles/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

	if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
	if($uploadOk == 0)
	{
		echo "Sorry your file was not uploaded";
	}
	else{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
?>