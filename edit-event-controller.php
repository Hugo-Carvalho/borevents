<?php

	session_start();
	
	include("conexao.php");
	
	//SELECIONAR REGISTO QUE SERÃO INSERIDOS NO BANCO.

	$cod_evento = $_SESSION['cod_evento'];

	$titulo = addslashes($_POST['titulo']);
	$descricao = nl2br(addslashes($_POST['descricao']));
	$valor = $_POST['valor'];
	$site = $_POST['site'];
	$data = $_POST['data'];
	$hora = $_POST['hora'];
	$end_local = $_POST['endereco'];
	$lat_local = $_POST['lat'];
	$lng_local = $_POST['lng'];

	if($lat_local != "" && $lng_local != ""){

		if(!empty($_FILES['upload-btn']['name'])){

			$sql_img = "SELECT img_evento
					    FROM evento
		                WHERE MD5(cod_evento) = '$cod_evento'";
		    
		    $resultado_img = mysqli_query($con, $sql_img);

		    while ($lista=mysqli_fetch_array($resultado_img)) {	

				$img_evento = $lista[0];
			}

			unlink($img_evento);

			$extensao_img = strtolower(substr($_FILES['upload-btn']['name'], -4));
			$extensao_img_fc = strtolower(substr($_FILES['upload-btn']['name'], -5));

			if($extensao_img == ".png" || $extensao_img == ".jpg" || $extensao_img_fc == ".jpeg" || $extensao_img == ".gif"){

				$new_name_img = md5(time()). $extensao_img;
				$diretory_img = "upload/eventos/".$new_name_img;

				move_uploaded_file($_FILES['upload-btn']['tmp_name'], $diretory_img);

				$sql_update_evento = "UPDATE evento 
				                      SET nome_evento = '$titulo', desc_evento = '$descricao', img_evento = '$diretory_img', valor_evento = '$valor', site_evento = '$site', data_evento = '$data', hora_evento = '$hora'
								      WHERE MD5(cod_evento) = '$cod_evento'";

				$resultado_evento = mysqli_query($con, $sql_update_evento);

				$sql_update_localizacao = "UPDATE localizacao
										   SET lat_local = '$lat_local', lng_local = '$lng_local', end_local = '$end_local'
										   WHERE MD5(cod_evento_fk) = '$cod_evento'";
				
				$resultado_localizacao = mysqli_query($con, $sql_update_localizacao);

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

				header("Location: https://borevents.com/edit-event.php?b=" . MD5($cod_evento));
			}

		} else {

			$sql_update_evento = "UPDATE evento 
			                      SET nome_evento = '$titulo', desc_evento = '$descricao', valor_evento = '$valor', site_evento = '$site', data_evento = '$data', hora_evento = '$hora'
							      WHERE MD5(cod_evento) = '$cod_evento'";

			$resultado_evento = mysqli_query($con, $sql_update_evento);

			$sql_update_localizacao = "UPDATE localizacao
									   SET lat_local = '$lat_local', lng_local = '$lng_local', end_local = '$end_local'
									   WHERE MD5(cod_evento_fk) = '$cod_evento'";
			
			$resultado_localizacao = mysqli_query($con, $sql_update_localizacao);

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

		header("Location: https://borevents.com/edit-event.php?b=" . MD5($cod_evento));
	}

?>