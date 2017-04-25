<?php
    function sorter($status) { 
        //written by William O'Leary - 15155528
		include 'dbh.php';
		// sql statement to return all unclaimed tasks from the database
		$sql = "SELECT claim_id FROM `taskStatus` WHERE status_id = '$status'";
		$result = mysqli_query($connect,$sql);
		$index = 0;
		//if the sql statement returns a valid result
		if(mysqli_num_rows($result) > 0 ) {
			//populates an array with the unclaimed tasks
			while($array = mysqli_fetch_array($result)) {
				$claims[$index] = $array['claim_id'];
				$index++;
			}
			// declaring a multidimensional array to store both the task ids and the claim by dates
			$tasklist = array('taskId' => array(),
						           'claimBy' => array());
		    //populating the multidimensional array with relevant info
			$counter = 0;
			for($i = 0; $i < sizeof($claims); $i++) {
				$sql = "SELECT task_id FROM `task_claims` WHERE claim_id = '$claims[$i]'";  
				$result = mysqli_query($connect,$sql);
				$task = mysqli_fetch_array($result);
				$sql = "SELECT task_id, claim_by_date from tasks WHERE task_id = $task[0]";
				$result = mysqli_query($connect,$sql);
			   	$row = mysqli_fetch_assoc($result);
				/*checks if the tasks that are unclaimed are in date 
				and if not they are not shown and there status is changed
				so they will no longer appear on the task stream*/
				$inDate = outOfDate($row['claim_by_date']);
				if($inDate == true) {
					$tasklist['taskId'][$i-$counter] = $row['task_id'];
					$tasklist['claimBy'][$i-$counter] = $row['claim_by_date'];
				}else {
				    $counter++;
				    $sql = "UPDATE taskStatus SET `status_id` = '4' WHERE claim_id = '$claims[$i]'";  
			        $result = mysqli_query($connect,$sql);
			    }
		    }
		    //getting present time
		    $timeNow = time(); 
		    // had to go through the sort twice for it to properly sort
		    for($k = 0; $k < 2; $k++) {
			    // selection-sort to sort each of tasks by closest date
			    for ($i = 0; $i < sizeof($tasklist['taskId'])-1; $i++) {
				    $min = $i;
				    for($j = $i+1; $j < sizeof($tasklist['taskId']); $j++) {
					    /*if the time between the present and time1 is less then the time between 
					    the present and time2 then they will swap places*/
					    if (strtotime((string)$timeNow) - strtotime((string)$tasklist['claimBy'][$j]) > 
					          strtotime((string)$timeNow) - strtotime((string)$tasklist['claimBy'][$min])) {
						    //setting up temporary placeholders for the variables as they're sorted
						    $min = $j;
						    $tempDate = $tasklist['claimBy'][$i];
						    $tempId = $tasklist['taskId'][$i];
						    //swaping places
						    $tasklist['claimBy'][$i] = $tasklist['claimBy'][$min];
						    $tasklist['taskId'][$i] = $tasklist['taskId'][$min];
			 
						    $tasklist['claimBy'][$min] = $tempDate;
						    $tasklist['taskId'][$min] = $tempId;
						}
                    }
				}	
		    }
	        //returns the sorted list of task ids
            return $tasklist['taskId'];
	    }else {
		     return NULL;
	    }
    }
 
    function outOfDate($date) {
        //simple process to check if we have not passed the claim by date of the task
        $timeNow = time();
        if(new DateTime() > new DateTime($date)) {
	        return false;
        }else {
	        return true;
        }
    }
?>