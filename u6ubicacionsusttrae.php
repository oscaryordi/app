<?php // TRAE TRAE TRAE TRAE
// ESTE CODIGO ES PARA VERIFICAR SI LA UNIDAD TRAE SUSTITUTO
// si trae sustituto
global $id_unidadEste;
$id_unidadEste = $id_unidad;
$sql_sust;

// SI CONSULTA GERENTE
if($_SESSION["movimientos"] > 0 OR $_SESSION["sustituto"] > 0){ // PRIVILEGIO PARA TODOS LOS QUE PUEDAN VER UBICACION
	
	$sql_sust = ' SELECT * '
        . ' FROM sustituto '
        . " WHERE id_unidadF = '$id_unidad' 
        	AND fechaI IS NOT NULL 
        	AND fechaF IS NULL 
        	AND status = '1' 
        	ORDER BY id_sust DESC LIMIT 1 ";

$res_sust 	= mysqli_query($dbd2, $sql_sust);
$filas_sust = mysqli_num_rows($res_sust);

if($filas_sust > 0)
{ //APERTURA EJECUTAR SI HUBO ALGO
echo "<fieldset><legend>Unidad parada trae sustituto</legend>";
echo "<table>\n";
echo "<caption style='color:red;background:yellow;'>ACTUALMENTE <b>TIENE SUSTITUTO</b></caption>";
echo "<tr>
<th>FOLIO</th>
<th>FECHA SOLICITUD</th>
<th>AUTO SUSTITUTO</th>
<th>MOTIVO</th>
<th>VER</th>
</tr>";
	while($row = mysqli_fetch_assoc($res_sust))
	{
		$id_sust 		= $row['id_sust'];
		$serieFallado 	= $row['serieFallado'];
		$serieSustituto = $row['serieSustituto'];
		$motivo 		= $row['motivo'];
		$fecharegistro 	= $row['fecharegistro'];
		$fechaInicio 	= $row['fechaI'];
		$fechaFinal 	= $row['fechaF'];
		$status 		= $row['status'];

		echo "<tr>";
		echo "<td>{$id_sust}</td>"; 
		echo "<td>{$fecharegistro}</td>"; 	

		idxserie($serieSustituto);
		datosxid($id_unidad);
		$tipoFallado = $Vehiculo;

		echo "<td>{$Economico} -- {$serieSustituto} -- {$Placas} -- {$tipoFallado}</td>";
		echo "<td>{$motivo}</td>";
		echo "<td>
			<a href='AutoSustitutoVerId.php?id_sustituto=$id_sust' target='blank'>Ver formato</a>
			</td>";
		echo "</tr>";

		idxserie($serieFallado); // PARA REGRESAR EL VALOR DEL ID AL AUTO QUE SE CONSULTA
		$id_unidad = $id_unidadEste;
	}
	echo "</table>";
	echo "<p>id_unidad $id_unidad</p>";
	echo "</fieldset>";
} //CIERRE EJECUTAR SI HUBO ALGO
} // CIERRE PRIVILEGIO PARA TODOS LOS QUE PUEDAN VER UBICACION
$id_unidad = $id_unidadEste;