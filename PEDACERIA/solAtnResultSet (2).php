<?php

##### INICIAR ARRAY DE CONTRATOS Y CLIENTES
$contratosArray[] = '';
$clientesArray[] = '';
##### INICIAR ARRAY DE CONTRATOS Y CLIENTES

if($filasuh > 0){// SI HAY RESULTADOS LE DAMOS PALANTE

// PINTAR ENCABEZADOS DE TABLA
echo "<section><fieldset><legend>RESUMEN SOLICITUDES DE ATENCIÓN</legend>";		
echo "<table class='ResTabla'>\n";
echo "<tr>
<th>ID_ATENCION</th>
<th>FECHA</th>
<th>CONTRATO</th>
<th>SUBAREA</th>
<th>UNIDAD</th>
<th>KM</th>
<th>DESCRIPCION</th>
<th>UBICACION</th>
<th>TIPO</th>

<th>PROGRAMAR</th>
</tr>";

while($row = mysqli_fetch_assoc($sql_SA_R)) // PINTAR RESULTADOS
{
	$id_solAtn 	= $row['id_solAtn']; // asignacion corresponde al equipo configurado
	$id_contrato= $row['id_contrato'];
	$id_subDiv2 = $row['id_subDiv2'];
	$id_unidad 	= $row['id_unidad'];

	$km 		= $row['km'];
	$descripcion= $row['descripcion'];
	$ubicacion 	= $row['ubicacion'];
	$sa1 = $row['sa1'];
	$sa2 = $row['sa2'];
	$sa3 = $row['sa3'];
	$sa4 = $row['sa4'];

	$id_mttoSol = $row['id_mttoSol'];
	$fechareg = $row['fechareg'];


	echo "<tr>";

	echo "<td>{$id_solAtn}</td>";
	echo "<td>{$fechareg}</td>";

/*
	contratoxid($id_contrato);
	clientexid($id_cliente);
	$rsM = substr($razonSocial, 0,40);
	echo "<td>ID{$id_alan}:::{$numero} <br>
			$rsM ... </td>";
	$id_contrato 	='';
	$id_cliente 	='';
*/

	if (@$contratosArray[$id_contrato] != '') {
	
	$rsM = substr($clientesArray[$id_cliente][1], 0, 40);

	echo "<td>ID{$contratosArray[$id_contrato][0]}:::{$contratosArray[$id_contrato][1]} <br>
			$rsM ... </td>";
	}
	else
	{
	contratoxid($id_contrato);
	clientexid($id_cliente);
	$rsM = substr($razonSocial, 0,40);
	echo "<td>ID{$id_alan}:::{$numero} <br>
			$rsM ... </td>";
	$id_contrato 	='';
	$id_cliente 	='';

		$contratosArray[$id_contrato][0] = $id_alan;
		$contratosArray[$id_contrato][1] = $numero;
		$contratosArray[$id_contrato][2] = $aliasCto;

		$clientesArray[$id_cliente][0] = $rfc;
		$clientesArray[$id_cliente][1] = $razonSocial;
		//$clientesArray[$id_cliente][2] = $aliasCto;
	}


	areaAXid_subDiv2($id_subDiv2);
	echo "<td>{$mostrarAAsn2}</td>";

	datosxid($id_unidad);
	echo "<td><b>{$Economico}</b> ::: {$Serie} ::: {$Placas}  ::: <br>
			{$Vehiculo}</td>";

	echo "<td>{$km}</td>";
	echo "<td>{$descripcion}</td>";
	echo "<td>{$ubicacion}</td>";

	$sa1t = ($sa1==1)?'PREVENTIVO':'';
	$sa2t = ($sa2==1)?'CORRECTIVO':'';
	$sa3t = ($sa3==1)?'SINIESTRO':'';
	$sa4t = ($sa4==1)?'OTRO':'';

	echo "<td>{$sa1t} {$sa2t} {$sa3t} {$sa4t}</td>";

	echo "<td><a href='solAtnProgram.php?id_solAtn=$id_solAtn' >PROGRAMAR</a></td>";

	echo "</tr>";
}
echo "</table>";
echo "</fieldset></section>";
}
else
{
	echo "NO HAY RESULTADOS";
}