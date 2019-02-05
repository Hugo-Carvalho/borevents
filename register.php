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
      <link rel="stylesheet" href="style/css/style-login.css">

    </head>
	<body>
		<div id="overlay" class="invisible"></div>
		<div id="loads" class="lds-css ng-scope invisible">
			<div class="lds-rolling load">
				<div></div>
			</div>
		</div>
		<div class="full-body">
			<nav class="navbar navbar-expand-lg navbar">
          		<div class="container">
              		<a href="index.php">
              			<img class="logo-login img-fluid" src="imgs/go-events_logo_black.png" />
              		</a>
              		<a class="link" href="login.php">Fazer login</a>
              	</div>
        	</nav>
			<form method="POST" action="register-controller.php">
				<div class="container window">
					<div class="window-content">
						<div class="d-none d-lg-block">
			                <h1 class="lg">
			                  	Tornar-se um eventureiro!
			                </h1>
			            </div>
			            <div class="d-block d-lg-none">
			                <h1 class="md">
			                  	Tornar-se um eventureiro!
			                </h1>
			            </div>
                		<div class="camps">
							<input type="E-mail" value="<?php echo $_SESSION['email']; ?>" name="email" id="email" class="form-control" placeholder="E-mail" required>
							<input type="name" value="<?php echo $_SESSION['nome']; ?>" name="nome" class="form-control" placeholder="Nome" required>
							<input type="password" value="<?php echo $_SESSION['senha']; ?>" name="senha" id="senha" class="form-control" placeholder="Senha" required>
							<input type="password" value="<?php echo $_SESSION['confirmar-senha']; ?>" name="confirmar-senha" id="confirmar-senha" class="form-control" placeholder="Confirmar senha" required>
							<?php
								if(isset($_SESSION['msg'])) {
									echo $_SESSION['msg'];
									unset($_SESSION['msg']);
								}
							?>
						</div>
						<input type="submit" onclick="registerFull()" class="btn btn-outline-light login pointer" value="Bora">
					</div>
				</div>
			</form>
		</div>
	</body>
	<footer>

		<script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

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

		    document.getElementById('email').addEventListener('keyup', function(e) {

			    usuario = document.getElementById('email').value.substring(0, document.getElementById('email').value.indexOf("@"));
				dominio = document.getElementById('email').value.substring(document.getElementById('email').value.indexOf("@")+ 1, document.getElementById('email').value.length);

				if ((usuario.length >=1) &&
				    (dominio.length >=3) &&
				    (usuario.search("@")==-1) &&
				    (dominio.search("@")==-1) &&
				    (usuario.search(" ")==-1) &&
				    (dominio.search(" ")==-1) &&
				    (dominio.search(".")!=-1) &&
				    (dominio.indexOf(".") >=1)&&
				    (dominio.lastIndexOf(".") < dominio.length - 1)) {

					document.getElementById('email').classList.remove('camp-red');
	    			document.getElementById('email').classList.add('camp-green');

				} else {

					document.getElementById('email').classList.remove('camp-green');
	    			document.getElementById('email').classList.add('camp-red');
				}

			});

			function registerFull(){
             	document.getElementById("overlay").classList.remove("invisible");
				document.getElementById("loads").classList.remove("invisible");
			}

    </script>

		</script>
	</footer>
</html>
