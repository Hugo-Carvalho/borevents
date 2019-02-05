<?php

	session_start();

	include("conexao.php");

	$id = $_SESSION['id'];
	$nome_org = addslashes($_POST['nome-org']);

	$sql_name_org = "SELECT nome_org 
					 FROM  organizacao
					 WHERE nome_org = '$nome_org'";

	$resultado = mysqli_query($con, $sql_name_org);

    $row = mysqli_num_rows($resultado);

    if ($row == 0) {

		if(!empty($_FILES['upload-btn']['name'])){

			$extensao_img = strtolower(substr($_FILES['upload-btn']['name'], -4));
			$extensao_img_fc = strtolower(substr($_FILES['upload-btn']['name'], -5));

			if($extensao_img == ".png" || $extensao_img == ".jpg" || $extensao_img_fc == ".jpeg" || $extensao_img == ".gif") {

				$new_name_img = md5(time()). $extensao_img;
				$diretory_img = "upload/usuarios/".$new_name_img;

				move_uploaded_file($_FILES['upload-btn']['tmp_name'], $diretory_img);
		
				$sql_inserir_org = "INSERT INTO organizacao (nome_org , img_org)
										   VALUES ('$nome_org','$diretory_img')";

				$resultado_org = mysqli_query($con, $sql_inserir_org);

				header("Location: organization.php");

			}

		} else {

			$sql_inserir_org = "INSERT INTO organizacao (nome_org , img_org)
									   VALUES ('$nome_org','imgs/foto-org.png')";

			$resultado_org = mysqli_query($con, $sql_inserir_org);

			header("Location: organization.php");
		}

		$sql_pegar_org = "SELECT cod_org 
						  FROM  organizacao 
						  ORDER BY cod_org ASC";

		$resultado_org = mysqli_query($con, $sql_pegar_org);


		while($lista = mysqli_fetch_array($resultado_org)){

			$num_cod_org = $lista[0];
		}
		
		$mod_cod_org =  "UPDATE usuario 
						 SET cod_org_fk = '$num_cod_org'
						 WHERE cod_usuario = '$id'";

	    $resultado = mysqli_query($con, $mod_cod_org);

	    $_SESSION['cod_org'] = $num_cod_org;
			
		header("Location: organization.php");

	} else {

		$_SESSION['msg-intern'] = "Ops... Organização ja cadastrada!";

		header("Location: suggestion-organization.php");
	}
		
?>

