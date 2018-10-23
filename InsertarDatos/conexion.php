<?php 

$server = "mysql";
$host = 'localhost';
$dbname = 'arduino';
$user = 'root';
$pass = 'sagitario';

try{	
	$conexion = new PDO("{$server}:host={$host};dbname={$dbname};", $user, $pass);
	// echo 'Conectado a '.$conexion->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "<br>";
}catch(PDOException $e){
	echo 'Error conectando a la BBDD ' . $e->getMessage() ."<br>";
}

 ?>