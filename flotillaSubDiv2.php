<fieldset><legend>Resumen de flotilla</legend>
<?php
areaAXid_subDiv2($id_subDiv2);
echo "AREA ADMINISTRATIVA:<h2>{$mostrarAAsn2}</h2>";


// INICIA RESULTADOS DE FLOTILLA
$sql_flotilla = 'SELECT au.id_unidad id_unidad, 
		au.id_asignacion id_asignacion, 
		au.id_subDiv3 id_subDiv3, 
		au.id_partida id_partida,   
		u.id, u.Economico Economico, u.marca Marca, 
		u.Serie Serie, u.Vehiculo Vehiculo, u.Modelo Modelo, 
		u.Color Color  '

		. ' FROM asignaUactual au '
		. ' JOIN '
		. ' ubicacion u '
		. ' ON '
		. ' au.id_unidad = u.id '
		. " WHERE  au.id_subDiv2 = '$id_subDiv2' "	// PARA QUE VEA EL SUBFILTRO 2	  
		. ' ORDER BY '
		. ' au.id_subDiv3 '
		. ' ASC , '
		. ' u.id '
		. ' DESC ';
//		. " LIMIT $pagina_1, $rxpag" ; 
		
echo "<table class='ResTabla'>\n";
echo "<tr>
		<th>ID en BD</th>
		<th>ECONOMICO</th>
		<th>MARCA</th>
		<th>SERIE</th>
		<th>VEHICULO</th>
		<th>MODELO</th>
		<th>COLOR</th>
		<th>PLACAS</th>
	  </tr>";

/*
// <th>MOTOR</th>, <th>CLAVE VEH</th>
<th>PROVEEDOR</th>
<th>FECHA FACTURA</th>
<th>FOLIO FACTURA</th>
<th>IMPORTE</th>
<th>PROYECTO</th>
<th>UBICACION</th>
*/

$res_flotilla = mysqli_query($dbd2, $sql_flotilla);

while($row = mysqli_fetch_assoc($res_flotilla)){
	$id_asignacion 	= $row['id_asignacion'];
	$id 			= $row['id_unidad'];
	$id_unidad 		= $row['id_unidad']; // PARA QUE FUNCIONE LA QUERY DEL HISTORICO
	$Economico 		= $row['Economico'];
	$marca 			= $row['Marca'];
	$serie 			= $row['Serie'];
	$vehiculo 		= $row['Vehiculo'];
	$modelo 		= $row['Modelo'];
	$color 			= $row['Color'];

	$id_subDiv3 	= $row['id_subDiv3'];
	$id_partida 	= $row['id_partida'];

//	$motor = $row['Motor'];
//	$clave = $row['claveVehicular'];

//	$proveedor = $row['Proveedor'];
//	$fecha = $row['FechaFactura'];
//	$folio = $row['FolioFactura'];
//	$importe = $row['Importe'];	

	
	//$pagado = $row['PAGADO'];
	
	echo "<tr>";
	echo "<td>{$id}</td>";

	echo "<td><a href='u3index.php?id_unidad=$id_unidad' title='Consultar UNIDAD'>
	{$Economico}</a></td>";

	echo "<td>{$marca}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$vehiculo}</td>";
	echo "<td>{$modelo}</td>";
	echo "<td>{$color}</td>";

	placaxid($id_unidad);
	echo "<td>{$Placas}</td>";

	areaAXid_subDiv3($id_subDiv3);
	echo "<td>{$mostrarAAsn3}</td>";

	$mostrarAAsn3 = '';

// SUPERVISOR LOGISTICA
if($_SESSION["superLog"] > 0){
	// FECHA ASIGNACION
	$sql_FA 	= "	SELECT fecha_inicio 
					FROM asignaUnidad 
					WHERE id_asignacion = $id_asignacion 
					LIMIT 1";
	$FA_R 		= mysqli_query($dbd2, $sql_FA);
	$arrayFA_R 	= mysqli_fetch_array($FA_R);
	$fechaAsignacion = $arrayFA_R['fecha_inicio'];
	// FECHA ASIGNACION
	echo "<td>{$fechaAsignacion}</td>";
}
// SUPERVISOR LOGISTICA


//	echo "<td>{$motor}</td>";
//	echo "<td>{$clave}</td>";
//	echo "<td>{$proveedor}</td>";
//	echo "<td>{$fecha}</td>";
//	echo "<td>{$folio}</td>";
//	echo "<td>{$importe}</td>";
	
//	ubicacionHistorico($id_unidad);
//	echo "<td>{$clienteA}</td>";
//	echo "<td>{$ubicacionA}</td>";
	
	// echo "<td><a href='formato_vista.php?numero_inventario=".$inventario."'><button type='button' class='btn btn-success  btn-sm'>
	// <span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> ver formato </button></a></td>";
	echo "</tr>";
}
echo "</table></fieldset>";
?>