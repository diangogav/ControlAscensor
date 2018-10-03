<?php 

exec("mode COM2 BAUD=9600 PARITY=N data=8 stop=1 to=off dtr=off rts=off");

$nombre_fichero = "\.\COM2";
echo $gestor 	= fopen($nombre_fichero, "r+b");
// if( $tamaño = filesize($nombre_fichero)){
	echo $contenido = fread($gestor, filesize($nombre_fichero));    
// }
fclose($gestor);
// echo json_encode($contenido);


 ?>