<?php

	session_start();
	
	include("conexao.php");
	
	//SELECIONAR REGISTO QUE SERÃO INSERIDOS NO BANCO.

	$id = $_SESSION['id'];
	$cod_org = $_SESSION['cod_org'];

	$responsavel = $_POST['responsavel'];
	$titulo = addslashes($_POST['titulo']);
	$descricao = nl2br(addslashes($_POST['descricao']));
	$valor = addslashes($_POST['valor']);	
	$site = addslashes($_POST['site']);
	$data = $_POST['data'];
	$hora = $_POST['hora'];
	$end_local = addslashes($_POST['endereco']);
	$lat_local = addslashes($_POST['lat']);
	$lng_local = addslashes($_POST['lng']);

	if($lat_local != "" && $lng_local != ""){

		if ($responsavel == "usr") {

			if(!empty($_FILES['upload-btn']['name'])){

				$extensao_img = strtolower(substr($_FILES['upload-btn']['name'], -4));
				$extensao_img_fc = strtolower(substr($_FILES['upload-btn']['name'], -5));

				if($extensao_img == ".png" || $extensao_img == ".jpg" || $extensao_img_fc == ".jpeg" || $extensao_img == ".gif"){

					$new_name_img = md5(time()). $extensao_img;
					$diretory_img = "upload/eventos/".$new_name_img;

					move_uploaded_file($_FILES['upload-btn']['tmp_name'], $diretory_img);

					$sql_inserir_evento = "INSERT INTO evento (cod_usuario_fk, cod_org_fk, nome_evento, desc_evento, img_evento, valor_evento, site_evento, data_evento, hora_evento)
									       VALUES ('$id', '1', '$titulo', '$descricao', '$diretory_img', '$valor', '$site', '$data', '$hora')";

					$resultado_evento = mysqli_query($con, $sql_inserir_evento);

					$sql_eventos = "SELECT cod_evento
									FROM evento
									ORDER BY cod_evento ASC";
							 
					$resultado_eventos = mysqli_query($con, $sql_eventos);

					while ($lista=mysqli_fetch_array($resultado_eventos)) {	

						$cod_event = $lista[0];
					}

					$sql_inserir_localizacao = "INSERT INTO localizacao (cod_evento_fk, lat_local, lng_local, end_local)
												VALUES ('$cod_event', '$lat_local', '$lng_local', '$end_local')";
					
					$resultado_localizacao = mysqli_query($con, $sql_inserir_localizacao);

					unset ($_SESSION['responsavel']);
					unset ($_SESSION['titulo']);
					unset ($_SESSION['descricao']);
					unset ($_SESSION['valor']);
					unset ($_SESSION['site']);
					unset ($_SESSION['endereco']);
					unset ($_SESSION['data']);
	                unset ($_SESSION['hora']);
					unset ($_SESSION['lat']);

					header("Location: my-events.php");

				} else {

					$_SESSION['responsavel'] = $responsavel;
					$_SESSION['titulo'] = $titulo;
					$_SESSION['descricao'] = $descricao;
					$_SESSION['valor'] = $valor;
					$_SESSION['site'] = $site;
					$_SESSION['endereco'] = $end_local;
					$_SESSION['data'] = $data;
					$_SESSION['hora'] = $hora;
					$_SESSION['lat'] = $lat_local;
					$_SESSION['lng'] = $lng_local;

					$_SESSION['msg-intern'] = "Extensão do arquivo não suportado. (.png .jpg .jpeg .gif)";

					header("Location: new-event.php");
				}

			} else {

				$sql_inserir_evento = "INSERT INTO evento (cod_usuario_fk, cod_org_fk, nome_evento, desc_evento, valor_evento, site_evento, data_evento, hora_evento)
									   VALUES ('$id', '1', '$titulo', '$descricao', '$valor', '$site', '$data', '$hora')";

				$resultado_evento = mysqli_query($con, $sql_inserir_evento);

				$sql_eventos = "SELECT cod_evento
								FROM evento
								ORDER BY cod_evento ASC";
						 
				$resultado_eventos = mysqli_query($con, $sql_eventos);

				while ($lista=mysqli_fetch_array($resultado_eventos)) {	

					$cod_event = $lista[0];
				}

				$sql_inserir_localizacao = "INSERT INTO localizacao (cod_evento_fk, lat_local, lng_local, end_local)
											VALUES ('$cod_event', '$lat_local', '$lng_local', '$end_local')";
				
				$resultado_localizacao = mysqli_query($con, $sql_inserir_localizacao);

				unset ($_SESSION['responsavel']);
				unset ($_SESSION['titulo']);
				unset ($_SESSION['descricao']);
				unset ($_SESSION['valor']);
				unset ($_SESSION['site']);
				unset ($_SESSION['endereco']);
				unset ($_SESSION['data']);
	            unset ($_SESSION['hora']);
				unset ($_SESSION['lat']);

				header("Location: my-events.php");
			}

		} else {

			if(!empty($_FILES['upload-btn']['name'])){

				$extensao_img = strtolower(substr($_FILES['upload-btn']['name'], -4));
				$extensao_img_fc = strtolower(substr($_FILES['upload-btn']['name'], -5));

				if($extensao_img == ".png" || $extensao_img == ".jpg" || $extensao_img_fc == ".jpeg" || $extensao_img == ".gif"){

					$new_name_img = md5(time()). $extensao_img;
					$diretory_img = "upload/eventos/".$new_name_img;

					move_uploaded_file($_FILES['upload-btn']['tmp_name'], $diretory_img);

					$sql_inserir_evento = "INSERT INTO evento (cod_usuario_fk, cod_org_fk, nome_evento, desc_evento, img_evento, valor_evento, site_evento, data_evento, hora_evento)
										   VALUES ('$id', '$cod_org', '$titulo', '$descricao', '$diretory_img', '$valor', '$site', '$data', '$hora')";

					$resultado_evento = mysqli_query($con, $sql_inserir_evento);

					$sql_eventos = "SELECT cod_evento
									FROM evento
									ORDER BY cod_evento ASC";
							 
					$resultado_eventos = mysqli_query($con, $sql_eventos);

					while ($lista=mysqli_fetch_array($resultado_eventos)) {	

						$cod_event = $lista[0];
					}

					$sql_inserir_localizacao = "INSERT INTO localizacao (cod_evento_fk, lat_local, lng_local, end_local)
												VALUES ('$cod_event', '$lat_local', '$lng_local', '$end_local')";
					
					$resultado_localizacao = mysqli_query($con, $sql_inserir_localizacao);

					unset ($_SESSION['responsavel']);
					unset ($_SESSION['titulo']);
					unset ($_SESSION['descricao']);
					unset ($_SESSION['valor']);
					unset ($_SESSION['site']);
					unset ($_SESSION['endereco']);
					unset ($_SESSION['data']);
	                unset ($_SESSION['hora']);
					unset ($_SESSION['lat']);

					header("Location: my-events.php");

				} else {

					$_SESSION['responsavel'] = $responsavel;
					$_SESSION['titulo'] = $titulo;
					$_SESSION['descricao'] = $descricao;
					$_SESSION['valor'] = $valor;
					$_SESSION['site'] = $site;
					$_SESSION['endereco'] = $end_local;
					$_SESSION['data'] = $data;
					$_SESSION['hora'] = $hora;
					$_SESSION['lat'] = $lat_local;
					$_SESSION['lng'] = $lng_local;

					$_SESSION['msg-intern'] = "Extensão do arquivo não suportado. (.png .jpg .jpeg .gif)";

					header("Location: new-event.php");
				}

			} else {

				$sql_inserir_evento = "INSERT INTO evento (cod_usuario_fk, cod_org_fk, nome_evento, desc_evento, valor_evento, site_evento, data_evento, hora_evento)
									   VALUES ('$id', '$cod_org', '$titulo', '$descricao', '$valor', '$site', '$data', '$hora')";

				$resultado_evento = mysqli_query($con, $sql_inserir_evento);

				$sql_eventos = "SELECT cod_evento
								FROM evento
								ORDER BY cod_evento ASC";
						 
				$resultado_eventos = mysqli_query($con, $sql_eventos);

				while ($lista=mysqli_fetch_array($resultado_eventos)) {	

					$cod_event = $lista[0];
				}

				$sql_inserir_localizacao = "INSERT INTO localizacao (cod_evento_fk, lat_local, lng_local, end_local)
											VALUES ('$cod_event', '$lat_local', '$lng_local', '$end_local')";
				
				$resultado_localizacao = mysqli_query($con, $sql_inserir_localizacao);

				unset ($_SESSION['responsavel']);
				unset ($_SESSION['titulo']);
				unset ($_SESSION['descricao']);
				unset ($_SESSION['valor']);
				unset ($_SESSION['site']);
				unset ($_SESSION['endereco']);
				unset ($_SESSION['data']);
	            unset ($_SESSION['hora']);
				unset ($_SESSION['lat']);

				header("Location: my-events.php");
			}

		}

	} else {

		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['titulo'] = $titulo;
		$_SESSION['descricao'] = $descricao;
		$_SESSION['valor'] = $valor;
		$_SESSION['site'] = $site;
		$_SESSION['endereco'] = $end_local;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['lat'] = $lat_local;
		$_SESSION['lng'] = $lng_local;

		$_SESSION['msg-intern'] = "Confirme a localização de seu evento no mapa.";

		header("Location: new-event.php");
	}

?>