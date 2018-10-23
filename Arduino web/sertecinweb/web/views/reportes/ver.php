<?php 
require "../../../controller/conexion.php";
$print = $_POST['print'];
	
$query = "SELECT * FROM data";
$ejecutar = $conexion->query($query);
echo "
<table class='table table-striped table-hover'>
 <thead>
    <th class='text-center'>id</th>
    <th class='text-center'>Comando</th>
    <th class='text-center'>Fecha y Hora</th>
 </thead>
 <tbody>
";
foreach($ejecutar as $row){
 echo "
 <tr>
    <td class='text-center'>".$row['id']."</td>
    <td class='text-center'>".Comando($row['data'])."</td>
    <td class='text-center'>".$row['time']."</td>
 </tr>   
 ";
}
echo "                   
 </tbody>
</table>
";		

 ?>