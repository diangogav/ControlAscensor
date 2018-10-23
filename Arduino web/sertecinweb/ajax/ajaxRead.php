<?php 

//////////////////////
// Conexion a la BD //
//////////////////////
require "../controller/conexion.php";
$tabla = 'historic';
///////////////////////////////////////////////////////////////////////////
// Leer los datos de la tabla "data", para mostrar en la pagina con ajax //
///////////////////////////////////////////////////////////////////////////
$query = "SELECT * FROM $tabla ORDER BY ID DESC LIMIT 1";
$resultado = $conexion->query($query);
$data = $resultado->fetch();

//////////////////////////////////////////////////////////
// Devuelve el contenido de la consulta en fotmato Json //
//////////////////////////////////////////////////////////
echo json_encode($data);

 ?>