<!--CONTRATOS-->
<?php

$sql_cto1 	= "SELECT * FROM clbCto WHERE id_contrato = '$id_contrato' limit 1";
$cto1R 		= mysqli_query($dbd2, $sql_cto1);

$tabBD 		= 'clbCto';

echo "<section>";
while($row = mysqli_fetch_assoc($cto1R))
	{
		echo "<div style='background-color: #d0e1e1; margin:15px; padding: 10px;'>";

		if($_SESSION["clientes"] > 3){
			include('ctoScoreCard.php');} // tabla resumen contrato

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
		global $id_contrato;
		
		$id_elem 		= 	$row['id_contrato']; // PARA BORRAR
		$borrado 		= 	$row['borrado']; // PARA BORRAR
		$tipoC 			= 	$row['tipoC'];

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
		echo "<td id='IA$id_alan'  >
				<a href='#IA$rfc' 
				style='font-size:1.5em; color:#0080ff;text-decoration:none;' 
				title='IR A INICIO' >&#8682;</a> ALAN 
				<span style='font-size:1.5em; color:#0080ff;' >
				{$id_alan}
				</span>
			  </td>";

		$tipoCtxt = ($tipoC == 0)? 'ARRENDAMIENTO':'MANTENIMIENTO';
		echo "<td>{$tipoCtxt}</td>";
		echo "<td>{$numero}</td>";

		unidadesContratoxid($id_contrato);
		echo "<td style='font-size:1.5em; color:blue;'>
				<a href='clienteflotilla.php?id_contrato=$id_contrato' 
				   style='text-decoration: none;' title='VER FLOTILLA'>
				{$unidadesCto}
				</a>
				 ::: 
				<span style='font-size:0.8em;'>
				<a href='mttoSolResSupCteCTO.php?id_contrato=$id_contrato' 
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

		if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS
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
		} // CIERRE PRIVILEGIOS 
		echo "</tr></table>";

		// DESGLOCE DE FLOTILLA
		echo "<br>";
		echo "	<table>
				<tr><th COLSPAN='4'>VER DESGLOCE DE FLOTILLA POR:</th>
				</tr>
				<tr>
					<th>ORDEN DE SERVICIO</th>
					<th>PARTIDA</th>
					<th>AREA ADMINISTRATIVA</th>
					<th>ENTIDAD FEDERATIVA</th>
				</tr>
				<tr>";
		echo "<td><a href='flotillaDesgloce.php?id_contrato=$id_contrato&tipoDesgloce=1' 
					 style='text-decoration: none;'>O</a></td>";
		echo "<td><a href='flotillaDesgloce.php?id_contrato=$id_contrato&tipoDesgloce=2' 
					 style='text-decoration: none;'>P</a></td>";
		echo "<td><a href='flotillaDesgloce.php?id_contrato=$id_contrato&tipoDesgloce=3' 
					 style='text-decoration: none;'>AA</a></td>";
		echo "<td><a href='flotillaDesgloce.php?id_contrato=$id_contrato&tipoDesgloce=4' 
					 style='text-decoration: none;'>EF</a></td>";
		echo "</tr>
				</table>";
		// DESGLOCE DE FLOTILLA

			echo "<p><a href='estimacionSubir.php?id_contrato=$id_contrato&id_cliente=$id_cliente' 
						style='text-decoration: none;' 
						title='SUBIR ESTIMACION'>
						VER ESTIMACIONES</a></p>";

			include ("clienteCtoEjec.php");

			include ("clienteCtoPtds.php");

			echo "<p><a href='clienteCtoAA.php?id_contrato=$id_contrato&id_cliente=$id_cliente' 
						style='text-decoration: none;' 
						title='VER AREAS ADMINISTRATIVAS'>
						VER AREAS ADMINISTRATIVAS</a></p>";

			if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS

				include ("clienteconv.php");
				include ("clientecump.php");
				include ("clienteconf.php");
				include ("clienteresp.php");
				include ("clienteCtoDto.php");
			} // CIERRE PRIVILEGIOS 

		echo "</div>";
	}
echo "</section>"; // Cerrar tabla
?>
<!--CONTRATOS-->