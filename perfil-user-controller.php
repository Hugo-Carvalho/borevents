<?php

	session_start();
	
	include("conexao.php");

	$cod_usuario = $_SESSION['cod_usuario_insc'];
	$id = $_SESSION['id'];

	$sql_insc = "SELECT cod_inscricao
                 FROM inscricao 
                 WHERE MD5(organizador_inscricao) = '$cod_usuario'";

    $resultado_insc = mysqli_query($con, $sql_insc);

    $row = mysqli_num_rows($resultado_insc);

    if ($row > 0) {

        $sql_del = "DELETE FROM inscricao 
                     WHERE MD5(organizador_inscricao) = '$cod_usuario'";

    	$resultado_del = mysqli_query($con, $sql_del);
    } else {

        $sql_usuario = "SELECT cod_usuario
                     FROM usuario 
                     WHERE MD5(cod_usuario) = '$cod_usuario'";

        $resultado_usuario = mysqli_query($con, $sql_usuario);

        while ($lista=mysqli_fetch_array($resultado_usuario)) {    

            $cod_usuario = $lista[0];
        }

        $sql_del = "INSERT INTO inscricao (cod_usuario_fk, organizador_inscricao)
                    VALUES ('$id', '$cod_usuario')";

    	$resultado_del = mysqli_query($con, $sql_del);
    }

    header("Location: https://borevents.com/perfil-user.php?b=" . $_SESSION['cod_usuario_insc'] . "");
?>