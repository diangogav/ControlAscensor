$(function(){
   const puertas = $('h3#puertas');
   setInterval(function(){    
      $.ajax({
        url: "../../ajax/ajaxRead.php",
        method: "get",
        dataType: 'json',
        success: function(data){
          mensaje(data);
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert(errorThrown);
           // alert(errorThrown);
           // alert( "¡¡ERROR!!, Revisar consola (F12)" );
           console.log("A: " + jqXHR);
           console.log("ERROR: " + textStatus);
           console.log("MENSAJE DE ERROR: " + errorThrown);
        }
     });
   },1000);
});

function mensaje(data){
  switch ( Number(data.data) ) {
    case 0:
       $('h3#puertas').text('Reposando PB');
       $('h3#piso').text('PB');
    break;
    case 1:
       $('h3#puertas').text('Reposando P1');
       $('h3#piso').text('1');
    break;
    case 2:
       $('h3#puertas').text('Reposando P2');
       $('h3#piso').text('2');
    break;
    case 3:
       $('h3#puertas').text('Abriendo');
    break;
    case 4:
       $('h3#puertas').text('Cerrando');
    break;
    case 5:
       $('h3#puertas').text('Cerradas');
       $('h3#piso').text('Subiendo');
    break;
    case 6:
       $('h3#puertas').text('Cerradas');
       $('h3#piso').text('Bajando');
    break;
    case 7:
       $('h3#puertas').text('Config Subir');
    break;
    case 8:
       $('h3#puertas').text('Config Bajar');
    break;
    case 9:
       $('h3#puertas').text('Parando');
    break;
    case 10:
       $('h3#puertas').text('Sensando');
    break;
    }
}