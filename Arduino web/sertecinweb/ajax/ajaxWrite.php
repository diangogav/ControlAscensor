<?php require "../controller/SerialPort.php" ?>
<?php 

$botonPresionado = $_POST['botonPresionado'];
$success = false;

$serial = new SerialPort("com1", "w+b", "9600");
$serial->openSerial();
if ( $botonPresionado == "subir" ) {
   $serial->writeSerial(0);
}
if ( $botonPresionado == "bajar" ) {
   $serial->writeSerial(1);
}
if ( $botonPresionado == "abrir" ) {
   $serial->writeSerial(2);
}
if ( $botonPresionado == "cerrar" ) {
   $serial->writeSerial(3);
}
$serial->closeSerial();

$success = true;
?>
<?php //require "ajaxRead.php" ?>