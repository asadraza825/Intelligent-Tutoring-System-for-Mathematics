<div id="container">
<table align="center">
  <tbody>
  <tr>
    <td class="header_top">
      <table>
        <tbody>
        <tr>
          <td height="194" width="100%"><!--<img src="images/logo1.png" width="150" height="90"/>
		  <img src="images/logo.gif" style="height: 164px;margin-left: -3px;padding-top: 20px;width: 450px;">-->
			<img src="images/logo_its.png" style="padding-top: 20px;padding-left:20px;width: 350px;height:164px;">
			</td>
          <td vAlign="top" width="48%" >
            <table border="0" cellSpacing="0" cellPadding="0" width="100%">
              <tbody>
              <tr>
            
				<td height="15" vAlign="top" align="right" style="padding-right:20px; ">
                <?php
				
		        if(isset($_SESSION["user"]))
		        {
	            ?>
				<span style="font-size:11px;font-weight:bold;"><?php echo "Welcome! ".$_SESSION['name'];?></span>
                <a href="logout.php">Log Out</a>&nbsp;&nbsp;
                <?php
				}
				?>
               <!-- <a href="register.php">Register</a> -->
				</td>
              </tr>
			  
              <tr>
               <td style=" padding-top: 5px;">
				<?php
				if(isset($_SESSION['user']))
					{
				?>
				
						  <fieldset class="login">
            <legend>Question No.<?php echo @$_GET['q'];?> </legend>
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>

				<tr>
					<td id="total"></td>
				</tr>
			</table>
				<?php
					}
					else{
				?>
									<form action="sign_in_form.php" method="post">
          <fieldset class="login">
            <legend>Student Login</legend>
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>User Name:</td>
					<td><input type="text" name="user" id="user" /> </td>
				</tr>
				<tr style="margin-bottom:5px;">
					<td>Password:</td>
					<td> <input type="password" name="pass" id="pass" /></td>
				</tr>
			</table>
				&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" name="submit"  value="Login" class='primary btn-default' />
              
			</fieldset>
        </form>
				<?php		
					}
				?>

				
				</td></tr>

			 </tbody></table></td></tr></tbody></table></td>
	</tr>
  <tr>
    <td>
			<?php
				require('include/common/menu.php');
			?>
	</td>
	</tr>
  <tr>
    <td height="20">&nbsp;</td></tr>
		
  <tr>
    <td></td></tr></tbody></table>