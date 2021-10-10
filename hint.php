<?php
	//error_reporting(0);
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
		require("include/classes/hints.php");
		require("include/classes/self_monitoring.php");
		@$ob = new hints($mysqli);
		@$self = new self_monitoring($mysqli);
		$q = $_GET['q'];
		$ch = $_GET['ch'];
		$qs_id = $self->get_question_id($q,$ch);
		$prompts = $ob->get_prompts($qs_id);
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
		<script type="text/javascript">
				$(document).ready(function(){
				$("#prompt").change(function(){
					var val = $(this).val();
					$('.instruct').show();
	
						if(val ==1){
							$("#1").show();
							$("#2").hide();
							$("#3").hide();
						}
						else if(val ==2){
							$("#2").show();
							$("#1").hide();
							$("#3").hide();
						}
						else if(val ==3){
							$("#3").show();
							$("#1").hide();
							$("#2").hide();
						}
					});
				});
		</script>
	


	</head>
	<body>
	<?php
		// common header
		require('include/common/top_header.php');
	?>
			<div class="content">
					<fieldset>
						<legend>Why I used Hint ?</legend>
							<br/>
							<br/>
							<select name="prompt" id="prompt" style="width:250px;">
							<option>Please Select</option>
					<?php
						
						for($i = 0,$j=1;$i<count($prompts);$i++,$j++){
					?>
							
								<option value="<?php echo $j;?>"><?php echo $prompts[$i][1];?></option>
							
					<?php
						}
					?>
					</select>
					</fieldset>
					<div class="instruct" style="display:none;color:red;font-weight:bold;">
					<p>
						<h5><i><u> Instructions</u></i></h5>
						<ul>
							<li>Read out hint and  please self explain  step and write in input field of step.</li>
						</ul>
					</p>
					<p>
						<h6>
						
						</h6>
						</p>
					</div>
					<?php
						
						for($i = 0,$j=1;$i<count($prompts);$i++,$j++){
								$hint = $ob->get_hints($prompts[$i][0]);
								$se_status = $hint[0][2];
					?>
						<form id="self_expl<?php echo $prompts[$i][0];?>" action="submit.php" method="post">
						<div id="<?php echo $j;?>" style="display:none;line-height:40px;">
						
							<fieldset>	
								<legend>
										<?php echo $prompts[$i][1];?>
								
								</legend>
							<br/>
							<?php
							if($se_status > 0){
								echo "<h5><b>What I understood ?</b></h5> <i>(Self Explain Each Step)</i>";	
							}
								echo $hint[0][1];
							?>
								<input type="hidden" name="prompt_id" value="<?php echo $prompts[$i][0];?>" />
								<input type="hidden" name="hint_id" value="<?php echo $hint[0][0];?>" />
								<input type="hidden" name="qs_id" value="<?php echo $q;?>" />
								<input type="hidden" name="ch_id" value="<?php echo $_GET['ch'];?>" />
							<?php
								
								if($se_status > 0){
							?>
								<input type="hidden" name="se_steps" value="<?php echo $se_status;?>" />
								<input type="submit" value="Back" class="btn btn-default" style="border:1px solid black !important;"/>
								</fieldset>
								</form>
							<?php
								}
							else{
							?>
								</fieldset>
							<fieldset>
							
								<legend>What I Understood ?</legend>
								<table style="width:auto;height:auto;">

								<tr>
									<td>
										<textarea  style="margin-top:45px;" name="explanation" id="explanation"></textarea>
									</td>

									<td id="error" class="error">
											<label class="error" for="explanation" style="display:none;">Please enter at least 30 characters.</label>
									</td>
									
								</tr>
								<tr><td><input type="submit" value="Back" class="btn btn-default" style="border:1px solid black !important;"/></td></tr>
								</table>
							</fieldset>
						</form>
							<?php
							}	
							?>
							
						</div>
					
					<?php
						}
					?>
			</div>
		<?php
			require('include/common/footer.php');
		?>
	</body>
</html>