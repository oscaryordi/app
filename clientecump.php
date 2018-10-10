<!--CUMPLIMIENTO-->
<?php
$sql_ccump = 'SELECT id_polcum, poliza, afianzadora, fecha, monto, 
			anualototal, pagada, montofactura, borrado  '
		. ' FROM '
		. ' clcCmpl '
		. " WHERE id_cliente = '$id_cliente' 
			AND id_contrato = '$id_contrato' 
			AND borrado = 0 ";		

$resultado_ccump = mysqli_query($dbd2, $sql_ccump);
@$campos_ccump 	= mysqli_num_fields($resultado_ccump);
@$filas_ccump 	= mysqli_num_rows($resultado_ccump);

$tabBD 			= 'clcCmpl';

echo "<section><p>POLIZA DE CUMPLIMIENTO: <b>$filas_ccump</b>";

if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS
	echo " <a href='clientecumpalta.php?id_cliente=$id_cliente&id_contrato=$id_contrato'>
	<button>Nueva Póliza de Cumplimiento</button></a>";
	} // CIERRE PRIVILEGIOS

echo "</p><table class='tablasimple'>"; 
if($filas_ccump > 0)
	{
		echo "
		<tr>
			<th># POLIZA</th>
			<th>AFIANZADORA</th>
			<th>FECHA</th>
			<th>MONTO</th>
			<th>ANUAL O TOTAL</th>
			<th>PAGADA</th>
			<th>MONTOFACTURA</th>
		</tr>";

		while($row = mysqli_fetch_assoc($resultado_ccump))
			{
			$id_elem 		= 	$row['id_polcum']; // PARA BORRAR
			$borrado 		= 	$row['borrado']; // PARA BORRAR
			$id_polcum 		= 	$row['id_polcum'];
			$poliza 		= 	$row['poliza'];
			$afianzadora 	= 	$row['afianzadora'];
			$fecha 			= 	$row['fecha'];
			$monto 			= 	$row['monto'];
			$anualototal 	= 	$row['anualototal'];
			$pagada 		= 	$row['pagada'];
			$montofactura 	= 	$row['montofactura'];
			
			$monto 			= number_format($monto,2);
			$montofactura 	= number_format($montofactura,2);

			echo "<tr>";
			echo "<td>{$poliza}</td>";
			echo "<td>{$afianzadora}</td>";
			echo "<td>{$fecha}</td>";
			echo "<td>{$monto}</td>";
			echo "<td>{$anualototal}</td>";
			echo "<td>{$pagada}</td>";
			echo "<td>{$montofactura}</td>";

		// INICIO EDITAR INFORMACION DE POLIZA CUMPLIMIENTO
		if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS	
			echo 	"<td>
				   	<FORM action='clientecumpeditar.php' method='POST' id='entabla'>
				   		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
						<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
					   	<INPUT TYPE='hidden' NAME='id_polcum' VALUE='$id_polcum'>
						<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
					</FORM>
			  		</td>";
		} // CIERRE PRIVILEGIOS	  		
		// TERMINA EDITAR INFORMACION DE POLIZA CUMPLIMIENTO		

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
<!--CUMPLIMIENTO-->  