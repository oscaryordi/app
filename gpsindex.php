<?php
include("1header.php");
include ("nav_gps.php"); 


if($_SESSION["gps"] > 0)
{ // VISTA A C4 
	?>
	<div style="padding:5px;">
		<p> BUSCAR GPS POR <b>LINEA</b> (NUMERO DE TELEFONO) 
		<form action='' method='post'>
			<input type='text' name='lineaB' 
			placeholder='Indique Linea' 
			title='Indique Linea' >
			<input type='submit' name='buscar' value='Buscar'  >
		</form>
		</p>
	</div>
	<?php

	if( isset($_POST['lineaB']) &&  $_POST['lineaB'] != '')
	{
		$lineaB 	= mysqli_real_escape_string($dbd2, $_POST['lineaB']);
		echo $lineaB;

		$pagina 	= '';

		gpsLinea($lineaB);
		gpsxLinea($id_linea);

		echo "<table class='ResTabla'>";
		echo "<tr>";
		echo "<th>ID</th>";
		echo "<th>IMEI</th>";
		echo "<th>LINEA</th>";
		echo "<th>SIM</th>
			  <th>BLOQUEO INSTALADO</th>
			  <th>OBS BLOQUEO</th>";

		echo "<th>FECHA DE INSTALACION</th>";
		echo "<th>FECHA DE DESINSTALACION</th>";
		echo "<th>UNIDAD</th>";
		echo "</tr>";
		while($row = mysqli_fetch_assoc($res_GPSxLinea))
		{
			$id_gps 	= $row['id_gps'];
			gpsXid_gps($id_gps);
			echo "<tr>";
				echo "<td>{$id_gps}</td>";
				echo "<td>{$imei}</td>";
				echo "<td>{$linea}</td>";
				echo "<td>{$sim}</td>";

				$bloqueoA = array("NO", "BOMBA DE GASOLINA", "IGNICION", "OTRO");
				echo "<td>{$bloqueoA[$bloqueo]}</td>";
				echo "<td>{$obs}</td>";
				
				echo "<td>{$fechaInicio}</td>";
				echo "<td>{$fechaFinal}</td>";
				datosxid($id_unidad);
				echo "<td><a href='u3index.php?id_unidad=$id_unidad&pagina=$pagina' 
				title='Consultar UNIDAD'>
				{$Economico}</a> ::: {$Serie} ::: {$Placas}  ::: <br>
				{$Vehiculo}</td>";	
			echo "</tr>";
		}
		echo "</table>";
	}
} // FIN PRIVILEGIO VISTA C4




if($_SESSION["gps"] > 0)
{ // VISTA A C4 
	// include ("nav_gps.php"); 
	?>
	<div style="padding:5px;">
		<p> BUSCAR GPS POR <b>IMEI</b> (SERIE DISPOSITIVO) 
		<form action='' method='post'>
			<input type='text' name='imei' 
			placeholder='Indique IMEI' 
			title='Indique IMEI' >
			<input type='submit' name='buscar' value='Buscar'  >
		</form>
		</p>
	</div>
	<?php

	if( isset($_POST['imei']) &&  $_POST['imei'] != '')
	{
		$imei 	= mysqli_real_escape_string($dbd2, $_POST['imei']);
		echo $imei;

		$pagina 	= '';

		gpsIMEI($imei);
		gpsxIMEI($id_imei);

		echo "<table class='ResTabla'>";
		echo "<tr>";
		echo "<th>ID</th>";
		echo "<th>IMEI</th>";
		echo "<th>LINEA</th>";
		echo "<th>SIM</th>
			  <th>BLOQUEO INSTALADO</th>
			  <th>OBS BLOQUEO</th>";

		echo "<th>FECHA DE INSTALACION</th>";
		echo "<th>FECHA DE DESINSTALACION</th>";
		echo "<th>UNIDAD</th>";
		echo "</tr>";
		while($row = mysqli_fetch_assoc($res_GPSxIMEI))
		{
			$id_gps 	= $row['id_gps'];

			gpsXid_gps($id_gps);

		echo "<tr>";
			echo "<td>{$id_gps}</td>";
			echo "<td>{$imei}</td>";
			echo "<td>{$linea}</td>";
			echo "<td>{$sim}</td>";

			$bloqueoA = array("NO", "BOMBA DE GASOLINA", "IGNICION", "OTRO");
			echo "<td>{$bloqueoA[$bloqueo]}</td>";
			echo "<td>{$obs}</td>";
			
			echo "<td>{$fechaInicio}</td>";
			echo "<td>{$fechaFinal}</td>";
			datosxid($id_unidad);
			echo "<td><a href='u3index.php?id_unidad=$id_unidad&pagina=$pagina' 
			title='Consultar UNIDAD'>
			{$Economico}</a> ::: {$Serie} ::: {$Placas}  ::: <br>
			{$Vehiculo}</td>";	
		echo "</tr>";
		}
		echo "</table>";
	}
} // FIN PRIVILEGIO VISTA C4





include("1footer.php");
?>