<?php require "../controller/SerialPort.php" ?>
<?php 

$boton = $_GET['boton'];

$serial = new SerialPort("com1", "w+b", "9600");
$serial->openSerial();
if ( $boton == "subir" ) {
   $serial->writeSerial(0);
}
if ( $boton == "bajar" ) {
   $serial->writeSerial(1);
}
if ( $boton == "abrir" ) {
   $serial->writeSerial(2);
}
if ( $boton == "cerrar" ) {
   $serial->writeSerial(3);
}
$serial->closeSerial();

echo $boton;  

?>