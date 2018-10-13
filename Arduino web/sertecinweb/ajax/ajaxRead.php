<?php 

$data = [];

// if ( $_POST['botonPresionado'] && $success == true) {
// 	$data = [ 
// 		'botonPresionado' => $_POST['botonPresionado'] 
// 	];
// 	echo json_encode($data);  
// 	return true;
// }

$server = "mysql";
$host = 'localhost';
$dbname = 'arduino';
$user = 'root';
$pass = '';

try{	
	$conexion = new PDO("{$server}:host={$host};dbname={$dbname};", $user, $pass);
	// echo 'Conectado a '.$conexion->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "<br>";
}catch(PDOException $e){
	echo 'Error conectando a la BBDD ' . $e->getMessage() ."<br>";
}

$query = "SELECT * FROM data ORDER BY ID DESC LIMIT 1";

$resultado = $conexion->query($query);

$data = $resultado->fetch();

echo json_encode($data);

 ?>