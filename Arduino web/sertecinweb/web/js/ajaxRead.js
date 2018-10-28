$(function(){
   const puertas = $('h3#puertas');
   setInterval(function(){    
      $.ajax({
        url: "../../ajax/ajaxRead.php",
        method: "get",
        dataType: 'json',
        success: function(data){
          console.log(data.data);
          const estado = Number(data.command);
          estadoAscensor(estado);
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
    $('#piso').html(`Reiniciando...<i class="fa fa-cog fa-spin fa-fw"></i>`);
    $('#puertas').html(`Reiniciando...<i class="fa fa-cog fa-spin fa-fw"></i>`);
  }else{
    $('#piso').text('Error!');
    $('#puertas').text('Error!');
  }
}

function estadoPB(estado){
  switch ( estado ) {
    case 0:
      $('#piso').text('PB');
      $('#puertas').text('Cerradas');
    break;
    case 1:
      $('#piso').text('PB');
      $('#puertas').text('Cerrando');
    break;
    case 2:
      $('#piso').text('PB');
      $('#puertas').text('Abriendo');
    break;
    case 3:
      $('#piso').text('PB');
      $('#puertas').text('Abiertas');
    break;
  }
}

function estadoP1(estado){
  switch ( estado ) {
    case 10:
      $('#piso').text('P1');
      $('#puertas').text('Cerradas');
    break;
    case 11:
      $('#piso').text('P1');
      $('#puertas').text('Cerrando');
    break;
    case 12:
      $('#piso').text('P1');
      $('#puertas').text('Abriendo');
    break;
    case 13:
      $('#piso').text('P1');
      $('#puertas').text('Abiertas');
    break;

  }
}

function estadoP2(estado){
  switch ( estado ) {
    case 20:
      $('#piso').text('P2');
      $('#puertas').text('Cerradas');
    break;
    case 21:
      $('#piso').text('P2');
      $('#puertas').text('Cerrando');
    break;
    case 22:
      $('#piso').text('P2');
      $('#puertas').text('Abriendo');
    break;
    case 23:
      $('#piso').text('P2');
      $('#puertas').text('Abiertas');
    break;
  }
}

function subiendoPiso(estado){
  switch (estado) {
    case 50:
      $('#piso').text('Subiendo a P1');
      $('#puertas').text('Cerradas');
    break;
    case 51:
      $('#piso').text('Subiendo a P2');
      $('#puertas').text('Cerradas');
    break;
  }
}

function bajandoPiso(estado){
  switch (estado) {
    case 62:
      $('#piso').text('Bajando a P1');
      $('#puertas').text('Cerradas');
    break;
    case 61:
      $('#piso').text('Bajando a PB');
      $('#puertas').text('Cerradas');
    break;
  }
}