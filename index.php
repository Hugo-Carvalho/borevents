<?php

	session_start();

	if((isset ($_SESSION['email']) == true) and (isset ($_SESSION['senha']) == true)) {

	    header('location:home.php');
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

              <ul class="navbar-nav nav">

	              <li class="nav-item">
	                  <a class="nav-link link-nm" href="login.php">Fazer login</a>
	              </li>

	              <li class="nav-item">
	                  <a class="nav-link link-nm" href="register.php">Criar conta</a>
	              </li>
	            
	          </ul>
          </div>
        </nav>
        <div class="container window">
          <div class="window-content">
            <p>
              <div class="d-none d-lg-block">
                <h1 class="lg">
                  Seus eventos favoritos em um só lugar!
                </h1>
              </div>
              <div class="d-block d-lg-none">
                <h1 class="md">
                  Seus eventos favoritos em um só lugar!
                </h1>
              </div>
            </p>
            <div class="buttons">
              <a href="home-s.php">
                <button type="button" class="btn btn-outline-light btn-evt pointer">Eventurar</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>