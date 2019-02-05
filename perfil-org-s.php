<?php

    session_start();

    if((isset ($_SESSION['email']) == true) and (isset ($_SESSION['senha']) == true)) {

        header('location:perfil-org.php?b=' . $_GET['b']);
    }
 
    $logado = $_SESSION['email'];

    include('conexao.php');

    $cod_org = $_GET['b'];

    $_SESSION['cod_org_insc'] = $cod_org;

    $sql_exibir = "SELECT nome_org, img_org
                   FROM organizacao 
                   WHERE MD5(cod_org) = '$cod_org'";

    $resultado_exibir = mysqli_query($con, $sql_exibir);

    while ($lista=mysqli_fetch_array($resultado_exibir)) {  

        $nome_org = $lista[0];
        $img_org = $lista[1];
    }

    $_SESSION['nome_org'] = $nome_org;
    $_SESSION['img_org'] = $img_org;

    $_SESSION['msg-insc'] = "&#9745; Inscrever-se";
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
      
      <nav class="navbar navbar-fixed-top navbar-expand-lg navbar-dark bg-gradient-primary">
          
        <div class="container">
      
            <a class="navbar-brand mb-0" href="home-s.php"><img class="logo" src="imgs/go-events_logo_black.png" /></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">

                <span class="navbar-toggler-icon"></span>
                
            </button>

          <div class="collapse navbar-collapse" id="navbarSite">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="maps-s.php">Maps</a>
                </li>

            </ul>

            <div class="d-none d-md-block">
        
                <form class="form-inline search-events" method="POST" action="result-search.php">
                    <input class="form-control ml-4 mr-2" id="events" name="search" type="search" placeholder="Buscar organizações, Eventos...">
                    <input class="btn btn-dark pointer" id="submit-events" type="submit" value="Bora"></input>
                </form>

            </div>

            <ul class="navbar-nav nav">

              <li class="nav-item">
                  <a class="nav-link" href="login.php">Fazer login</a>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="register.php">Criar conta</a>
              </li>
            
            </ul>

            <div class="d-block d-md-none">
                
                <form class="form-inline search-events" method="POST" action="result-search.php">
                    <input class="form-control ml-4 mr-2" id="events-sm" name="search" type="search" placeholder="Buscar Organizações, Eventos...">
                    <input class="btn btn-dark pointer" id="submit-events-sm" type="submit" value="Bora"></input>
                </form>

            </div>
          </div>
        </div>
      </nav>        
        <div class="d-block">
            <div id="sidenav-sm" class="sidenav-sm">
                <a href="javascript:void(0)" class="closebtn-sm" onclick="close_nav()">&times;</a>
                <div class="view-users-org">
		            <?php

                        include("conexao.php");

                        $cod_org = $_SESSION['cod_org_insc'];

                        $sql_users_org = "SELECT *
                                          FROM usuario
                                          WHERE MD5(cod_org_fk) = '$cod_org'
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
		            <?php

                        include("conexao.php");
                        
                        $cod_org = $_SESSION['cod_org_insc'];

                        $sql_users_org = "SELECT *
                                          FROM usuario
                                          WHERE MD5(cod_org_fk) = '$cod_org'
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
                            <a href="login.php">
                                <?php
                                    $_SESSION['msg'] = "Faça seu login eventureiro!";
                                ?>
                                <span class="pointer"><?php echo $_SESSION['msg-insc']; ?></span>
                            </a>
                            <div class="buscar-btn">
                                <span class="pointer" onclick="open_nav_push()">&#9776; Ver integrantes</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-block d-lg-none">
                        <div class="menu-seg-md">
                           <a href="login.php">
                                <?php
                                    $_SESSION['msg'] = "Faça seu login eventureiro!";
                                ?>
                                <span class="pointer"><?php echo $_SESSION['msg-insc']; ?></span>
                            </a>
                            <div class="buscar-btn-md">
                                <span class="pointer" onclick="open_nav_push()">&#9776; Ver integrantes</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-block d-md-none d-lg-none">
                        <div class="menu-seg-sm">
                            <a href="login.php">
                                <?php
                                    $_SESSION['msg'] = "Faça seu login eventureiro!";
                                ?>
                                <span class="pointer"><?php echo $_SESSION['msg-insc']; ?></span>
                            </a>
                            <div class="buscar-btn-sm">
                                <span class="pointer" onclick="open_nav()">&#9776; Ver integrantes</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-xs-10">
                <div class="feed">
                    <div class="container">
                        <?php

                            include("conexao.php");

                            $cod_org = $_SESSION['cod_org_insc'];

                            $sql = "SELECT *
                                FROM evento
                                WHERE MD5(cod_org_fk) = '$cod_org'
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

    </footer>     
</html>