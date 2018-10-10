<?php
echo "<section  style='padding:5px;'><fieldset><legend>RESUMEN DE SOLICITUDES DE MANTENIMIENTO</legend>";

$sql_mttoSol = '';

$pagina = '';

	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . " WHERE id_unidad = '$id_unidad'  AND cancelado = 0   "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC ' ;

		include('mttoSolResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN

echo "<legend>Bitacora de Mantenimiento</legend>";

$sql3 = "SELECT 
		`fecha` 	as `FECHA`, 
		`importe` 	as `IMPORTE`, 
		`proveedor` as `PROVEEDOR`, 
		`concepto` 	as `CONCEPTO`, 
		`km` 		as `KM` 
		FROM `bitacora` 
		WHERE `id_unidad` = $id_unidad  
		ORDER BY fecha DESC LIMIT 0, 30 ";

$res3 		= mysqli_query($dbd2, $sql3);
@$campos3 	= mysqli_num_fields($res3);
@$filas3 	= mysqli_num_rows($res3);

echo "<table  class='ResTabla' >\n"; // Empezar tabla
echo "<caption><a>Cantidad de mantenimientos encontrados: <b>$filas3</b>   ";
echo "</a></caption>\n";

echo "
	<tr>
	<th>FECHA</th>
	<th>IMPORTE</th>
	<th>PROVEEDOR</th>
	<th>CONCEPTO</th>
	<th>KM</th>
	</tr>
	";

while( $row = mysqli_fetch_assoc($res3) )
{

	$fecha 		= $row['FECHA'];
	$importe 	= $row['IMPORTE'];
	$proveedor 	= $row['PROVEEDOR'];
	$concepto 	= $row['CONCEPTO'];
	$km 		= $row['KM'];

	echo "<tr>";
	echo "<td>$fecha</td>";
	echo "<td>$importe</td>";
	echo "<td>$proveedor</td>";
	echo "<td>$concepto</td>";
	echo "<td>$km </td>";
	echo "</tr>";
}

echo "</table>\n"; // Cerrar tabla
echo "</fieldset></section>";