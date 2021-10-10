<?php
	class self_explain{
		var $mysqli;
function __construct($conn){
		$this->mysqli = $conn;
	}	
	
			function set_self_exp($exp,$qs_id,$std){
					$q = mysqli_query($this->mysqli,"INSERT INTO conceptual_se(self_explanation,qs_id,student_id)VALUES('$exp',$qs_id,$std)");// or die(mysql_error());
								if($q){
										return true;
									}
								else{
									return false;
								}
		}

	}		
	?>