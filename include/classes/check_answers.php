<?php
class check_answers{

var $ans;
var $test_ans;
var $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}
function check($a){
			$this->ans = $a;
			if($this->ans == 4){
				return true;
			}

}
function check_ans($choice,$qs){
			$answer = $this->get_answer($qs);
			if($answer == $choice){
					return true;

			}
			else{

				return false;
			}
}
function get_answer($q){
			
			$query = mysqli_query($this->mysqli,"SELECT * FROM activity_answers WHERE qs_id = $q");
			
			while($result= $query->fetch_array())
			{
					
					$this->ans = trim($result['answer']);

			}
			return $this->ans;
}
function check_test_ans($choice,$qs){
			$answer = $this->get_test_answer($qs);
			if($answer == $choice){
					return true;

			}
			else{

				return false;
			}
}
function get_test_answer($q){
			
			$query = mysqli_query($this->mysqli,"SELECT a.option_id FROM test_answers a,test_question_options b  WHERE a.qs_id = $q AND a.option_id = b.option_id");
			
			while($result= $query->fetch_array())
			{
				$this->test_ans = $result['option_id'];
					
			}
			return $this->test_ans;
}
}
?>