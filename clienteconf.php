<!--CONFIDENCIALIDAD-->
<?php
$sql_cconf = 'SELECT 
			id_polconfid, afianzadora, fecha, monto,
		 	anualototal, pagada, montofactura, borrado  '
        . ' FROM '
        . ' cldConfid '
        . " WHERE id_cliente = '$id_cliente'  
        	AND id_contrato = '$id_contrato' 
        	AND borrado = 0 ";		

$resultado_cconf 	= mysqli_query($dbd2, $sql_cconf);
@$campos_cconf 		= mysqli_num_fields($resultado_cconf);
@$filas_cconf 		= mysqli_num_rows($resultado_cconf);

$tabBD 				= 'cldConfid';

echo "<section><p>POLIZA DE CONFIDENCIALIDAD: <b>$filas_cconf</b>"; 

if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS
	echo " <a href='clienteconfalta.php?id_cliente=$id_cliente&id_contrato=$id_contrato'>
	<button>Nueva Póliza de Confidencialidad</button></a>";
	} // CIERRE PRIVILEGIOS 

echo "</p><table class='tablasimple'>"; 
if($filas_cconf > 0)
	{
		echo "<tr>
				<th>AFIANZADORA</th>
				<th>FECHA</th>
				<th>MONTO</th>
				<th>ANUAL O TOTAL</th>
				<th>PAGADA</th>
				<th>MONTOFACTURA</th>
			  </tr>";

		while($row = mysqli_fetch_assoc($resultado_cconf))
			{
			$id_elem 		= 	$row['id_polconfid']; // PARA BORRAR
			$borrado 		= 	$row['borrado']; // PARA BORRAR	
			$id_polconfid 	= 	$row['id_polconfid'];
			$afianzadora 	= 	$row['afianzadora'];
			$fecha 			= 	$row['fecha'];
			$monto 			= 	$row['monto'];
			$anualototal 	= 	$row['anualototal'];
			$pagada 		= 	$row['pagada'];
			$montofactura 	= 	$row['montofactura'];
			
			echo "<tr>";
			echo "<td>{$afianzadora}</td>";
			echo "<td>{$fecha}</td>";
			echo "<td>{$monto}</td>";
			echo "<td>{$anualototal}</td>";
			echo "<td>{$pagada}</td>";
			echo "<td>{$montofactura}</td>";

		// INICIO EDITAR INFORMACION DE POLIZA CONFIDENCIALIDAD
		if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS	
			echo 	"<td>
			       	<FORM action='clienteconfeditar.php' method='POST' id='entabla'>
			       		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
	        		    <INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
	        		   	<INPUT TYPE='hidden' NAME='id_polconfid' VALUE='$id_polconfid'>
	        		    <INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
	        		</FORM>
			  		</td>";
		} // CIERRE PRIVILEGIOS 
		// TERMINA EDITAR INFORMACION DE POLIZA CONFIDENCIALIDAD

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
<!--CONFIDENCIALIDAD-->  