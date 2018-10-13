$(function(){   
   
   let boton = $("button[name=subir], button[name=bajar], button[name=abrir], button[name=cerrar], button[name=reset]");
   boton.on("click", function(e){
      e.preventDefault();
      const nombreBoton = $(this).attr('name');
      const puertas = $('h3#puertas');
      $.ajax({
         url: "../../ajax/ajaxWrite.php",
         method: "post",
         dataType: 'json',
         data : {
            "botonPresionado":nombreBoton
         },
         success: function(data){
            // alert("Boton presionado "+data.botonPresionado);         
         },
         error: function(jqXHR, textStatus, errorThrown){
            alert("Error al mandar datos");
            alert(errorThrown);
            // alert( "¡¡ERROR!!, Revisar consola (F12)" );
            // console.log("A: " + jqXHR);
            // console.log("ERROR: " + textStatus);
            // console.log("MENSAJE DE ERROR: " + errorThrown);
         }
      });
   });
});
