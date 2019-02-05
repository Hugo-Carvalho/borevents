<?php

include("conexao.php");

// Select all the rows in the markers table
$result_markers = "SELECT e.nome_evento, l.lat_local, l.lng_local, l.end_local 
                   FROM evento e, localizacao l
                   WHERE e.cod_evento = l.cod_evento_fk";

$resultado_markers = mysqli_query($con, $result_markers);

header("Content-type: application/json");

$q = [];
// Iterate through the rows, printing XML nodes for each
while ($row_markers = mysqli_fetch_assoc($resultado_markers)){
   $q[] =
    [
      'name' => $row_markers['nome_evento'],
      'end_local' =>  $row_markers['end_local'],
      'lat_local' =>  $row_markers['lat_local'],
      'lng_local' =>  $row_markers['lng_local'],
    ]
   ;
}

echo json_encode($q);




