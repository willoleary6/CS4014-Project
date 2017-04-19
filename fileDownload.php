<?php
	include 'dbh.php';
	$id = $_POST['download'];
	$sql = "SELECT * from tasks WHERE task_id = $id";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
	$target_file = $row['Attached_files'];
	$filename = "Preview.".$row['file_type']."";
	echo $filename;
	header("Content-disposition: attachment; filename= $filename");
	header("Content-type: application/".$row['file_type']."");
	readfile("$target_file");