<?php
	require('config.php');
	session_start();
	if(!(isset($_SESSION['user']))){
		header('location:register.php');
		exit();
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
		table.table td{font-size:16px;border:none !important;}
	</style>
	<script src="scripts/jquery.validate.min.js"></script>
					<?php
					//$resource = mysql_query("select * from jmai");
					//while($result =  mysql_fetch_array($resource)){
						//echo $result[0].":{required:true},";
					//}
					?>
			
	 <script type="text/javascript">

			/* Fire Valaidate */
			$(document).ready(function(){
	


$("#jmai").validate({
  		
  rules: {

           item1: {required: true},
		   item2:{required:true}
		   
     },
      messages: {

		  item1:{},
		  item2: {}
		  
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
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<table class="table">
				<form method="post" id="jmai" action="jmai_submit.php">
				<?php
					$resource = mysql_query("select * from jmai");
					while($result =  mysql_fetch_array($resource)){
				?>
					<tr>
						<td style="background:#ECEFF4;"><?php echo $result[0].".". $result[1];?></td>
					</tr>
					<tr>
						<td>
						<!--
							<table class="table" style="padding:0px !important;">
								<tr>
									<td><input type="radio" value="1" name="<?php echo $result[0];?>" />&nbsp;&nbsp;1</td>
									<td><input type="radio" value="2" name="<?php echo $result[0];?>" />&nbsp;&nbsp;2</td>
									<td><input type="radio" value="3" name="<?php echo $result[0];?>" />&nbsp;&nbsp;3</td>
									<td><input type="radio" value="4" name="<?php echo $result[0];?>" />&nbsp;&nbsp;4</td>
									<td><input type="radio" value="5" name="<?php echo $result[0];?>" />&nbsp;&nbsp;5</td>
								</tr>
							</table>
							-->
							<input type="radio" value="1" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" value="2" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" value="3" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" value="4" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" value="5" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
				<?php
					}
				?>
				<tr>
					<td><input type="submit" value="submit" /></td>
				</tr>
				</table>
				</form>
			</div>
		</div>
	</div>
	<?php
			require('include/common/footer.php');
	?>
	</body>
</html>