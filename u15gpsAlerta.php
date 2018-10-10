<?php
if($_SESSION["gpsA"] > 0)
{
	gpsAxid($id_unidad);
	if($tieneAlerta == 'Si')
	{
		echo "<fieldset><p>$gpsAtexto</p></fieldset>";

		if($_SESSION["gps"] > 0)
		{
		echo "<td style='text-align:center;'>";
		$atendido = $gpsAtendido;
			if($atendido==0)
			{
			echo "<a href='gpsAlertaE.php?
					id_alertaGps=$id_alertaGps
					&atendido=$atendido'  
					style='text-decoration:none; color:blue;'  title='Editar' >EDITAR ALERTA GPS
				  </a>";
			}
		echo "</td>";
		}
	}
}