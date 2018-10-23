<?php require "../../../controller/session.php" ?>
<?php require "../../../controller/funciones.php" ?>
<?php 
   require "../../../controller/conexion.php";
   header("Content-type: application/vnd.ms-excel");
   header("Content-Disposition: attachment;filename=Reporte_log.xls");
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>    
   <title>Sertecinweb</title>   
 </head>
 <body>
    <div class="container">
      <h3>SERTECINWEB</h3>
      <h4 class="title ">
               Comandos ejecutados por
         <?php 
         echo $_SESSION['nombre']." ".$_SESSION['apellido']." CI: V-".$_SESSION['cedula'] ;
         ?>
         </h4>
      <table class='table table-striped table-hover' border="1">
         <thead>
            <th>#</th>
            <th>Comando</th>
            <th>Fecha y Hora</th>
         </thead>
         <tbody>
         <?php     
            $query = "SELECT * FROM historic";
            $ejecutar = $conexion->query($query);
            foreach($ejecutar as $row){
             echo "
             <tr>
                <td>".$row['id']."</td>
                <td>".Comando($row['command'])."</td>
                <td>".$row['time']."</td>
             </tr>   
             ";
            }
         ?>
         </tbody>
      </table>
    </div>
 </body>
 </html>