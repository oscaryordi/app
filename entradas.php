<!-- ESTILO -->
<style>
td{ font-size:.85em;}
a img {width:163px;height:70px;}
th {background-color:#016155;FONT-SIZE: .65em; FONT-FAMILY: Arial; COLOR: white; padding: 1px 4px;border-radius: 5px;}
</style>
<?php
$sql_entradas = 'SELECT '
       	. ' `id_unidad`, ' 
        . ' `id_formato`, '
        . ' `fecharecepcion`, '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo`, '
        . ' `razonentrada`, '
        . ' `proyecto_origen`, '
        . ' `proyecto_destino` '
        . ' FROM `formato_inventario` ';
$sql_entradas .= " WHERE `proyecto_destino` LIKE '%JETVAN TEMPORAL%' ";
$sql_entradas .= ' ORDER BY '
        . ' `numero_inventario` '
        . ' DESC '
        . ' LIMIT 20'; 

echo "<fieldset><legend>Resumen de entradas a la fecha</legend>";
echo "<table  class='ResTabla'>";
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
	 if($_SESSION["gps"] > 0  or $_SESSION["gpsV"] > 0)
		{
		 echo "<th>GPS</th>";
		}
echo "	<th>VER DETALLE</th>
	  </tr>";


$res_entradas = mysqli_query($dbd2, $sql_entradas);

while($row = mysqli_fetch_assoc($res_entradas)){
	$id_unidad 		= $row['id_unidad'];
	$id_inventario 	= $row['id_formato'];	
	$fecharecepcion = $row['fecharecepcion'];
	$inventario 	= $row['numero_inventario'];
	$economico 		= $row['economico'];
	$placas 		= $row['placas'];
	$serie 			= $row['serie'];
	$tipo 			= $row['tipo'];
	$razonentrada 	= $row['razonentrada'];
	$proyecto_origen = $row['proyecto_origen'];
	$proyecto_destino = $row['proyecto_destino'];
	//$pagado = $row['PAGADO'];
	
	echo "<tr>";
	echo "<td>{$fecharecepcion}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";
	echo "<td>{$razonentrada}</td>";
	echo "<td>{$proyecto_origen}</td>";
	echo "<td>{$proyecto_destino}</td>";

	if($_SESSION["gps"] > 0 or $_SESSION["gpsV"] > 0)
	{
		gpsxid($id_unidad);
		$color = '';
		if($tienegps == 'No'){$color = 'red';}
		echo "<td style='color:$color;'>{$tienegps}</td>";
	} 	
	
	echo "<td>
	<a href='formato_vista_id.php?id_inventario=".$id_inventario."'>
	<button type='button' class='btn btn-success  btn-sm'>
	<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span>
	 ver formato </button>
	</a>
	</td>";

	echo "</tr>";
}
echo "</table></fieldset>";