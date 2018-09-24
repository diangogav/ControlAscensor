<?php

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
    	echo $fp . "<br>";

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
    echo $fw . "<br>";// devuelve cantidad de bytes escritos o false si da error
    echo $fc . "<br>";	
}

if(isset($_POST['submit1'])) {
    $fo = openSerial(1);
}

if(isset($_POST['submit2'])) {
    $fo = openSerial(0);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Demo PHP Arduino Comunicacizn Puerto Serial</title>
  <meta charset="utf-8">
</head>
<body>
  <h3>Demo PHP Arduino Comunicación Puerto Serial</h3>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="submit1" value="ON"><br>
    <input type="submit" name="submit2" value="OFF"><br>   
  </form>

</body>
</html>

