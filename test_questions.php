<div class="content" style="width:980px;">
	<div class="question">
			<p class="qs">
		
				<?php
				echo "Q: ".$problem[0][0];
				?>
			</p>
<form id="myForm" action="test_check.php" method="post">
			<table class="options">
			<?php
				for($i = 0;$i<count($options);$i++){
			?>
			<tr>
				<td><input type="radio" name="choice" value="<?php echo $options[$i][0];?>" /></td><td><?php echo $options[$i][1];?></td>
			</tr>
			<?php
				}
			?>
			</table>
		<br/>
<table>
<tr>
	<td>
		<input type="submit" value="Next Question" id="submit_ans" style="width:110px;"/>
	</td>
	<td id="check1" style="color:green;font-weight:bold;padding-left:10px;">
		
	</td>
	<td id="check2" style="color:red;font-weight:bold;padding-left:10px;">
		
	</td>
</tr>
</table>
<input type="hidden" name="chapter" value="<?php echo $_GET['ch'];?>" />
<input type="hidden" name="question" value="<?php echo $_GET['q'];?>" />
</form>
<p>
	<?php
		if(@$_GET['msg']){
			echo $_GET['msg'];
		}
	?>
</p>
		</div>
	</div>