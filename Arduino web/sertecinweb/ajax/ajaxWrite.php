<?php require "../controller/SerialPort.php" ?>
<?php 

$botonPresionado = $_POST['botonPresionado'];
$data = [
   'botonPresionado' => $_POST['botonPresionado']
];

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

echo json_encode($data);  

?>