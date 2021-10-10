<?php
	class self_monitoring{
	var $snapshot = array();
	var $activity = array();
	var $hints   = array();
	var $prompts = array();
	var $frq_count = array();
	var $question_id;
	var $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}
			function generate_snapshot($q,$s){
						$this->question_id = $q;
						$q = mysqli_query($this->mysqli,"SELECT * FROM student_selfmonitoring a, self_monitoring b WHERE  a.qs_id = $q AND a.student_id = $s
										  AND a.self_monitoring = b.self_monitoring");

						$i = 0;

						while($r = $q->fetch_array()){
							 $flag = true;
							 $get_activity = $this->get_activity($r['self_monitoring']);
								 for($j = 0 ;$j<count($get_activity);$j++){
									 $this->snapshot[$i] = $get_activity[$j];
									 $i++;
									 $flag  = false;
								 }
							if($flag){
									$i++;
									
							}
							
						}
		return $this->snapshot;
		}

		function get_activity($s_id){
					
					$q = mysqli_query($this->mysqli,"SELECT * FROM self_monitoring WHERE self_monitoring = $s_id");
						$i = 0;
						while($r = $q->fetch_array()){
							$attempt = $r['attempt_id'];
							
							
							if($attempt == 0)
							{
											$this->activity[0] =  $this->get_prompt($r['prompt_id']);
											$this->activity[1] = $this->get_hint($r['hint_id']);
											$se_status = $this->get_se_status($r['hint_id']);
											if($se_status){
													$self_expl = $this->extract_se($r['self_explanation']);
											}
											else{
													$self_expl = $r['self_explanation'];
											}
											
											$this->activity[2] = "<span class='lbl'>You Self Explanation:</span>".$self_expl;
							}
							else{
								$attemp_query = mysqli_query($this->mysqli,"SELECT * FROM answer_attempts WHERE attempt_id = $attempt");
								while($r_attempt = $attemp_query->fetch_array()){
									if($r_attempt['answer'] == 1){
										$this->activity[0] = "<span class='lbl'>You:</span> Question Attempt";
										$this->activity[1] = "<span class='lbl1'>System:</span>  Correct....";
										$this->activity[2] = "<span class='lbl1'>System :</span> Next Question";
										
									}
									else if($r_attempt['answer'] == 2){
										$this->activity[0] = "<span class='lbl'>You :</span> Question Attempt";
										$this->activity[1] = "<span class='lbl1'>System :</span> Wrong....";
										$this->activity[2] = "<span class='lbl1'>System:</span>Please attempt again...You can use System Hint";
										
									}
									else if($r_attempt['answer'] == 3){
										$this->activity[0] = "<span class='lbl'>You :</span> Give Up";;
										$this->activity[1] = "<span class='lbl'>You :</span>Show Answer";
										$sol_resource = mysqli_query($this->mysqli,"SELECT solution  FROM activity_solutions WHERE qs_id = $this->question_id ");
										$res = $sol_resource->fetch_array();
										$solution = $res['solution'];
										$se_resource = mysqli_query($this->mysqli,"SELECT self_explanation FROM self_monitoring WHERE attempt_id = $attempt");
										$result = $se_resource->fetch_array();
										$se = $this->extract_se($result['self_explanation']);
										$this->activity[2] = "<span class='lbl1'>System:</span>Answer : <br/>$solution <br/><span class='lbl'>You :$se</span>";
										
									}
									else if($r_attempt['answer'] == 4){
										$this->activity[0] = "<span class='lbl'>You :</span> Give Up";;
										$this->activity[1] = "<span class='lbl'>You :</span>Next Question";
										$this->activity[2] = "<span class='lbl1'>System :</span> Next Question";
										
									}
								}
							}
							
						}
						
			return $this->activity;
		}
		function get_prompt($p_id){
				$prompt = mysqli_query($this->mysqli,"SELECT * FROM meta_prompts WHERE  prompts_id = $p_id");
				$r = $prompt->fetch_array();
				$statement =  $r['prompt'];
				return "<span class='lbl'>User : </span>$statement";
		}
		function get_hint($h_id){
				$hint = mysqli_query($this->mysqli,"SELECT * FROM hints WHERE  hint_id = $h_id");
				$r = $hint->fetch_array();
				$statement =  $r['hint'];
				return "<span class='lbl1'>System Hint:</span> $statement";
		}
		function get_se_status($hint_id){
			$hint = mysqli_query($this->mysqli,"SELECT hint,se_status FROM hints WHERE  hint_id = $hint_id");
			$r =    $hint->fetch_array();
			if($r['se_status'] > 0){
					return true;
				}
				else{
					return false;
				}
		}
		function extract_se($se){
			
						$step_self_exp = explode(",",$se);
						for($i = 0,$j = 1;$i<count($step_self_exp);$i++,$j++){
							$se_steps .="<br/><span style='color:#2EA5D0'>Step ".$j." Self Explanation  :</span> ";
							$se_steps .= $step_self_exp[$i]; 
							$se_steps .="<br/>";
						}
						return $se_steps;
		}
		function save_attempt($ans,$std,$qs){
			
			$q = mysqli_query($this->mysqli,"INSERT INTO answer_attempts(answer) VALUES($ans)");
			$attempt_id = $this->mysqli->insert_id;
			$q1 = mysqli_query($this->mysqli,"insert into self_monitoring(attempt_id) values($attempt_id)");
			$self_monitoring_id = $this->mysqli->insert_id;
			$q2 = mysqli_query($this->mysqli,"INSERT INTO student_selfmonitoring(self_monitoring,student_id,qs_id) VALUES($self_monitoring_id,$std,$qs)");
			if($q AND $q1){
				return true;
			}
			else{
				return false;
				
			}
		}
		function save_attempt_with_se($ans,$std,$qs,$se){
			
			$q = mysqli_query($this->mysqli,"INSERT INTO answer_attempts(answer) VALUES($ans)") or die(mysql_error());
			$attempt_id = $this->mysqli->insert_id;
			$q1 = mysqli_query($this->mysqli,"insert into self_monitoring(self_explanation,attempt_id) values('$se',$attempt_id)")or die(mysql_error());
			$self_monitoring_id = $this->mysqli->insert_id;
			$q2 = mysqli_query($this->mysqli,"INSERT INTO student_selfmonitoring(self_monitoring,student_id,qs_id) VALUES($self_monitoring_id,$std,$qs)")or die(mysqli_error());
			if($q AND $q1){
				return true;
			}
			else{
				return false;
				
			}
		}
		function frequency_count($q,$std){
				
				$this->frq_count[0]= $this->wrong_attempts($q,$std); 
				$this->frq_count[1] = $this->right_attempts($q,$std); 
				
				$this->frq_count[2]= $this->all_attempts($q,$std);
				return $this->frq_count;
		}
		function right_attempts($q,$std){
			$resource = mysqli_query($this->mysqli,"SELECT COUNT(*) FROM student_selfmonitoring a,self_monitoring b,answer_attempts c
WHERE a.qs_id = $q AND a.student_id = $std AND a.self_monitoring = b.self_monitoring AND b.attempt_id = c.attempt_id AND c.answer = 1 ");
			$result = $resource->fetch_array();
			return $result;
		}
		function wrong_attempts($q,$std){
				$resource = mysqli_query($this->mysqli,"SELECT COUNT(*) FROM student_selfmonitoring a,self_monitoring b,answer_attempts c
WHERE a.qs_id = $q AND a.student_id = $std AND a.self_monitoring = b.self_monitoring AND b.attempt_id = c.attempt_id AND c.answer = 2 ");
			$result = $resource->fetch_array();
			return $result;

		}
		function all_attempts($q,$std){
				$resource = mysqli_query($this->mysqli,"SELECT COUNT(*) FROM student_selfmonitoring a,self_monitoring b,answer_attempts c
WHERE a.qs_id = $q AND a.student_id = $std AND a.self_monitoring = b.self_monitoring AND b.attempt_id = c.attempt_id AND(c.answer = 1 OR c.answer = 2)");
		$result = $resource->fetch_array();
			return $result;

		}
		function update_question($std,$id,$option_id){
			$query = mysqli_query($this->mysqli,"INSERT INTO student_attempts(student_id,qs_id,option_id) VALUES($std,$id,$option_id)") or die(mysqli_error());
			
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
		function update_activity($std,$id){
			
			$query = mysqli_query($this->mysqli,"INSERT INTO student_activity_attempts(student_id,qs_id) VALUES($std,$id)") or die(mysql_error());
			
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
		function save_result($qs,$status,$student){
			$query = mysqli_query($this->mysqli,"INSERT INTO results(qs_id,score,student_id) VALUE($qs,$status,$student)") or die(mysql_error());
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
		function get_coneptual_exp($q_id,$std_id){
			$query = mysqli_query($this->mysqli,"SELECT * FROM conceptual_se WHERE qs_id = $q_id AND student_id = $std_id") or die(mysql_error());
				while($result = $query->fetch_array()){
						$coneptual_se = $result['self_explanation'];
				}
				return $coneptual_se;
		}
	function get_question_id($q,$ch){
		
				$query =  mysqli_query($this->mysqli,"SELECT qs_id FROM activity_questions WHERE question_id = $q AND ch_id = $ch");
				$result = $query->fetch_array();
				return $result['qs_id'];
		
		
	}
	function get_solution_se($attempt_id){
				$query = mysqli_query($this->mysqli,"SELECT  * FROM self_monitoring WHERE attempt_id = $attempt_id");
				$result = $query->fetch_array();
				$se = $result['self_explanation'];
	}
	}		
?>