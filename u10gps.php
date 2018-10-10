<!-- ########### GPS COLOCADO ########## -->
<?php
if($_SESSION["gpsV"] > 0){
	gpsxid($id_unidad);
	//$gpsAvisa = ($tienegps == 'Si')?"<span style='color:white;background-color:green;'>SI TIENE GPS</span>":"<span style='color:white;background-color:red;'>NO TIENE GPS</span>";

	echo "<p>$gpsAvisa</p>";
}

if($_SESSION["gps"] > 0 or $_SESSION["gpsV"] > 0)
{  // INICIO PRIVILEGIOS C4 

// INICIO consulta gps
	$sql_gps = 'SELECT * '
		. ' FROM gpsAsignado '
		. " WHERE id_unidad = '$id_unidad' " 
		. ' ORDER BY '
		. ' id_gps '
		. ' DESC ' ;
//		. " LIMIT $pagina_1, $rxpag " ;
	$res_GPS 	= mysqli_query($dbd2, $sql_gps);
	$filas_GPS 	= mysqli_num_rows($res_GPS);

	

	if($filas_GPS > 0)
	{ // APERTURA ejecutar si hubo algo


		if($_SESSION["gps"] > 0)
		{
				echo "<fieldset><legend>Unidad cuenta con GPS</legend>";
				echo "<table class='ResTabla'>";
				echo "  <tr>
						<th></th>
						<th>ASIGNACION</th>
						<th>GPS IMEI</th>
						<th>LINEA NUMERO</th>
						<th>SIM SERIE</th>
						<th>BLOQUEO INSTALADO</th>
						<th>OBS BLOQUEO</th>
						<th>FECHA DE INSTALACION</th>
						<th>FECHA DE DESINSTALACION</th>
						</tr>";
				//<th>ECONOMICO</th>
				//<th>SERIE</th>
				//<th>TIPO</th>

				while($row = mysqli_fetch_assoc($res_GPS))
				{
					$id_gps 	= $row['id_gps']; // asignacion corresponde al equipo configurado
					$id_imei 	= $row['id_imei'];
					$id_linea 	= $row['id_linea'];
					$id_sim 	= $row['id_sim'];
					$bloqueo 	= $row['bloqueo'];
					$obs		= $row['obs'];
				//	$id_unidad	= $row['id_unidad'];
					$fechaInicio = $row['fechaInicio'];
					$fechaFinal  = $row['fechaFinal'];

					// INICIO sacar imei
					$sql_imei = "SELECT imei FROM gpsImei WHERE id_imei = '$id_imei' LIMIT 1 ";
					$res_imei = mysqli_query($dbd2, $sql_imei);
					while($rowimei = mysqli_fetch_assoc($res_imei)){ $imei = $rowimei['imei'];}
					// FIN sacar imei

					// INICIO sacar linea
					$sql_linea = "SELECT numero FROM gpsLinea WHERE id_linea = '$id_linea' LIMIT 1 ";
					$res_linea = mysqli_query($dbd2, $sql_linea);
					while($rowlinea = mysqli_fetch_assoc($res_linea)){ $linea = $rowlinea['numero'];}
					// FIN sacar linea

					// INICIO sacar sim
					$sql_sim = "SELECT numeroSim FROM gpsSim WHERE id_sim = '$id_sim' LIMIT 1 ";
					$res_sim = mysqli_query($dbd2, $sql_sim);
					while($rowsim = mysqli_fetch_assoc($res_sim)){ $sim = $rowsim['numeroSim'];}
					// FIN sacar sim

				// INICIO poner renglon resultados
				echo "<tr>";
				// ERROR REPORTAR
						if($fechaFinal == '')
						{
						echo "<td>
								<a href='gpsQuitar.php?
								id_gps=$id_gps
								&id_unidad=$id_unidad
								&fechaFinal=$fechaFinal' >
								<button type='button' title='QUITAR'>
								Quitar
								</button>
								</a>
							  </td>";
						}
						else
						{
							echo "<td></td>";
						}	
					echo "<td>{$id_gps}</td>";
					echo "<td>{$imei}</td>";
					echo "<td>{$linea}</td>";
					echo "<td>{$sim}</td>";
					$bloqueoA = array("NO", "BOMBA DE GASOLINA", "IGNICION", "OTRO");
					echo "<td>{$bloqueoA[$bloqueo]}</td>";
					echo "<td>{$obs}</td>";
				//	datosxid($id_unidad);
				//	echo "<td>{$Economico}</td>";
				//	echo "<td>{$Serie}</td>";
				//	echo "<td>{$Vehiculo}</td>";
					echo "<td>{$fechaInicio}</td>";
					echo "<td>{$fechaFinal}</td>";
					
				echo "</tr>";
				// FIN poner renglon resultados
				}
				echo "</table>";
				echo "<br> FECHA FINAL";
				var_dump($fechaFinal);
				echo "<br>";
				echo "</fieldset>";
		}


		if($_SESSION["gps"] > 0 or $_SESSION["gpsV"] > 0)
		{		

			echo "<fieldset><legend>Ubicación GPS</legend><table class='ResTabla'><td>";
			gpsxid($id_unidad);
				if($tienegps == 'Si')
				{
				echo "CONSULTAR ULTIMO REPORTE VALIDO DE UBICACION";
				echo "<form target='_blank' action='gpsUltimaPos.php' method='POST'>";
				echo "<input type='hidden' name='gpsImeiActual' value='$gpsImeiActual'>";
				echo "<input type='submit' name='consultar' value='Consultar'>";
				echo "</form>";
		//		echo "<a href='http://187.188.203.80:8080/last/conn.aspx?uuid=$gpsImeiActual' target='_blank' >
		//				VER ULTIMO REPORTE VALIDO DE UBICACION</a>";
				}
			echo "</td></table></fieldset>";
		}

	}
	else
	{
		echo "UNIDAD YA NO CUENTA CON GPS";
	}
	// CIERRE ejecutar si hubo algo
} // CIERRE PRIVILEGIOS C4 ?>
<!-- ########### GPS COLOCADO ########## -->