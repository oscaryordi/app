<?php
?>
<style>
.resaltar	{color:blue;size:1.3em;};
td {padding:0px;margin:0px;}
#corta td {padding:0px;margin:0px;}
</style>
<table style="padding:5px;">
	<tr>
		<td>
			<b>SOLICITUD DE CHEQUE</b>
			<br>Folio: 
			<span style='color:red;'><?php echo $id_mttoSol;?></span>
			<br>Fecha: 
			<?php echo $fechaEj;?>
		</td>
		<td>
			<b>PROYECTO-CLIENTE</b>  
			<br>Cliente:
			<?php echo   $razonSocial;?>
			<br>Contrato:
			<?php echo "id ::: ".$id_alan." ::: ".$numero;?>
		</td>
	</tr>
	<tr>
		<td>
			 <table id='corta' >
			 <tr >
			 	<td ><b>UNIDAD</b></td>
			 	<td ></td></tr>
			 <tr><td>Economico: </td>
			 	<td><span class='resaltar'><?php echo $Economico;?></span></td></tr>
			 <tr>
			 	<td>Serie: </td>
			 	<td><?php echo $Serie;?></td></tr>
			 <tr>
			 	<td>Placas:</td>
			 	<td><?php echo $Placas;?></td></tr>
			 </table>
		</td>
		<td>
			<br>Tipo: 
			<?php echo $Vehiculo;?>
			<br>Color: 
			<?php echo $Color;?>
			<br>Modelo: 
			<?php echo $Modelo;?>
			 
		</td>
	</tr>
	<tr>
		<td style='vertical-align: top;'>
			
			<b>PROVEEDOR</b> 
			 <br>Razon Social:  
			<?php  if($esreembolso == 1){echo "REEMBOLSO :  $nombreR ";}else{echo "&nbsp". $PrazonSocial;} // PROVEEDOR ?>
			 <br>RFC:  
			<?php  if($esreembolso == 1){echo " &nbsp; Facturado por : $Prfc :::  $PrazonSocial ";}else{echo "&nbsp". $Prfc;} // PROVEEDOR ?>
		</td>
		<td>
			<b>PAGO</b> 
			<br>Nombre: 
			<?php echo "&nbsp". $nombreR; // REEMBOLSO ?>
			<br>Clabe: 
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCclabe;} // PROVEEDOR ?>
			<?php echo "&nbsp". $clabeR; // REEMBOLSO ?>
			<br>Cuenta:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCcuenta;} // PROVEEDOR ?>
			<?php echo "&nbsp". $cuentaR; // REEMBOLSO ?>
			<br>Sucursal:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCsucursal;} // PROVEEDOR ?>
			<?php echo "&nbsp". $sucR; // REEMBOLSO ?>
			<br>Banco:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCbanco;} // PROVEEDOR ?>
			<?php echo "&nbsp". $bancoR; // REEMBOLSO ?>
		</td>
	</tr>
	<tr>
		<td style='vertical-align: top;' colspan="2">
			<b>DETALLE</b>
			<br>Concepto:
			<?php echo $concepto;?>
			<br>Importe:  $ 
			<span class='resaltar'><?php echo number_format( $importe, 2);?></span>
			<br>Kilometraje:
			<span class='resaltar'><?php echo $km;?></span>
			<br>Observaciones: 
			<?php echo $obs;?>
		</td>
<!--		<td>
			<b>FIRMAS</b>
			<br>Solicita:  
			<?php echo $nombreEjec; ?>
			<br>Autoriza: 
			 <?php echo @$autorizoNombreG; // VOBO autoriza GERENTE ?> 
			<br>VO.BO.: 
			 <?php echo $autorizoNombreS; // VOBO autoriza SUPERVISOR ?> 
			<br>Recibio:	
			 <?php echo @$recibeNombre; // RECIBE CONTABILIDAD ?> 
		</td>
-->	</tr>
</table>