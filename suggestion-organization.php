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

    $id = $_SESSION['id'];

    $sql = "SELECT cod_tipo_fk
            FROM usuario
            WHERE cod_usuario = '$id'";

    $resultado = mysqli_query($con, $sql);

    while ($lista=mysqli_fetch_array($resultado)) { 

        $tipo = $lista[0];
    }

    if($tipo == 2){ //eventureiro

        header('location:suggestion-organizer.php');
    }

    $select_org = "SELECT cod_org_fk
                   FROM usuario 
                   WHERE cod_usuario = '$id'";

    $resultado = mysqli_query($con, $select_org);

    while($lista = mysqli_fetch_array($resultado)){

        $cod_org = $lista[0];

    }

    if ($cod_org != 1) {

        header('location:organization.php');
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

                <a href="info.php"><img src="<?php echo $_SESSION['img']; ?>" class="img-circle" width="50" height="50" /></a>

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
                        <a class="nav-link disabled">Minha organização</a>
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

                    <a href="info.php"><img src="<?php echo $_SESSION['img']; ?>" class="img-circle" width="50" height="50" /></a>

                </div>
            </div>
        </nav>

    <div class="container">
        <div class="form-group col-xs-12">
            <div class="msg-congratulations">
                <p class="title">Aeee... Você é um organizador!</p>
            </div>
            <div class="msg-congratulations">
                <p class="subtitle">Você já pode criar eventos, porem com uma organização tudo fica mais dinâmico!</p>
            </div>
            <div class="msg-congratulations-org">
                <p>A orgnização é como um grupo, assim você e outras pessoas podem divulgar um mesmo evento e os eventureiros que seguirem a organização irão visualizar!</p>
            </div>
            <p class="wish">Então, você deseja...</p>
        	<div class="d-none d-md-block">
	          	<div class="create-org-lg">
	            	<span class="pointer" data-toggle="collapse" data-target="#content-create-org-lg"  >&#9819; Criar uma nova organização!</span>
	            </div>
	      		<div class="collapse navbar-collapse" id="content-create-org-lg">
	      			<form method="POST" action="create-organization.php" enctype="multipart/form-data">
		   				<label class="lab-margin-top">Nome organização:</label>
		   				<input type="text" class="form-control" name="nome-org" placeholder="Nome da organização" required>
		  				<label class="lab-margin-top">Escolha a imagem da organização:</label>	
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <input class="form-control" id="name-file" name="name-file" placeholder="Selecionar imagem para a organização" disabled="disabled" />
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="file-upload btn btn-dark pointer">
                                    <span>Selecionar imagem</span>
                                    <input id="upload-btn" name="upload-btn" type="file" class="upload form-control-file" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 pos-center" id="image-holder"></div>
		   				<div class="insert-link-org">
		   					<input class="btn btn-dark pointer" id="submit" type="submit" value="Bora">
		   				</div>
					</form>
				</div>
		        <div class="link-org-lg">
		        	<span class="pointer" data-toggle="collapse" data-target="#content-link-org-lg" >&#9819; Vincular-se a uma organização!</span>
                </div>
	        	<div class="collapse navbar-collapse" id="content-link-org-lg">
	        		<div class="form-group col-sm-12">
	        			<div class="form-group col-sm-4 insert-link-org">
	        				<form method="POST" action="link-organization.php">
		        				<input type="text" class="form-control nome-link-org lab-margin-top" name="nome-link-org" placeholder="Insira o código da organização" required/>
								<input class="btn btn-dark lab-margin-top pointer" id="submit" type="submit" value="Bora">	
							</form>
	        			</div>
	        		</div>
	       		</div>    
                <div class="continue-lg">
                    <a href="my-events.php">&#9819; Continuar sem uma organização!</a>
                </div>
		    </div>
		    <div class="d-block d-md-none">
	          	<div class="create-org-sm">
	            	<span class="pointer" data-toggle="collapse" data-target="#content-create-org-sm"  >&#9819; Criar uma nova organização!</span>
	            </div>
	      		<div class="collapse navbar-collapse" id="content-create-org-sm">
	      			<form method="POST" action="create-organization.php" enctype="multipart/form-data">
		   				<label class="lab-margin-top">Nome organização:</label>
		   				<input type="text" class="form-control" name="nome-org" placeholder="Nome organização" required>
		  				<label class="lab-margin-top">Escolha a imagem da organização:</label>	
		   				<div class="form-row">
                            <div class="form-group col-sm-6">
                                <input class="form-control" id="name-file" name="name-file" placeholder="Selecionar imagem para a organização" disabled="disabled" />
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="file-upload btn btn-dark pointer">
                                    <span>Selecionar imagem</span>
                                    <input id="upload-btn" name="upload-btn" type="file" class="upload form-control-file" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 pos-center" id="image-holder"></div>
						<div class="insert-link-org">
		   					<input class="btn btn-dark pointer" id="submit" type="submit" value="Bora">   	
		   				</div>
					</form>
	      		</div>
		        <div class="link-org-sm">
		        	<span class="pointer" data-toggle="collapse" data-target="#content-link-org-sm" >&#9819; Vincular-se a uma organização!</span>
                </div>
	        	<div class="collapse navbar-collapse" id="content-link-org-sm">
	        		<div class="form-group col-sm-12">
	        			<div class="form-group col-sm-4 insert-link-org">
	        				<form method="POST" action="link-organization.php">
		        				<input class="form-control nome-link-org lab-margin-top" name="nome-link-org" placeholder="Insira o código da organização" required />
								<input class="btn btn-dark lab-margin-top pointer" id="submit" type="submit" value="Bora"> 
							</form>	
	        			</div>
	        		</div>
	       		</div>  
                <div class="continue-sm">
                    <a href="my-events.php">&#9819; Continuar sem uma organização!</a>
                </div>
		    </div>
	    </div>
        <?php
            if(isset($_SESSION['msg-intern'])) {
                echo $_SESSION['msg-intern'];
                unset($_SESSION['msg-intern']);
            }
        ?>
	</div>
</body>
<footer> 

        <?php include("footer.html") ?>
        
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

    <script src="js/script.js"></script>

    <script type="text/javascript">

        document.getElementById("upload-btn").onchange = function () {
            document.getElementById("name-file").value = this.value;
        };
        
        $("#upload-btn").on('change', function () {
             
            if (typeof (FileReader) != "undefined") {
         
                var image_holder = $("#image-holder");
         
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (true) {
                        image_holder.empty();
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-circle img-thumbnail insert-image-org"
                        }).appendTo(image_holder);
                    }
                }

                image_holder.show();
                $("#img-file").hide();
                reader.readAsDataURL($(this)[0].files[0]);

            } else {

                alert("Este navegador nao suporta FileReader.");
            }
        });

    </script>

</footer>
</html>