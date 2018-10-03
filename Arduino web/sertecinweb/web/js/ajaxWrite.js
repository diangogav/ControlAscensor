$(function(){

   let boton = $("button[name=subir], button[name=bajar], button[name=abrir], button[name=cerrar]");
   boton.on("click", function(e){
      e.preventDefault();
      const nombreBoton = $(this).attr('name');
      // alert(mensaje);
      $.ajax({
         url: "../../ajax/ajaxWrite.php",
         method: "post",
         data : {
            "botonPresionado":nombreBoton
         },
         success: function(data){
            console.log("Boton para "+data+" ascensor presionado!");
         }
      });
   });

})