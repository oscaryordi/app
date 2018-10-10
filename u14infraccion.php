<?php
if($_SESSION["infraccionV"] > 0)
{ // APERTURA PRIVILEGIO
	infraccionesXid_unidad($id_unidad);
	if($infracciones > 0)
		{
		echo "<a href='infHistorialUno.php?id_unidad=".@$id_unidad."' 
				style='text-decoration:none;'>
				<button type='button' title='Ver Historial de Infracciones'>
				Ver Historial de Infracciones</button></a>\n";
		}
} // CIERRE PRIVILEGIO
?>