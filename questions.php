<div class="content" style="width:980px;margin:auto;padding:auto;">
	<div class="question">
		<p class="qs">
				
				<?php
				echo "Q ".$id." # ".$problem[0][1];
				?>
		</p>
<form id="myForm" action="check.php" method="post">
			<table class="options">

				<tr>
					
					<?php if($_GET['q'] == 1 AND $_GET['ch'] == 1 OR $_GET['q'] == 4 AND $_GET['ch'] == 1 OR $_GET['q'] == 6 AND $_GET['ch'] == 1 OR $_GET['q'] == 7 AND $_GET['ch'] == 1 OR $_GET['q'] == 9 AND $_GET['ch'] == 1){
					?>
					<!--<td><span style='color:blue;font-size:12px;'>dont use space between values in ratio answer 2:1(write) 2 : 1 (wrong)</span></td>-->
					<td>
						<table class="table">
							<tr>
								<td style="border-top:0px;"><input type="input" name="choice1"  style="width:20px;" /></td>
							</tr>
							
							<tr>
								<td style="border-top: 1px solid black;"><input type="input" name="choice2"  style="width:20px;" />
								<input type="hidden" name="compound" value="true" />
								</td>
							</tr>
						</table>
						 
					</td>
					<?php
					}
					
				else{
				?>
					<td><input type="input" name="choice"  size="10" /></td>				
				<?php
				}
				?>
				</tr>
			
			</table>
		<br/>
		<p id="solution" style="display:none;"> <span style="color:green"> Answer : </span>
 		<?php
				$ans = $ob->get_answer($problem[0][0]);
				echo "<span style='color:red;'><b> ".$ans['answer']." </b></span>";			
		?>
			<br/>
			Please Click On Any &nbsp;&nbsp;&nbsp;&nbsp;
			<a href="solution.php?ch=<?php echo $_GET['ch']; ?>&q=<?php echo $_GET['q'];?>" class='btn btn-default'>Show Question Solution  </a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="submit3.php?action=save&ch=<?php echo $_GET['ch']; ?>&q=<?php echo $_GET['q'];?>" class='btn btn-default'>Next Question </a>
		</p>
<table id="check">
<tr>
	<td>
		<input type="submit" value="Check" id="submit_ans" />
	</td>
	<td id="check1" style="color:green;font-weight:bold;padding-left:10px;">
		
	</td>
	<td id="check2" style="color:red;font-weight:bold;padding-left:10px;">
		
	</td>
	<td id="solution_link" style="color:red;font-weight:bold;padding-left:10px;">
	</td>
	</tr>
</table>
<input type="hidden" name="question" value="<?php echo $problem[0][0];?>" />
<input type="hidden" name="next" value="<?php echo $_GET['q'];?>" />
<input type="hidden" name="chapter" value="<?php echo $_GET['ch'];?>" />
</form>
<p>
	<?php
		if(@$_GET['msg']){
			echo $_GET['msg'];
		}
	?>
</p>
		</div>
		<?php require('agent.php');?>
	</div>
