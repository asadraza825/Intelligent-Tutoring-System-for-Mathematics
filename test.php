<?php
	require('connection.php');
	include("include/classes/contents.php");
	@$ob = new contents();
	//@$ob->content();	
	$chapters = $ob->contents();	

?>
<html>
	<head>
		<title>Problem Solving Activity</title>
	<?php
		// common head tags
		require('include/common/head.php');
	?>
	</head>
	<body>
	<!--
		<p align="center">
			<img src="images/logo.gif" />
		</p>
	-->
	<?php
		// common header
		require('include/common/header.php');
	?>

		<?php
			//require('include/common/footer.php');
		?>
	</body>
</html>
