<?php

echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
$borrarTxtIcon = "<i class='fa fa-trash-o'  style='font-size:16px; color:gray;font-weight: ;'   alt='ELIMINAR' ></i>";

if($id_estimacion > 0 )
{ // INICIO SI HAY RESULTADOS 
// PINTAR ENCABEZADO
	echo"<h2>ESTIMACION ACTUAL</h2>";
	echo "<fieldset><legend>ESTIMACION ACTUAL</legend>";


	echo "<table id='ResTabla' >
		<tr>
			<th>FOLIO EST</th>
			<th>FECHA INICIO</th>
			<th>FECHA FINAL</th>
			<th>IMPORTE</th>

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

		echo "<tr>";
		echo "<td>{$id_estimacion}</td>";
		echo "<td>{$fechaIn}</td>";
		echo "<td>{$fechaFn}</td>";
		echo "<td style='text-align:right;'>$".number_format($montoEiI, 2)."</td>";
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
	$irASubirA = "<td><a href='estimacionAltaDocto.php?
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
			echo "<td>";
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
			echo "<td>";
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


	// FORMULARIO SUBIR OTRO PERMANENTE
	echo $irASubirA.'0'.$irASubirB;
	// FORMULARIO SUBIR OTRO PERMANENTE


##### INICIA BORRAR TODA LA ESTIMACION
$borrado = 0;
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

		echo "</tr>";
	echo "</table>";
	echo "</fieldset>";
}