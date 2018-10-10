<!--CONTRATOS-->
<?php
$sql_ccto =  "  SELECT id_contrato, id_alan, documento, fuente, estatus, "
			." numero, aliasCto, fechacontrato, fechainicio, "
			." fechafin, min, max, borrado, tipoC "
			.' FROM '
			.' clbCto '
			." WHERE id_cliente = '$id_cliente' "
			." AND borrado = 0 "
			." ORDER BY id_alan DESC ";

$resultado_ccto = mysqli_query($dbd2, $sql_ccto);
@$campos_ccto 	= mysqli_num_fields($resultado_ccto);
@$filas_ccto 	= mysqli_num_rows($resultado_ccto);

$tabBD 			= 'clbCto';


if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS ?>
	<a href='clientectoalta.php?id_cliente=<?php echo "$id_cliente";?>' >
		<button type='button' title='Alta Contrato'>Nuevo contrato</button>
	</a>
<?php } // CIERRE PRIVILEGIOS


echo "<section><p>CONTRATOS REGISTRADOS: <b>$filas_ccto</b> , CON LOS ID'S ALAN : </p>";
// encabezados
echo "<div style='background-color: #d0e1e1; margin:15px; padding: 10px;'>";
echo "<table class='tablasimple'>
		<tr>
			<th>ID alan</th>
			<th>TIPO CONTRATO</th>
			<th>NUMERO</th>
			<th>UNIDADES ACTUALES</th>
			<th>ALIAS CTO</th>
			<th>DOCUMENTO</th>
			<th>FUENTE</th>
			<th>ESTATUS</th>
			<th>FECHA DEL CONTRATO</th>
			<th>INICIO</th>
			<th>FIN</th>
			<th>VIGENCIA EXTENDIDA</th>
			<th>MINIMO</th>
			<th>MAXIMO</th>
		</tr>";
// encabezados

while($rowF = mysqli_fetch_assoc($resultado_ccto))
{
	$id_alanIA = 	$rowF['id_alan'];
	$msgIdAlan = 	($rowF['id_alan'] == null OR $rowF['id_alan']==0)? ', &#9785; NO HAY ID_ALAN':'' ;

		global $id_contrato;
		
		$id_elem 		= 	$rowF['id_contrato']; // PARA BORRAR
		$borrado 		= 	$rowF['borrado']; // PARA BORRAR
		$tipoC 			= 	$rowF['tipoC'];

		$id_contrato 	= 	$rowF['id_contrato'];
		$id_alan	 	= 	$rowF['id_alan'];		
		$documento 		= 	$rowF['documento'];
		$fuente 		= 	$rowF['fuente'];
		$estatus 		= 	$rowF['estatus'];
		$numero 		= 	$rowF['numero'];
		$aliasCto 		= 	$rowF['aliasCto'];
		$fechacontrato 	= 	$rowF['fechacontrato'];
		$fechainicio 	= 	$rowF['fechainicio'];
		$fechafin 		= 	$rowF['fechafin'];
		$min 			= 	$rowF['min'];
		$max 			= 	$rowF['max'];

		@$min = number_format($min,2);
		@$max = number_format($max,2);

		echo "<tr>";
		echo "<td id='IA$id_alan'  >
				ALAN 
				<span style='font-size:1.5em; color:#0080ff;' >
				<a href='ctoIndex.php?id_contrato=$id_contrato' 
				style='text-decoration:none;' title='IR A INICIO' >
				{$id_alan}
				</a> 
				</span>
			</td>";

		$tipoCtxt = ($tipoC == 0)? 'ARRENDAMIENTO':'MANTENIMIENTO';
		echo "<td>{$tipoCtxt}</td>";		
		echo "<td>{$numero}</td>";

		unidadesContratoxid($id_contrato);
		echo "<td style='font-size:1.5em; color:blue;'>
				<a  href='clienteflotilla.php?id_contrato=$id_contrato' 
					style='text-decoration: none;' 
					title='VER FLOTILLA'>
				{$unidadesCto}
				</a>
				 ::: 
				<span style='font-size:0.8em;'>
				<a  href='mttoSolResSupCteCTO.php?id_contrato=$id_contrato' 
					style='text-decoration: none;' 
					title='VER RESUMEN DE MANTENIMIENTO'>
				Mtto
				</a>
				</span>
				</td>";

		echo "<td>{$aliasCto}</td>";
		echo "<td>{$documento}</td>";
		echo "<td>{$fuente}</td>";
		echo "<td>{$estatus}</td>";
		echo "<td>{$fechacontrato}</td>";
		echo "<td>{$fechainicio}</td>";
		echo "<td>{$fechafin}</td>";

		fechaExtendidaXid_contrato($id_contrato);
		echo "<td>{$fechaExtendida}</td>";

		echo "<td>{$min}</td>";
		echo "<td>{$max}</td>";

		// EDITAR INFORMACION DEL CONTRATO
		if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS
		echo 	"<td>
			   	<FORM action='clientectoeditar.php' method='POST' id='entabla'>
			   		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
					<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
					<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
				</FORM>
		  		</td>";
		
		echo 	"<td>
			   	<FORM action='clienteCtoDtoAlta.php' method='POST' id='entabla'>
			   		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
					<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
					<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Subir Archivo'>
				</FORM>
		  		</td>";
		 } // CIERRE PRIVILEGIOS 		

		// INICIA BORRAR ARCHIVO
		?>
		<script>
		var fechaTXT<?php echo $id_contrato; ?> 	= '<?php echo $fechacontrato; ?>';
		var montoTXT<?php echo $id_contrato; ?> 	= '<?php echo $max; ?>';
		</script>
		<?php
		$tabBD 			= 'clbCto'; // EN ALGUNA PARTE CAMBIA LA TABLA DE VALOR...
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
							+ fechaTXT<?php echo $id_contrato; ?> 
							+ ', MONTO: ' 
							+ montoTXT<?php echo $id_contrato; ?>);"
		<?php	echo "		>
							$borrarTxtIcon 
						</a>
					</td>";
		// TERMINA BORRAR ARCHIVO
		echo "</tr>";
}
echo "</table></section>"; // Cerrar tabla
?>
<!--CONTRATOS-->