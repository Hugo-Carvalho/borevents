<?php

	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	
	$host = "localhost";
	$user = "root";
	$pass = "borevents01@";
	$dbname = "borevents";

	$con = mysqli_connect($host, $user, $pass, $dbname);
	
?>	