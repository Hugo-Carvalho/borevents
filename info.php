<?php

    session_start();

    if((isset ($_SESSION['email']) == false) and (isset ($_SESSION['senha']) == false)) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }
 
    $logado = $_SESSION['email'];

    $_SESSION['msg'] = "Faça seu login eventureiro!";

    include("conexao.php");

    $cod_org = $_SESSION['cod_org'];

    $sql_org = "SELECT nome_org
                FROM organizacao
                WHERE cod_org = '$cod_org'";

    $resultado_org = mysqli_query($con, $sql_org);

    while ($lista=mysqli_fetch_array($resultado_org)) {  

        $nome_org = $lista[0];
    }

    $_SESSION['nome_org'] = $nome_org;
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
    <link rel="stylesheet" href="style/css/style-screens-segs.css">
    <link rel="stylesheet" href="style/css/footer.css">
    
  </head>
	<body>
		<nav class="navbar navbar-fixed-top navbar-expand-lg navbar-dark bg-gradient-primary">
          
        <div class="container">
      
            <a class="navbar-brand mb-0" href="home.php"><img class="logo" src="imgs/go-events_logo_black.png" /></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">

                <span class="navbar-toggler-icon"></span>
                
            </button>

            <div class="d-block d-lg-none">

                <img src="<?php echo $_SESSION['img']; ?>" class="img-circle" width="50" height="50" />

            </div>

            <div class="collapse navbar-collapse" id="navbarSite">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="maps.php">Maps</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="my-events.php">Meus eventos</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="suggestion-organization.php">Minha organização</a>
                    </li>
                
                </ul>

                <div class="d-block d-md-none">
                
                    <form class="form-inline search-events" method="POST" action="result-search.php">
                        <input class="form-control ml-4 mr-2" id="events-sm" name="search" type="search" placeholder="Buscar Organizações, Eventos...">
                        <input class="btn btn-dark pointer" id="submit-events-sm" type="submit" value="Bora"></input>
                    </form>

                </div>

                <div class="d-none d-md-block">
            
                    <form class="form-inline search-events" method="POST" action="result-search.php">
                        <input class="form-control ml-4 mr-2" id="events" name="search" type="search" placeholder="Buscar organizações, Eventos...">
                        <input class="btn btn-dark pointer" id="submit-events" type="submit" value="Bora"></input>
                    </form>

                </div>

                <div class="d-none d-lg-block">

                    <img src="<?php echo $_SESSION['img']; ?>" class="img-circle" width="50" height="50" />

                </div>

            </div>
      
        </nav>
		<form>
			<div class="container">
				<div class="space-top">
					<!--Informações do cadastro.-->

					<!--Foto de perfil.-->
					<div class="image">
						<img class="img-circle img-thumbnail edit-image-perfil" src="<?php echo $_SESSION['img']; ?>">
					</div>
					<div class="infos">
                        <p><label>Organização: <?php echo $_SESSION['nome_org']; ?></label></p>
						<p><label>Nome: <?php echo $_SESSION['nome']; ?></label></p>
						<p><label>Email: <?php echo $_SESSION['email']; ?></label></p>
					</div>
					<div class="msg-intern-right">
						<?php
	                        if(isset($_SESSION['msg-intern'])) {
	                            echo $_SESSION['msg-intern'];
	                            unset($_SESSION['msg-intern']);
	                        }
	                    ?>
                	</div>
					<!--Botão para fazer a edição do cadastro.-->
					<div class="buttons-footer">
                        <a href="editar-usuario.php">
						  <input class="btn btn-dark submit-button_edit pointer" id="submit-edit" type="button" value="Editar informações">
                        </a>
                        <a href="logout.php">
						  <input class="btn btn-dark submit-button_exit pointer" id="submit-exit" type="button" value="Sair">
                        </a>
					</div>
				</div>
			</div>
		</form>
	</body>
	<footer>

        <?php include("footer.html") ?>
      
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="node_modules/jquery/dist/jquery.js"></script>
      <script src="node_modules/popper.js/dist/umd/popper.js"></script>
      <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
       
      <script src="js/script.js"></script>

    </footer>
</html>