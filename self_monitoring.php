<?php
	error_reporting(0);
	session_start();
	require('config.php');
	if(!(isset($_SESSION['user']))){
		header('location:register.php');
		exit();
	}
	else{
		    require("include/classes/session.php");
			$s_status = new session();
			$student = $_SESSION['user'];
			$page = "self_monitoring.php?";
			$qry_str= $_SERVER['QUERY_STRING'];
			$url = $page.$qry_str;
			$s_status->update_url($student,$url);
	}
	
	
	
	if(isset($_GET['q'])){
		require("include/classes/self_monitoring.php");
		@$ob = new self_monitoring($mysqli);
		$qs = $_GET['q'];
		$ch = $_GET['ch'];
		$next_question = ($qs+1);
		$q = $ob->get_question_id($qs,$ch);
		$student = $_SESSION['user'];
		$conceptual_se = $ob->get_coneptual_exp($q,$student);
		$frq_count = $ob->frequency_count($q,$student);
		$snapshot = $ob->generate_snapshot($q,$student);	
	}
?>
<html>
	<head>
		<title>Intelligent Tutoring system with Self explanation and Self monitoring</title>
	<?php
		// common head tags
		require('include/common/head.php');
	?>
<style type="text/css">
table.table{border-collapse:collapse; table-layout: fixed;;word-wrap:break-word !important;}
 span.lbl{font-weight:bold;color:green;}
  span.lbl1{font-weight:bold;color:red;}
div.row fieldset{margin-left: 75px!important;}
</style>
	<style type="text/css">
	table.table td	input[type="text"].se_ex{width:300px !important;}
	//input.se_ex{display:none !important;}
	</style>
	</head>
	<body>
	<?php
		// common header
		require('include/common/top_header.php');
	?>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<fieldset>
						<legend>Snapshot of all problem solving activity of Question <?php echo $_GET['q'];?></legend>
							<br/>
							<br/>
							<div style="color:red;font-weight:bold;border:solid 2px black">
								
									<h5>Self Monitoring of problem solving activity</h5>
								
							</div>
							<br/>
							<p style="text-decoration:underline;font-weight:bold;color:#4E7293">Frequency Count</p>
							<ul style="list-style:none;padding:5px;">
								<li><?php echo "<b>Wrong Attempts :</b>&nbsp;&nbsp;".$frq_count[0][0];?></li>
								<li><?php echo "<b>Right Attempt :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$frq_count[1][0];?></li>
								<li><?php echo "<b>Total Attempts :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$frq_count[2][0];?></li>
							</ul>
							<p style="text-decoration:underline;font-weight:bold;color:#4E7293">Self Explanation After Problem Solving Activity</p>
							<div style="margin-top:20px;margin-bottom:20px;height=100px;background-color:black;color:white;min-height:100px;padding:10px;">
								<?php echo $conceptual_se;?>
							</div>
								<div style="color:red;font-weight:bold;">
								<p>
									<h6>Note:Self Monitoring all your problem solving activity(Recommended)</h6>
								</p>
							</div>
							<p>
								<a href="index.php?ch=<?php echo $_GET['ch'];?>&q=<?php echo $next_question;?>" class="btn btn-default" style="font-weight:bold;border:solid 1px black !important;background-color:#0F2369;color:white !important;font-size:12px;">Next Question</a>
							</p>
							<!-- color:blue -->
							<p style="text-decoration:underline;font-weight:bold;color:#4E7293">Over all Problem Solving Activity</p>
						<table class="table">
							
						<?php
						
						for($i = 0;$i<count($snapshot);$i++){
					?>
						<tr>
							<td><?php echo $snapshot[$i];?></td>
						</tr>
					
					<?php
						}
					?>
					</table>
					</fieldset>
			</div>
		</div>
	</div>
</div>
		<?php
			require('include/common/footer.php');
		?>
	</body>
</html>