<?php
	//error_reporting(0);
	session_start();
	if(!(isset($_SESSION['user']))){
			header('location:register.php');
			exit();
	}
	else{
			require('config.php');
		    require("include/classes/session.php");
			$s_status = new session();
			$student = $_SESSION['user'];
			$page = "selfExplanation.php?";
			$qry_str= $_SERVER['QUERY_STRING'];
			$url = $page.$qry_str;
			$s_status->update_url($student,$url);
	}
	if(isset($_GET['q'])){
		$q = $_GET['q'];
		$ch = $_GET['ch'];

	}
?>
<html>
	<head>
		<title>Mathematics Tutoring System</title>
	<?php
		// common head tags
		require('include/common/head.php');
	?>
	<body>
	<?php
		// common header
		require('include/common/top_header.php');
	?>
			
				<div class="content">
					<div class="instruct" style="color:red;font-weight:bold;font-size:12px;">
					<?php
						if(isset($_GET['msg'])){
							echo "<h6>".$_GET['msg']."</h6>";
						}
					?>
					<p>
						<!--<h4>Please Self Explain what you got concept and knowledge after completing this problem solving activity..</h4>-->
						<h5>Please write your Self Explanation..</h4>
					</p>
					</div>
		
							<form id="concp_self_exp" action="submit2.php" method="post">
								
								<input type="hidden" name="qs_id" value="<?php echo $q;?>" />
								 <input type="hidden" name="ch" value="<?php echo $ch;?>" />
							<fieldset>
							
								<legend>What i understood and learned after after finishing that problem solving activity?</legend>
								<table style="width:auto;height:auto;">

								<tr>
									<td>
										<textarea  style="margin-top:45px;" name="explanation" id="explanation"></textarea>
									</td>

									<td id="error" class="error">
											<label class="error" for="explanation" style="display:none;">Please enter at least 30 characters.</label>
									</td>
									
								</tr>
								<tr><td><input type="submit" value="submit" class="btn btn-default" style="border:1px solid black !important;"/></td></tr>
								</table>
							</fieldset>
						</form>
					
					
				
			</div>
		<?php
			require('include/common/footer.php');
		?>
	</body>
</html>