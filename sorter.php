<?php
include 'dbh.php';
function sortList($claims){
	$tasklist = array('taskId' => array(),
	                  'claimBy' => array());
	for($i = 0; $i < sizeof($claims); $i++){
	   $sql = "SELECT task_id FROM `task_claims` WHERE claim_id = '$claims[$i]'";  
	   $result1 = mysqli_query($connect,$sql);
	   $task = mysqli_fetch_array($result1);
	   $sql = "SELECT task_id, claim_by_date from tasks WHERE task_id = $task[0]";
	   $result = mysqli_query($connect,$sql);
	   $row = mysqli_fetch_assoc($result);
	   $tasklist['taskId'][$i] = $row['task_id'];
	   $tasklist['claimBy'][$i] = $row['claim_by_date'];
	}
}























$sql = "SELECT claim_id FROM `taskStatus` WHERE status_id = '1'";
$result = mysqli_query($connect,$sql);
$index = 0;
if(mysqli_num_rows($result) > 0 ){
while($array = mysqli_fetch_array($result)){
   $claims[$index] = $array['claim_id'];
   $index++;
 }
}
sortList($claims);


?>