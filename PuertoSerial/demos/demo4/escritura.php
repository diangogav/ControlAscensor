<?php

//////////////////////////////////////////////////////////
// ENVIAR/RECIBIR DATOS POR PUERTO SERIAL PHP - ARDUINO //
//////////////////////////////////////////////////////////

// Parametros de conexion
$port = "com1"; // Puerto de conexion
$baud = "9600";
$parity = "n";
$data = 8;
$stop = 1;
$to = "off";
$dtr = "off";
$rts = "off";
$method = "w+b"; // metodo escritura (w)

// Configuracion de los parametros para realizar conexion por puerto serial
function configSerial($port){
	global $baud, $parity, $data, $stop, $to, $dtr, $rts;
	return "mode ".$port.": BAUD=".$baud." PARITY=".$parity." DATA=".$data." STOP=".$stop." to=".$to." dtr=".$dtr." rts=".$rts;
}

function openSerial($command) {
	global $port, $method;
  // Se inicializa la conexion al puerto serial como false
	$openSerialOK = false;
	try {
		// Ejecuta la configuracion de los parametros de conexion
		echo $config = configSerial($port);
		echo "<br>";
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
		$fw = fwrite($fp, $command);
		// Cierra la conexion al puerto serial
		$fc = fclose($fp);
    }
}

if(isset($_POST['submit1'])) {
    $fo = openSerial(1);
    $mensaje = "Enviado ON";
    echo exec("ECHO $port");
}

if(isset($_POST['submit2'])) {
    $fo = openSerial(0);
    $mensaje = "Enviado OFF";
}