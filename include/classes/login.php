<?php
	
	class login{

		var $status_arr = array();
		var $url;	
		var $mysqli;
		function __construct($conn){
			$this->mysqli = $conn;
		}

		function save_login($std){
		
				$success = mysqli_query($this->mysqli,"INSERT INTO login_sessions(student_id,start_time) VALUES($std,now())");//or die(mysql_error());
				return $success;
			if($success){
					return true;
			}
			else{
				
				return false;
			}
			
			
		}
		function save_status($std){
		
				$success = mysqli_query($this->mysqli,"INSERT INTO status_repository(student_id) VALUES($std)");//or die(mysql_error());
				return $success;
			if($success){
					return true;
			}
			else{
				
				return false;
			}
			
			
		}
		function save_url($std){
		
				$success = mysqli_query($this->mysqli,"INSERT INTO status_url(student_id) VALUES($std)");//or die(mysql_error());
				return $success;
			if($success){
					return true;
			}
			else{
				
				return false;
		}
	}
		function get_url($std){
		
				$a = mysqli_query($this->mysqli,"SELECT * FROM  status_url where student_id = $std");//or die(mysql_error());
				$success = mysqli_num_rows($a);
			if($success){
					while($result = $a->fetch_array()){
							$this->url = $result['url'];
							
					}
					
					return $this->url;
			}
			else{
				
				return false;
			}
			
			
		}
}
?>