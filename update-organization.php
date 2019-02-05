<?php

	session_start();

	include("conexao.php");

	$id = $_SESSION['id'];
	$cod_org = $_SESSION['cod_org'];
	$nome_org = $_SESSION['nome_org'];
	
	$new_nome_org = $_POST['nome-org'];

	$sql_name_org = "SELECT nome_org 
					 FROM  organizacao
					 WHERE nome_org = '$new_nome_org' AND 
					 	   nome_org <> '$nome_org'";

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
		
				$sql_inserir_org = "UPDATE organizacao 
				                    SET nome_org = '$new_nome_org', img_org = '$diretory_img'
									WHERE cod_org = '$cod_org'";

				$resultado_org = mysqli_query($con, $sql_inserir_org);

				unlink($_SESSION['img_org']);

				header("Location: organization.php");

			}

		} else {

			$sql_inserir_org = "UPDATE organizacao 
			                    SET nome_org = '$new_nome_org'
								WHERE cod_org = '$cod_org'";

			$resultado_org = mysqli_query($con, $sql_inserir_org);

			header("Location: organization.php");
		}

	} else {

		$_SESSION['msg-intern-uporg'] = "Ops... Organização ja cadastrada!";

		header("Location: suggestion-organization.php");
	}
		
?>

