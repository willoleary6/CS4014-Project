<?php
include_once 'connection.php';
	
	class User {
		
		private $db;
		private $connection;
		private $response = array();
                
		function __construct() {
			$this -> db = new DB_Connection();
			$this -> connection = $this->db->getConnection();
		}
		
		public function does_user_exist($username,$password)
		{
			        $response['valid_name'] = true;
                                $response['success'] = true;
                                $response['data_fields'] = true;
                                $query = "Select * from users where username='$username'";
			        $result = mysqli_query($this->connection, $query);
			        if(mysqli_num_rows($result)>0){
			        $response['valid_name'] = false;
			        }
                                
                                if($response['valid_name']) 
                                { 
                                 $query = "insert into users (username, password) values ( '$username','$password')";
				 $inserted = mysqli_query($this -> connection, $query);
			         if($inserted != 1 ){
					$response['success'] = false;
				 }
                                }
                               echo json_encode($response);
			       mysqli_close($this->connection);
			
			
		}
		
	}
	
	
	$user = new User();
	if(isset($_POST['username'],$_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(!empty($username) && !empty($password)){
			
			$encrypted_password = md5($password);
			$user-> does_user_exist($username,$password);
			
		}else{
		       $response['valid_name'] = true;
                       $response['success'] = true;
                       $response['data_fields'] = false; 
                       echo json_encode($response);
		}
		
	}
?>