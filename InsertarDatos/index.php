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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<button type="submit" name="accion" value="00">Reposando PB Cerradas</button>
	<button type="submit" name="accion" value="01">Reposando PB Cerrando</button>
	<button type="submit" name="accion" value="02">Reposando PB Abriendo</button>
	<button type="submit" name="accion" value="03">Reposando PB Abiertas</button>
	<hr align="left" width="50%">
	<button type="submit" name="accion" value="10">Reposando P1 Cerradas</button>
	<button type="submit" name="accion" value="11">Reposando P1 Cerrando</button>
	<button type="submit" name="accion" value="12">Reposando P1 Abriendo</button>
	<button type="submit" name="accion" value="13">Reposando P1 Abiertas</button>
	<hr align="left" width="50%">
	<button type="submit" name="accion" value="20">Reposando P2 Cerradas</button>
	<button type="submit" name="accion" value="21">Reposando P2 Cerrando</button>
	<button type="submit" name="accion" value="22">Reposando P2 Abriendo</button>
	<button type="submit" name="accion" value="23">Reposando P2 Abiertas</button>
	<hr align="left" width="50%">
	<button type="submit" name="accion" value="50">Subiendo a P1</button>
	<button type="submit" name="accion" value="51">Subiendo a P2</button>
	<button type="submit" name="accion" value="62">Bajando a P1</button>
	<button type="submit" name="accion" value="61">Bajando a PB</button>
	<hr align="left" width="50%">
	<button type="submit" name="accion" value="255">Resetear</button>
	
</form>
<h5 id="piso"></h5>
<h5 id="puertas"></h5>

<script src="jquery-3.3.1.min.js"></script>
<script>
$(function(){
	setInterval(function(){		
	   $.ajax({
	     url: "select.php",
	     method: "get",
	     dataType: 'json',
	     success: function(data){
	     	const estado = Number(data.command);
	     	estadoAscensor(estado);    
	     },
	     error: function(jqXHR, textStatus, errorThrown){
	     	alert("Error de Lectura");
	        // alert(errorThrown);
	        // alert( "¡¡ERROR!!, Revisar consola (F12)" );
	        console.log("A: " + jqXHR);
	        console.log("ERROR: " + textStatus);
	        console.log("MENSAJE DE ERROR: " + errorThrown);
	     }
	  });
	},1000);
});

function estadoAscensor(estado){
	if (estado >= 0 && estado <= 3) {
		estadoPB(estado);
	}
	else if (estado >= 10 && estado <= 13) {
		estadoP1(estado);
	}
	else if (estado >= 20 && estado <= 23) {
		estadoP2(estado);
	}
	else if (estado == 50 || estado == 51) {
		subiendoPiso(estado);
	}
	else if (estado == 61 || estado == 62) {
		bajandoPiso(estado);
	}
	else if(estado == 255){
		$('#piso').text('Reseteando...');
		$('#puertas').text('Reseteando...');
	}
}

function estadoPB(estado){
	switch ( estado ) {
 		case 0:
 			$('#piso').text('Piso: PB');
 			$('#puertas').text('Puertas: Cerradas');
 		break;
 		case 1:
 			$('#piso').text('Piso: PB');
 			$('#puertas').text('Puertas: Cerrando');
 		break;
 		case 2:
 			$('#piso').text('Piso: PB');
 			$('#puertas').text('Puertas: Abriendo');
 		break;
 		case 3:
 			$('#piso').text('Piso: PB');
 			$('#puertas').text('Puertas: Abiertas');
 		break;
 	}
}

function estadoP1(estado){
	switch ( estado ) {
 		case 10:
			$('#piso').text('Piso: P1');
			$('#puertas').text('Puertas: Cerradas');
		break;
		case 11:
			$('#piso').text('Piso: P1');
			$('#puertas').text('Puertas: Cerrando');
		break;
		case 12:
			$('#piso').text('Piso: P1');
			$('#puertas').text('Puertas: Abriendo');
		break;
		case 13:
			$('#piso').text('Piso: P1');
			$('#puertas').text('Puertas: Abiertas');
		break;

 	}
}

function estadoP2(estado){
	switch ( estado ) {
		case 20:
			$('#piso').text('Piso: P2');
			$('#puertas').text('Puertas: Cerradas');
		break;
		case 21:
			$('#piso').text('Piso: P2');
			$('#puertas').text('Puertas: Cerrando');
		break;
		case 22:
			$('#piso').text('Piso: P2');
			$('#puertas').text('Puertas: Abriendo');
		break;
		case 23:
			$('#piso').text('Piso: P2');
			$('#puertas').text('Puertas: Abiertas');
		break;
 	}
}

function subiendoPiso(estado){
	switch (estado) {
		case 50:
 			$('#piso').text('Piso: Subiendo a P1');
 			$('#puertas').text('Puertas: Cerradas');
 		break;
 		case 51:
 			$('#piso').text('Piso: Subiendo a P2');
 			$('#puertas').text('Puertas: Cerradas');
 		break;
	}
}

function bajandoPiso(estado){
	switch (estado) {
		case 62:
 			$('#piso').text('Piso: Bajando a P1');
 			$('#puertas').text('Puertas: Cerradas');
 		break;
 		case 61:
 			$('#piso').text('Piso: Bajando a PB');
 			$('#puertas').text('Puertas: Cerradas');
 		break;
	}
}



</script>
</body>
</html>
