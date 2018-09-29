<?php

	sleep(1);
	$nombre_fichero = "texto.txt";
	$gestor 		= fopen($nombre_fichero, "r+b");
	$contenido		= [ "datos" => fread($gestor, filesize($nombre_fichero)) ];
	fclose($gestor);
	$json = json_encode($contenido);
	echo $json;


 ?>