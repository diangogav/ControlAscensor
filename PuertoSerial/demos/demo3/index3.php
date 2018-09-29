<?php

// require 'PhpSerial/src/PhpSerial.php';

function openSerial($command) {
	$openSerialOK = false;
	try {
		// $serial = new phpSerial();
		exec("mode com3: BAUD=9600 PARITY=n DATA=8 STOP=1 to=off dtr=off rts=off");
		$fp =fopen("com3", "w");
		// $serial->_dHandle = $fp;
		//sleep(2);
		//$fp = fopen('/dev/ttyUSB0','r+'); //use this for Linux
		$openSerialOK = true;
	} catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
	}

	if($openSerialOK) {
		 fwrite($fp, $command); //write string to serial
		// $serial->sendMessage($command);
		echo $command . "<br>";
		fclose($fp);
    }	
}

// openSerial("Without this line, the first control will not work. I don't know way.");

if(isset($_POST['submit1'])) {
    openSerial(1);
}

if(isset($_POST['submit2'])) {
    openSerial(0);
}
if(isset($_POST['submit3'])) {
    openSerial(2);
}
if(isset($_POST['submit4'])) {
    openSerial(3);
}
if(isset($_POST['submit5'])) {
    openSerial(4);
}
if(isset($_POST['submit6'])) {
    openSerial(5);
}
if(isset($_POST['submit7'])) {
    openSerial(6);
}
if(isset($_POST['submit8'])) {
    openSerial(7);
}
if(isset($_POST['submit9'])) {
    openSerial(8);
}
if(isset($_POST['submit10'])) {
    openSerial(9);
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <input type="submit" name="submit1" value="ON"><br>
   <input type="submit" name="submit2" value="OFF"><br>   
  <!--  <input type="submit" name="submit3" value="1 off"><br>   
   <input type="submit" name="submit4" value="1 off"><br>   
   <input type="submit" name="submit5" value="1 off"><br>   
   <input type="submit" name="submit6" value="1 off"><br>   
   <input type="submit" name="submit7" value="1 off"><br>   
   <input type="submit" name="submit8" value="1 off"><br>   
   <input type="submit" name="submit9" value="1 off"><br>   
   <input type="submit" name="submit10" value="1 off"><br>    -->
</form>

