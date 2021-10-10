<?php
	session_start();
	require('config.php');
	if(!(isset($_SESSION['user']))){
			header('location:register.php');
			exit();
	}
	else{
			require('config.php');
		    require("include/classes/session.php");
			$s_status = new session();
			$student = $_SESSION['user'];
			$page = "hint.php?";
			$qry_str= $_SERVER['QUERY_STRING'];
			$url = $page.$qry_str;
			$s_status->update_url($student,$url);
	}
	if(isset($_GET['q'])){
		require("include/classes/problems.php");
		require("include/classes/self_monitoring.php");
		$ob = new problems($mysqli);
		@$self = new self_monitoring($mysqli);
		$q = $_GET['q'];
		$ch = $_GET['ch'];
		$qs_id = $self->get_question_id($q,$ch);
		$_SESSION['ch'] = $q;
		$_SESSION['q'] = $ch;
	
	}
?>
<html>
	<head>
		<title>Mathematics Tutoring System</title>
	<?php
		// common head tags
		require('include/common/head.php');
	?>
	<style type="text/css">
	table.table td	input[type="text"].se_ex{width:300px !important;}
	
	</style>
	</head>
	<body>
	<?php
		// common header
		require('include/common/top_header.php');
	?>
			<div class="content">
			
					<div class="instruct" style="display:none;color:red;font-weight:bold;">
					<p>
						<h5>Read out Solution and after read out please explain your self every step or in Brief hint what you understood and how it helped  you to solve problem.</h5>
					</p>
					
					</div>
						<form action="submit3.php" method="post">

						
							<fieldset>	<legend>Solution of Question # <?php echo $_GET['q'];?></legend>
							<br/><br/>
							<?php
								$solution = $ob->get_solution($qs_id);
								echo $solution['solution'];
							?>
								<input type="hidden" name="qs_id" value="<?php echo $q;?>" />
								<input type="hidden" name="ch_id" value="<?php echo $_GET['ch'];?>" />
							<?php
								$se_status = $solution['se_status'];
								//if($se_status > 0){
							?>
								<input type="hidden" name="se_steps" value="<?php echo $se_status;?>" />
								<input type="submit" value="submit" class="btn btn-default" style="border:1px solid black !important;"/>
								</fieldset>
							
							<?php
								//}
							
							?>
					</form>
		<?php
			require('include/common/footer.php');
		?>
	</body>
</html>