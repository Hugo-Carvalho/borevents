<?php

// Começa uma nova sessão
session_start();

// Incluir o códgio de conexão neste arquivo
include("conexao.php");

//senha aleatoria
$ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
$mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
$nu = "0123456789"; // $nu contem os números
$si = "!@#$%¨&*()_+="; // $si contem os símbolos

// se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
$senha .= str_shuffle($ma);
// se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
$senha .= str_shuffle($mi);
// se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
$senha .= str_shuffle($nu);
// se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
$senha .= str_shuffle($si);
// retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
$senha = substr(str_shuffle($senha),0,8);

$senha_cry = password_hash($senha, PASSWORD_DEFAULT);

$email = $_POST['email-for-reset-pass'];

if (preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/", $email)){

	$sql_email = "SELECT email_usuario
				  FROM usuario
				  WHERE email_usuario = '$email'";
			 
	$resultado_email = mysqli_query($con, $sql_email);	

	// Verifica o número de linhas que retornarão do db
	$row_user = mysqli_num_rows($resultado_email);

    if ($row_user > 0) {

		$sql = "UPDATE usuario
				SET senha_usuario = '$senha_cry' 
				WHERE email_usuario = '$email'";

		$result = mysqli_query($con, $sql);

		$assunto = "Sua nova senha eventureiro!";

		$menssagem = "
						<html lang=\"pt-br\">
						<head>
						  <title>Sua nova senha eventureiro!</title>
						  <meta charset=\"utf-8\">
						</head>
						<body>
						  <p>Sua senha foi redefinida!</p>
						  <br>
						  <p>Lembre-se de que podera altera-la quando quiser nas configurações de sua conta...</p>
						  <br>
						  <p> Nova senha:" .$senha ."</p>
						</body>
						</html>";

		$header = "";

		require "PHPMailer/PHPMailerAutoload.php";

		$Mailer = new PHPMailer();
		
		//Define que será usado SMTP
		$Mailer->IsSMTP();
		
		//Enviar e-mail em HTML
		$Mailer->isHTML(true);
		
		//Aceitar carasteres especiais
		$Mailer->Charset = "UTF-8";
		
		//Configurações
		$Mailer->SMTPAuth = true;
		$Mailer->SMTPSecure = "SSL";
		$Mailer->Timeout =   10;
		
		//nome do servidor
		$Mailer->Host = 'smtpout.secureserver.net';
		$Mailer->Port = 465;
		
		//Dados do e-mail de saida - autenticação
		$Mailer->Username = "team@borevents.com";
		$Mailer->Password = "borevents01@";

		
		//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
		$Mailer->From = "team@borevents.com";
		
		//Nome do Remetente
		$Mailer->FromName = "BorEvents";
		
		//Assunto da mensagem
		$Mailer->Subject = $assunto;
		
		//Corpo da Mensagem
		$Mailer->Body = $menssagem;
		
		//Destinatario 
		$Mailer->AddAddress($email);
		
		if($Mailer->Send()){

			$_SESSION['msg'] = "Senha alterada com sucesso, verifique sua caixa de e-mail!";

			header("Location: login.php");

		}else{

			$Mailer = new PHPMailer();
		
			//Define que será usado SMTP
			$Mailer->IsSMTP();
			
			//Enviar e-mail em HTML
			$Mailer->isHTML(true);
			
			//Aceitar carasteres especiais
			$Mailer->Charset = "UTF-8";
			
			//Configurações
			$Mailer->SMTPAuth = true;
			$Mailer->SMTPSecure = "SSL";
			
			//nome do servidor
			$Mailer->Host = 'smtp.gmail.com';
			$Mailer->Port = 587;  
			
			//Dados do e-mail de saida - autenticação
			$Mailer->Username = "team.borevents@gmail.com";
			$Mailer->Password = "borevents01@";

			
			//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
			$Mailer->From = "team@borevents.com";
			
			//Nome do Remetente
			$Mailer->FromName = "BorEvents";
			
			//Assunto da mensagem
			$Mailer->Subject = $assunto;
			
			//Corpo da Mensagem
			$Mailer->Body = $menssagem;
			
			//Destinatario 
			$Mailer->AddAddress($email);
			
			if($Mailer->Send()){

				$_SESSION['msg'] = "Senha alterada com sucesso, verifique sua caixa de e-mail!";

				header("Location: login.php");

			}else{

				$_SESSION['msg'] = "Erro no envio do e-mail: ". $Mailer->ErrorInfo ." Por favor, tente novamente mais tarde!";
							
				$resultado = mysqli_query($con, $sql_delete);

				header("Location: login.php");
			}
		}

	} else {

		$_SESSION['msg'] = "Nenhum eventureiro foi encontrado com o email informado!";
		header("Location: login.php");
	}

} else {

	unset ($_SESSION['email']);

	$_SESSION['msg'] = "O email inserido não parece válido";

	header("Location: login.php");
}

?>