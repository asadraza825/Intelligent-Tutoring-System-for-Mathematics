<?php
	class hints{
	var $prompts = array();
	var $hints = array();
	var $mysqli;
	function __construct($conn){
		$this->mysqli = $conn;
	}
			function get_prompts($q){
					$q = mysqli_query($this->mysqli,"SELECT * FROM meta_prompts WHERE qs_id = $q") or die(mysql_error());
						$i = 0;
						while($r = $q->fetch_array()){
							$this->prompts[$i][0] = $r['prompts_id'];
							$this->prompts[$i][1] = $r['prompt'];
							$i++;
						}
		return $this->prompts;
		}

		function get_hints($p_id){
					
					$q = mysqli_query($this->mysqli,"SELECT * FROM hints WHERE prompt_id = $p_id") or die(mysql_error());
						$i = 0;
						while($r = $q->fetch_array()){
							$this->hints[$i][0] = $r['hint_id'];
							$this->hints[$i][1] = $r['hint'];
							$this->hints[$i][2] = $r['se_status'];
							$i++;
						}
		return $this->hints;
		}
		function get_question_id($q,$ch){
		
				$query =  mysqli_query($this->mysqli,"SELECT qs_id FROM activity_questions WHERE question_id = $q AND ch_id = $ch");
		$result = $query->fetch_array();
		return $result['qs_id'];
		
		
	}
	}		
	?>