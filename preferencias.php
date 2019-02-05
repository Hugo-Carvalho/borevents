<?php

    session_start();
    
    if((isset ($_SESSION['email']) == false) and (isset ($_SESSION['senha']) == false)) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }
 
    $logado = $_SESSION['email'];

    $_SESSION['msg'] = "Faça seu login eventureiro!";

    $_SESSION['sugPref'] = true;

    include("conexao.php");    
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
   		<form method="POST" action="result-preferencias.php" enctype="multipart/form-data">
            <div class="container">
            	<div class="d-none d-lg-block">
	   				<div class="pref-title">
						<h1>Olá, nos conte um pouco sobre suas preferências...</h1>
	   				</div>
	   				<div class="pref-subtitle">
						<p>Desta forma poderemos te sugerir eventos de acordo com sua identidade!</p>
	   				</div>
	   			</div>
	   			<div class="d-block d-lg-none">
	   				<div class="pref-title-sm">
						<h1>Olá, nos conte um pouco sobre suas preferências...</h1>
	   				</div>
	   				<div class="pref-subtitle-sm">
						<p>Desta forma poderemos te sugerir eventos de acordo com sua identidade!</p>
	   				</div>
	   			</div>
   				<label>Estilos musicais:</label>
				<div class="form-row">
                    <div class="form-group col-sm-12">
                        <select multiple required name="musica[]" id="musica" class="form-control">
                            <?php
									$sql = "SELECT *
				    					FROM itemCategoria
	                					WHERE cod_cat_fk = '1'";
	    
	    						$resultado = mysqli_query($con, $sql);
  								while ($lista=mysqli_fetch_array($resultado)) {	
      								echo '<option value="'.$lista["cod_item"].'">'.$lista["nome_item"].'</option>';    
 					 			}
							?>   
                        </select> 
                        <div class="d-none d-lg-block">
	                        <small class="form-text text-muted">
							 	Utilize o Ctrl para selecionar mais de uma opção.
							</small>
						</div>
                    </div>
                </div>
                <label>Comes e bebes:</label>
				<div class="form-row">
                    <div class="form-group col-sm-12">
                        <select multiple required name="comes[]" id="comes" class="form-control">
                            <?php
									$sql = "SELECT *
				    					FROM itemCategoria
	                					WHERE cod_cat_fk = '2'";
	    
	    						$resultado = mysqli_query($con, $sql);
  								while ($lista=mysqli_fetch_array($resultado)) {	
      								echo '<option value="'.$lista["cod_item"].'">'.$lista["nome_item"].'</option>';    
 					 			}
							?>   
                        </select> 
                        <div class="d-none d-lg-block">
	                        <small class="form-text text-muted">
							 	Utilize o Ctrl para selecionar mais de uma opção.
							</small>
						</div>
                    </div>
                </div>
                <label>Ambiente:</label>
				<div class="form-row">
                    <div class="form-group col-sm-12">
                        <select multiple required name="ambiente[]" id="ambiente" class="form-control">
                            <?php
									$sql = "SELECT *
				    					FROM itemCategoria
	                					WHERE cod_cat_fk = '3'";
	    
	    						$resultado = mysqli_query($con, $sql);
  								while ($lista=mysqli_fetch_array($resultado)) {	
      								echo '<option value="'.$lista["cod_item"].'">'.$lista["nome_item"].'</option>';    
 					 			}
							?>   
                        </select> 
                        <div class="d-none d-lg-block">
	                        <small class="form-text text-muted">
							 	Utilize o Ctrl para selecionar mais de uma opção.
							</small>
						</div>
                    </div>
                </div>
                <label>Universitário:</label>
				<div class="form-row">
                    <div class="form-group col-sm-12">
                        <select multiple required name="universitario[]" id="universitario" class="form-control">
                            <?php
									$sql = "SELECT *
				    					FROM itemCategoria
	                					WHERE cod_cat_fk = '4'";
	    
	    						$resultado = mysqli_query($con, $sql);
  								while ($lista=mysqli_fetch_array($resultado)) {	
      								echo '<option value="'.$lista["cod_item"].'">'.$lista["nome_item"].'</option>';    
 					 			}
							?>   
                        </select> 
                        <div class="d-none d-lg-block">
	                        <small class="form-text text-muted">
							 	Utilize o Ctrl para selecionar mais de uma opção.
							</small>
						</div>
                    </div>
                </div>
   				<label>Temático:</label>
				<div class="form-row">
                    <div class="form-group col-sm-12">
                        <select multiple required name="tematico[]" id="tematico" class="form-control">
                            <?php
									$sql = "SELECT *
				    					FROM itemCategoria
	                					WHERE cod_cat_fk = '5'";
	    
	    						$resultado = mysqli_query($con, $sql);
  								while ($lista=mysqli_fetch_array($resultado)) {	
      								echo '<option value="'.$lista["cod_item"].'">'.$lista["nome_item"].'</option>';    
 					 			}
							?>   
                        </select> 
                        <div class="d-none d-lg-block">
	                        <small class="form-text text-muted">
							 	Utilize o Ctrl para selecionar mais de uma opção.
							</small>
						</div>
                    </div>
                </div>
                <div class="buttons-footer">
                    <input class="btn btn-dark pointer" id="submit" type="submit" value="Ver eventos">
                    <a href="home.php">
                        <button class="btn btn-dark pointer" type="button">Pular</button>
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
    </footer>
</html>

