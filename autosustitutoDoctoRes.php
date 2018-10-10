<?php

// inicia documentos del sustituto
$sql_sustD = "SELECT * FROM sustDocto WHERE id_sust = '$id_sust' ORDER BY id_docto DESC ";
$sql_sustDR = mysqli_query($dbd2, $sql_sustD);

echo "<div>";
echo "<fieldset>";
echo "<table>
	<tr>
		<th>id_docto</th>
		<th>DOCUMENTO</th>
	</tr>
";

while($row = mysqli_fetch_assoc($sql_sustDR))
{
	$id_docto 	= $row['id_docto'];
	$archivo 	= $row['archivo'];
	$ruta 		= $row['ruta'];

	echo "<tr>";
	echo "<td>$id_docto</td>";
	echo "<td><a href='$urlPrincipal/exp/sustituto/$ruta/$archivo' target='_blank' > $archivo </a></td>";
	
	echo "</tr>";
}

echo "</table>";
echo "</fieldset>";
echo "</div>";
// termina documentos del sustituto