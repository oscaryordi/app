<?php

$sql_estRes_R 	= mysqli_query($dbd2, $sql_estRes);
$cuantasFueron 	= mysqli_affected_rows($dbd2);

echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
$borrarTxtIcon = "<i class='fa fa-trash-o'  style='font-size:16px; color:gray;font-weight: ;'   alt='ELIMINAR' ></i>";

$montoEjercido 	= 0;
$montoFactura 	= 0;
$montoEstimado 	= 0;
$montoOtros 	= 0;
$montoPenado 	= 0;

if(mysqli_num_rows($sql_estRes_R) > 0 )
{ // INICIO SI HAY RESULTADOS 
// PINTAR ENCABEZADO


	echo "<fieldset><legend>RESUMEN DE ESTIMACIONES</legend>"; 

/*
	echo "<p> 
		<a href='estimacionResumen_GET.php?
					id_contrato=$id_contrato' 
		title='DESCARGAR RESUMEN'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
		DESCARGAR RESUMEN</a>
		</p>";
*/
	echo "<table id='ResTabla' >
	<tr>
	<th>FOLIO EST</th>
	<th>RFC</th>
	<th>ID CONTRATO</th>

	<th>FECHA INICIO</th>
	<th>FECHA FINAL</th>
	<th>IMPORTE</th>

	<th>PENALIZACION</th>

	<th>IMPORTE A PAGAR</th>

	<th>OBSERVACIONES ESTIMACION</th>

	<th>EDITAR</th>

	<th>FACTURA</th>
	<th>ESTIMACION</th>
	<th>PENALIZACION</th>
	<th>OTRO</th>
	<th>SUBIR + </th>
	<th>BORRAR TODO</th>
	<th>CAPTURO</th>	
	</tr>";

	while($row = mysqli_fetch_assoc($sql_estRes_R))
	{

		$id_estimacion 	= $row['id_estimacion'];
		$id_cliente 	= $row['id_cliente'];
		$id_contrato 	= $row['id_contrato'];
		$mesE 			= $row['mesE'];
		$anioE 			= $row['anioE'];

		$fechaIn 		= $row['fechaIn'];
		$fechaFn 		= $row['fechaFn'];

		$montoEiI 		= $row['montoEiI'];
		$d1 			= $row['d1Factura'];
		$d2 			= $row['d2Estimacion'];
		$d3 			= $row['d3OtroSoporte'];
		$d4 			= $row['d4Penaliza'];
		$d5 			= $row['d5CompPago'];
		$obs 			= $row['obs'];
		$fechareg 		= $row['fechareg'];
		$capturo 		= $row['capturo'];
		$borrado 		= $row['borrado'];

		echo "<tr>";
		echo "<td><a href='estimacionEditar.php?
					id_contrato=$id_contrato
					&id_cliente=$id_cliente
					&id_estimacion=$id_estimacion
					&borrado=$borrado'  
					style='text-decoration:none; color:blue;'  title='Editar' >
			{$id_estimacion}</a></td>";
		
		//mesTxtEsp($mesE);

		contratoxid($id_contrato);
		clientexid($id_cliente);

		echo "<td>{$rfc}</td>";
		echo "<td>{$id_alan}</td>";


		echo "<td>{$fechaIn}</td>";
		echo "<td>{$fechaFn}</td>";

		echo "<td style='text-align:right;'>$".number_format($montoEiI, 2)."</td>";

		montoPenaxid_estima($id_estimacion);
		echo "<td>$".number_format($montoP, 2)."</td>";
		$totalPagar = $montoEiI - $montoP;
		echo "<td>$".number_format($totalPagar, 2)."</td>";

		$montoEjercido += $totalPagar;

		echo "<td>{$obs}</td>";

		echo "<td style='text-align:center;'>
				<a 	href='estimacionEditar.php?
					id_contrato=$id_contrato
					&id_cliente=$id_cliente
					&id_estimacion=$id_estimacion
					&borrado=$borrado'  
					style='text-decoration:none;'  title='Editar' >
					<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
				</a>
			</td>";


	// ICONO GENERICO SUBIR ARCHIVO INICIA
	$irASubirA = "<td style='text-align:center;'><a href='estimacionAltaDocto.php?
						id_contrato=$id_contrato&
						id_estimacion=$id_estimacion&
						tipo=";

	$irASubirB = "' style='text-decoration:none;'  
					title='Subir FACTURA' >
					<img src='img/Upload.gif' 
					style='width:16px;height:16px;'  
					alt='Subir FACTURA' >
					</a></td>";
	// ICONO GENERICO SUBIR ARCHIVO TERMINA	


	// INICIO ANALIZA SI ESTA FACTURADO
	if($d1  > 0)
		{
			echo "<td style='text-align:center;'>";
			for($x = 1; $x <= $d1; $x++){ 
			echo "<a href='estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=1&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver FACTURA' >
					<img src='img/th.jpg' style='width:16px;height:16px;'  alt='Ver FACTURA' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			$tipo = 1;
			echo $irASubirA.$tipo.$irASubirB;
		} //&pagina=@$pagina
	// TERMINA ANALIZA SI ESTA FACTURADO


	// INICIO ESTIMACION // echo "<td>{$d2}</td>";
	if($d2  > 0)
		{
			echo "<td style='text-align:center;'>";
			for($x = 1; $x <= $d2; $x++){ 
			echo "<a href='estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=2&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver ESTIMACION' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver ESTIMACION' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			$tipo = 2;
			echo $irASubirA.$tipo.$irASubirB;
		} //&pagina=@$pagina
	// TERMINA ESTIMACION


	// INICIO PENALIZACION // echo "<td>{$d2}</td>";
	if($d4  > 0)
		{
			echo "<td style='text-align:center;'>";
			for($x = 1; $x <= $d4; $x++){ 
			echo "<a href='estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=4&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver PENALIZACION' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver PENALIZACION' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			$tipo = 2;
			echo $irASubirA.$tipo.$irASubirB;
		} //&pagina=@$pagina
	// TERMINA PENALIZACION


	// INICIO OTRO // echo "<td>{$d3}</td>";
	if($d3  > 0)
		{
			echo "<td style='text-align:center;'>";
			for($x = 1; $x <= $d3; $x++){ 
			echo "<a href='estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=3&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver OTRO' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver OTRO' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			$tipo = 3;
			echo $irASubirA.$tipo.$irASubirB;
		} //&pagina=@$pagina
	// TERMINA OTRO

//	$id_estimacion = '';


			// FORMULARIO SUBIR OTRO PERMANENTE
			echo $irASubirA.'0'.$irASubirB;
			// FORMULARIO SUBIR OTRO PERMANENTE


##### INICIA BORRAR TODA LA ESTIMACION
?>
<script>
var folioEstimacion<?php echo $id_estimacion; ?> = <?php echo $id_estimacion; ?> ;
var mesEstimacion<?php echo $id_estimacion; ?> 	= '<?php echo $mesETxt; ?>' ;
var anioEstimacion<?php echo $id_estimacion; ?> 	= '<?php echo $anioE; ?>' ;
</script>
<?php
		echo "<td style='text-align:center;'>";
		echo "<a 	href='estimacionBorrar.php?
					id_contrato=$id_contrato
					&id_cliente=$id_cliente
					&id_estimacion=$id_estimacion
					&borrado=$borrado'   
					style='text-decoration:none;'  title='Borrar' ";
?>
					onClick="javascript: return confirm('Confirma proceder a BORRAR ESTIMACION, FOLIO:' 
					+ folioEstimacion<?php echo $id_estimacion; ?> 
					+ ', MES:' 
					+ mesEstimacion<?php echo $id_estimacion; ?> 
					+ ', AÑO: ' 
					+ anioEstimacion<?php echo $id_estimacion; ?>);"
<?php	echo "		>
					$borrarTxtIcon 
				</a>
			</td>";
##### TERMINA BORRAR TODA LA ESTIMACION


		$id_usuario = $capturo;
		usuarioxid($id_usuario); 
		echo "<td>{$nombre}</td>";
		$id_usuario = 0;


##### facturado estimacion
	$sql_Fe = "SELECT SUM(importeDto) totalFacturado FROM estimacionDocto WHERE id_estimacion = '$id_estimacion' AND tipo = 1 AND extension like '%pdf%'  AND  borrado = 0 ";
	$sql_Fe_R 		= mysqli_query($dbd2, $sql_Fe);
	$facturado_M	= mysqli_fetch_array($sql_Fe_R);
	$montoFactura 	+= $facturado_M['totalFacturado'];
##### facturado estimacion

##### estimado archivos
	$sql_Fe = "SELECT SUM(importeDto) totalEstimado FROM estimacionDocto WHERE id_estimacion = '$id_estimacion' AND tipo = 2 AND  borrado = 0 ";
	$sql_Fe_R 		= mysqli_query($dbd2, $sql_Fe);
	$facturado_M	= mysqli_fetch_array($sql_Fe_R);
	$montoEstimado 	+= $facturado_M['totalEstimado'];
##### estimado archivos


##### estimado archivos
	$sql_Fe = "SELECT SUM(importeDto) totalOtros FROM estimacionDocto WHERE id_estimacion = '$id_estimacion' AND tipo = 3  AND  borrado = 0 ";
	$sql_Fe_R 		= mysqli_query($dbd2, $sql_Fe);
	$facturado_M	= mysqli_fetch_array($sql_Fe_R);
	$montoOtros 	+= $facturado_M['totalOtros'];
##### estimado archivos


##### estimado archivos
	$sql_Fe = "SELECT SUM(importeDto) totalPenado FROM estimacionDocto WHERE id_estimacion = '$id_estimacion' AND tipo = 4  AND  borrado = 0 ";
	$sql_Fe_R 		= mysqli_query($dbd2, $sql_Fe);
	$facturado_M	= mysqli_fetch_array($sql_Fe_R);
	$montoPenado 	+= $facturado_M['totalPenado'];
##### estimado archivos




		echo "</tr>";

	}
	echo "</table>";


	echo "<table class='ResTabla'>";
	echo "<tr><th>MONTO EJERCIDO IVA INCLUIDO:</th><td>$".number_format($montoEjercido, 2)."</td></tr> ";
	echo "<tr><th>TOTAL FACTURADO IVA INCLUIDO:</th><td>$".@number_format($montoFactura, 2)."</td></tr>";
	echo "<tr><th>TOTAL ESTIMACIONES IVA INCLUIDO:</th><td> $".@number_format($montoEstimado, 2)."</td></tr>";
	echo "<tr><th>TOTAL OTROS IVA INCLUIDO:</th><td> $".@number_format($montoOtros, 2)."</td></tr>";
	echo "<tr><th>TOTAL PENADO IVA INCLUIDO:</th><td> $".@number_format($montoPenado, 2)."</td></tr>";
	echo "</table>";

	echo "</fieldset>";
}


if( $cuantasFueron == 0){
	echo "<fieldset><legend>RESUMEN DE ESTIMACIONES</legend>";	
	echo "<h3>AUN NO HAY ESTIMACIONES PARA ESTE CONTRATO</h3>";
	echo "</fieldset>";
}
