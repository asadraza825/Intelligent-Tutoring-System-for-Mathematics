<?php
	
	//error_reporting(0);
	//$connection = mysqli_connect("localhost","root","");
$mysqli = mysqli_connect("localhost","root","","10sol");
$GLOBALS['mysqli'] = $mysqli;
	if(!$mysqli){
		//mysql_select_db('ox_witsm');
		//mysql_select_db('ox_witsm_frac_prop');
		//mysql_select_db('asadraza_frac_prop_model');
		//mysql_select_db('asadraza_frac_prop_model_10_sol');
	//}
	//else{
		echo "connection not established";
		die();
	}
?>