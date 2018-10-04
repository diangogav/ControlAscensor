<?php 

$data = [];

if ( $_POST['botonPresionado'] && $success == true) {
	$data = [ 
		'botonPresionado' => $_POST['botonPresionado'] 
	];
	echo json_encode($data);  
	return true;
}

 ?>