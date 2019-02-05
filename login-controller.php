<?php

	session_start();

	include("conexao.php");
	
	// Atribuindo as variaveis "$_" os valores recebidos do formulário
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$_SESSION['sugPref'] = false;

	// Validação de login

	if (preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/", $email)){

		$sql_email = "SELECT email_usuario
					  FROM usuario
					  WHERE email_usuario = '$email'";
				 
		$resultado_email = mysqli_query($con, $sql_email);	

		// Verifica o número de linhas que retornarão do db
		$row = mysqli_fetch_assoc($resultado_email);

		if ($row) {

			$sql_confirmacao = "SELECT confirmar_usuario
						 	    FROM usuario
							    WHERE email_usuario = '$email'";

			$resultado_confirmacao = mysqli_query($con, $sql_confirmacao);

			while ($lista=mysqli_fetch_array($resultado_confirmacao)) {	

				$confirmacao = $lista[0];
			}

			if($confirmacao == 1){

				$sql_senha = "SELECT senha_usuario 
						 	  FROM usuario
							  WHERE email_usuario = '$email'";

				$resultado_senha = mysqli_query($con, $sql_senha);

				while ($lista=mysqli_fetch_array($resultado_senha)) {	

					$senha_cry = $lista[0];
				}

				$sql_id = "SELECT cod_usuario
						   FROM usuario
						   WHERE email_usuario = '$email'";

				$resultado_id = mysqli_query($con, $sql_id);

				while ($lista=mysqli_fetch_array($resultado_id)) {	

					$id = md5($lista[0]);
				}

				if (password_verify($senha, $senha_cry)) {

					$sql_id = "SELECT cod_usuario, nome_usuario, cod_org_fk, img_usuario
							   FROM usuario
							   WHERE email_usuario = '$email'";

					$resultado_id = mysqli_query($con, $sql_id);

					while ($lista=mysqli_fetch_array($resultado_id)) {	

						$id = $lista[0];
						$nome = $lista[1];
						$cod_org = $lista[2];
						$img = $lista[3];
					}

					$_SESSION['id'] = $id;
					$_SESSION['nome'] = $nome;
					$_SESSION['cod_org'] = $cod_org;
					$_SESSION['email'] = $email;
					$_SESSION['senha'] = $senha;
					$_SESSION['img'] = $img;
					header("Location: home.php");

				} else {

					$_SESSION['email'] = $email;
					unset ($_SESSION['senha']);

					$_SESSION['msg'] = "Senha inválida";

					header("Location: login.php");
				}

			} else {

				unset ($_SESSION['email']);
				unset ($_SESSION['senha']);

				$_SESSION['msg'] = "O cadastro ainda não foi confirmado, verifique sua caixa de e-mail!";

				header("Location: login.php");

			}

		} else {

			unset ($_SESSION['email']);
			unset ($_SESSION['senha']);

			$_SESSION['msg'] = "E-mail inválido";

			header("Location: login.php");
		}

	} else {

		unset ($_SESSION['email']);
		unset ($_SESSION['senha']);

		$_SESSION['msg'] = "O email inserido não parece válido";

		header("Location: login.php");
	}
	
		
?>