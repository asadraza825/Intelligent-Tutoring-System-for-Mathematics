<?php
	//error_reporting(0);
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
			$page = "index.php?";
			$qry_str= $_SERVER['QUERY_STRING'];
			$url = $page.$qry_str;
			$s_status->update_url($student,$url);
	}
?>
<html>
	<head>
		<title>Metacognitive Mathematics Tutor</title>
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
	$("#sys_feedback").html("");
	$("#check2").html("<img src='images/load.gif' width='30' height='30' />");
	$("#submit_ans").css("disable","disable")
    var url = "check.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#myForm").serialize(), // serializes the form's elements.
           success: function(data)
           {
			   
             //$("#check").html(data);  // show response from the php script.
			  res = $.parseJSON(data);
			  if(res.check == 1){
			
				$("#check1").html("Correct..");
					$("#check2").html("");
					setTimeout(
  function() 
  {
    //do this
	//window.location.href="self_monitoring.php?ch=1&q="+res.q;
	window.location.href="selfExplanation.php?ch="+res.ch+"&q="+res.q;
  }, 1000);				
			  }
			  else if(res.check ==  0){
				$("#check1").html("");
				$("#sys_feedback").html("");
				$("#check2").html("Wrong..");
				
				//alert(res.frq);
				if(res.frq > 2){
					$("#solution_link").html("<a href='javascript:void(0)' class='primary btn-default' onclick='show_ans()'>Give Up</a>");
				}
			  }
			  else if(res.check ==  3){
				
				$("#check1").html("");
				$("#sys_feedback").html("");
				$("#check2").html("Some Problem Occurs! Please Try again...");
			  }
			  else if(res.check == 4){
				$("#check1").html("");
				$("#sys_feedback").html("");
				$("#check2").html("Answer Field is Empty...");
			  }
			 $("#sys_feedback").html(res.msg);
		   }
         });
		 
    return false; // avoid to execute the actual submit of the form.
});
});
</script>
	<script type="text/javascript">
		function chapter(id){
			window.location = 'index.php?ch='+id+'&q=1';
			
		}
		function show_ans(){
			
			document.getElementById("solution").style.display="block";
			document.getElementById("check").style.display="none";
			document.getElementById("agent").style.display="none";
			
			
			
		}
	</script>
	<style type="text/css">
			table#solution {
					background: none repeat scroll 0 0 #eee !important;
			}
table.table td	input[type="text"].se_ex{width:300px !important;}			
	</style>
	</head>
	<body>
	<?php
		// common header
		require('include/common/top_header.php');
			if(!(isset($_GET['ch']))){
				require("include/classes/chapters.php");
				$ob_chapter = new chapters($GLOBALS['mysqli']);
				$student = $_SESSION['user'];
				$chapter = $ob_chapter->get_class($student);
			if($chapter =="vi" or $chapter =="VI"){
				$chapters = $ob_chapter->get_chapter(1);
			} else if($chapter =="vii" or $chapter =="VII"){
				$chapters = $ob_chapter->get_chapter(2);
			} 
				
				//$chapters = $ob_chapter->get_chapters();
			?>
			<div class="content">
				<select name="chapters" onchange="chapter(this.value);" style="width:200px">
					<option>Please Select </option>
					<?php for($i = 0;$i<count($chapters);$i++){ ?>
						<option value="<?php echo $chapters[$i][0];?>"><?php echo $chapters[$i][1];?></option>
					<?php
					}
					?>
				</select>
			</div>
		<?php
		} 
		else if (isset($_GET['ch']) and isset($_GET['q'])){
					
			require("include/classes/problems.php");
			
			
			$ob = new problems($mysqli);
			$id = $_GET['q'];	
			$ch = $_GET['ch'];
			$student = $_SESSION['user'];
			$problem = $ob->get_problems($ch,$id);	
			if($problem){
				require('questions.php');
				//require('agent.php');
			}
			else{
				echo "<div class='container' style='text-align:center;'><p>You have completed enough exercises of chapter.$ch for practice Now time to test you understanding..</p><p>Please Click <a href='problems.php' style='font-size:12px;'>Test</a></p></div>";
			}
	
		}
		else  if(isset($_GET['status'])){
				$ch = $_GET['status'];
				echo "<div class='container'><p>You have completed enough exercises of chapter.$ch for practice Now time to test you understanding..</p><p>Please Click <a href='problems.php?ch=$ch' style='font-size:12px;'>Test</a></p></div>";
		}
		else{echo "<script type='text/javascript'>window.location='index.php';</script>";}
		?>
		<div id="redirect">
		</div>
		<?php
			require('include/common/footer.php');
		?>
	</body>
</html>