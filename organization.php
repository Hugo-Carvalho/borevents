<?php

    session_start();
    
    if((isset ($_SESSION['email']) == false) and (isset ($_SESSION['senha']) == false)) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }
 
    $logado = $_SESSION['email'];

    $_SESSION['msg'] = "Faça seu login eventureiro!";

    include('conexao.php');

    $id = $_SESSION['id'];

    $cod_org = $_SESSION['cod_org'];

    $sql_exibir = "SELECT nome_org, img_org
                   FROM organizacao 
                   WHERE cod_org = '$cod_org'";

    $resultado_exibir = mysqli_query($con, $sql_exibir);

    while ($lista=mysqli_fetch_array($resultado_exibir)) {  

        $nome_org = $lista[0];
        $img_org = $lista[1];
    }

    $_SESSION['nome_org'] = $nome_org;
    $_SESSION['img_org'] = $img_org;
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
          
        <link rel="stylesheet" href="style/css/style.css">
        <link rel="stylesheet" href="style/css/style-maps.css">
        <link rel="stylesheet" href="style/css/style-screens-segs.css">
          
        <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="style/css/footer.css">
        
    </head>
    <body>

        <div id="overlay" class="invisible"></div>
            <div id="loads" class="lds-css ng-scope invisible">
                <div class="lds-rolling load">
                <div></div>
            </div>
        </div>
      
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
        
        <div class="d-block">
            <div id="sidenav-sm" class="sidenav-sm">
                <a href="javascript:void(0)" class="closebtn-sm" onclick="close_nav()">&times;</a>
                <div class="view-users-org">
                	<div class="btn-add">
		                <a href="" class="link pointer" data-toggle="modal" data-target="#modal-add-event">
		                	<input class="btn btn-outline-light login pointe" type="submit" value="Add eventureiro"></input>
		                </a>
		                <?php

		                    if(isset($_SESSION['msg-intern'])) {
		                        echo $_SESSION['msg-intern'];
	                            echo "<input hidden=\"true\" type=\"text\" id=\"msg-intern-sm\" value=\"" . $_SESSION['msg-intern'] . "\"></input>";
		                    }
		                ?>
		            </div>
		            <?php

                        include("conexao.php");

                        $cod_org = $_SESSION['cod_org'];

                        $sql_users_org = "SELECT *
                                          FROM usuario
                                          WHERE cod_org_fk = '$cod_org'
                                          ORDER BY cod_usuario DESC";

                        $resultado_users_org = mysqli_query($con, $sql_users_org);

                        while($lista=mysqli_fetch_array($resultado_users_org)){

                            echo "<div class=\"container nome-user\">";
                                echo "<div class=\"form-group col-xs-12\">";
                                    echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($lista['cod_usuario']) . "\">";
                                        echo "<img src=\"" . $lista['img_usuario'] . "\" class=\"img-circle img-user-org\" width=\"50\" height=\"50\" />";
                                    echo "</a>";
                                echo "</div>";
                                echo "<div class=\"form-group col-xs-12\">";
                                    echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($lista['cod_usuario']) . "\">";
                                        echo "<span>" . $lista['nome_usuario'] . "</span>";

                                        if($lista['cod_usuario'] == $id){
	                                        echo "<a href=\"\" class=\"link pointer\" data-toggle=\"modal\" data-target=\"#modal-exit-org\">";
							                	echo "<input class=\"btn btn-outline-light login pointer\" type=\"submit\" value=\"Sair da organização\"></input>";
							                echo "</a>";
							            }
                                    echo "</a>";
                                 echo "</div>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="d-none d-md-block">
            <div id="sidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="close_nav_push()">&times;</a>
                <div class="view-users-org">
                	<div class="btn-add">
		                <a href="" class="link pointer" data-toggle="modal" data-target="#modal-add-event">
		                	<input class="btn btn-outline-light login pointer" type="submit" value="Add eventureiro"></input>
		                </a>
		                <?php

		                    if(isset($_SESSION['msg-intern'])) {
		                        echo $_SESSION['msg-intern'];
	                            echo "<input hidden=\"true\" type=\"text\" id=\"msg-intern\" value=\"" . $_SESSION['msg-intern'] . "\"></input>";
	                            unset($_SESSION['msg-intern']);
		                    }
		                ?>
		            </div>
		            <?php

                        include("conexao.php");

                        $id = $_SESSION['id'];
                        $cod_org = $_SESSION['cod_org'];

                        $sql_users_org = "SELECT *
                                          FROM usuario
                                          WHERE cod_org_fk = '$cod_org'
                                          ORDER BY cod_usuario DESC";

                        $resultado_users_org = mysqli_query($con, $sql_users_org);

                        while($lista=mysqli_fetch_array($resultado_users_org)){

                            echo "<div class=\"container nome-user\">";
                                echo "<div class=\"form-group col-xs-12\">";
                                    echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($lista['cod_usuario']) . "\">";
                                        echo "<img src=\"" . $lista['img_usuario'] . "\" class=\"img-circle img-user-org\" width=\"50\" height=\"50\" />";
                                    echo "</a>";
                                echo "</div>";
                                echo "<div class=\"form-group col-xs-12\">";
                                    echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($lista['cod_usuario']) . "\">";
                                        echo "<span>" . $lista['nome_usuario'] . "</span>";

                                        if($lista['cod_usuario'] == $id){
	                                        echo "<a href=\"\" class=\"link pointer\" data-toggle=\"modal\" data-target=\"#modal-exit-org\">";
							                	echo "<input class=\"btn btn-outline-light login pointer\" type=\"submit\" value=\"Sair da organização\"></input>";
							                echo "</a>";
							            }
                                    echo "</a>";
                                 echo "</div>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="main">
            <div class="container">
            	<div class="msg-org">
	            </div>
                <div class="name-org">
                    <label><?php echo $_SESSION['nome_org']; ?></label>
                </div>
                <div class="image">
                    <img class="img-circle img-thumbnail edit-image-perfil" src="<?php echo $_SESSION['img_org']; ?>">
                </div>
            </div>
            <div class="form-group col-xs-12">
                <div class="container">
                    <div class="d-none d-md-none d-lg-block">
                        <div class="menu-seg">
                            <span class="pointer" data-toggle="collapse" data-target="#content-update-org">&#9998; Editar informações</span>
                            <div class="buscar-btn">
                                <span class="pointer" onclick="open_nav_push()">&#9776; Ver integrantes</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-block d-lg-none">
                        <div class="menu-seg-md">
                            <span class="pointer" data-toggle="collapse" data-target="#content-update-org">&#9998; Editar informações</span>
                            <div class="buscar-btn-md">
                                <span class="pointer" onclick="open_nav_push()">&#9776; Ver integrantes</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-block d-md-none d-lg-none">
                        <div class="menu-seg-sm">
                            <span class="pointer" data-toggle="collapse" data-target="#content-update-org">&#9998; Editar informações</span>
                            <div class="buscar-btn-sm">
                                <span class="pointer" onclick="open_nav()">&#9776; Ver integrantes</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <div class="container">
		            <div class="collapse navbar-collapse" id="content-update-org">
		            	<form method="POST" action="update-organization.php" enctype="multipart/form-data">
			   				<label class="lab-margin-top">Nome organização:</label>
			   				<input type="text" class="form-control" name="nome-org" placeholder="Nome da organização" value="<?php echo $_SESSION['nome_org']; ?>" required>
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
		                    <?php
			                    if(isset($_SESSION['msg-intern-uporg'])) {
			                        echo $_SESSION['msg-intern-uporg'];
			                        unset($_SESSION['msg-intern-uporg']);
			                    }
			                ?>
			   				<div class="insert-link-org">
			   					<input class="btn btn-dark pointer" id="submit" type="submit" value="Bora">
			   				</div>
						</form>
					</div>
				</div>
			</div>
            <div class="form-group col-xs-10">
                <div class="feed">
                    <div class="container">
                        <?php

                            include("conexao.php");

                            $id = $_SESSION['id'];
                            $cod_org = $_SESSION['cod_org'];

                            $sql = "SELECT *
                                FROM evento
                                WHERE cod_org_fk = '$cod_org'
                                ORDER BY cod_evento DESC";

                            $resultado = mysqli_query($con, $sql);

                            while($lista=mysqli_fetch_array($resultado)){

                                $cod_evento = $lista['cod_evento'];

                                $sql_loc = "SELECT *
                                            FROM localizacao
                                            WHERE cod_evento_fk = '$cod_evento'";

                                $resultado_loc = mysqli_query($con, $sql_loc);

                                while($lista_loc=mysqli_fetch_array($resultado_loc)){

                                    $lat = $lista_loc['lat_local'];
                                    $lng = $lista_loc['lng_local'];
                                    $end = $lista_loc['end_local'];
                                }

                                $cod_usuario_fk = $lista['cod_usuario_fk'];

                                $sql_user = "SELECT *
                                             FROM usuario
                                             WHERE cod_usuario = '$cod_usuario_fk'";

                                $resultado_user = mysqli_query($con, $sql_user);

                                while($lista_user=mysqli_fetch_array($resultado_user)){

                                    $cod_usuario = $lista_user['cod_usuario'];
                                    $img_usuario = $lista_user['img_usuario'];
                                    $nome_usuario = $lista_user['nome_usuario'];
                                }

                                $cod_org_fk = $lista['cod_org_fk'];

                                $sql_org = "SELECT *
                                             FROM organizacao
                                             WHERE cod_org = '$cod_org_fk'";

                                $resultado_org = mysqli_query($con, $sql_org);

                                while($lista_org=mysqli_fetch_array($resultado_org)){

                                    $cod_org = $lista_org['cod_org'];
                                    $img_org = $lista_org['img_org'];
                                    $nome_org = $lista_org['nome_org'];
                                }
                                
                                echo "<div class=\"feed-container\">";
                                    echo "<div class=\"container\">";
                                        echo "<div class=\"autor\">";
                                            if($cod_org == 1) {
                                                echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($cod_usuario) . "\">";
                                                    echo "<img class=\"img-circle view-image-perfil\" src=\"" . $img_usuario . "\" width=\"70\" height=\"70\">";
                                                    echo "<span>" . $nome_usuario . "</span>";
                                                echo "</a>";
                                            } else {
                                                echo "<a href=\"https://borevents.com/perfil-org.php?b=" . MD5($cod_org) . "\">";
                                                    echo "<img class=\"img-circle view-image-perfil\" src=\"" . $img_org . "\" width=\"70\" height=\"70\">";
                                                    echo "<span>" . $nome_org . "</span>";
                                                echo "</a>";
                                            }
                                        echo "</div>";
                                        echo "<div class=\"event\">";
                                            echo "<div class=\"header\">";
                                                echo "<div class=\"nome-evento\">";
                                                    echo "<h1>" . $lista['nome_evento'] . "</h1>";
                                                echo "</div>";
                                            echo "</div>";
                                            echo "<div class=\"img\">";
                                                if($lista['img_evento'] != null) {
                                                    echo "<img src=\"" . $lista['img_evento'] . "\" class=\"img-thumbnail img-evento\" />";
                                                }
                                            echo "</div>";
                                            echo "<div class=\"desc\">";
                                                echo "<div class=\"desc-evento\">";
                                                    echo "<p>" . $lista['desc_evento'] . "</p>";
                                                echo "</div>";
                                                echo "<div class=\"valor-evento\">";
                                                    echo "<p>&#128181; Valor: " . $lista['valor_evento'] . "</p>";
                                                echo "</div>";
                                                echo "<div class=\"data-evento\">";
                                                    echo "<p>&#128197; Data: " . date('d/m/Y',  strtotime($lista['data_evento'])) . "</p>";
                                                    echo "<p>&#128337; Hora: " . $lista['hora_evento'] . "</p>";
                                                echo "</div>";
                                                echo "<div class=\"local-evento\">";
                                                    echo "<p>Local do evento: " . $end . "</p>";
                                                        echo "<form class=\"form-inline\" method=\"POST\" action=\"maps.php\">";
                                                            echo "<input hidden=\"true\" type=\"text\" name=\"lat\" value=\"" . $lat . "\"></input>";   
                                                            echo "<input hidden=\"true\" type=\"text\" name=\"lng\" value=\"" . $lng . "\"></input>";   
                                                            echo "<button class=\"btn btn-sm btn-outline-light text-dark pointer\" type=\"submit\"><img class=\"map-icon\" src=\"imgs/map-icon.png\"> Ver no maps</button>";
                                                        echo "</form>";
                                                echo "</div>";
                                                echo "<div class=\"site-evento\">";
                                                    if($lista['site_evento'] != null) {
                                                        echo "<p>&#10149; Acesse <a href='http://" . $lista['site_evento'] . "' target=\"_blank\">" . $lista['site_evento'] . "</a> para mais informações!</p>";
                                                    }
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                        echo "<div class=\"btns\">";
                                            echo "<a href=\"https://borevents.com/edit-event.php?b=" . MD5($lista['cod_evento']) . "\">";
					                      		echo "<input class=\"btn btn-dark pointer\" type=\"submit\" name=\"edit-event\" value=\"Editar este evento\"></input>";
					                      	echo "</a>";
                                        echo "</div>";
                                        echo "<div class=\"comentarios\">";
                                              echo "<form method=\"POST\" action=\"comentario.php\" enctype=\"multipart/form-data\">";
                                                  echo "<div class=\"form-group col-sm-12\">";
                                                      echo "<textarea name=\"comentario\" class=\"form-control comentario\" type=\"text\" placeholder=\"Digite um comentário...\"></textarea>";
                                                  echo "</div>";
                                                  echo "<input hidden=\"true\" type=\"text\" name=\"cod_event\" value=\"" . $cod_evento . "\"></input>";
                                                  echo "<input class=\"btn btn-dark pointer\" id=\"submit\" type=\"submit\" value=\"Bora\">";
                                              echo "</form>";
                                              echo "</div>";

                                            $sql = "SELECT *
                                                    FROM comentario
                                                    WHERE cod_evento_fk = '$cod_evento'
                                                    ORDER BY cod_coment DESC";

                                              $resultado_coment = mysqli_query($con, $sql);

                                              $row = mysqli_num_rows($resultado_coment);

                                              if ($row > 0) {

                                                while($lista=mysqli_fetch_array($resultado_coment)){

                                                  $cod_usuario_fk = $lista['cod_usuario_fk'];

                                                  $sql_user = "SELECT *
                                                           FROM usuario
                                                           WHERE cod_usuario = '$cod_usuario_fk'";

                                                  $resultado_user = mysqli_query($con, $sql_user);

                                                  while($lista_user=mysqli_fetch_array($resultado_user)){

                                                    $cod_usuario = $lista_user['cod_usuario'];
                                                    $img_usuario = $lista_user['img_usuario'];
                                                    $nome_usuario = $lista_user['nome_usuario'];
                                                  }
                                                  
                                                  echo "<div class=\"feed-container\">";
                                                      echo "<div class=\"container\">";
                                                          echo "<div class=\"autor\">";
                                                                echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($cod_usuario) . "\">";
                                                                  echo "<img class=\"img-circle view-image-perfil\" src=\"" . $img_usuario . "\" width=\"45\" height=\"45\">";
                                                                  echo "<span>" . $nome_usuario . "</span>";
                                                                echo "</a>";
                                                                echo "<span> --- " . $lista['text_coment'] . "</span>";
                                                          echo "</div>";
                                                      echo "</div>";
                                                  echo "</div>";
                                              }
                                            }
                                    echo "</div>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>

        <?php include("footer.html") ?>
      
        <script>

            function open_nav_push() {
                document.getElementById("sidenav").style.width = "250px";
                document.getElementById("main").style.marginRight = "250px";
            }

            function close_nav_push() {
                document.getElementById("sidenav").style.width = "0";
                document.getElementById("main").style.marginRight = "0";
            }

            function open_nav() {
                document.getElementById("sidenav-sm").style.width = "250px";;
            }

            function close_nav() {
                document.getElementById("sidenav-sm").style.width = "0";
            }
        </script>
          
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
                        image_holder.empty();
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-circle img-thumbnail insert-image-org"
                        }).appendTo(image_holder);
	                }

	                image_holder.show();
	                $("#img-file").hide();
	                reader.readAsDataURL($(this)[0].files[0]);

	            } else {

	                alert("Este navegador nao suporta FileReader.");
	            }
	        });

	    </script>
    	<script type="text/javascript">
			
			var lar = screen.width;

    		if(document.getElementById('msg-intern') != null && lar >= 768){

    			open_nav_push();
    		} else {

    			close_nav_push();
    		}
    	
    		if(document.getElementById('msg-intern-sm') != null && lar < 768){

    			open_nav();
    		} else{

    			close_nav();
    		}

            function registerFull(){
                document.getElementById("overlay").classList.remove("invisible");
                document.getElementById("loads").classList.remove("invisible");
            }
    	</script>

        <!-- Modal -->
	  	<div class="modal fade" id="modal-add-event" role="dialog">
	    	<div class="modal-dialog">
	    
	      		<!-- Modal content-->
		      	<div class="modal-content">
		        	<div class="modal-header">
		          		<button type="button" class="close" data-dismiss="modal">&times;</button>
		          		<h4 class="modal-title">Adicionar eventureiro</h4>
		        	</div>
		        	<div class="modal-body">

		        		<form method="POST" action="add-for-organization.php">

			          		<p class="reset-pass-txt">Informe o email de login do eventureiro para que ele possa obter o código de acesso da organização.</p>
                            <input type="E-mail" name="email-event-for-cod" id="email-event-for-cod" class="form-control" placeholder="E-mail do eventureiro" required>
							<div class="email-evet-for-cod-btn">
								<input type="submit" onclick="registerFull()" class="btn btn-dark pointer" value="Bora">
							</div>
						</form>
		        	</div>
		      	</div>
	    	</div>
	  	</div>
	  	<div class="modal fade" id="modal-exit-org" role="dialog">
	    	<div class="modal-dialog">
	    
	      		<!-- Modal content-->
		      	<div class="modal-content">
		        	<div class="modal-header">
		          		<button type="button" class="close" data-dismiss="modal">&times;</button>
		          		<h4 class="modal-title">Sair da organização</h4>
		        	</div>
		        	<div class="modal-body">
		          		<p class="reset-pass-txt">Tem certeza que deseja sair da organização <?php echo $_SESSION['nome_org']; ?>?</p>
						<div class="email-evet-for-cod-btn">
							<a href="exit-organization.php">
								<input type="submit" class="btn btn-dark pointer" value="Sim">
							</a>
							<button type="button" class="btn btn-dark pointer" data-dismiss="modal">Não</button>
						</div>
		        	</div>
		      	</div>
	    	</div>
	  	</div>
    </footer>     
</html>