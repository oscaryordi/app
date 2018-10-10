<?php

$res_fact = mysqli_query($dbd2, $sql_fact);

##### INICIAR ARRAY DE CONTRATOS
$contratosArray[] = '';
$clientesArray[] = '';
##### INICIAR ARRAY DE CONTRATOS


echo "<section><fieldset><legend>RESUMEN DE FACTURAS</legend>";		
echo "<table class='ResTabla'>\n";
echo "<tr>
<th>DOCUMENTO_ID</th>
<th>ESTIMACION_ID</th>
<th>FOLIO FACTURA</th>
<th>VER</th>
<th>IMPORTE</th>
<th>CLIENTE</th>
<th>CONTRATO</th>
</tr>";



while($row = mysqli_fetch_assoc($res_fact))
{

	$id_docto 		= $row['id_docto']; // asignacion corresponde al equipo configurado
	$id_estimacion 	= $row['id_estimacion'];
	$importeDto 	= $row['importeDto'];
	$nombreO 		= $row['nombreO'];

	$archivo 		= $row['archivo'];
	$ruta 			= $row['ruta'];

/*
	// INICIO sacar imei
	$sql_imei = "SELECT imei FROM gpsImei WHERE id_imei = '$id_imei' LIMIT 1 ";
	$res_imei = mysqli_query($dbd2, $sql_imei);
	while($rowimei = mysqli_fetch_assoc($res_imei)){ $imei = $rowimei['imei'];}
	// FIN sacar imei
*/

	// INICIO poner renglon resultados
	echo "<tr>";

	echo "<td>{$id_docto}</td>";
	echo "<td>{$id_estimacion}</td>";
	echo "<td>{$nombreO}</td>";
	echo "<td><a href='http://sistema.jetvan.com.mx/exp/estima/$ruta/$archivo' target='_blank'>FA</a></td>";
	echo "<td>".number_format($importeDto,2)."</td>";

    estimacionDts($id_estimacion);

/*
//CHECAR SI YA EXISTE EN ARRAY
	$cAexiste = '';
	if( @$contratosArray[$id_contrato] != '' )
	{
		$cAexiste = 'Ya existe JAJA';
	}
//CHECAR SI YA EXISTE EN ARRAY// $cAexiste.
*/

/*

	if ($id_asignacion=='')
	{
		$asinacionTXT = ($id_asignacion=='')?'NO HAY ASIGNACION FORMAL':'';
		echo "<td>$asinacionTXT</td><td></td><td></td>";
	}
*/
	if (@$contratosArray[$id_contrato] != '') {
		echo '<td>'.$id_cliente.'::: '.$clientesArray[$id_cliente][0].' <br> '.$clientesArray[$id_cliente][1].'</td>';
		echo '<td>  id_contrato '.$id_contrato.' ::: ALAN '.$contratosArray[$id_contrato][0].' ALAN ::: No. OFICIAL '.$contratosArray[$id_contrato][1].'</td>';
		//echo '<td>'.$fecha_inicioASG.'</td>';
	}
	else
	{
		contratoxid($id_contrato);
		clientexid($id_cliente);
		echo '<td>'.$id_cliente.'::: '.$rfc.' <br> '.$razonSocial.'</td>';
		echo '<td>  id_contrato '.$id_contrato.' ::: ALAN '.$id_alan.' ALAN ::: No. OFICIAL '.$numero.'</td>';
		//echo '<td>'.$fecha_inicioASG.'</td>';

		$contratosArray[$id_contrato][0] = $id_alan;
		$contratosArray[$id_contrato][1] = $numero;
		$contratosArray[$id_contrato][2] = $aliasCto;

		$clientesArray[$id_cliente][0] = $rfc;
		$clientesArray[$id_cliente][1] = $razonSocial;
		//$clientesArray[$id_cliente][2] = $aliasCto;
	}
	
	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";