<?php
// ESTE CODIGO ES PARA VERIFICAR SI LA UNIDAD SE ENTREGO COMO SUSTITUTO
// si es sustituto
global $id_unidadEste;
$id_unidadEste = $id_unidad;
$sql_sust;

// SI CONSULTA GERENTE
if($_SESSION["movimientos"] > 0 OR $_SESSION["sustituto"] > 0){ // PRIVILEGIO PARA TODOS LOS QUE PUEDAN VER UBICACION
	
	$sql_sust = ' SELECT * '
        . ' FROM sustituto '
        . " WHERE id_unidadS = '$id_unidad' 
        	AND fechaI IS NOT NULL 
        	AND fechaF IS NULL 
        	AND status = '1' 
        	ORDER BY id_sust DESC LIMIT 1 ";

$res_sust 	= mysqli_query($dbd2, $sql_sust);
$filas_sust = mysqli_num_rows($res_sust);

if($filas_sust > 0){ //APERTURA EJECUTAR SI HUBO ALGO

echo "<fieldset><legend>Es sustituto</legend>";
echo "<table>\n";
echo "<caption style='color:#cc6600;background:#e6ffe6;'>ACTUALMENTE <b>ES SUSTITUTO</b> DE</caption>";
echo "<tr>
	<th>FOLIO</th>
	<th>FECHA SOLICITUD</th>
	<th>AUTO BASE</th>
	<th>MOTIVO</th>
	<th>VER</th>
	</tr>";
while($row = mysqli_fetch_assoc($res_sust)){
	$id_sust 		= $row['id_sust'];
	$serieFallado 	= $row['serieFallado'];
	$serieSustituto = $row['serieSustituto'];
	$motivo 		= $row['motivo'];
	$fecharegistro 	= $row['fecharegistro'];
	$fechaInicio 	= $row['fechaI'];
	$fechaFinal 	= $row['fechaF'];
	$status 		= $row['status'];
//include("funcion.php");
	echo "<tr>";
	echo "<td>{$id_sust}</td>"; 
	echo "<td>{$fecharegistro}</td>"; 	

	idxserie($serieFallado);
	datosxid($id_unidad);
	$tipoFallado = $Vehiculo;

	echo "<td>{$Economico} -- {$serieFallado} -- {$Placas} -- {$tipoFallado}</td>";
	echo "<td>{$motivo}</td>";
	echo "<td>
		<a href='AutoSustitutoVerId.php?id_sustituto=$id_sust' target='blank'>Ver formato</a>
		</td>";
	echo "</tr>";
	
	//idxserie($serieSustituto); // PARA REGRESAR EL VALOR DEL ID AL AUTO QUE SE CONSULTA
	$id_unidad = $id_unidadEste;
	}
	echo "</table>";
	echo "<p>id_unidad $id_unidad</p>";
	echo "</fieldset>";
	} //CIERRE EJECUTAR SI HUBO ALGO
} // CIERRE PRIVILEGIO PARA TODOS LOS QUE PUEDAN VER UBICACION
$id_unidad = $id_unidadEste;