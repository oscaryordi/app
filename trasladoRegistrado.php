<?php
echo "<link rel='stylesheet' 
	href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
$borrarTxtIcon = "<i class='fa fa-trash-o'  
					style='font-size:16px; 
					color:gray;font-weight: ;'   
					alt='ELIMINAR' ></i>";
$verPdf 	= "<i class='fa fa-file-pdf-o'  
					style='font-size:16px; 
					color:gray;font-weight: ;'   
					alt='PDF' ></i>";
$verDto 	= "<i class='fa fa-file-o'  
					style='font-size:16px; 
					color:gray;font-weight: ;'   
					alt='DETALLE' ></i>";
$iconoS		= "<i class='fa fa-upload' 
					style='font-size:16px; 
					color:gray;font-weight: ;'   
					alt='SUBIR' ></i>";

$iconoErase		= "<i class='fa fa-times-circle' 
					style='font-size:16px; 
					color:gray;font-weight: ;'   
					alt='BORRAR' ></i>";
$pagina=0;

$sql_T 		= "SELECT * FROM mov_traslados WHERE id_movFor = '$id_movForR' LIMIT 1 ";
$sql_TR 	= mysqli_query($dbd2, $sql_T);
$matrizT 	= mysqli_fetch_array($sql_TR);

$id_movFor 	= $matrizT['id_movFor'];
$id_cliente = $matrizT['id_cliente'];
$id_contrato= $matrizT['id_contrato'];

$id_clienteD = $matrizT['id_clienteD'];
$id_contratoD= $matrizT['id_contratoD'];

$id_unidad 	= $matrizT['id_unidad'];
$folio_inv 	= $matrizT['folio_inv'];
$facturaT 	= $matrizT['facturaT'];
$costoT 	= $matrizT['costoT'];

$aliasEmergente 	= $matrizT['aliasEmergente'];

$motivoM 	= $matrizT['motivoM'];

$kmO 		= $matrizT['kmO'];
$fechaO 	= $matrizT['fechaO'];
$horaO 		= $matrizT['horaO'];
$ciudadO 	= $matrizT['ciudadO'];
$estadoO 	= $matrizT['estadoO'];
$entregaNO 	= $matrizT['entregaNO'];
$telO 		= $matrizT['telO'];
$cpO 		= $matrizT['cpO'];

$kmD 		= $matrizT['kmD'];
$fechaD 	= $matrizT['fechaD'];
$horaD 		= $matrizT['horaD'];
$ciudadD	= $matrizT['ciudadD'];
$estadoD 	= $matrizT['estadoD'];
$recibeND 	= $matrizT['recibeND'];
$telD 		= $matrizT['telD'];
$cpD 		= $matrizT['cpD'];

$id_prov 	= $matrizT['id_prov'];
$conductor 	= $matrizT['conductor'];

$falso 		= $matrizT['falso'];
$obs 		= $matrizT['obs'];

$falsoT = '';
if($falso == 1){$falsoT = 'FALSO';}


