<?php 
require "escritura.php"; 
require "lectura.php"; 
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

	<h2>COM1: <?php echo $mensaje ?? "No se ha enviado"; ?></h2>
	<h2>COM2: <?php echo $contenido ?? "No se ha recibido"; ?></h2>
  
  <hr>
  <button id="consulta">Consulta AJAX</button>
  <br>
  <div id="mensaje"></div>

<script src="js/jquery/jquery-3.3.1.min.js"></script>
<script>
$(function(){

  $('#consulta').click(function(){
    $.ajax({
        type: 'get',
        url: 'ajax.php',
        dataType: "json",
        beforeSend: function(){
          $('#mensaje').html("<h3>Cargando...</h3>");
        },
        success: function(data){
          $('#mensaje').html(`
            <h3>Respuesta consulta: </h3>
            ${data.datos}
          `);
        },
        error: function(a,b,c){
            alert("Error");
            // toastrErrorTopRight("Error Ajax", "Problema en sidebar");
            console.log(a);
            console.log(b);
            console.log(c);
        }

    });
  });
    
});
</script>
</body>
</html>

