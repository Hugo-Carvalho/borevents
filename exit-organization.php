<?php

	session_start();

	include("conexao.php");

	$id = $_SESSION['id'];

	$sql = "UPDATE usuario
		    SET cod_org_fk = '1'
		    WHERE cod_usuario = '$id'";
			 
	$resultado_email = mysqli_query($con, $sql);	

	$row_user = mysqli_num_rows($resultado);

	$_SESSION['cod_org'] = '1';

	header("Location: suggestion-organization.php");
?>