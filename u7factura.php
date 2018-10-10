<?php
if($_SESSION["facturas"] > 0)
{ // APERTURA PRIVILEGIOS 

$sqlFu = 'SELECT f.Proveedor, f.FechaFactura, f.FolioFactura, f.importe, '
		. ' f.FacturaOriginal, f.FechaArchivoTLC '
        . ' FROM '
        . ' facturaunidad f'
        . " WHERE f.id_unidad = $id_unidad LIMIT 0, 1 ";
$resultadoFu 	= mysqli_query($dbd2, $sqlFu);
@$matrizFu 		= mysqli_fetch_array($resultadoFu);

@$filasFactura 	= mysqli_num_rows($resultadoFu);
@$importe 		= $matrizFu['importe'];
$importe 		= number_format($importe,2);
@$Proveedor		= $matrizFu['Proveedor'];
@$FolioFactura	= $matrizFu['FolioFactura'];
@$FechaFactura	= $matrizFu['FechaFactura'];

echo "<fieldset><legend>Factura de la Unidad</legend>";
	if($filasFactura == 0 )
	{	
		if($_SESSION["facturas"] > 1)
		{  // AUTORIZACION PARA INSERTAR DATOS DE FACTURA // APERTURA PRIVILEGIOS
			echo "<a href='u7facturaalta.php?id_unidad=".@$id_unidad."' >
			<button type='button' title='Agregar datos de Factura'>
			Agregar datos de factura</button></a>\n";
		} // AUTORIZACION PARA INSERTAR DATOS DE FACTURA // CIERRE PRIVILEGIOS
	}
	else 
	{ // PINTAR FORMATO
		if($_SESSION["facturas"] > 1) // EDITAR EDITAR EDITAR
		{ // AUTORIZACION PARA EDITAR INFORMACION DE FACTURA // APERTURA PRIVILEGIOS
			echo "<a href='u7facturaeditar.php?id_unidad=".@$id_unidad."
			&Proveedor=".$Proveedor."
			&FolioFactura=".$FolioFactura."
			&FechaFactura=".$FechaFactura."  
			&importe=".$importe."' > 
			<button type='button' title='Editar dstos de Factura'>
			Editar datos de factura</button></a>\n";
		} // AUTORIZACION PARA EDITAR INFORMACION DE FACTURA // CIERRE PRIVILEGIOS
		?>
		<table > 
			<tr><th>Proveedor</th>
				<td><?php echo  @$matrizFu['Proveedor'];?></td>
			</tr>
			<tr><th>Folio de la Factura</th>
				<td><?php echo  @$matrizFu['FolioFactura'];?></td>
			</tr>
			<tr><th>Fecha de la Factura</th>
				<td><?php echo  @$matrizFu['FechaFactura'];?></td>
			</tr>
			<tr><th>Importe IVA incluido</th>
				<td><?php echo  $importe;?></td></tr>
			<tr><th>¿Se tiene Factura Original?</th>
				<td><?php echo  $matrizFu['FacturaOriginal'];?></td>
			</tr>
			<tr><th>Fecha en archivo TLC</th>
				<td><?php echo  $matrizFu['FechaArchivoTLC'];?></td>
			</tr>
		</table>
		<?php 
	} // FIN DE PINTAR FORMATO
echo "</fieldset>";
} // CIERRE PRIVILEGIOS
?> 