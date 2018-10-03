<?php 

// LEER CONTENIDO DE UN TXT

// $nombre_fichero = "texto.txt";
// $gestor = fopen($nombre_fichero, "r+b");
// $contenido = fread($gestor, filesize($nombre_fichero));
// fclose($gestor);
// echo json_encode($contenido);

$port = "com1:"; // Puerto de conexion
$baud = "9600";
$parity = "n";
$data = 8;
$stop = 1;
$to = "off";
$dtr = "off";
$rts = "off";
$method = "w+"; // metodo escritura (w)

function configSerial($port){
	global $baud, $parity, $data, $stop, $to, $dtr, $rts;
	return "mode ".$port.": BAUD=".$baud." PARITY=".$parity." DATA=".$data." STOP=".$stop." to=".$to." dtr=".$dtr." rts=".$rts;
}

function readSerial() {
	global $port, $method;
  // Se inicializa la conexion al puerto serial como false
	$openSerialOK = false;
	try {
		// Ejecuta la configuracion de los parametros de conexion
		$config = configSerial($port);
		exec( $config );
		// Abre la conexion al puerto establecido en los parametros de conexion
		$fp = fopen($port, $method);
		// Al abrir el puerto se cambia a true la conexion al puerto serial
		$openSerialOK = true;
	} catch(Exception $e) {
		echo 'Mensaje: ' .$e->getMessage();
	}
	// Si hay conexion por el puerto serial procede a enviar los datos al dispositivo
	if($openSerialOK) {
		// Realiza la escritura segun la conexion y el contenido pasado por parametro
		// $contenido = fread($fp, "10");
		$contenido = fgets($fp);
		// Cierra la conexion al puerto serial
		fclose($fp);
		return $contenido;
    }
    return "No hubo conexion";
}



?>
