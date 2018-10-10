<?php
if($_SESSION["placas"] > 0){  // APERTURA PRIVILEGIOS VE PLACAS
$sql4 		= "	SELECT `Placas`, estadoE FROM `placa` "
			. " WHERE `id_unidad`= $id_unidad "
			. " ORDER BY `fechaAsignacion` DESC LIMIT 0, 30 ";
$res4 		= 	mysqli_query($dbd2, $sql4);

echo "<!--PLACAS--><fieldset><legend>-</legend>";
echo "<table><tr><th>Placas</th>";
?>
<style>.estadoE{font-size: 9px;color:	#006400;}</style>
<?php
$contador = 0;
while($row4 = mysqli_fetch_assoc($res4))
{
	$Placas1 	= $row4['Placas'];
	$estadoE 	= $row4['estadoE'];
	$actual 	= ($contador == 0)?" Actual ":" Anterior "; // TERNIARIO

	echo "<td>";
	echo "$Placas1";
		if($_SESSION["placas"] > 1) // ESTADO EMPLACAMIENTO
		{
			$id_estado 	= $estadoE;
			estadoxidEdo($id_estado);
			//$nombreE 	= substr($nombreE,0,9);
			echo "<span class='estadoE'> $iso31662E </span>";
		}
	echo "$actual";

		if($_SESSION["placas"] > 2) // EDITAR
		{
			echo "<a href='u5placaseditar.php?id_unidad=".$id_unidad."&placas=".$Placas1."' >
			<button type='button' title='Editar Placas'>Ed</button></a>";
		}
	echo "</td>";
	$contador ++;
}

if($TipoBusqueda !== 'Actualizar Placas')
{
	if($_SESSION["placas"] > 1)
	{ // APERTURA PRIVILEGIOS CREA PLACAS
		echo "<td><a href='u5placasalta.php?id_unidad=".$id_unidad."' >
		<button type='button' title='Actualizar Placas'>
		Actualizar  Placas
		</button></a></td>\n";
	} // CIERRE PRIVILEGIOS CREA PLACAS
}
echo "</tr></table>"; // Cerrar tabla
echo "</fieldset><!--PLACAS-->";
} // CIERRE PRIVILEGIOS  VE PLACAS ?>