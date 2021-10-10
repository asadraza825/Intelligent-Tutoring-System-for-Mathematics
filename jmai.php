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
		   item2: {required:true},
		   item3: {required: true},
		   item4: {required: true},
		   item5: {required: true},
		   item6: {required: true},
		   item7: {required: true},
		   item8: {required: true},
		   item9: {required: true},
		   item10: {required: true},
		   item11: {required: true},
		   item12: {required: true},
		   item13: {required: true},
		   item14: {required: true},
		   item15: {required: true},
		   item16: {required: true},
		   item17: {required: true},
		   item18: {required: true}
     },
      messages: {

		  item1:{},
		  item2: {},
		  item3:{},
		  item4:{},
		  item5:{},
		  item6:{},
		  item7:{},
		  item8:{},
		  item9:{},
		  item10:{},
		  item11:{},
		  item12:{},
		  item13:{},
		  item14:{},
		  item15:{},
		  item16:{},
		  item17:{},
		  item18:{}
		  
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
				<form method="post" id="jmai" action="jmai_submit.php">
				<table class="table">
				
				
				<?php
					$resource = mysqli_query($mysqli,"select * from jmai");
					while($result =  $resource->fetch_array()){
				?>
					<tr>
						<td style="background:#ECEFF4;font-weight:bold;"><?php echo $result[0].".". $result[1];?></td>
					</tr>
					<tr>
						<td>
						
							<input type="radio" value="1" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;Never&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" value="2" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;Seldom&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" value="3" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;Sometime&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" value="4" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;Often&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" value="5" name="item<?php echo $result[0];?>" />&nbsp;&nbsp;Always&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="item<?php echo $result[0];?>" class="error" style="display:none">Please Select</label>
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