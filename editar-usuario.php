<?php

    session_start();
    
    if((isset ($_SESSION['email']) == false) and (isset ($_SESSION['senha']) == false)) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }
 
    $logado = $_SESSION['email'];

    $_SESSION['msg'] = "Faça seu login eventureiro!";
    
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

        <form method="POST" action="editar-usuario-controller.php" enctype="multipart/form-data">

            <div class="container">
                <div class="space-top">

                    <div class="image">
                        <div class="look-img">
                            <img class="img-circle img-thumbnail edit-image-perfil" id="img-file" src="<?php echo $_SESSION['img']; ?>">
                            <div id="image-holder"></div>
                        </div>
                        <div class="file-upload btn btn-dark pointer">
                            <span>Selecionar imagem</span>
                            <input id="upload-btn" name="upload-btn" type="file" class="upload form-control-file" />
                        </div>
                    </div>
                    <div class="camps">
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <label>Nome:</label>
                                <input class="form-control" name="nome" id="nome" type="text" value="<?php echo $_SESSION['nome']; ?>" placeholder="Nome"></input>  
                            </div>
                            <div class="form-group col-sm-6">  
                                <label>Senha:</label> 
                                <input class="form-control" name="senha" id="senha" type="password" value="<?php echo $_SESSION['senha']; ?>" placeholder="Senha"></input>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Confirme senha:</label>
                                <input class="form-control" name="confirmar-senha" id="confirmar-senha" type="password" value="<?php echo $_SESSION['senha']; ?>" placeholder="Confirmar senha"></input>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(isset($_SESSION['msg-intern'])) {
                            echo $_SESSION['msg-intern'];
                            unset($_SESSION['msg-intern']);
                        }
                    ?>
                    <div class="buttons-footer">
                        <input class="btn btn-dark submit-button_edit pointer" id="submit-edit" type="submit" value="Salvar alterações">
                         <a href="info.php">
                            <button class="btn btn-dark pointer" type="button">Cancelar</button>
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

        <script type="text/javascript">

            document.getElementById('confirmar-senha').addEventListener('keyup', function(e) {

                if (document.getElementById("senha") != null && document.getElementById("confirmar-senha") != null) {

                    if (document.getElementById('senha').value == document.getElementById('confirmar-senha').value) {

                        document.getElementById('confirmar-senha').classList.remove('camp-red');
                        document.getElementById('confirmar-senha').classList.add('camp-green');

                    }else if (document.getElementById('senha').value != document.getElementById('confirmar-senha').value) {

                        document.getElementById('confirmar-senha').classList.remove('camp-green');
                        document.getElementById('confirmar-senha').classList.add('camp-red'); 
                    }
                }
            });

            $("#upload-btn").on('change', function () {
             
                if (typeof (FileReader) != "undefined") {
             
                    var image_holder = $("#image-holder");
             
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        if (true) {
                            image_holder.empty();
                            $("<img />", {
                                "src": e.target.result,
                                "class": "img-circle img-thumbnail edit-image-perfil"
                            }).appendTo(image_holder);
                        }
                    }

                    image_holder.show();
                    $("#img-file").hide();
                    reader.readAsDataURL($(this)[0].files[0]);

                } else{

                    alert("Este navegador nao suporta FileReader.");
                }
            });

        </script>

    </footer>  
</html>