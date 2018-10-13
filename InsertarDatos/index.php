<?php 
require "insert.php"
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inserción Datos</title>
	<link rel="stylesheet" href="">
</head>
<body>
<h1>Insertar Datos a BD arduino</h1>
<h5 id="resultado"></h5>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<button type="submit" name="accion" value="0">Reposando PB</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="1">Reposando P1</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="2">Reposando P2</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="3">Abriendo</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="4">Cerrando</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="5">Subiendo</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="6">Bajando</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="7">Config Subir</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="8">Config Bajar</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="9">Parando</button><hr width="10%" align="left">	
	<button type="submit" name="accion" value="10">Sensando</button><hr width="10%" align="left">	
</form>

<script src="jquery-3.3.1.min.js"></script>
<script>
$(function(){
	setInterval(function(){		
	   $.ajax({
	     url: "select.php",
	     method: "get",
	     dataType: 'json',
	     success: function(data){
	     	// console.log(data.id);
	     	// console.log(data.data);
	     	// console.log(data.data+" "+data.time);
	     	switch ( Number(data.data) ) {
	     		case 0:
	     			$('#resultado').text('Reposando PB');
	     		break;
	     		case 1:
	     			$('#resultado').text('Reposando P1');
	     		break;
	     		case 2:
	     			$('#resultado').text('Reposando P2');
	     		break;
	     		case 3:
	     			$('#resultado').text('Abriendo');
	     		break;
	     		case 4:
	     			$('#resultado').text('Cerrando');
	     		break;
	     		case 5:
	     			$('#resultado').text('Subiendo');
	     		break;
	     		case 6:
	     			$('#resultado').text('Bajando');
	     		break;
	     		case 7:
	     			$('#resultado').text('Config Subir');
	     		break;
	     		case 8:
	     			$('#resultado').text('Config Bajar');
	     		break;
	     		case 9:
	     			$('#resultado').text('Parando');
	     		break;
	     		case 10:
	     			$('#resultado').text('Sensando');
	     		break;
	     	}
	     },
	     error: function(jqXHR, textStatus, errorThrown){
	     	alert("Error");
	        // alert(errorThrown);
	        // alert( "¡¡ERROR!!, Revisar consola (F12)" );
	        console.log("A: " + jqXHR);
	        console.log("ERROR: " + textStatus);
	        console.log("MENSAJE DE ERROR: " + errorThrown);
	     }
	  });
	},1000);
});
</script>
</body>
</html>
