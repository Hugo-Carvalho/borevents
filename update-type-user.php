<?php

    session_start();

    include("conexao.php");

	$id = $_SESSION['id'];
	 
	$sql_update = "UPDATE usuario
 				   SET cod_tipo_fk = '1' 
 				   WHERE cod_usuario = '$id'";
	
	$resultado = mysqli_query($con, $sql_update);

	header('location:suggestion-organization.php');
?>