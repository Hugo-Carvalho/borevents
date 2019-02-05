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
	
	<!-- Corpo da página -->
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
              	<a class="link" href="register.php">Criar conta</a>
        	</nav>
			
			<form method="POST" action="login-controller.php">
				<div class="container window">
					<div class="window-content">
						<div class="d-none d-lg-block">
			                <h1 class="lg">
								Bora eventurar!
			                </h1>
			            </div>
			            <div class="d-block d-lg-none">
							<h1 class="md">
								Bora eventurar!
			                </h1>
			            </div>
                		<div class="camps">
                			<?php
								if(isset($_SESSION['msg'])) {
									echo $_SESSION['msg'];
									unset($_SESSION['msg']);
								}
							?>
							<input type="E-mail" value="<?php echo $_SESSION['email']; ?>" name="email" id="email" class="form-control" placeholder="E-mail" required>
							<input type="password" name="senha" class="form-control" placeholder="Senha" required>
							<a href="" class="link pointer" data-toggle="modal" data-target="#myModal">Esqueceu a senha?</a>
						</div>
						<input type="submit" class="btn btn-outline-light login pointer" value="Bora">
					</div>
				</div>
			</form>
		</div>
	</body>
	<footer>

		<!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

		<script type="text/javascript">

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

		<!-- Modal -->
	  	<div class="modal fade" id="myModal" role="dialog">
	    	<div class="modal-dialog">
	    
	      		<!-- Modal content-->
		      	<div class="modal-content">
		        	<div class="modal-header">
		          		<button type="button" class="close" data-dismiss="modal">&times;</button>
		          		<h4 class="modal-title">Redefinir senha</h4>
		        	</div>
		        	<div class="modal-body">

		        		<form method="POST" action="reset-pass-controller.php">

			          		<p class="reset-pass-txt">Informe seu email de login para que possamos te mandar sua nova senha.</p>
							<input type="E-mail" name="email-for-reset-pass" id="email-for-reset-pass" class="form-control" placeholder="E-mail" required>
							<div class="reset-pass-btn">
								<input type="submit" onclick="registerFull()" class="btn btn-dark pointer" value="Bora">
							</div>
						</form>
		        	</div>
		      	</div>
	    	</div>
	  	</div>
	</footer>
</html>