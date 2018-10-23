<?php 
require "conexion.php";

if ( isset($_POST['accion']) ) {

	$fecha_hora = time();
	$data = $_POST['accion'];

	$query = "INSERT INTO data (data) VALUES ($data)";

	$exec = $conexion->exec($query);

	if( $exec ){
		echo "Datos insertados {$data}";
	}else{
		echo "Datos no insertados";
	}
}

 ?>