<?php

function diferenciaFechas($id_solAtn){
	global $dbd2;
	global $diferenciaDias;
	
	$sql_fechaS = "SELECT * FROM solAtn WHERE id_solAtn = '$id_solAtn' ";
	$fechaSR 	= mysqli_query($dbd2, $sql_fechaS);
	$fechaSRM 	= mysqli_fetch_assoc($fechaSR);

	$fechareg 	= $fechaSRM['fechareg'];
	$fechaRPg 	= $fechaSRM['fechaRPg'];
	$fechaRPg 	= ($fechaRPg != null)? $fechaRPg : date('Y-m-d') ;

	$fechareg 	= substr($fechareg, 0, 10);
	$fechaRPg 	= substr($fechaRPg, 0, 10);

	$fechareg 	= date_create("$fechareg");
	$fechaRPg 	= date_create("$fechaRPg");

	$diffZ 		= date_diff($fechareg, $fechaRPg);
	
	$diferenciaDias = ($diffZ->format("%a")) + 1;
}

##### INICIAR ARRAY DE CONTRATOS Y CLIENTES
$contratosArray[] = '';
$clientesArray[] = '';
##### INICIAR ARRAY DE CONTRATOS Y CLIENTES

if($filasuh > 0)
{// SI HAY RESULTADOS LE DAMOS PALANTE

// PINTAR ENCABEZADOS DE TABLA
echo "<section><fieldset><legend>RESUMEN SOLICITUDES DE ATENCIÓN</legend>";		
echo "<table class='ResTabla'>\n";
echo "<tr>
<th>ID_ATENCION</th>
<th>FECHA<BR> SOLICITUD</th>
<th>CONTRATO</th>
<th>SUBAREA</th>
<th>UNIDAD</th>
<th>KM</th>
<th>DESCRIPCION</th>
<th>UBICACION</th>
<th>TIPO</th>
<th>DOCUMENTO<BR>ADJUNTADO</th>
<th>PROGRAMAR</th>
<th>FECHA<BR>PROGRAMACION</th>
<th>CUMPLIMIENTO<BR>PROGRAMACION</th>
<th>SEGUIMIENTO</th>

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
	
	$sa1 		= $row['sa1'];
	$sa2 		= $row['sa2'];
	$sa3 		= $row['sa3'];
	$sa4 		= $row['sa4'];

	$programado = $row['programado'];

	$id_mttoSol = $row['id_mttoSol'];
	$fechareg 	= $row['fechareg'];
	$fechaRPg 	= $row['fechaRPg'];

	$capturoPg 	= $row['capturoPg']; //capturoPg

	echo "<tr>";

	echo "<td>{$id_solAtn}</td>";
	echo "<td>{$fechareg}</td>";

	if (@$contratosArray[$id_contrato] != '') 
	{
		$rsM = substr($clientesArray[$id_cliente][1], 0, 40);

		echo "<td>ID{$contratosArray[$id_contrato][0]}</td>";

		/*echo "<td>ID{$contratosArray[$id_contrato][0]}:::
				{$contratosArray[$id_contrato][1]} <br>
				$rsM ... </td>";*/
	}
	else
	{
		contratoxid($id_contrato);
		clientexid($id_cliente);
		$rsM = substr($razonSocial, 0,40);

		echo "<td>ID{$id_alan}</td>";

		/*echo "<td>ID{$id_alan}:::{$numero} <br>
				$rsM ... </td>";*/

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
	$mostrarAAsn2 = substr($mostrarAAsn2, 0,10);
	echo "<td>{$mostrarAAsn2} ... </td>";

	datosxid($id_unidad);
	echo "<td>
			<a href='u3index.php?id_unidad=$id_unidad' title='Consultar UNIDAD'>
			{$Economico}</a>
			 ::: {$Serie} ::: {$Placas}  ::: <br>
			{$Vehiculo}</td>";

	echo "<td>{$km}</td>";
	echo "<td>{$descripcion}</td>";
	echo "<td>{$ubicacion}</td>";

	$sa1t = ($sa1==1)?'PREVENTIVO':'';
	$sa2t = ($sa2==1)?'CORRECTIVO':'';
	$sa3t = ($sa3==1)?'SINIESTRO':'';
	$sa4t = ($sa4==1)?'OTRO':'';
	echo "<td>{$sa1t} {$sa2t} {$sa3t} {$sa4t}</td>";

	solAtnAnexo($id_solAtn);
	if($archivoSA != '')
	{
		echo "<td><a href='https://sistema.jetvan.com.mx/exp/mtto/$rutaSA/$archivoSA' target='_blank''>
					VER</a>
			  </td>";	
	}
	else
	{
		echo "<td></td>";	
	}

	if($programado == 0)
	{
		echo "<td><a href='solAtnProgram.php?id_solAtn=$id_solAtn' >PROGRAMAR</a></td>";		
	}
	else
	{ //  text-decoration:none;
		echo "<td>
				<span style='color:green;'> 
					<a 	href='solAtnProgramado.php?id_solAtn=$id_solAtn' 
						style='color:green;' >
					PROGRAMADO 
					</a>
				</span> 
			  </td>";	
	}

	echo "<td>$fechaRPg</td>";

	# CUMPLIMIENTO
	diferenciaFechas($id_solAtn);//echo $diferenciaDias;
	echo "<td>$diferenciaDias</td>";
	# CUMPLIMIENTO

	echo "<td>$capturoPg</td>";


	##### BUSCAR SOLICITUD
	$sql = "SELECT id_mttoSol from mttoSol WHERE id_unidad = '$id_unidad' and km = '$km'  ";
	$sqlR = mysqli_query($dbd2, $sql);
	$sqlM = mysqli_fetch_assoc($sqlR);
	$id_mttoSol = $sqlM['id_mttoSol'];
	echo "<td>$id_mttoSol</td>";
	##### BUSCAR SOLICITUD


	echo "</tr>";
}
echo "</table>";
echo "</fieldset></section>";
}
else
{
	echo "NO HAY RESULTADOS";
}