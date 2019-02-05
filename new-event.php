<?php

    session_start();
    
    if((isset ($_SESSION['email']) == false) and (isset ($_SESSION['senha']) == false)) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }
 
    $logado = $_SESSION['email'];

    $_SESSION['msg'] = "Faça seu login eventureiro!";

    date_default_timezone_set("America/Sao_Paulo"); 
    
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
      
        <form method="POST" action="new-event-controller.php" enctype="multipart/form-data">
            <div class="container">
                <div class="camps">
                    <div id="atribuir">
                        <label>Atribuir o responsável pelo evento:</label>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <input id="cod-org" hidden="true" type="text" name="cod-org" value="<?php echo $_SESSION['cod_org']; ?>"></input>
                                <select name="responsavel" id="responsavel" class="form-control">
                                    <option value="usr" <?php if($_SESSION['responsavel'] == "usr"){echo("selected");}?>>Organizador</option>
                                    <option value="org" <?php if($_SESSION['responsavel'] == "org"){echo("selected");}?>>Organização</option>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <label>Título do evento:</label>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <input class="title form-control" name="titulo" value="<?php echo $_SESSION['titulo']; ?>" type="text" placeholder="Título do evento" required></input>
                        </div>
                    </div>
                        <label>Descrição do evento:</label>
                        <div class="form-row">
                            <form  class="form-inline">
                                <div class="form-group col-sm-6">
                                    <input class="form-control" id="name-file" name="name-file" placeholder="Selecionar imagem para o evento" disabled="disabled" />
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class="file-upload btn btn-dark pointer">
                                        <span>Selecionar imagem</span>
                                        <input id="upload-btn" name="upload-btn" type="file" class="upload form-control-file" />
                                    </div>
                                </div>
                            </form>
                            <div class="form-group col-sm-12" id="image-holder"></div>
                            <div class="form-group col-sm-12">
                                <textarea class="description form-control" name="descricao" type="text" placeholder="Descrição do evento"><?php echo $_SESSION['descricao']; ?></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <input class="form-control" type="text" name="site" value="<?php echo $_SESSION['site']; ?>" placeholder="Site para realizar a compra ou obter mais informações"></input>
                            </div>
                            <div class="form-group col-sm-6">
                                <input class="form-control" type="number" min="0" name="valor" value="<?php echo $_SESSION['valor']; ?>" placeholder="Informações sobre valores e formas de pagamentos" required></input>
                            </div>

                            <div class="form-group col-sm-4">
                                <div class="input-group">
                                    <input type="date" name="data" value="<?php echo $_SESSION['data']; ?>" min="<?php echo date('Y-m-d') ?>" class="form-control" placeholder="Selecione a data do evento" required><span class="input-group-addon">&#128197;</span>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <div class="input-group">
                                    <input type="time" name="hora" value="<?php echo $_SESSION['hora']; ?>" class="form-control" required><span class="input-group-addon">&#128337;</span>
                                </div>
                            </div>
                        </div>
                    <label>Localização do Evento:</label>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <input class="form-control" id="address" type="text" name="endereco" value="<?php echo $_SESSION['endereco']; ?>" placeholder="Pesquisar a localização do evento" required></input>

                            <input id="lat" hidden="true" type="text" name="lat" value="<?php echo $_SESSION['lat']; ?>"></input>

                            <input id="lng" hidden="true" type="text" name="lng" value="<?php echo $_SESSION['lng']; ?>"></input>

                            <div class="map-location">
                                <a class="toggler pointer refrechr" id="refrech-map">
                                    <img class="refrech-icon" src="imgs/refrech-icon.jpg">Atualizar no mapa
                                </a>
                                <a class="toggler pointer select" id="select-map" data-toggle="collapse" data-target="#map-select-location">
                                    <img class="map-icon" src="imgs/map-icon.png">Confirmar no mapa
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="map-select-location">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="msg-intern-right">
                    <?php
                        if(isset($_SESSION['msg-intern'])) {
                            echo $_SESSION['msg-intern'];
                            unset($_SESSION['msg-intern']);
                        }
                    ?>
                </div>
                <div class="buttons-footer">
                    <input class="btn btn-dark pointer" onclick="registerFull()" id="submit" type="submit" value="Criar evento">
                    <a href="my-events.php">
                        <button class="btn btn-dark pointer" type="button">Cancelar</button>
                    </a>
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
        <script src="js/script-map-select-location.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0rooq9Gl_LsNW7Ry6T4uDyNqFz8ouM7w&callback=initMap"></script>

        <script type="text/javascript">

            if(document.getElementById("cod-org").value == '1'){

                document.getElementById("atribuir").remove();
            }

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
                            "class": "img-thumbnail img-evento"
                        }).appendTo(image_holder);
                    }

                    image_holder.show();
                    $("#img-file").hide();
                    reader.readAsDataURL($(this)[0].files[0]);

                } else {

                    alert("Este navegador nao suporta FileReader.");
                }
            });

            function registerFull(){
                document.getElementById("overlay").classList.remove("invisible");
                document.getElementById("loads").classList.remove("invisible");
            }

        </script>
    </footer>
</html>