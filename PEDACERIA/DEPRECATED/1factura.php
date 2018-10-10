<?php
if($_SESSION["facturas"] > 0){ // APERTURA PRIVILEGIOS 
 ?>

<!--FACTURA-->
<?php

$sqlFu = 'SELECT f.Proveedor, f.FechaFactura, f.FolioFactura, f.importe, f.FacturaOriginal, f.FechaArchivoTLC '
        . ' FROM '
        . ' facturaunidad f'
        . " WHERE f.Economico = $uNEco LIMIT 0, 1 ";

//echo "<br>";
$resultadoFu = mysql_query($sqlFu);
@$matrizFu = mysql_fetch_array($resultadoFu);

@$filasFactura = mysql_num_rows($resultadoFu);
 
@$importe = $matrizFu[importe];
$importe = number_format($importe,2);
@$Proveedor=$matrizFu[Proveedor]; // PARA ELIMINAR MENSAJE DE ERROR Notice: Use of undefined constant Proveedor - assumed 'Proveedor' in C:\xampp\htdocs\APP\app\1factura.php on line 38
@$FolioFactura=$matrizFu[FolioFactura];
@$FechaFactura=$matrizFu[FechaFactura];

?>
<fieldset><legend>Factura de la Unidad</legend>
<?php
	if($filasFactura == 0 ){	
		
		if($_SESSION["facturas"] > 1){  // AUTORIZACION PARA INSERTAR DATOS DE FACTURA
			
			echo "<a href='factura_agregar.php?uNEco=".@$uNEco."' >
			<button type='button' title='Agregar dstos de Factura'>
			<span style='font-size:1.4em'>&#9916;</span>Agregar datos de factura</button></a>\n";
			
		} // CIERRE PRIVILEGIOS
	}

	else { // PINTAR FORMATO
  
		if($_SESSION["facturas"] > 1){ // AUTORIZACION PARA EDITAR INFORMACION DE FACTURA
  	
			echo "<a href='factura_editar.php?uNEco=".@$uNEco."
			&Proveedor=".$Proveedor."
			&FolioFactura=".$FolioFactura."
			&FechaFactura=".$FechaFactura."  
			&importe=".$importe."' > 
			<button type='button' title='Editar dstos de Factura'>
			Editar datos de factura</button></a>\n";
		}
	?>
<table > 
<tr><th>Proveedor</th><td><?echo @$matrizFu[Proveedor];?></td></tr>
<tr><th>Folio de la Factura</th><td><?echo @$matrizFu[FolioFactura];?></td></tr>
<tr><th>Fecha de la Factura</th><td><?echo @$matrizFu[FechaFactura];?></td></tr>
<tr><th>Importe IVA incluido</th><td><?echo $importe;?></td></tr>
<tr><th>¿Se tiene Factura Original?</th><td><?echo "$matrizFu[FacturaOriginal] &nbsp";?></td></tr>
<tr><th>Fecha en archivo TLC</th><td><?echo "$matrizFu[FechaArchivoTLC] &nbsp";?></td></tr>
</table>
<?php 
	} // FIN DE PINTAR FORMATO
?>
</fieldset>	
<!--FACTURA-->
<?php 
} // CIERRE PRIVILEGIOS
?> 