datosxid($id_unidad);
?>
<table>
	<tr>
		<td colspan="2" style='color:green;'>
			<?php 
			motivoMov($motivoM);
			$motivoTxt = strtoupper($motivoTxt);
			echo "<h2>".$motivoTxt."</h2>";
			?>
		</td>	
	</tr>
	<tr>
		<td colspan="2" style='color:red;'>
			<?php echo $falsoT;?>
			<?php echo " ".$obs;?>
		</td>	
	</tr>

	<tr>
	<?php
	datosxid($id_unidad);
	echo "<td colspan='2'><b>{$Economico}</b> ::: {$Serie} ::: {$Placas}  ::: {$Vehiculo}</td>";
	?>
	</tr>

	<tr>
	<?php 
		contratoxid($id_contrato);
		clientexid($id_cliente);
	?>
	<td>
	<table class='ResTabla'>
		<b>PROYECTO ORIGEN</b>
		<tr><td>ID_CONTRATO A:</td>	<td><?php echo $id_alan;?></td></tr>
		<tr><td>N.OFICIAL::</td>	<td><?php echo $numero;?></td></tr>
		<tr><td>ALIAS_CTO:</td>		<td><?php echo $aliasCto;?></td></tr>
		<tr><td>RFC:</td>			<td><?php echo $rfc;?></td></tr>
		<tr><td>RAZON SOCIAL:</td>	<td><?php echo $razonSocial;?></td></tr>
		<tr><td>ALIAS_CTE:</td>		<td><?php echo $alias;?></td></tr>
	</table>
	</td>

	<?php 
		contratoxid($id_contratoD);
		clientexid($id_cliente);
	?>
	<td>
	<table class='ResTabla'>
		<b>PROYECTO DESTINO</b>
		<tr><td>ID_CONTRATO A:</td>	<td><?php echo $id_alan;?></td></tr>
		<tr><td>N.OFICIAL::</td>	<td><?php echo $numero;?></td></tr>
		<tr><td>ALIAS_CTO:</td>		<td><?php echo $aliasCto;?></td></tr>
		<tr><td>RFC:</td>			<td><?php echo $rfc;?></td></tr>
		<tr><td>RAZON SOCIAL:</td>	<td><?php echo $razonSocial;?></td></tr>
		<tr><td>ALIAS_CTE:</td>		<td><?php echo $alias;?></td></tr>
	</table>
	</td>
	<?php 
		$id_contrato 	='';
		$id_cliente 	='';
	?>
	</tr>

	<tr>	
		<td>

		<table class='ResTabla'>
			<b>PROVEEDOR</b>
			<tr><td>Nombre:</td>		<td><?php
										$id_provT 	= $matrizT['id_prov']; 
										provTxid($id_provT);
										echo "$provTN";
										?></td></tr>
			<tr><td>Conductor: </td>	<td><?php echo $conductor;?></td></tr>
		</table>

		</td>
		<td>

		<table class='ResTabla'>
			<b>TRASLADO</b>
			<tr><td>Folio:</td>		<td  style='color:red;'><?php echo $folio_inv;?></td></tr>
			<tr><td>Factura:</td>	<td><?php echo $facturaT;?></td></tr>
			<tr><td>Costo:</td>		<td><?php echo $costoT;?></td></tr>
		</table>

		</td>	
	</tr>

	<tr>
		<td>

		<table class='ResTabla'>
			<b>ORIGEN</b>
			<tr><td>Kilometraje:</td><td><?php echo $kmO;?></td></tr>
			<tr><td>Fecha:</td>		<td><?php echo $fechaO;?></td></tr>
			<tr><td>Hora: </td>		<td><?php echo $horaO;?></td></tr>
			<tr><td>Ciudad:</td>	<td><?php echo $ciudadO;?></td></tr>
			<tr><td>Estado: </td>	<td><?php
									$estadoN =  $estadoO;
									estadoT($estadoN);
									echo $estadoTN;
									?></td></tr>

			<tr><td>Código Postal: </td><td><?php echo $cpO;?></td></tr>
			<tr><td>Persona que Entrego: </td><td><?php echo $entregaNO;?></td></tr>
			<tr><td>Telefono: </td>	<td><?php echo $telO;?></td></tr>
		</table>
			 
		</td>
		<td>

		<table class='ResTabla'>
			<b>DESTINO</b> 
			<tr><td>Kilometraje:</td><td><?php echo $kmD;?></td></tr>
			<tr><td>Fecha:</td>		<td><?php echo $fechaD;?></td></tr>
			<tr><td>Hora: </td>		<td><?php echo $horaD;?></td></tr>
			<tr><td>Ciudad:</td>	<td><?php echo $ciudadD;?></td></tr>
			<tr><td>Estado: </td>	<td><?php
									$estadoN =  $estadoD;
									estadoT($estadoN);
									echo $estadoTN;
									?></td></tr>
			<tr><td>Código Postal: </td><td><?php echo $cpD;?></td></tr>
			<tr><td>Persona que Recibe: </td><td><?php echo $recibeND;?></td></tr>
			<tr><td>Telefono: </td>	<td><?php echo $telD;?></td></tr>
		</table>

		</td>
	</tr>
<?php
	echo "<tr><td colspan='2'>"; // ESCANEO
	buscaDocTra($id_movFor);
	$icono = ($extension == 'pdf')? $verPdf: 'V';
	if($ArchivoTra != ''){
	echo "<a href='http://sistema.jetvan.com.mx/exp/traslados/$rutaTra/$ArchivoTra' target='_blank' title='Ver Escaneo'>$icono</a> ";

	echo "<a href='movTrasladoDoctoBorrar.php?id_movFor=$id_movFor&id_doctoTra=$id_doctoTra&pagina=$pagina' title='Borrar Escaneo'>$iconoErase</a>";
	}
	else
	{
	echo "<a href='movTrasladoDoctoAlta.php?id_movFor=$id_movFor' title='Subir Escaneo'>$iconoS</a>";
	}
	echo "</td></tr>";
?>
</table>