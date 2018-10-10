<!--RESPONSABILIDAD CIVIL-->
<?php
$sql_crc = 'SELECT id_polrc, afianzadora, fecha, sumasegurada, 
			periodo, pagada, montofactura, borrado '
		. ' FROM '
		. ' cleRc '
		. " WHERE id_cliente = '$id_cliente'  
			AND id_contrato = '$id_contrato' 
			AND borrado = 0 ";

$resultado_crc 	= mysqli_query($dbd2, $sql_crc);
@$campos_crc 	= mysqli_num_fields($resultado_crc);
@$filas_crc 	= mysqli_num_rows($resultado_crc);

$tabBD 			= 'cleRc';

echo "<section><p>POLIZA DE RESPONSABILIDAD CIVIL: <b>$filas_crc</b>"; 

if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS
	echo " <a href='clienterespalta.php?id_cliente=$id_cliente&id_contrato=$id_contrato'>
	<button>Nueva Póliza de Responsabilidad Civil</button></a>";
	} // CIERRE PRIVILEGIOS

echo "</p><table class='tablasimple'>"; 
if($filas_crc > 0)
	{
		echo "
		<tr>
			<th>AFIANZADORA</th>
			<th>FECHA</th>
			<th>SUMA ASEGURADA</th>
			<th>PERIODO</th>
			<th>PAGADA</th>
			<th>MONTOFACTURA</th>
		</tr>";

		while($row = mysqli_fetch_assoc($resultado_crc))
		{
			$id_elem 		= 	$row['id_polrc']; // PARA BORRAR
			$borrado 		= 	$row['borrado']; // PARA BORRAR
			$id_polrc 		= 	$row['id_polrc'];
			$afianzadora 	= 	$row['afianzadora'];
			$fecha 			= 	$row['fecha'];
			$sumasegurada 	= 	$row['sumasegurada'];
			$periodo 		= 	$row['periodo'];
			$pagada 		= 	$row['pagada'];
			$montofactura 	= 	$row['montofactura'];
			
			echo "<tr>";
			echo "<td>{$afianzadora}</td>";
			echo "<td>{$fecha}</td>";
			echo "<td>{$sumasegurada}</td>";
			echo "<td>{$periodo}</td>";
			echo "<td>{$pagada}</td>";
			echo "<td>{$montofactura}</td>";

		// INICIO EDITAR INFORMACION DE POLIZA RESPONSABILIDAD CIVIL
		if($_SESSION["clientes"] > 1)
		{ // APERTURA PRIVILEGIOS
			echo 	"<td>
					<FORM action='clienterespeditar.php' method='POST' id='entabla'>
						<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
						<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
						<INPUT TYPE='hidden' NAME='id_polrc' VALUE='$id_polrc'>
						<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
					</FORM>
					</td>";
		} // CIERRE PRIVILEGIOS
		// TERMINA EDITAR INFORMACION DE POLIZA RESPONSABILIDAD CIVIL

		// INICIA BORRAR ARCHIVO
		?>
		<script>
		var fechaTXT 	= '<?php echo $fecha; ?>' 		;
		var montoTXT 	= '<?php echo $montofactura; ?>';
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
<!--RESPONSABILIDAD CIVIL-->