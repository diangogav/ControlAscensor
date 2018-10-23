<?php require "../../../controller/session.php" ?>
<?php require "../../../controller/funciones.php" ?>
<?php 
  require "../../../controller/conexion.php";
  require_once '../../../vendor/dompdf/autoload.inc.php';
  require_once '../../../vendor/dompdf/lib/html5lib/Parser.php';
  require_once '../../../vendor/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
  require_once '../../../vendor/dompdf/lib/php-svg-lib/src/autoload.php';
  require_once '../../../vendor/dompdf/src/Autoloader.php';
  Dompdf\Autoloader::register();
 ?>
<?php 
$html ="
<!DOCTYPE html>
<html>
<head>    
  <title>Sertecinweb</title>  
  <link href='../../css/style.css>
</head>
<body>
  <h3 align='center' class='center'>SERTECINWEB</h3>
  <h4 align='center'>
    Comandos ejecutados por ".$_SESSION['nombre']." ".$_SESSION['apellido']." CI: V-".$_SESSION['cedula']."
  </h4>
  <div class='container'>
    <table width=100%>
      <thead>
        <tr>
          <th>#</th>
          <th>Comando</th>
          <th>Fecha y Hora</th>
        </tr>
      </thead>
      ";   
    $query = "SELECT * FROM data";
    $ejecutar = $conexion->query($query);
    foreach($ejecutar as $row){
    $html.= "
     <tr>
        <td>".$row['id']."</td>
        <td>".Comando($row['data'])."</td>
        <td>".$row['time']."</td>
     </tr>";
    }
$html .="  
    </table>
  </div>
</body>
</html>";

// reference the Dompdf namespace
use Dompdf\Dompdf;

$html = utf8_encode($html);
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

$dompdf->set_option('defaultFont', 'Courier');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Reporte_log.pdf");


  ?>


