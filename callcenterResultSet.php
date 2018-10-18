<?php
$sql_callR = mysqli_query($dbd2, $sql_call);

##### INICIAR ARRAY DE CONTRATOS
$contratosArray[] = '';
$clientesArray[] = '';
##### INICIAR ARRAY DE CONTRATOS

echo "<section><fieldset><legend>RESUMEN DE EQUIPOS ASIGNADOS</legend>";		
echo "<table class='table table-hover table-bordered table-responsive-md'>\n";
echo "<thead>
		<tr>
		<th scope='col'>id_callcenter</th>
		<th scope='col'>FECHA</th>
		<th scope='col'>UNIDAD</th>

		<th scope='col'>CLIENTE</th>
		<th scope='col'>CONTRATO</th>

		<th scope='col'>USUARIO:</th>
		<th scope='col'>ASUNTO:</th>
		<th scope='col'>CANALIZADO A:</th>
	  
	  </tr>
	  </thead>";

while($row = mysqli_fetch_assoc($sql_callR))
{
	$id_callcenter	= $row['id_callcenter'];
	$fechareg	= $row['fechareg'];
	$id_unidad	= $row['id_unidad'];
	$id_contrato= $row['id_contrato'];

	$usNombre 	= $row['usNombre'];
	$usTelFijo 	= $row['usTelFijo'];
	$usTelMovil = $row['usTelMovil'];
	$usEmail 	= $row['usEmail'];

	$comentario 	= $row['comentario'];
	$id_ejecutivo 	= $row['id_ejecutivo'];


	// INICIO poner renglon resultados
	echo "<tr>";
	echo "<th scope='row'>{$id_callcenter}</th>";
	echo "<td>{$fechareg}</td>";

	datosxid($id_unidad);
	echo "<td><a href='u3index.php?id_unidad=$id_unidad' title='Consultar UNIDAD'>
				{$Economico}</a> ::: 
				{$Serie} ::: 
				{$Placas}  ::: <br>
				{$Vehiculo}</td>";


	if (@$contratosArray[$id_contrato] != '') {
		echo '<td>'.$id_cliente.'::: '.$clientesArray[$id_cliente][0].' <br> '.$clientesArray[$id_cliente][1].'</td>';
		echo "<td>ID <a href='ctoIndex.php?id_contrato=$id_contrato' 
				style='text-decoration:none;' title='VER CONTRATO' >
				=> {$id_alan}
				</a> ::: ALAN ".$contratosArray[$id_contrato][0].' ALAN ::: No. OFICIAL '.$contratosArray[$id_contrato][1].'</td>';
		//echo '<td>'.$fecha_inicioASG.'</td>';
	}
	else
	{
		contratoxid($id_contrato);
		clientexid($id_cliente);
		echo '<td>'.$id_cliente.'::: '.$rfc.' <br> '.$razonSocial.'</td>';
		//contratoxid($id_contrato);
		echo "<td>ID <a href='ctoIndex.php?id_contrato=$id_contrato' 
				style='text-decoration:none;' title='VER CONTRATO' >
				=> {$id_alan}
				</a> ::: ALAN ".$id_alan.' ALAN ::: No. OFICIAL '.$numero.'</td>';
		//echo '<td>'.$fecha_inicioASG.'</td>';

		$contratosArray[$id_contrato][0] = $id_alan;
		$contratosArray[$id_contrato][1] = $numero;
		$contratosArray[$id_contrato][2] = $aliasCto;

		$clientesArray[$id_cliente][0] = $rfc;
		$clientesArray[$id_cliente][1] = $razonSocial;
		//$clientesArray[$id_cliente][2] = $aliasCto;
	}

	echo "<td>Nombre: $usNombre, Tel: $usTelFijo, Cell: $usTelMovil, Mail: $usEmail</td>";

	echo "<td>Asunto: , Comentario: $comentario</td>";
$id_usuario = $id_ejecutivo;
	usuarioxid($id_usuario);
	echo "<td>$nombre</td>";


	
	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";
echo "</fieldset></section>";