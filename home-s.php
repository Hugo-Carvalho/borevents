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
      <div class="form-group col-xs-10">
        <div class="feed">
          <div class="container">
            <?php

              include("conexao.php");

                    $sql = "SELECT *
                            FROM evento
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
                      echo "</div>";
                    }
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

    </footer>
</html>