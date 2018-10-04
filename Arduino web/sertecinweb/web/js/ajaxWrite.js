$(function(){   
   
   let boton = $("button[name=subir], button[name=bajar], button[name=abrir], button[name=cerrar]");
   boton.on("click", function(e){
      e.preventDefault();
      const nombreBoton = $(this).attr('name');
      const puertas = $('h3#puertas');
      // alert(mensaje);
      $.ajax({
         url: "../../ajax/ajaxWrite.php",
         method: "post",
         dataType: 'json',
         data : {
            "botonPresionado":nombreBoton
         },
         success: function(data){
            const botonPresionado = data.botonPresionado;
            console.log("Boton para "+botonPresionado+" ascensor presionado!");
            switch (botonPresionado) {
               case 'abrir':
                  puertas.text('Abiertas');
               break;
               case 'cerrar':
                  puertas.text('Cerradas');
               break;
            }
         },
         error: function(jqXHR, textStatus, errorThrown){
            alert(errorThrown);
            // alert( "¡¡ERROR!!, Revisar consola (F12)" );
            // console.log("A: " + jqXHR);
            // console.log("ERROR: " + textStatus);
            // console.log("MENSAJE DE ERROR: " + errorThrown);
         }
      });
   });
});
