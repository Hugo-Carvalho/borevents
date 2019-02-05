<?php

	session_start();
	
	include("conexao.php");

	$cod_org = $_SESSION['cod_org_insc'];
	$id = $_SESSION['id'];

	$sql_insc = "SELECT cod_inscricao
                 FROM inscricao 
                 WHERE MD5(organizacao_inscricao) = '$cod_org'";

    $resultado_insc = mysqli_query($con, $sql_insc);

    $row = mysqli_num_rows($resultado_insc);

    if ($row > 0) {

        $sql_del = "DELETE FROM inscricao 
                     WHERE MD5(organizacao_inscricao) = '$cod_org'";

    	$resultado_del = mysqli_query($con, $sql_del);
    } else {

        $sql_org = "SELECT cod_org
                     FROM organizacao 
                     WHERE MD5(cod_org) = '$cod_org'";

        $resultado_org = mysqli_query($con, $sql_org);

        while ($lista=mysqli_fetch_array($resultado_org)) {    

            $cod_org = $lista[0];
        }

        $sql_del = "INSERT INTO inscricao (cod_usuario_fk, organizacao_inscricao)
                    VALUES ('$id', '$cod_org')";

    	$resultado_del = mysqli_query($con, $sql_del);
    }

    header("Location: https://borevents.com/perfil-org.php?b=" . $_SESSION['cod_org_insc'] . "");
?>