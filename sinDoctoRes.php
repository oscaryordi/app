<?php


// inicia documentos del siniestro
$sql_sinD = "SELECT * FROM sinDocto WHERE id_siniestro = '$id_siniestro' ORDER BY id_docto DESC ";
$sql_sinDR = mysqli_query($dbd2, $sql_sinD);

echo "<div>";
echo "<fieldset>";
echo "<table>
	<tr>
		<th>id_docto</th>
		<th>DOCUMENTO</th>
	</tr>
";

while($row = mysqli_fetch_assoc($sql_sinDR))
{
	$id_docto 	= $row['id_docto'];
	$archivo 	= $row['archivo'];
	$ruta 		= $row['ruta'];

	echo "<tr>";
	echo "<td>$id_docto</td>";
	echo "<td><a href='$urlPrincipal/exp/siniestro/$ruta/$archivo' target='_blank' > $archivo </a></td>";
	
	echo "</tr>";
}

echo "</table>";
echo "</fieldset>";
echo "</div>";
// termina documentos del siniestro