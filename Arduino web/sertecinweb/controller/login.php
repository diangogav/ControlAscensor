<?php

try{

	$base=new PDO('mysql:host=localhost; dbname=sertecin','root','');

	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	
	
	$sql="SELECT * FROM usuarios WHERE CI_USUAR=:login and PASSWORD=:password";

	$resultado=$base->prepare($sql);
	$login=htmlentities(addslashes($_POST["cedula"]));
	$password=htmlentities(addslashes($_POST["password"]));

	$resultado->bindValue(":login",$login);
	$resultado->bindValue(":password",$password);

	$resultado->execute();	

	$numero_registro=$resultado->rowCount();

	if($numero_registro!=0){
		session_start();
		while($registro = $resultado->fetch()) {
		    $_SESSION['nombre'] = $registro['prime_nombr'];
		    $_SESSION['apellido'] = $registro['prime_apell'];
		    $_SESSION['cedula'] = $registro['ci_usuar'];
		}
		header("location:../web/views/index.php");					
	   														
		}else{

		header("location:../index.html");
		}
		
	   
		
	

}catch(Exception $e){

die("Error: ". $e->getMessage());

}
?>