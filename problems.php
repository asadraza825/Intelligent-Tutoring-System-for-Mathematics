<?php
	require('config.php');
	session_start();
	if(!(isset($_SESSION['user']))){
			header('location:register.php');
			exit();
	}
	else{
			
		    require("include/classes/session.php");
			$s_status = new session();
			$student = $_SESSION['user'];
			$page = "problems.php?";
			$qry_str= $_SERVER['QUERY_STRING'];
			$url = $page.$qry_str;
			$s_status->update_url($student,$url);
	}
?>
<html>
	<head>
		<title>Mathematics Tutoring System</title>
	<?php
		// common head tags
		require('include/common/head.php');
	?>
	<script type="text/javascript">
$(document).ready(function(){
// this is the id of the form
$("#myForm").submit(function() {
	$("#check1").html("");
	$("#check2").html("");
	$("#check2").html("<img src='images/load.gif' />");
    var url = "test_check.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#myForm").serialize(), // serializes the form's elements.
           success: function(data)
           {
			   
             //$("#check").html(data);  // show response from the php script.
			  res = $.parseJSON(data);
			  if(res.check == 1){
				
				$("#check1").html("Saved.Please Wait Next question is loading....");
				
					setTimeout(
  function() 
  {

    //do this
	
	window.location.href="problems.php?ch="+res.ch+"&q="+res.qid;
  }, 1000);
									
			  }
			  
			  else if(res.check ==  3){
				
				$("#check1").html("");
				
				$("#check2").html("Some Problem Occurs! Please Try again...");
			  }
			  else if(res.check == 4){
				$("#check1").html("");
				
				$("#check2").html("Please Select Option...");
			  }
			 
			 
			  
			
		   }
         });

    return false; // avoid to execute the actual submit of the form.
});
});
</script>
	<script type="text/javascript">
		function chapter(id){
			window.location = 'problems.php?action=start&ch='+id;
		}
	</script>
	</head>
	<body>
	<?php
		// common header
		require('include/common/top_header.php');
			if(!(isset($_GET['ch']))){
				require("include/classes/chapters.php");
				$ob_chapter = new chapters($GLOBALS['mysqli']);
				$student = $_SESSION['user'];
				$class = $ob_chapter->get_class($student);
				if($class == 'vi' or $class == 'VI'){
					$chapters = $ob_chapter->get_chapter(1);
					
				} else if($class == 'vii' or $class == 'VII'){
					$chapters = $ob_chapter->get_chapter(2);
				}
				
				//$chapters = $ob_chapter->get_chapters();
			?>
			<div class="content">
				<select name="chapters" onchange="chapter(this.value);" style="width:250px">
					<option>Please Select </option>
					<?php for($i = 0;$i<count($chapters);$i++){ ?>
						<option value="<?php echo $chapters[$i][0];?>">Test - <?php echo $chapters[$i][1];?></option>
					<?php
					}
					?>
				</select>
			</div>
		<?php
		} else 	if(isset($_GET['action']) and isset($_GET['ch'])){
			?>
			<div class="content">
			
				<?php 
				$chapter = $_GET['ch'];
				$query = mysqli_query($mysqli,"SELECT * FROM test_questions WHERE ch_id = $chapter LIMIT 1");
				$qs =   $query->fetch_array();
				
				?>
				<a href="problems.php?ch=<?php echo $_GET['ch'];?>&q=<?php echo $qs['question_id'];?>" class="btn btn-default" style="font-size:12;font-weight:bold;">Start Test</a>
			
				
			</div>
		<?php
		}
		else if (isset($_GET['ch']) and isset($_GET['q'])){		
			require("include/classes/problems.php");
			
			$ob = new problems($GLOBALS['mysqli']);
			
			$student = $_SESSION['user'];
			$q = $_GET['q'];
			$ch = $_GET['ch'];	
			$q_id = $ob->get_question_id($q,$ch);
			$problem = $ob->get_questions($ch,$q);
			if($problem){
				$options = $ob->get_options($q_id);
				require('test_questions.php');	
			}
			else{
				$std = $_SESSION['user'];
				$session_status = mysqli_query($mysqli,"DELETE FROM status_url WHERE student_id = $std");// or die(mysql_error());
				if($session_status){
						//echo "<div class='content'><p><h3>Your Test Has Completed.</h3></p></div>";
						
						echo "<script type='text/javascript'>window.location='jmai.php'</script>";
				}
				else{
					echo "Error occur!Please contact Web Administrator.."; 
				}
				
			}
			
		}
		?>
		<div id="redirect">
		</div>
		<?php
			require('include/common/footer.php');
		?>
	</body>
</html>