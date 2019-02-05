<?php

	session_start();

	// Incluir o códgio de conexão neste arquivo
	include("conexao.php");
	
	$nome = $_POST['nome'];
	$senha = $_POST['senha'];
	$confirmar_senha = $_POST['confirmar-senha'];

	$id = $_SESSION['id'];

	if ($senha == $confirmar_senha){	

		if(!empty($_FILES['upload-btn']['name'])){

			$sql_img = "SELECT img_usuario
					    FROM usuario
		                WHERE cod_usuario = '$id'";
		    
		    $resultado_img = mysqli_query($con, $sql_img);

		    while ($lista=mysqli_fetch_array($resultado_img)) {	

				$img_usuario = $lista[0];
			}

			unlink($img_usuario);

			$extensao_img = strtolower(substr($_FILES['upload-btn']['name'], -4));
			$extensao_img_fc = strtolower(substr($_FILES['upload-btn']['name'], -5));

			if($extensao_img == ".png" || $extensao_img == ".jpg" || $extensao_img_fc == ".jpeg" || $extensao_img == ".gif"){

				$new_name_img = md5(time()). $extensao_img;
				$diretory_img = "upload/usuarios/".$new_name_img;

				move_uploaded_file($_FILES['upload-btn']['tmp_name'], $diretory_img);

				$senha_cry = password_hash($senha, PASSWORD_DEFAULT);

				$sql_update = "UPDATE usuario
							   SET nome_usuario = '$nome', senha_usuario = '$senha_cry', img_usuario = '$diretory_img'
							   WHERE cod_usuario = '$id'";	
				
				$resultado = mysqli_query($con, $sql_update);

				$_SESSION['msg-intern'] = "Alterações realizadas com sucesso!";

				$_SESSION['img'] = $diretory_img;
				$_SESSION['nome'] = $nome;
				$_SESSION['senha'] = $senha;

				header("Location: info.php");

			} else {

				$_SESSION['nome'] = $nome;
				$_SESSION['senha'] = $senha;

				$_SESSION['msg-intern'] = "Extensão do arquivo não suportado. (.png .jpg .jpeg .gif)";

				header("Location: editar-usuario.php");
			}
		} else {

			$senha_cry = password_hash($senha, PASSWORD_DEFAULT);

			$sql_update = "UPDATE usuario
						   SET nome_usuario = '$nome', senha_usuario = '$senha_cry'
						   WHERE cod_usuario = '$id'";	
			
			$resultado = mysqli_query($con, $sql_update);

			$_SESSION['msg-intern'] = "Alterações realizadas com sucesso!";

			$_SESSION['nome'] = $nome;
			$_SESSION['senha'] = $senha;

			header("Location: info.php");
		}
			
	} else {

		unset ($_SESSION['senha']);
		unset ($_SESSION['confirmar_senha']);

		$_SESSION['msg-intern'] = "A senha inserida não corresponde com a senha confirmada";
		header("Location: editar-usuario.php");
	}	

?>