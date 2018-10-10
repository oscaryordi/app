<?php 

$sql_entradas = 'SELECT '
      	. ' `id_unidad`, ' 
        . ' `id_formato`, '
        . ' `fechaentrega`, '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo`, '
        . ' `razonsalida`, '
        . ' `proyecto_origen`, '
        . ' `proyecto_destino` '
        . ' FROM `formato_inventario` ';
$sql_entradas .= " WHERE `hora_salida` > '0:00' ";
$sql_entradas .= ' ORDER BY '
        . '  fechaentrega DESC, `id_formato` '
        . ' DESC '
        . ' LIMIT 20';

echo "<fieldset><legend>Resumen de salidas a la fecha</legend>";
echo "<table  class='ResTabla'>\n";
echo "<tr>
<th>FECHA DE INGRESO</th>
<th>INVENTARIO</th>
<th>ECONOMICO</th>
<th>PLACAS</th>
<th>SERIE</th>
<th>TIPO</th>
<th>MOTIVO</th>
<th>ORIGEN</th>
<th>DESTINO</th>";

if($_SESSION["gps"] > 0  or $_SESSION["gpsV"] > 0){
	echo "<th>GPS</th>";
}

echo "<th>VER DETALLE</th></tr>";
$res_entradas = mysqli_query($dbd2, $sql_entradas);

while($row = mysqli_fetch_assoc($res_entradas)){
	$id_unidad 		= $row['id_unidad'];
	$id_inventario 	= $row['id_formato'];
	$fechaentrega 	= $row['fechaentrega'];
	$inventario 	= $row['numero_inventario'];
	$economico 		= $row['economico'];
	$placas 		= $row['placas'];
	$serie 			= $row['serie'];
	$tipo 			= $row['tipo'];
	$razonsalida 	= $row['razonsalida'];
	$proyecto_origen = $row['proyecto_origen'];
	$proyecto_destino = $row['proyecto_destino'];
	//$pagado = $row['PAGADO'];
	
	echo "<tr>";
	echo "<td>{$fechaentrega}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";
	echo "<td>{$razonsalida}</td>";
	echo "<td>{$proyecto_origen}</td>";
	echo "<td>{$proyecto_destino}</td>";
	
	if($_SESSION["gps"] > 0  or $_SESSION["gpsV"] > 0)
	{
		gpsxid($id_unidad);
		$color = '';
		if($tienegps == 'No'){$color = 'red';}
		echo "<td style='color:$color;'>{$tienegps}</td>";
	} 	
	echo "<td><a href='formato_vista_id.php?id_inventario=".$id_inventario."'><button type='button' class='btn btn-success  btn-sm'>
	<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> ver formato </button></a></td>";
	echo "</tr>";
}
echo "</table></fieldset>";
?>