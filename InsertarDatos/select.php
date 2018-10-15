<?php 

require "conexion.php";

$query = "SELECT * FROM historic ORDER BY ID DESC LIMIT 1";

$resultado = $conexion->query($query);

$registro = $resultado->fetch();

echo json_encode($registro);

 ?>