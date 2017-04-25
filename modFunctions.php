<?php
    include 'dbh.php';
	if(isset($_POST['ban'])){
        $ban = explode(",",($_POST['ban']));
	    /*3 SQL statements the first to ban the user,
		the second to unpublish any of his tasks
		and the 3rd to cancel any tasks he's claimed*/
		$sql = "UPDATE user_details SET banned = 1 where user_id = $ban[1];
		    
			UPDATE taskStatus a 
            JOIN task_claims b
            ON a.claim_id = b.claim_id
			JOIN tasks c 
			ON b.task_id = c.task_id
			JOIN user_details d 
			ON c.user_id = d.user_id
			SET status_id = 7
			WHERE d.user_id = $ban[1];
			
			UPDATE taskStatus a
              JOIN task_claims b 
                 ON a.claim_id = b.claim_id
            SET a.status_id = 6
            WHERE b.user_id = $ban[1];
			";
		$result = mysqli_query($connect,$sql);
	}
	if(isset($_POST['unpublish'])){
    $unpublish = explode(",",($_POST['unpublish']));;
	 $sql = "UPDATE taskStatus s
	 JOIN task_claims c
	 ON s.claim_id = c.claim_id
	 SET s.status_id = 7
	 WHERE c.task_id = $unpublish[1]";
	 $result = mysqli_query($connect,$sql);
	}	
	 header("location: taskStream.php");
	
?>