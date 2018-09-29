<?php 

// LEER CONTENIDO DE UN TXT

function ajax(){
	$nombre_fichero = "texto.txt";
	$gestor = fopen($nombre_fichero, "r+b");
	$contenido = fread($gestor, filesize($nombre_fichero));
	fclose($gestor);
	return json_encode($contenido);
}


function readSerial() {
	$puerto = "com2";
  // Se inicializa la conexion al puerto serial como false
	$openSerialOK = false;
	try {
		// Ejecuta la configuracion de los parametros de conexion
		echo $config = configSerial($puerto);
		exec( $config );
		// Abre la conexion al puerto establecido en los parametros de conexion
		echo $fp = fopen($puerto, "r+b");
		// Al abrir el puerto se cambia a true la conexion al puerto serial
		$openSerialOK = true;
	} catch(Exception $e) {
		echo 'Mensaje: ' .$e->getMessage();
	}
	// Si hay conexion por el puerto serial procede a enviar los datos al dispositivo
	if($openSerialOK) {
		// Realiza la escritura segun la conexion y el contenido pasado por parametro
		$contenido = fread($fp, "10");
		// Cierra la conexion al puerto serial
		fclose($fp);
		return $contenido;
    }
    return "No hubo conexion";
}

// $contenido = readSerial();
// 
echo isset($mensaje) ? readSerial() : "No existe";

?>
