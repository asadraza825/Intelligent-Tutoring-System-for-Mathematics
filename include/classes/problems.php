<?php
	
	class problems{
	var $problem = array();
	var $question = array();
	var $options = array();
	var $options_ = array();
	var $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
		//echo "<h1>HELLO ASAD RAZA!</h1>";
	}
		function get_problems($ch,$id){
			
					$q = mysqli_query($this->mysqli,"SELECT qs_id,question FROM activity_questions WHERE question_id =".$id." and ch_id = $ch") or die(mysql_error());
					 $length = mysqli_num_rows($q);
					 if($length == 0){
						 return false;
					 }
						$i = 0;
						while($r = $q->fetch_array()){
							$this->problem[$i][0] = $r['qs_id'];
							$this->problem[$i][1] = $r['question'];
							$i++;
						}
		return $this->problem;
		}

		function get_questions($ch,$id){
						
						
					
					$q = mysqli_query($this->mysqli,"SELECT question FROM test_questions  WHERE ch_id = $ch AND question_id = $id");

						if(mysqli_num_rows($q)){
							
							$i = 0;
							while($r = $q->fetch_array()){
								//$this->question[$i][0] = $r['question_id'];
								$this->question[$i][0] = $r['question'];
								$i++;
							}
						}
						else{
							
							return false;
							
						}
						
			return $this->question;
		}
		function get_options($id){
					$q = mysqli_query($this->mysqli,"SELECT * FROM test_question_options WHERE qs_id =".$id."");// or die(mysql_error());
						$i = 0;
						while($r = $q->fetch_array()){
							$this->options[$i][0] = $r['option_id'];
							$this->options[$i][1] = $r['qs_option'];
							$i++;
						}
		return $this->options;
		}
		function get_options_($id){
					$q = mysqli_query($this->mysqli,"SELECT * FROM activity_options WHERE qs_id =".$id."") or die(mysql_error());
						$i = 0;
						while($r = $q->fetch_array()){
							$this->options_[$i][0] = $r['option_id'];
							$this->options_[$i][1] = $r['qs_option'];
							$i++;
						}
		return $this->options_;
		}
		function rand_problem($std){
			$qstn =rand(1,$this->max_questions);
			$query = mysqli_query($this->mysqli,"SELECT * FROM student_attempts WHERE student_id = $std AND qs_id = $qstn");
			$count = mysqli_num_rows($query);
			if($count){
				
				$this->rand_problem($std);
				
			}
			else{
				return $qstn;
			}
		}
		function get_attempts($std){
					//$query = mysqli_query("SELECT COUNT(*) FROM student_attempts WHERE student_id = $std");
					$query =   mysqli_query("SELECT * FROM student_attempts WHERE student_id = $std");
					$length =  mysqli_num_rows($query);
					if($length<=$this->max_questions){
						echo $length;
						return true;
					}
					else{
						return false;
					}
					
		}
		function get_solution($qs){
					$query = mysqli_query($this->mysqli,"SELECT * FROM activity_solutions WHERE qs_id = $qs");
					return mysqli_fetch_array($query);	
		}
		function get_answer($qs){
					$query = mysqli_query($this->mysqli,"SELECT answer FROM activity_answers WHERE qs_id = $qs");
						
					return $query->fetch_array();	
		}
		function get_question_id($q,$ch){
			
				$query =  mysqli_query($this->mysqli,"SELECT qs_id FROM test_questions WHERE question_id = $q AND ch_id = $ch");
				$result = $query->fetch_array();
				return $result['qs_id'];
		
		
	}
	}	
	?>