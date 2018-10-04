<?php


class SerialPort
{
	/////////////////
	// PROPIEDADES //
	/////////////////

	private $_port;
	private $_baud;
	private $_parity;
	private $_data;
	private $_stop;
	private $_to;
	private $_dtr;
	private $_rts;
	private $_method;
	private $_opened;
	private $_fopen;

	///////////////////
	// CONSTRUCTORES //
	///////////////////

	public function __construct($port, $method, $baud = "9600"){
		$this->_port = $port;
		$this->_baud = $baud;
		$this->_method = $method;
		$this->_parity = "n";
		$this->_data = 8;
		$this->_stop = 1;
		$this->_to = "off";
		$this->_dtr = "off";
		$this->_rts = "off";
		$this->_opened = false;
		$this->_fopen = null;
	}

	///////////////////////
	// GETTERs y SETTERs //
	///////////////////////
	
	// SETTERS
	public function setPort($port){
		$this->_port = $port;
	}
	public function setBaud($baud){
		$this->_baud = $baud;
	}
	public function setParity($parity){
		$this->_parity = $parity;
	}
	public function setData($data){
		$this->_data = $data;
	}
	public function setStop($stop){
		$this->_stop = $stop;
	}
	public function setTo($to){
		$this->_to = $to;
	}
	public function setDtr($dtr){
		$this->_dtr = $dtr;
	}
	public function setRts($rts){
		$this->_rts = $rts;
	}
	public function setMethod($method){
		$this->_method = $method;
	}
	public function setOpened($opened){
		$this->_opened = $opened;
	}
	public function setFopen($fopen){
		$this->_fopen = $fopen;
	}

	// GETTERS
	public function getPort(){
		return $this->_port;
	}
	public function getBaud(){
		return $this->_baud;
	}
	public function getParity(){
		return $this->_parity;
	}
	public function getData(){
		return $this->_data;
	}
	public function getStop(){
		return $this->_stop;
	}
	public function getTo(){
		return $this->_to;
	}
	public function getDtr(){
		return $this->_dtr;
	}
	public function getRts(){
		return $this->_rts;
	}
	public function getMethod(){
		return $this->_method;
	}
	public function getOpened(){
		return $this->_opened;
	}
	public function getFopen(){
		return $this->_fopen;
	}

	/////////////
	// METODOS //
	/////////////

	// PUBLICOS

	public function openSerial(){
		if ( $this->getOpened() == true) {
			$error = "Error, el puerto {$this->getPort()} ya se encuentra abierto";
			// Coloca el error HTTP en la cabecera
			$this->errorToAjax(404, $error);
			return false;
		}
		try {
			// Ejecuta la configuracion de los parametros de conexion
			exec( $this->configSerial() );
			// Abre la conexion al puerto establecido en los parametros de conexion
			$fp = fopen( $this->getPort(), $this->getMethod() );
			$this->setFopen($fp);
			// Al abrir el puerto se cambia a true la conexion al puerto serial
			$this->setOpened(true);
		} catch(Exception $e) {
			echo 'Mensaje: ' . $e->getMessage();
			return false;
		}
		return true;
	}

	public function writeSerial($command) {	  	
		// Si hay conexion por el puerto serial procede a enviar los datos al dispositivo
		if( $this->getOpened() ) {
			// Realiza la escritura segun la conexion y el contenido pasado por parametro
			return fwrite( $this->getFopen(), $command );			
	    }
	    return "El puerto {$this->getPort()} esta cerrado, no se puede escribir";
	}

	public function closeSerial(){
		if ( $this->getOpened() == false ) {
			echo "El puerto {$this->getPort()} esta cerrado";
			return false;
		}
		// Cierra la conexion al puerto serial
		$fc = fclose( $this->getFopen() );
		$this->setOpened(false);
		return true;
	}

	// PRIVADOS

	private function configSerial(){
		return "mode " . $this->getPort() . ": BAUD=" . $this->getBaud() . " PARITY=" . $this->getParity() . " DATA=".$this->getData() . " STOP=" . $this->getStop() . " to=" . $this->getTo() . " dtr=" . $this->getDtr() . " rts=" . $this->getRts();
	}

	private function errorToAjax($status, $mensaje){
		header("HTTP/1.0 {$status} {$mensaje}");
	}


}


?>