<?php 

$sql_T 		= "SELECT * FROM mov_traslados WHERE id_movFor = '$id_movForR' LIMIT 1 ";
$sql_TR 	= mysql_query($sql_T);
$matrizT 	= mysql_fetch_array($sql_TR);

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

$kmO 		= $matrizT['kmO'];
$fechaO 	= $matrizT['fechaO'];
$horaO 		= $matrizT['horaO'];
$domicilioO = $matrizT['domicilioO'];
$estadoO 	= $matrizT['estadoO'];
$entregaNO 	= $matrizT['entregaNO'];
$telO 		= $matrizT['telO'];

$kmD 		= $matrizT['kmD'];
$fechaD 	= $matrizT['fechaD'];
$horaD 		= $matrizT['horaD'];
$domicilioD	= $matrizT['domicilioD'];
$estadoD 	= $matrizT['estadoD'];
$recibeND 	= $matrizT['recibeND'];
$telD 		= $matrizT['telD'];

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
		<td colspan="2" style='color:red;'>
			<?php echo $falsoT;?>
			<?php echo " ".$obs;?>
		</td>	
	</tr>

	<tr>
		<td>
			<b>UNIDAD</b>
			<br>Economico: 
			<?php echo $Economico;?>
			<br>Serie: 
			<?php echo $Serie;?>
			<br>Placas: 
			<?php echo $Placas;?>
			 
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
		<td>
			<b>CLIENTE ORIGEN</b>
			<br> 
			<?php 
			clientexid($id_cliente);
			echo "$alias ::: $razonSocial";
			echo "$aliasEmergente";
			?>
			<br> 
			<b>CLIENTE DESTINO</b>
			<br> 
			<?php 
			clientexid($id_clienteD);
			echo "$alias ::: $razonSocial";
			echo "$aliasEmergente";
			?>
		</td>
		<td>
			<b>CONTRATO ORIGEN</b>
			<br> 
			<?php 
			contratoxid($id_contrato);
			echo "$numero ::: $aliasCto";
			?>
			<br> 
			<b>CONTRATO DESTINO</b>
			<br> 
			<?php 
			contratoxid($id_contratoD);
			echo "$numero ::: $aliasCto";
			?>
		</td>		

	</tr>

	<tr>	

		<td>
			<b>PROVEEDOR</b>
			<br> 
			<?php
			$id_provT 	= $matrizT['id_prov']; 
			provTxid($id_provT);
			echo "$provTN";
			?>
			
			<br>Conductor: 
			<?php echo $conductor;?>


		</td>
		<td>
			<b>TRASLADO</b>
			<br>Folio: 
			<?php echo $folio_inv;?>
			<br>Factura: 
			<?php echo $facturaT;?>
			<br>Costo: 
			<?php echo $costoT;?>
		</td>	


	</tr>


	<tr>
		<td>
			<b>ORIGEN</b>
			<br>Kilometraje: 
			<?php echo $kmO;?>
			<br>Fecha: 
			<?php echo $fechaO;?>
			<br>Hora: 
			<?php echo $horaO;?>
			<br>Domicilio: 
			<?php echo $domicilioO;?>
			<br>Estado: 
			<?php
			$estadoN =  $estadoO;
			estadoT($estadoN);
			echo $estadoTN;
			?>
			<br>Persona que Entrego: 
			<?php echo $entregaNO;?>
			<br>Telefono: 
			<?php echo $telO;?>
			 
		</td>
		<td>
			<b>DESTINO</b> 
			<br>Kilometraje: 
			<?php echo $kmD;?>
			<br>Fecha: 
			<?php echo $fechaD;?>
			<br>Hora: 
			<?php echo $horaD;?>
			<br>Domicilio: 
			<?php echo $domicilioD;?>
			<br>Estado: 
			<?php 
			$estadoN =  $estadoD;
			estadoT($estadoN);
			echo $estadoTN;
			?>
			<br>Persona que Recibe: 
			<?php echo $recibeND;?>
			<br>Telefono: 
			<?php echo $telD;?>
			 
		</td>

	</tr>
</table>

<?php 



/*
				echo "<hr>".$id_unidad."<br>";

				echo "<hr>".$id_cliente."<br>";
				echo $id_contrato."<br>";
				echo $folio_inv."<br>";
				echo $facturaT."<br>";
				echo $costoT."<br>";
				echo $id_prov."<br>";
				echo $conductor."<br><hr>";

				echo $kmO."<br>";
				echo $fechaO."<br>";
				echo $horaO."<br>";
				echo $domicilioO."<br>";
				echo $estadoO."<br>";
				echo $entregaNO."<br>";
				echo $telO."<br><hr>";

				echo $kmD."<br>";
				echo $fechaD."<br>";
				echo $horaD."<br>";
				echo $domicilioD."<br>";
				echo $estadoD."<br>";
				echo $recibeND."<br>";
				echo $telD."<br><hr>";

				echo $falso."<br><hr>";
*/