<?php
if($_SESSION["kmUsr"] >= 0){  // APERTURA PRIVILEGIOS
//<!--KILOMETRAJE HISTORICO-->
	$sql_km = 'SELECT fechareg, km '
		. ' FROM kmH '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY fechareg DESC LIMIT 20 ';
	$sql_km_R   = mysqli_query($dbd2, $sql_km);
	@$camposuh  = mysqli_num_fields($sql_km_R);
	@$filasuh   = mysqli_num_rows($sql_km_R);

echo "<br>";
echo "<fieldset><legend>REPORTE DE KILOMETRAJE HISTORICO, se muestran hasta 20 registros</legend>\n";
echo "<table>\n"; // Empezar tabla
echo "<tr><th colspan=$camposuh >CANTIDAD DE REGISTROS: <b>$filasuh</b></th></tr>\n";


echo "<tr>"; // Crear fila
echo "<th>FECHA DEL REGISTRO</th>";
echo "";
echo "<th>KM</th>";
echo "";
echo "</tr>\n"; // Cerrar fila


while (@$rowuh = mysqli_fetch_assoc($sql_km_R)) 
{
	$km 		= $rowuh['km'];
	$fechareg 	= $rowuh['fechareg'];

	echo "<tr>"; // Crear fila
	echo "<td>$fechareg</td>";		
	echo "<td>$km</td>";
	echo "</tr>";
}
echo "</table>\n"; // Cerrar tabla
echo "</fieldset>";
echo "<br>";
} // CIERRE PRIVILEGIOS  