<!--CONVENIO MODIFICATORIO-->
<?php
$sql_conv = 'SELECT 
			id_convenio, id_cliente, id_contrato, id_convAO, 
			documento, fuente, estatus, numero, 
			aliasConv, fechafirma, fechainicio, fechafin, 
			min, max, borrado  '
		. ' FROM '
		. ' clbCtoConv '
		. " WHERE id_cliente = '$id_cliente'  
			AND id_contrato = '$id_contrato' 
			AND borrado = 0  ";		

$resultado_conv = mysqli_query($dbd2, $sql_conv);
@$campos_conv 	= mysqli_num_fields($resultado_conv);
@$filas_conv 	= mysqli_num_rows($resultado_conv);

$tabBD 			= 'clbCtoConv';

echo "<section><p>CONVENIO MODIFICATORIO: <b>$filas_conv</b>"; 

if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS
	echo " <a href='clienteconvalta.php?id_cliente=$id_cliente&id_contrato=$id_contrato'>
	<button>Nuevo Convenio Modificatorio</button></a>";
	} // CIERRE PRIVILEGIOS 

echo "</p><table class='tablasimple'>"; 
if($filas_conv > 0)
	{
		echo "<tr>

		<th>ID convAO</th>
		<th>NUMERO</th>

		<th>ALIAS CONVENIO</th>
		<th>DOCUMENTO</th>
		<th>FUENTE</th>
		<th>ESTATUS</th>
		<th>FECHA DEL CONVENIO</th>
		<th>INICIO</th>
		<th>FIN</th>
		<th>MINIMO</th>
		<th>MAXIMO</th>
		</tr>";

	while($row = mysqli_fetch_assoc($resultado_conv))
		{
			$id_elem 		= 	$row['id_convenio']; // PARA BORRAR
			$borrado 		= 	$row['borrado']; // PARA BORRAR
			$id_convenio 	= 	$row['id_convenio'];
			$id_cliente 	= 	$row['id_cliente'];	
			$id_contrato 	= 	$row['id_contrato'];
			$id_convAO 		= 	$row['id_convAO'];
			$documento 		= 	$row['documento'];
			$fuente 		= 	$row['fuente'];
			$estatus 		= 	$row['estatus'];
			$numero 		= 	$row['numero'];
			$aliasConv 		= 	$row['aliasConv'];
			$fechafirma 	= 	$row['fechafirma'];
			$fechainicio 	= 	$row['fechainicio'];
			$fechafin 		= 	$row['fechafin'];
			$min 			= 	$row['min'];
			$max 			= 	$row['max'];

			@$min = number_format($min,2);
			@$max = number_format($max,2);

			echo "<tr>";
			echo "<td>{$id_convAO}</td>";
			echo "<td>{$numero}</td>";

//		unidadesContratoxid($id_contrato);
//			echo "<td></td>";

			echo "<td>{$aliasConv}</td>";
			echo "<td>{$documento}</td>";
			echo "<td>{$fuente}</td>";
			echo "<td>{$estatus}</td>";
			echo "<td>{$fechafirma}</td>";
			echo "<td>{$fechainicio}</td>";
			echo "<td style='background-color:#FFDAB9;'>{$fechafin}</td>";
			echo "<td>{$min}</td>";
			echo "<td>{$max}</td>";

		// INICIO EDITAR INFORMACION DEL CONVENIO
		if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS	
			echo 	"<td>
					<FORM action='clienteconveditar.php' method='POST' id='entabla'>
						<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
						<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
						<INPUT TYPE='hidden' NAME='id_convenio' VALUE='$id_convenio'>
						<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
					</FORM>
					</td>";
		} // CIERRE PRIVILEGIOS	  		
		// TERMINA EDITAR INFORMACION DEL CONVENIO		

		// INICIA BORRAR ARCHIVO
		?>
		<script>
		var fechaTXT 	= '<?php echo $fechafirma; ?>' 		;
		var montoTXT 	= '<?php echo $max; ?>';
		</script>
		<?php
				echo "<td style='text-align:center;'>"; // BORRAR ELEMENTO
				echo "<a 	href='clienteCtoElemBorrar.php?
							id_elem=$id_elem
							&id_cliente=$id_cliente
							&id_contrato=$id_contrato
							&tabBD=$tabBD
							&borrado=$borrado
							'   
							style='text-decoration:none;'  title='Borrar' ";
		?>
							onClick="javascript: return confirm('Confirma proceder a BORRAR ELEMENTO:' 
							+ '' 
							+ ', DE FECHA: ' 
							+ fechaTXT 
							+ ', MONTO: ' 
							+ montoTXT);"
		<?php	echo "		>
							$borrarTxtIcon 
						</a>
					</td>";
		// TERMINA BORRAR ARCHIVO

			echo "</tr>";
		}
	}
echo "</table></section>"; // Cerrar tabla
?>
<!--CONVENIO MODIFICATORIO-->