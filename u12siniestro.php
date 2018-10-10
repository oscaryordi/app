<!-- ########### BITACORA SINIESTRO BASADA EN ID_UNIDAD ########## -->
<?php 
if($_SESSION["siniestro"] > 0)
{  // puede ver SINIESTRO??? 

$sqlSin = " SELECT `id_siniestro`, `cdSin`, `motivo`, 
			`fechaSin`, `numSin`, `status`  
			FROM `siniestro` 
			WHERE `id_unidad` = $id_unidad  
			ORDER BY id_siniestro DESC LIMIT 5 "; 
$resSin = mysqli_query($dbd2, $sqlSin);

if(mysqli_affected_rows($dbd2) > 0)
{
	echo "<fieldset><legend>SINIESTROS DE LA UNIDAD</legend>";
	echo "<table class='ResTabla'>
			<tr>
			<th>ID_SINIESTRO</th>
			<th>CIUDAD</th>
			<th>MOTIVO</th>
			<th>FECHA</th>
			<th>NUMERO</th>
			<th>STATUS</th>
			</tr>
	";

	while($sinM = mysqli_fetch_assoc($resSin))
	{
		$id_siniestro 	= $sinM['id_siniestro'];
		$cdSin 			= $sinM['cdSin'];
		$motivo 		= $sinM['motivo'];
		$fechaSin 		= $sinM['fechaSin'];
		$numSin 		= $sinM['numSin'];
		$status 	 	= $sinM['status'];

		echo "<tr>";
			echo "<td><a href='sinVerId.php?id_siniestro=$id_siniestro' 
				title='Ver Siniestro' >
			$id_siniestro
			</a></td>";
			echo "<td>$cdSin</td>";
			echo "<td>$motivo</td>";
			echo "<td>$fechaSin</td>";
			echo "<td>$numSin</td>";
			echo "<td>$status</td>";
		echo "</tr>";
	}
	echo "</table></fieldset>";
}
} // CIERRE PRIVILEGIOS puede ver SINIESTRO ?>
<!-- ########### BITACORA SINIESTRO BASADA EN ID_UNIDAD ########## -->