<?php
	
	class register{
		
			
		function register_account($post){
			//$post 	   = 	 $this->escape_special_chars($post);
			$name 	   = 	 trim($post['name']);
			$user 	   = 	 trim($post['user']);
			$class 	   = 	 trim($post['class']);
			$password  = 	 trim($post['password']);			
			$rpassword = 	 trim($post['r_password']);
			$mysqli = $GLOBALS['mysqli'];  
			// check already user exists
			$q = mysqli_query($mysqli,"select * from student where  user_name = '$user'") or die(mysqli_error());
			$count = mysqli_num_rows($q);
			if($count){
				header('location:register.php?error2=fail');
				exit();
			}
	
			if($password == $rpassword){
			
				$success = mysqli_query($mysqli,"INSERT INTO student(student_name,class,user_name,password,created)VALUES('".$name."','".$class."','".$user."','".$password."',NOW())");//or die(mysql_error());
				return $success;
			}
			else{
				
				header('location:register.php?error=fail');
				exit();
			}
			
			
		}
		function escape_special_chars(){
		
			return array_map('mysql_real_escape_string',$_POST);
		}
}
?>