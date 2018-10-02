$(function(){

   let boton = $("button[name=subir], button[name=bajar], button[name=abrir], button[name=cerrar]");
   boton.on("click", function(e){
      e.preventDefault();
      const nameBoton = $(this).attr('name');
      // alert(mensaje);
      $.ajax({
         url: "../../ajax/ajaxWrite.php",
         method: "get",
         data : {
            "boton":nameBoton
         },
         success: function(data){
            console.log(data);
         }
      });
   });

})