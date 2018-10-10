<?php
// INICIO mostrar contrato a que se agrega PARTIDA
##### ##### ##### ##### ##### #####

$sql_ccto = 'SELECT 
			id_contrato, id_alan, documento, fuente, 
			estatus, numero, aliasCto, fechacontrato, 
			fechainicio, fechafin, min, max '
		. ' FROM '
		. ' clbCto '
		. " WHERE id_contrato = '$id_contrato' ";		

$resultado_ccto = mysqli_query($dbd2, $sql_ccto);
@$campos_ccto 	= mysqli_num_fields($resultado_ccto);
@$filas_ccto 	= mysqli_num_rows($resultado_ccto);

echo "<section><p>CONTRATO ACTUAL: <b>$filas_ccto</b></p>"; 

while($row = mysqli_fetch_assoc($resultado_ccto))
	{
		echo "<div style='background-color: #d0e1e1; margin:15px; padding: 10px;'>";
		echo "<table class='tablasimple'>
		<tr>
			<th>ID alan</th>
			<th>NUMERO</th>
			<th>UNIDADES ACTUALES</th>
			<th>ALIAS CTO</th>
			<th>DOCUMENTO</th>
			<th>FUENTE</th>
			<th>ESTATUS</th>
			<th>FECHA DEL CONTRATO</th>
			<th>INICIO</th>
			<th>FIN</th>
			<th>MINIMO</th>
			<th>MAXIMO</th>
		</tr>";
		global $id_contrato;
		$id_contrato 	= 	$row['id_contrato'];
		$id_alan	 	= 	$row['id_alan'];		
		$documento 		= 	$row['documento'];
		$fuente 		= 	$row['fuente'];
		$estatus 		= 	$row['estatus'];
		$numero 		= 	$row['numero'];
		$aliasCto 		= 	$row['aliasCto'];
		$fechacontrato 	= 	$row['fechacontrato'];
		$fechainicio 	= 	$row['fechainicio'];
		$fechafin 		= 	$row['fechafin'];
		$min 			= 	$row['min'];
		$max 			= 	$row['max'];

		@$min = number_format($min,2);
		@$max = number_format($max,2);

		echo "<tr>";
		echo "<td>{$id_alan}</td>";
		echo "<td>{$numero}</td>";

		unidadesContratoxid($id_contrato);
		echo "<td>{$unidadesCto}</td>";

		echo "<td>{$aliasCto}</td>";
		echo "<td>{$documento}</td>";
		echo "<td>{$fuente}</td>";
		echo "<td>{$estatus}</td>";
		echo "<td>{$fechacontrato}</td>";
		echo "<td>{$fechainicio}</td>";
		echo "<td>{$fechafin}</td>";
		echo "<td>{$min}</td>";
		echo "<td>{$max}</td>";

		// INICIO EDITAR INFORMACION DEL CONTRATO
		echo 	"<td>
			   	<FORM action='clientectoeditar.php' method='POST' id='entabla'>
			   		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
					<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
					<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
				</FORM>
		  		</td>";
		// INICIO EDITAR INFORMACION DEL CONTRATO

		// INICIA SUBIR ARCHIVOS DEL CONTRATO		
		echo 	"<td>
			   	<FORM action='clienteCtoDtoAlta.php' method='POST' id='entabla'>
			   		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
					<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
					<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Subir Archivo'>
				</FORM>
		  		</td>";
		// TERMINA SUBIR ARCHIVOS DEL CONTRATO

		echo "</tr></table>";

		include ("clienteCtoPtds.php");
		echo "</div>";	 
	}
echo "</section>"; // Cerrar tabla
##### ##### ##### ##### ##### #####
// TERMINA mostrar contrato a que se agrega PARTIDA