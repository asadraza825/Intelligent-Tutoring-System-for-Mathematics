<?php
	
	class session{
		
			
		function update_status($std,$act,$test,$question){
				$mysqli = $GLOBALS['mysqli'];
				$success = mysqli_query($mysqli,"UPDATE status_repository SET activity_staus = 1,test_status = 0 ,ch_id = 1, qs_id = 1 WHERE student_id = 5");//or die(mysql_error());
				
			if($success){
					return true;
			}
			else{
				
				return false;
			}
			
			
		}
		function update_url($std,$url){
				$mysqli = $GLOBALS['mysqli'];
				$success = mysqli_query($mysqli,"UPDATE `status_url` SET url ='$url' WHERE student_id = $std");//or die(mysql_error());
				
			if($success){
					return true;
			}
			else{
				
				return false;
			}
			
			
		}
		
}
?>