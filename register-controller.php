<?php

	// Começa uma nova sessão
	session_start();

	// Incluir o códgio de conexão neste arquivo
	include("conexao.php");
	
	$email = $_POST['email'];
	$nome = addslashes($_POST['nome']);
	$senha = $_POST['senha'];
	$confirmar_senha = $_POST['confirmar-senha'];

    if (preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/", $email)){

		// Verifica se existe algum e-mail no db 
    	$sql_email = "SELECT email_usuario
						FROM usuario
					   WHERE email_usuario = '$email'";
				 
		$resultado_email = mysqli_query($con, $sql_email);	

		// Verifica o número de linhas que retornarão do db
		$row = mysqli_fetch_assoc($resultado_email);

		if ($row == 0) {

			if ($senha == $confirmar_senha) {

				$senha = password_hash($senha, PASSWORD_DEFAULT);

				$sql_inserir = "INSERT INTO usuario (cod_tipo_fk, cod_org_fk, nome_usuario, email_usuario, senha_usuario, img_usuario, confirmar_usuario)
									 VALUES ('2', '1', '$nome', '$email', '$senha', 'imgs/foto-perfil.png', '0')";
									
				$resultado = mysqli_query($con, $sql_inserir);

				// Para colocar o ID do usuário no link de confirmação de usuário
				$sql_id = "SELECT cod_usuario
							 FROM usuario
							WHERE email_usuario = '$email'";

				$resultado_id = mysqli_query($con, $sql_id);

				while ($lista = mysqli_fetch_array($resultado_id)) {	

					$id = md5($lista[0]);
				}

				$assunto = "Quase um eventureiro!";

				$link = "https://borevents.com/confirm-user.php?b=". $id;

				$menssagem = "
								<html lang=\"pt-br\">
								<head>
								  <title>Quase um eventureiro!</title>
								  <meta charset=\"utf-8\">
								</head>
								<body>
								  <p>Olá ". $nome .", está quase tudo pronto!</p>
								  <br>
								  <p>Só precisamos que você confirme seu cadastro no link abaixo:</p>
								  <br>
								  <a href=\"" . $link ."\">" . $link ."</a>
								</body>
								</html>";

				$header = "";

				require "PHPMailer/PHPMailerAutoload.php";
			
				$Mailer = new PHPMailer();
				
				// Define que será usado SMTP
				$Mailer->IsSMTP();
				
				// Enviar e-mail em HTML
				$Mailer->isHTML(true);
				
				// Aceitar carasteres especiais
				$Mailer->Charset = "UTF-8";
				
				// Configurações
				$Mailer->SMTPAuth = true;
				$Mailer->SMTPSecure = "SSL";
				$Mailer->Timeout = 10;
				
				// Nome do servidor
				$Mailer->Host = 'smtpout.secureserver.net';
				$Mailer->Port = 465;
				
				// Dados do e-mail de saida - autenticação
				$Mailer->Username = "team@borevents.com";
				$Mailer->Password = "borevents01@";
				
				// E-mail remetente (deve ser o mesmo de quem fez a autenticação)
				$Mailer->From = "team@borevents.com";
				
				// Nome do Remetente
				$Mailer->FromName = "BorEvents";
				
				// Assunto da mensagem
				$Mailer->Subject = $assunto;
				
				// Corpo da Mensagem
				$Mailer->Body = $menssagem;
				
				// Destinatario 
				$Mailer->AddAddress($email);
				
				if($Mailer->Send()){

					$_SESSION['msg'] = "Cadastro realizado com sucesso, verifique sua caixa de e-mail!";
					header("Location: login.php");

				} else {

					$Mailer = new PHPMailer();
				
					// Define que será usado SMTP
					$Mailer->IsSMTP();
					
					// Enviar e-mail em HTML
					$Mailer->isHTML(true);
					
					// Aceitar carasteres especiais
					$Mailer->Charset = "UTF-8";
					
					// Configurações
					$Mailer->SMTPAuth = true;
					$Mailer->SMTPSecure = "SSL";
					
					// Nome do servidor
					$Mailer->Host = 'smtp.gmail.com';
					$Mailer->Port = 587;  
					
					// Dados do e-mail de saida - autenticação
					$Mailer->Username = "team.borevents@gmail.com";
					$Mailer->Password = "borevents01@";

					// E-mail remetente (deve ser o mesmo de quem fez a autenticação)
					$Mailer->From = "team@borevents.com";
					
					// Nome do Remetente
					$Mailer->FromName = "BorEvents";
					
					// Assunto da mensagem
					$Mailer->Subject = $assunto;
					
					// Corpo da Mensagem
					$Mailer->Body = $menssagem;
					
					// Destinatario 
					$Mailer->AddAddress($email);
					
					if($Mailer->Send()){

						$_SESSION['msg'] = "Cadastro realizado com sucesso, verifique sua caixa de e-mail!";

						header("Location: login.php");

					}else{

						$_SESSION['msg'] = "Erro no envio do e-mail: ". $Mailer->ErrorInfo ." Por favor, tente novamente mais tarde!";

						$sql_delete = "DELETE FROM `usuario` 
									   WHERE cod_usuario = '$id'";
									
						$resultado = mysqli_query($con, $sql_delete);

						header("Location: register.php");
					}
				}
			
			} else {
				$_SESSION['email'] = $email;
				$_SESSION['nome'] = $nome;
				unset ($_SESSION['senha']);
				unset ($_SESSION['confirmar_senha']);
				$_SESSION['msg'] = "A senha inserida não corresponde com a senha confirmada";
				header("Location: register.php");
			}

		} else {
			unset ($_SESSION['email']);
			unset ($_SESSION['nome']);
			unset ($_SESSION['senha']);
			unset ($_SESSION['confirmar_senha']);
			$_SESSION['msg'] = "Eventureiro já cadastrado!";
			header("Location: register.php");
		}

	} else {
		unset ($_SESSION['email']);
		unset ($_SESSION['nome']);
		unset ($_SESSION['senha']);
		unset ($_SESSION['confirmar_senha']);
		$_SESSION['msg'] = "O email inserido não parece válido";
		header("Location: register.php");
	}

?>