<?php

    session_start();
    
    if((isset ($_SESSION['email']) == false) and (isset ($_SESSION['senha']) == false)) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:maps-s.php');
    }
 
    $logado = $_SESSION['email'];

    $_SESSION['lat'] = $_POST['lat'];
    $_SESSION['lng'] = $_POST['lng'];
    
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
          
        <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="style/css/footer.css">
        
    </head>
    <body>
      
      <nav class="navbar navbar-fixed-top navbar-expand-lg navbar-dark bg-gradient-primary">
          
        <div class="container">
      
            <a class="navbar-brand mb-0" href="home.php"><img src="imgs/go-events_logo_black.png" width="120" height="50" /></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">

                <span class="navbar-toggler-icon"></span>
                
            </button>

            <div class="d-block d-lg-none">

                <a href="info.php"><img src="<?php echo $_SESSION['img']; ?>" class="img-circle" width="50" height="50" /></a>

            </div>
            <div class="collapse navbar-collapse" id="navbarSite">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link disabled">Maps</a>
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
      
        <div class="form-group col-sm-12 ">
            
            <div class="d-block d-md-none d-lg-none">
                <form class="form-inline search-address">
                    <input class="form-control address-sm" id="address-sm" type="search" placeholder="Buscar localização">
                    <input class="btn btn-dark submit-address-sm" id="submit-address-sm" type="button" value="Buscar">
                </form>
            </div>
            <div class="d-none d-md-block d-lg-none">
                <form class="form-inline search-address">
                    <input class="form-control address-md" id="address-md" type="search" placeholder="Buscar localização">
                    <input class="btn btn-dark submit-address-md" id="submit-address-md" type="button" value="Buscar">
                </form>
            </div>
            <div class="d-none d-md-none d-lg-block">
                <form class="form-inline search-address">
                    <input class="form-control address-lg" id="address-lg" type="search" placeholder="Buscar localização">
                    <input class="btn btn-dark submit-address-lg" id="submit-address-lg" type="button" value="Buscar">
                </form>
            </div>

            <input id="lat" hidden="true" type="text" name="lat" value="<?php echo $_SESSION['lat']; ?>"></input>

            <input id="lng" hidden="true" type="text" name="lng" value="<?php echo $_SESSION['lng']; ?>"></input>

            <div id="map"></div>

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
        <script src="js/script-maps.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0rooq9Gl_LsNW7Ry6T4uDyNqFz8ouM7w&callback=initMap"></script>

    </footer>
</html>