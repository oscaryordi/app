<?php
if($_SESSION["solAtn"] > 0){  // APERTURA PRIVILEGIOS

	$sql_SA =   ' SELECT * '
				. ' FROM solAtn '
				//. " WHERE id_unidad = '$id_unidad' "
				. ' ORDER BY fechareg DESC LIMIT 100 ';
	$sql_SA_R 	= mysqli_query($dbd2,$sql_SA);
	@$camposuh  = mysqli_num_fields($sql_SA_R);
	@$filasuh   = mysqli_num_rows($sql_SA_R);


// FUNCION PARCHE PARA HABILITAR FUNCION INEXISTENTE
function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}
// FUNCION PARCHE PARA HABILITAR FUNCION INEXISTENTE

echo "<br>";
echo "<fieldset><legend>HISTORICO DE SOLICITUDES DE ATENCION, se muestran hasta 100 registros</legend>\n";
echo "<table class='ResTabla'>\n"; // Empezar tabla
echo "<tr><th colspan=$camposuh >CANTIDAD DE REGISTROS: <b>$filasuh</b></th></tr>\n";
echo "<tr>"; // Crear fila
	for ($i = 0;$i < $camposuh;$i++)
	{
		$nombrecampouh = mysqli_field_name($sql_SA_R, $i); // $nombrecampouh = mysqli_field_name($sql_SA_R, $i);
		echo "<th>$nombrecampouh</th>";
	}
	echo "</tr>\n"; // Cerrar fila
	while (@$rowuh = mysqli_fetch_assoc($sql_SA_R)) 
	{
		echo "<tr>"; // Crear fila
		foreach ($rowuh as $key => $value) 
		{
			echo "<td>$value</td>";
		}
	}
echo "</table>\n"; // Cerrar tabla
echo "</fieldset>";
echo "<br>";
} // CIERRE PRIVILEGIOS