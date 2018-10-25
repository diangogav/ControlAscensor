<?php 

/////////////////////////////////
// Datos para conexion a la BD //
/////////////////////////////////
$server = "mysql";
$host = 'localhost';
$dbname = 'arduino';
$user = 'root';
$pass = '';

///////////////////////////////////////////////////////////////////////////////
// Conexion a la BD, si hay algun error devuelve alert en pantalla con error //
///////////////////////////////////////////////////////////////////////////////
try{	
	$conexion = new PDO("{$server}:host={$host};dbname={$dbname};", $user, $pass);
	// echo 'Conectado a '.$conexion->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "<br>";
}catch(PDOException $e){
	// echo 'Error conectando a la BBDD ' . $e->getMessage() ."<br>";
	header("HTTP/1.0 500 Error con la conexion a la BD");

}

 ?>