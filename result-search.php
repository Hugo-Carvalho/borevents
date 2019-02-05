<?php

    session_start();

    $_SESSION['search'] = $_POST['search'];
    
    if((isset ($_SESSION['email']) == false) and (isset ($_SESSION['senha']) == false)) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:result-search-s.php');
    }
 
    $logado = $_SESSION['email'];

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

      <!-- Owl Carousel 2 CSS -->
      <link rel="stylesheet" href="owlcarousel/dist/assets/owl.carousel.css">
      <link rel="stylesheet" href="owlcarousel/dist/assets/owl.theme.default.min.css">

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

                    <a href="info.php"><img src="<?php echo $_SESSION['img']; ?>" class="img-circle" width="50" height="50" /></a>

                </div>
            </div>
        </nav>

        <div class="camp-users">
            <ul class="nav nav-tabs">
                <li class="active"><a class="pointer" data-toggle="tab" href="#eventureiros">Eventureiros</a></li>
                <li class="active"><a class="pointer" data-toggle="tab" href="#organizacoes">Organizações</a></li>
            </ul>

            <div class="tab-content">
                <div id="eventureiros" class="tab-pane active">
                   <?php

                        include("conexao.php");

                        $search = $_SESSION['search'];

                        $sql_user = "SELECT *
                                     FROM usuario
                                     WHERE nome_usuario LIKE '%$search%' OR
                                           email_usuario LIKE '%$search%'
                                     ORDER BY cod_usuario DESC";

                        $resultado_user = mysqli_query($con, $sql_user);

                        $row_user = mysqli_num_rows($resultado_user);

                        if ($row_user > 0) {

                            echo "<div class=\"form-group col-sm-12\">";
                                echo "<div class=\"owl-carousel owl-theme\">";

                                    while($lista=mysqli_fetch_array($resultado_user)){

                                        echo "<div class=\"item\">";
                                            echo "<div class=\"columns\">";
                                                echo "<div class=\"d-block d-md-none d-lg-none\">";
                                                    echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($lista['cod_usuario']) . "\">";
                                                        echo "<img class=\"img-circle view-image-perfil-sm\" src=\"" . $lista['img_usuario'] . "\">";
                                                    echo "</a>";
                                                echo "</div>";
                                                echo "<div class=\"d-none d-md-block d-lg-none\">";
                                                    echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($lista['cod_usuario']) . "\">";
                                                        echo "<img class=\"img-circle view-image-perfil-md\" src=\"" . $lista['img_usuario'] . "\">";
                                                    echo "</a>";
                                                echo "</div>";
                                                echo "<div class=\"d-none d-md-none d-lg-block\">";
                                                    echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($lista['cod_usuario']) . "\">";
                                                        echo "<img class=\"img-circle view-image-perfil-lg\" src=\"" . $lista['img_usuario'] . "\">";
                                                    echo "</a>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                echo "</div>";
                            echo "</div>";

                        } else {

                            echo "<div class=\"d-none d-md-block\">";
                                echo "<div class=\"null-evento\">";
                                    echo "<p>Nenhum eventureiro encontrado!</p>";
                                echo "</div>";
                            echo "</div>";
                            echo "<div class=\"d-block d-md-none\">";
                                echo "<div class=\"null-evento-sm\">";
                                    echo "<p>Nenhum eventureiro encontrado!</p>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>

                </div>
                <div id="organizacoes" class="tab-pane fade">
                   <?php

                        include("conexao.php");

                        $search = $_SESSION['search'];

                        $sql_org = "SELECT *
                                    FROM organizacao
                                    WHERE nome_org LIKE '%$search%' AND
                                          cod_org <> '1'
                                    ORDER BY cod_org DESC";

                        $resultado_org = mysqli_query($con, $sql_org);

                        $row_org = mysqli_num_rows($resultado_org);

                        if ($row_org > 0) {

                            echo "<div class=\"form-group col-sm-12\">";
                                echo "<div class=\"owl-carousel owl-theme\">";

                                    while($lista=mysqli_fetch_array($resultado_org)){

                                        echo "<div class=\"item\">";
                                            echo "<div class=\"columns\">";
                                                echo "<div class=\"d-block d-md-none d-lg-none\">";
                                                    echo "<a href=\"https://borevents.com/perfil-org.php?b=" . MD5($lista['cod_org']) . "\">";
                                                        echo "<img class=\"img-circle view-image-perfil-sm\" src=\"" . $lista['img_org'] . "\">";
                                                    echo "</a>";
                                                echo "</div>";
                                                echo "<div class=\"d-none d-md-block d-lg-none\">";
                                                    echo "<a href=\"https://borevents.com/perfil-org.php?b=" . MD5($lista['cod_org']) . "\">";
                                                        echo "<img class=\"img-circle view-image-perfil-md\" src=\"" . $lista['img_org'] . "\">";
                                                    echo "</a>";
                                                echo "</div>";
                                                echo "<div class=\"d-none d-md-none d-lg-block\">";
                                                    echo "<a href=\"https://borevents.com/perfil-org.php?b=" . MD5($lista['cod_org']) . "\">";
                                                        echo "<img class=\"img-circle view-image-perfil-lg\" src=\"" . $lista['img_org'] . "\">";
                                                    echo "</a>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                echo "</div>";
                            echo "</div>";

                        } else {

                            echo "<div class=\"d-none d-md-block\">";
                                echo "<div class=\"null-evento\">";
                                    echo "<p>Nenhuma organização encontrada!</p>";
                                echo "</div>";
                            echo "</div>";
                            echo "<div class=\"d-block d-md-none\">";
                                echo "<div class=\"null-evento-sm\">";
                                    echo "<p>Nenhuma organização encontrada!</p>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>

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

                        $search = $_SESSION['search'];

                        $sql = "SELECT *
                                FROM evento
                                WHERE nome_evento LIKE '%$search%' OR
                                      desc_evento LIKE '%$search%'
                                ORDER BY cod_evento DESC";

                        $resultado = mysqli_query($con, $sql);

                        $row = mysqli_num_rows($resultado);

                        if ($row > 0) {

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

                                    $cod_org_event = $lista_org['cod_org'];
                                    $img_org_event = $lista_org['img_org'];
                                    $nome_org_event = $lista_org['nome_org'];
                                }
                                
                                echo "<div class=\"feed-container\">";
                                    echo "<div class=\"container\">";
                                        echo "<div class=\"autor\">";
                                            if($cod_org_event == 1) {
                                                echo "<a href=\"https://borevents.com/perfil-user.php?b=" . MD5($cod_usuario) . "\">";
                                                    echo "<img class=\"img-circle view-image-perfil\" src=\"" . $img_usuario . "\" width=\"70\" height=\"70\">";
                                                    echo "<span>" . $nome_usuario . "</span>";
                                                echo "</a>";
                                            } else {
                                                echo "<a href=\"https://borevents.com/perfil-org.php?b=" . MD5($cod_org_event) . "\">";
                                                    echo "<img class=\"img-circle view-image-perfil\" src=\"" . $img_org_event . "\" width=\"70\" height=\"70\">";
                                                    echo "<span>" . $nome_org_event . "</span>";
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
                                        if($lista['cod_usuario_fk'] == $id || ($lista['cod_org_fk'] == $cod_org && $lista['cod_org_fk'] != 1)) {
                                            echo "<div class=\"btns\">";
                                                echo "<a href=\"https://borevents.com/edit-event.php?b=" . MD5($lista['cod_evento']) . "\">";
                                                    echo "<input class=\"btn btn-dark pointer\" type=\"submit\" name=\"edit-event\" value=\"Editar este evento\"></input>";
                                                echo "</a>";
                                            echo "</div>";
                                        }
                                    echo "</div>";
                                echo "</div>";
                            }

                        } else {

                            echo "<div class=\"d-none d-md-block\">";
                                echo "<div class=\"null-evento\">";
                                    echo "<p>Ops... Nenhum evento encontrado!</p>";
                                echo "</div>";
                            echo "</div>";
                            echo "<div class=\"d-block d-md-none\">";
                                echo "<div class=\"null-evento-sm\">";
                                    echo "<p>Ops... Nenhum evento encontrado!</p>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>

                </div>
            </div>
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

        <script src="owlcarousel/dist/owl.carousel.js"></script>

        <script type="text/javascript">
            
            $('.owl-carousel').owlCarousel({
                loop:false,
                margin:10,
                nav:true,
                responsive : {
                    // breakpoint from 0 up
                    0 : {

                        items:3.2
                    },

                    450 : {

                        items:4
                    },
                    // breakpoint from 480 up
                    520 : {
                        
                        items:4.2
                    },
                    // breakpoint from 768 up
                    768 : {
                        
                        items:4
                    },

                    912 : {
                        
                        items:4
                    },

                    1100 : {
                        
                        items:4.5
                    },

                    1315 : {
                        
                        items:6
                    }

                }
            });
        </script> 

    </footer>
</html>