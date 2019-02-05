<?php

	session_start();
	
	include("conexao.php");

	$id = $_SESSION['id'];
	$comentario = $_POST['comentario'];	
	$cod_event = $_POST['cod_event'];

	$sql_inserir = "INSERT INTO comentario (cod_evento_fk, cod_usuario_fk, text_coment)
								VALUES ('$cod_event', '$id', '$comentario')";
	
	$resultado = mysqli_query($con, $sql_inserir);

	$var = "<script>javascript:history.back(-1)</script>";
	echo $var;

?>