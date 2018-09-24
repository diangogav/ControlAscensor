<?php

// Parametros de conexion
$port = "com3"; // Puerto de conexion
$baud = "9600";
$parity = "n";
$data = 8;
$stop = 1;
$to = "off";
$dtr = "off";
$rts = "off";
$method = "w+b"; // metodo escritura (w)

// Configuracion de los parametros para realizar conexion por puerto serial
function configSerial(){
	global $port, $baud, $parity, $data, $stop, $to, $dtr, $rts;
	return "mode ".$port.": BAUD=".$baud." PARITY=".$parity." DATA=".$data." STOP=".$stop." to=".$to." dtr=".$dtr." rts=".$rts;
}

function openSerial($command) {
	global $port, $method;
  // Se inicializa la conexion al puerto serial como false
	$openSerialOK = false;
	try {
		// Ejecuta la configuracion de los parametros de conexion
		exec( configSerial() );
		// Abre la conexion al puerto establecido en los parametros de conexion
		$fp = fopen($port, $method);
    	if($fp){
    		echo "Puerto $port abierto";
    	}else{
    		echo "No se pudo abrir puerto {$port}";
    	}
    	echo "<br>";

		// Al abrir el puerto se cambia a true la conexion al puerto serial
		$openSerialOK = true;
	} catch(Exception $e) {
		echo 'Mensaje: ' .$e->getMessage();
	}
	// Si hay conexion por el puerto serial procede a enviar los datos al dispositivo
	if($openSerialOK) {
		// Realiza la escritura segun la conexion y el contenido pasado por parametro
		$fw = fwrite($fp, $command);
		if($fw){
    		echo "Escrito $fw bytes";
    	}else{
    		echo "No se pudo escribir";
    	}
    	echo "<br>";
		// Cierra la conexion al puerto serial
		$fc = fclose($fp);
		if($fc){
    		echo "Puerto $port cerrado";
    	}else{
    		echo "No se pudo cerrar puerto {$port}";
    	}
    	echo "<br>";
    }
    //echo $fw . "<br>";// devuelve cantidad de bytes escritos o false si da error	
}

openSerial("Texto");

?>

