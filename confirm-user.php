<?php

	session_start();
	
	include("conexao.php");

	$id = $_GET['b'];

	if(!empty($id)){

		$sql = "UPDATE usuario
				SET confirmar_usuario = '1' 
				WHERE MD5(cod_usuario) = '$id'";

		$result = mysqli_query($con, $sql);

	}
?>
<!doctype html>
<html lang="pt-br">
    <head>
      <title>BorEvents</title>

      <link href="imgs/favicon.ico" rel="shortcut icon" />
      
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
      <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">

      <!-- Style -->
      <link rel="stylesheet" href="style/css/style.css">
      <link rel="stylesheet" href="style/css/style-login.css">
      
    </head>
    <body>
      <div class="full-body"> 
        <nav class="navbar navbar-expand-lg navbar">
            
          <div class="container">
        
              <img class="logo-login img-fluid" src="imgs/go-events_logo_black.png" />
              
        </nav>
        <div class="container window">
          <div class="window-content">
            <p>
              <div class="d-none d-lg-block">
                <h1 class="lg">
                  Yes... Você agora é um eventureiro!
                </h1>
              </div>
              <div class="d-block d-lg-none">
                <h1 class="md">
                  Yes... Você agora é um eventureiro!
                </h1>
              </div>
            </p>
            <div class="buttons">
              <a href="https://borevents.com/login.php">
                <button type="button" class="btn btn-outline-light btn-evt pointer">Eventurar</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>