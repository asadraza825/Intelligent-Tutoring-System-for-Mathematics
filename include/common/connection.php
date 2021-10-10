<?php
	$connection = mysql_connect("localhost","root","");
	if($connection){
		mysql_select_db('asadraza_frac_prop_model_10_sol');
	}
	else{
		echo "connection not establishted";
		die();
	}

?>