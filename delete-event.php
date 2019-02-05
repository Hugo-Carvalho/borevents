<?php

    session_start();

    include("conexao.php");

    $cod_evento = $_SESSION['cod_evento'];

    $sql_img = "SELECT img_evento
			    FROM evento
                WHERE MD5(cod_evento) = '$cod_evento'";
    
    $resultado_img = mysqli_query($con, $sql_img);

    while ($lista=mysqli_fetch_array($resultado_img)) {	

		$img_evento = $lista[0];
	}

	unlink($img_evento);

    $sql_delete_localizacao = "DELETE FROM localizacao
                               WHERE MD5(cod_evento_fk) = '$cod_evento'";
    
    $resultado_localizacao = mysqli_query($con, $sql_delete_localizacao);

    $sql_delete_evento = "DELETE FROM evento 
                          WHERE MD5(cod_evento) = '$cod_evento'";

    $resultado_evento = mysqli_query($con, $sql_delete_evento);

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
?>