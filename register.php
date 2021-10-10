<?php
	require('config.php');
?>
<html>
	<head>
		<title>Intelligent Tutoring system with Self explanation and Self monitoring</title>
	<?php
		// common head tags
		require('include/common/head.php');
	?>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#register').validate({
	rules:{
		name:{required:true},
		user:{required:true},
		class:{required:true},
		password:{required:true},
		r_password:{required:true}
	},
	messages:{
		name:{},
		email:{},
		class:{},
		password:{},
		r_password:{}
	}
	});
});
</script>
<style type="text/css">
.register input[type="text"],input[type="password"]{

    border-radius: 5px !important;
    outline: medium none;
   
}
table.register tr td{padding:9px;}
.error{font-size:14  !important;}
</style>
<script type="text/javascript" src="scripts/jquery.validate.min.js"></script>
</head>
	<body>
	<?php
		// common header
		require('include/common/top_header.php');
	?>
<section>
		<div class="container">
			<div class="row" style="margin-left:70px !important;">
				<div class="col-sm-12">
                           	<?php
							if(isset($_GET['msg'])){
						?>
						<div style="background-color:black;color:white;padding:15px;width:982px">
						<?php
								echo "Account Created Successfully! Please Login..";
						?>
							</div>
						<?php
							}
						
							else if(isset($_GET['error1'])){
						?>
							<div style="background-color:black;color:white;padding:15px;width:982px">
						<?php
									echo "Some Problem Occurs Please try again!";
						?>
							</div>
						<?php
							}
							else if(isset($_GET['error'])){
						?>
							<div style="background-color:black;color:white;padding:15px;width:982px">
						<?php
									echo "Password and Repeat Password are not matched!";
						?>
								</div>
						<?php
							}
						
								else if(isset($_GET['error2'])){
						?>
							<div style="background-color:black;color:white;padding:15px;width:982px">
						<?php
									echo "User name already exists!";
						?>
								</div>
						<?php
							}
						?>
                    <fieldset>
						<legend>Register An Account</legend>
                
				<div class="signup-form"><!--sign up form-->
				
						
						<form method="post" action="register_account.php"   id="register">
							<table class="register">
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>Student Name </td>
									<td><input type="text" placeholder="Your Name" name="name"></td>
								</tr>
								<tr>
									<td>Class </td>
									<td>
										<select name="class">
											<option value="">Please Select </option>
											<option value="VI">VI </option>
											<option value="VII">VII </option>
										</select>
									
									</td>
								</tr>
								<tr>
									<td>User Name</td>
									<td><input type="text" placeholder="Example : Ali123" name="user" ></td>
									<td><span style="color:red;font-size:12px;">Please Dont Use space eg.Ali01(Correct), Ali 01 (Incorrect)</span></td>
								</tr>
								<tr>
									<td>Password</td>
									<td><input type="password" placeholder="Password" name="password" ></td>
								</tr>
								<tr>
									<td>Repeat Password</td>
									<td><input type="password" placeholder="Repeat Password" name="r_password"></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary" type="submit" style="color:white !important;">Register</button></td>
								</tr>
							</table>
						</form>
					</div>
			</fieldset>
</div>
</div>
</div>
</section>
<!-- footer -->
<?php
			require('include/common/footer.php');
		?>
</body></html>
