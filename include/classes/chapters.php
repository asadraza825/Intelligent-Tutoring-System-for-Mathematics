<?php
	
	class chapters{
	var $chapters = array();
	var $chapter = array();
	var $class;
	var $mysqli;
	function __construct($conn){
		$this->mysqli = $conn;
		//echo "<h1>HELLO ASAD RAZA!</h1>";
	}
		function get_chapters(){
					$q = mysqli_query($this->mysqli,"select * from chapters where status = 1") or die(mysql_error());
						$i = 0;
						while($r = mysql_fetch_array($q)){
							$this->chapters[$i][0] = $r['ch_id'];
							$this->chapters[$i][1] = $r['chapter_name'];
							$i++;
						}
		return $this->chapters;
		}
		function get_chapter($id){
							$q = mysqli_query($this->mysqli,"select * from chapters where ch_id = $id") or die(mysql_error());

							$i = 0;
							//print_r(mysql_fetch_array($q));die;
							while($r = $q->fetch_array()){
							$this->chapter[$i][0] = $r['ch_id'];
							$this->chapter[$i][1] = $r['chapter_name'];
							$i++;
						}
		return $this->chapter;
		}
		function get_class($id){
							$q = mysqli_query($this->mysqli,"SELECT class FROM student WHERE student_id = $id") or die(mysql_error());

						while($r = $q->fetch_array()){
							$this->class = $r['class'];
						}
			return $this->class ;
		}
	
	}	
	
	
	?>