<?php
include("1header.php");

if($_SESSION["gerencia"] > 0)
{ // VISTA A GERENCIA
	include("nav_gerencia.php");
	?>
	<fieldset><legend>Resumen de entradas a la fecha <span  id='fecha_actual2' ></span></legend>
	<?php

	$sql_docs = 'SELECT e.`capturo` , u.nombre, COUNT( e.`archivo` ) cuenta , MAX( e.fechareg ) ultimo '
	        . ' FROM `expedientes` e'
	        . ' JOIN usuarios u ON u.id_usuario = e.capturo'
	        . ' GROUP BY e.capturo'
	        . ' ORDER BY MAX( e.fechareg ) DESC'
	        . ' LIMIT 0, 30 '; 

	echo "<table class='table  table-bordered table-hover table-condensed'>\n";
	echo "<tr>
			<th>ID</th>
			<th>NOMBRE</th>
			<th>TOTAL SUBIDOS</th>
			<th>ULTIMA OCASION EN QUE SUBIO ARCHIVOS</th>
		  </tr>";

	$res_docs = mysqli_query($dbd2, $sql_docs);

	while($row = mysqli_fetch_assoc($res_docs))
		{
			$id_usuario = $row['capturo'];
			$nombre_usuario = $row['nombre'];
			$capturas_usuario = $row['cuenta'];
			$ultima_captura = $row['ultimo'];
			
			echo "<tr>";
			echo "<td>{$id_usuario}</td>";
			echo "<td>{$nombre_usuario}</td>";
			echo "<td>{$capturas_usuario}</td>";
			echo "<td>{$ultima_captura}</td>";
			echo "</tr>";
		}
	echo "</table></fieldset>";


} // FIN PRIVILEGIO VISTA GERENCIA 

include("1footer.php");?>