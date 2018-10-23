<?php require "../../../controller/session.php" ?>
<?php require "../../../controller/funciones.php" ?>
<?php 
   require "../../../controller/conexion.php";
   header("Content-type: application/vnd.ms-word");
   header("Content-Disposition: attachment;filename=Reporte_log.doc");
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>    
   <title>Sertecinweb</title>   
 </head>
 <body>
    <div class="container">
      <h3 align="center">SERTECINWEB</h3>
      <h4 align="center">
               Comandos ejecutados por
         <?php 
         echo $_SESSION['nombre']." ".$_SESSION['apellido']." CI: V-".$_SESSION['cedula'] ;
         ?>
         </h4>
      <table align="center" border="1">
         <thead>
            <th class="fondo">#</th>
            <th class="fondo">Comando</th>
            <th class="fondo">Fecha y Hora</th>
         </thead>
         <tbody>
         <?php     
            $query = "SELECT * FROM data";
            $ejecutar = $conexion->query($query);
            foreach($ejecutar as $row){
             echo "
             <tr>
                <td class='fondo'>".$row['id']."</td>
                <td class='fondo'>".Comando($row['data'])."</td>
                <td class='fondo'>".$row['time']."</td>
             </tr>   
             ";
            }
         ?>
         </tbody>
      </table>
    </div>
 </body>
 </html>