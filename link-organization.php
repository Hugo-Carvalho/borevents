<?php

	session_start();

	include("conexao.php");

	$id = $_SESSION['id'];

	$cod_confirmacao = $_POST['nome-link-org'];

	$select_org = "SELECT cod_org 
				   FROM organizacao 
				   WHERE MD5(cod_org) = '$cod_confirmacao'";

	$resultado = mysqli_query($con, $select_org);

	$row = mysqli_num_rows($resultado);

	if ($row > 0) {

		while($lista = mysqli_fetch_array($resultado)){

			$cod_org = $lista[0];

		}

		$vincular = "UPDATE usuario 
					 SET cod_org_fk = '$cod_org'
					 WHERE cod_usuario = '$id'";

		$resultado_vinc = mysqli_query($con, $vincular);

		$_SESSION['cod_org'] = $cod_org;

		header("Location: organization.php");

	}else{

		$_SESSION['msg-intern'] = "Nenhuma organização encontrada, favor inserir novamente!";

		header("Location: suggestion-organization.php");
	}

?>

