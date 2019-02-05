<?php

session_start();

include("conexao.php");

$email = $_POST['email-event-for-cod'];

if (preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/", $email)){

	$sql_email = "SELECT email_usuario
				  FROM usuario
				  WHERE email_usuario = '$email'";
			 
	$resultado_email = mysqli_query($con, $sql_email);	

	$row_user = mysqli_num_rows($resultado_email);

	$cod_org = $_SESSION['cod_org'];

    if ($row_user > 0) {

		$assunto = "Codigo de cadastro na organização!";

		$menssagem = "
						<html lang=\"pt-br\">
						<head>
						  <title>Codigo de cadastro na organização!</title>
						  <meta charset=\"utf-8\">
						</head>
						<body>
						  <p> Vincule-se na organização com o código: " . MD5($cod_org) ."</p>
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

			$_SESSION['msg-intern'] = "Código enviado com sucesso!";

			header("Location: organization.php");

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

				$_SESSION['msg-intern'] = "Código enviado com sucesso!";

				header("Location: organization.php");

			}else{

				$_SESSION['msg-intern'] = "Erro no envio do e-mail: ". $Mailer->ErrorInfo ." Por favor, tente novamente mais tarde!";
							
				$resultado = mysqli_query($con, $sql_delete);

				header("Location: organization.php");
			}
		}

	} else {

		$_SESSION['msg-intern'] = "Nenhum eventureiro foi encontrado com o email informado!";
		header("Location: organization.php");
	}

} else {

	unset ($_SESSION['email_evet_for_cod']);

	$_SESSION['msg-intern'] = "O email inserido não parece válido";

	header("Location: organization.php");
}

?>