<?php

if (isset($_GET['action'])) {

	$accion = $_GET['action'];

	require 'PhpSerial/src/PhpSerial.php';

	require "lepiaf/serialport/src/lepiaf/SerialPort/SerialPort.php";

	$serial = new phpSerial();
	$serial->deviceSet("COM3"); //This will be the port your Arduino is connected
	$serial->confBaudRate(9600);
	$serial->deviceOpen();

	if ($accion == 'green1') {

		$serial->sendMessage("0\r");

	}else if ($accion == 'green0'){

		$serial->sendMessage("1\r");		

	}

	if ($accion == 'red1') {

		$serial->sendMessage("2\r");

	}else if ($accion == 'red0'){

		$serial->sendMessage("3\r");		

	}

	if ($accion == 'fan1') {

		$serial->sendMessage("4\r");

	}else if ($accion == 'fan0'){

		$serial->sendMessage("5\r");		

	}

	$serial->deviceClose();

}

?>

<!DOCTYPE html>

<html>
<head>
	<title>Arduino control</title>
</head>
<body>

	<h1>Arduino and PHP communications</h1>

	<div style="background-color: red;width: 10%;color: white;"><h5>Red Led</h5></div>
	<a href="index.php?action=red1"><button>on</button></a>&nbsp;
	<a href="index.php?action=red0"><button>off</button></a>

	<div style="background-color: green;width: 10%;color: white;"><h5>green Led</h5></div>
	<a href="index.php?action=green1"><button>on</button></a>&nbsp;
	<a href="index.php?action=green0"><button>off</button></a>

	<div style="background-color: gray;width: 10%;color: white;"><h5>Fan</h5></div>
	<a href="index.php?action=fan1"><button>on</button></a>&nbsp;
	<a href="index.php?action=fan0"><button>off</button></a>

</body>
</html>