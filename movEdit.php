<?php 
include("1header.php");

if($_SESSION["movForaneo"] > 0){ // VISTA A EJECUTIVOS
include ("nav_mov.php");

$id_movForR = $_GET['id_movFor'];

echo "<h2>TRASLADO BD : $id_movForR </h2>";

// INICIO DATOS ORIGINALES
$sql_T 		= "SELECT * FROM mov_traslados WHERE id_movFor = '$id_movForR' LIMIT 1 ";
$sql_TR 	= mysqli_query($dbd2, $sql_T);
$matrizT 	= mysqli_fetch_array($sql_TR);

//$id_movFor 	= $matrizT['id_movFor'];
$id_clienteSE 	= $matrizT['id_cliente'];
$id_contratoSE 	= $matrizT['id_contrato'];

$id_clienteDSE 	= $matrizT['id_clienteD'];
$id_contratoDSE	= $matrizT['id_contratoD'];

$id_unidadSE 	= $matrizT['id_unidad'];
$folio_invSE 	= $matrizT['folio_inv'];
$facturaTSE 	= $matrizT['facturaT'];
$costoTSE 		= $matrizT['costoT'];

$aliasEmergenteSE 	= $matrizT['aliasEmergente'];

$motivoMSE 	= $matrizT['motivoM'];

$kmOSE 		= $matrizT['kmO'];
$fechaOSE 	= $matrizT['fechaO'];
$horaOSE 	= $matrizT['horaO'];
$ciudadOSE 	= $matrizT['ciudadO'];
$estadoOSE 	= $matrizT['estadoO'];
$entregaNOSE= $matrizT['entregaNO'];
$telOSE 	= $matrizT['telO'];
$cpOSE 		= $matrizT['cpO'];

$kmDSE 		= $matrizT['kmD'];
$fechaDSE 	= $matrizT['fechaD'];
$horaDSE 	= $matrizT['horaD'];
$ciudadDSE	= $matrizT['ciudadD'];
$estadoDSE 	= $matrizT['estadoD'];
$recibeNDSE = $matrizT['recibeND'];
$telDSE 	= $matrizT['telD'];
$cpDSE 		= $matrizT['cpD'];

$id_provSE 	= $matrizT['id_prov'];
$conductorSE= $matrizT['conductor'];

$falsoSE 	= $matrizT['falso'];
$obsSE 		= $matrizT['obs'];

/*$sql_TRR 		= mysqli_query($dbd2, $sql_T);
$matrizCC		= mysqli_fetch_assoc($sql_TRR);
$arrayviejo 	= json_encode($matrizCC);*/
$arrayviejo = " id_movForR = $id_movForR , ";
// TERMINA DATOS ORIGINALES


$subido = ''; 

// FECHA DE MEXICO para utilizarla en lugar de la del servidor
date_default_timezone_set('America/Mexico_city');
$fechareg 		= date("Y-m-d H:i:s");
// FECHA DE MEXICO para utilizarla en lugar de la del servidor

if(isset($_POST['Datos']))
{
	
	// MENSAJES DE ERROR
	$error1 = '';
//	if(isset($_POST['id_contrato']) && $_POST['id_contrato'] != 0 ){;}else{$error1 = ':: No indico contrato Origen<br>';}
	$error2 = '';
//	if(isset($_POST['id_contratoD']) && $_POST['id_contratoD'] != 0){;}else{$error2 = ':: No indico contrato Destino<br>';}
	$error3 = '';
	if($_POST['id_prov']!= 0 ){;}else{$error3= ':: No indico proveedor<br>';}
	$error4 = '';
	if($_POST['estadoO']!= 0 ){;}else{$error4= ':: No indico Estado de Origen<br>';}
	$error5 = '';
	if($_POST['estadoD']!= 0 ){;}else{$error5= ':: No indico Estado de Destino<br>';}
	$error6 = '';
//	if($_POST['id_unidad']!= '' && $_POST['id_unidad']!= 0 ){;}else{$error6= ':: No indico Unidad Vehicular';}
	// MENSAJES DE ERROR

	$errorES = $error1.$error2.$error3.$error4.$error5.@$error6;

	if(
		$errorES == '' 
//		$_POST['id_contrato']!='' 
//		&& $_POST['folio_inv']!=''
//		&& $_POST['id_prov']!='' 
//		&& $_POST['facturaT']!='' 
	)
	{
		
			@$id_unidad	  =mysqli_real_escape_string($dbd2, $_POST['id_unidad']);
			@$id_contrato= mysqli_real_escape_string($dbd2, $_POST['id_contrato']);
			@$id_contratoD= mysqli_real_escape_string($dbd2, $_POST['id_contratoD']);

			$folio_inv  = mysqli_real_escape_string($dbd2, $_POST['folio_inv']);
			$facturaT	= mysqli_real_escape_string($dbd2, $_POST['facturaT']);
			$costoT		= mysqli_real_escape_string($dbd2, $_POST['costoT']);

			$id_prov	= mysqli_real_escape_string($dbd2, $_POST['id_prov']);
			$conductor	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['conductor']));
			$motivoM	= mysqli_real_escape_string($dbd2, $_POST['motivoM']);

			$kmO  		= mysqli_real_escape_string($dbd2, $_POST['kmO']);
			$fechaO  	= mysqli_real_escape_string($dbd2, $_POST['fechaO']);
			$horaO  	= mysqli_real_escape_string($dbd2, $_POST['horaO']);
			$ciudadO  	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['ciudadO']));
			$cpO  		= mysqli_real_escape_string($dbd2, $_POST['cpO']);
			$estadoO   	= mysqli_real_escape_string($dbd2, $_POST['estadoO']);
			$entregaNO  = strtoupper(mysqli_real_escape_string($dbd2, $_POST['entregaNO'])) ;
			$telO  		= mysqli_real_escape_string($dbd2, $_POST['telO']);

			$kmD  		= mysqli_real_escape_string($dbd2, $_POST['kmD']);
			$fechaD  	= mysqli_real_escape_string($dbd2, $_POST['fechaD']);
			$horaD  	= mysqli_real_escape_string($dbd2, $_POST['horaD']);
			$ciudadD  	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['ciudadD']));
			$cpD  		= mysqli_real_escape_string($dbd2, $_POST['cpD']);
			$estadoD   	= mysqli_real_escape_string($dbd2, $_POST['estadoD']);
			$recibeND	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['recibeND'])) ;
			$telD  		= mysqli_real_escape_string($dbd2, $_POST['telD']);

			$falso  	= mysqli_real_escape_string($dbd2, @$_POST['falso']);
			if($falso == '' )
				{ $falso = 0;}
			$observaciones  	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['observaciones']));

/*
				echo "<hr>";
				echo $id_unidad."<br>";
				echo $id_contrato."<br>";
				echo $id_contratoD."<br>";
				echo "<hr>";

				echo $folio_inv."<br>";
				echo $facturaT."<br>";
				echo $costoT."<br>";
				echo $id_prov."<br>";
				echo $conductor."<br>";
				echo $motivoM."<br><hr>";

				echo $kmO."<br>";
				echo $fechaO."<br>";
				echo $horaO."<br>";
				echo $ciudadO."<br>";
				echo $cpO."<br>";
				echo $estadoO."<br>";
				echo $entregaNO."<br>";
				echo $telO."<br><hr>";

				echo $kmD."<br>";
				echo $fechaD."<br>";
				echo $horaD."<br>";
				echo $ciudadD."<br>";
				echo $cpD."<br>";
				echo $estadoD."<br>";
				echo $recibeND."<br>";
				echo $telD."<br><hr>";

				echo "<hr>";
				echo $falso."<br>";
				echo $observaciones."<br>";
				echo "<hr>";
*/				
//			$coma = ',';
//			$importeivainc= str_replace($coma,"",$importeivainc);
			$capturo = $_SESSION["id_usuario"];

			// CREAR SENTENCIA UPDATE
			$sql_MT_up = "UPDATE mov_traslados SET ";

			if(isset($_POST['id_contrato']) && $_POST['id_contrato'] != 0 )
				{ $sql_MT_up .= " id_contrato = '$id_contrato' , ";
				  $arrayviejo .= " id_contrato = '$id_contratoSE' , ";}
			if(isset($_POST['id_contratoD']) && $_POST['id_contratoD'] != 0)
				{ $sql_MT_up .= " id_contratoD = '$id_contratoD' , ";
					$arrayviejo .= " id_contratoD = '$id_contratoDSE' , ";}
			if(isset($_POST['id_unidad']) && $_POST['id_unidad']!= '' && $_POST['id_unidad']!= 0 )
				{ $sql_MT_up .= " id_unidad = '$id_unidad' , ";
					$arrayviejo .= " id_unidad = '$id_unidadSE' , ";}

			if($folio_inv != $folio_invSE )
				{ 	$sql_MT_up .= " folio_inv = '$folio_inv' , ";
					$arrayviejo .= " folio_inv = '$folio_invSE' , ";}
			if($facturaT != $facturaTSE )
				{ 	$sql_MT_up .= " facturaT = '$facturaT' , ";
					$arrayviejo .= " facturaT = '$facturaTSE' , ";}
			if($costoT != $costoTSE )
				{ 	$sql_MT_up .= " costoT = '$costoT' , ";
					$arrayviejo .= " costoT = '$costoTSE' , ";}
			if($id_prov != $id_provSE )
				{ 	$sql_MT_up .= " id_prov = '$id_prov' , ";
					$arrayviejo .= " id_prov = '$id_provSE' , ";}
			if($conductor != $conductorSE )
				{ 	$sql_MT_up .= " conductor = '$conductor' , ";
					$arrayviejo .= " conductor = '$conductorSE' , ";}
			if($motivoM != $motivoMSE )
				{ 	$sql_MT_up .= " motivoM = '$motivoM' , ";
					$arrayviejo .= " motivoM = '$motivoMSE' , ";}

			if($kmO != $kmOSE )
				{ 	$sql_MT_up .= " kmO = '$kmO' , ";
					$arrayviejo .= " kmO = '$kmOSE' , ";}
			if($fechaO != $fechaOSE )
				{ 	$sql_MT_up .= " fechaO = '$fechaO' , ";
					$arrayviejo .= " fechaO = '$fechaOSE' , ";}
			if($horaO != $horaOSE )
				{ 	$sql_MT_up .= " horaO = '$horaO' , ";
					$arrayviejo .= " horaO = '$horaOSE' , ";}
			if($ciudadO != $ciudadOSE )
				{ 	$sql_MT_up .= " ciudadO = '$ciudadO' , ";
					$arrayviejo .= " ciudadO = '$ciudadOSE' , ";}
			if($cpO != $cpOSE )
				{ 	$sql_MT_up .= " cpO = '$cpO' , ";
					$arrayviejo .= " cpO = '$cpOSE' , ";}
			if($estadoO != $estadoOSE )
				{ 	$sql_MT_up .= " estadoO = '$estadoO' , ";
					$arrayviejo .= " estadoO = '$estadoOSE' , ";}
			if($entregaNO != $entregaNOSE )
				{ 	$sql_MT_up .= " entregaNO = '$entregaNO' , ";
					$arrayviejo .= " entregaNO = '$entregaNOSE' , ";}
			if($telO != $telOSE )
				{ 	$sql_MT_up .= " telO = '$telO' , ";
					$arrayviejo .= " telO = '$telOSE' , ";}

			if($kmD != $kmDSE )
				{ 	$sql_MT_up .= " kmD = '$kmD' , ";
					$arrayviejo .= " kmD = '$kmDSE' , ";}
			if($fechaD != $fechaDSE )
				{ 	$sql_MT_up .= " fechaD = '$fechaD' , ";
					$arrayviejo .= " fechaD = '$fechaDSE' , ";}
			if($horaD != $horaDSE )
				{ 	$sql_MT_up .= " horaD = '$horaD' , ";
					$arrayviejo .= " horaD = '$horaDSE' , ";}
			if($ciudadD != $ciudadDSE )
				{ 	$sql_MT_up .= " ciudadD = '$ciudadD' , ";
					$arrayviejo .= " ciudadD = '$ciudadDSE' , ";}
			if($cpD != $cpDSE )
				{ 	$sql_MT_up .= " cpD = '$cpD' , ";
					$arrayviejo .= " cpD = '$cpDSE' , ";}
			if($estadoD != $estadoDSE )
				{ 	$sql_MT_up .= " estadoD = '$estadoD' , ";
					$arrayviejo .= " estadoD = '$estadoDSE' , ";}
			if($recibeND != $recibeNDSE )
				{ 	$sql_MT_up .= " recibeND = '$recibeND' , ";
					$arrayviejo .= " recibeND = '$recibeNDSE' , ";}
			if($telD != $telDSE )
				{ 	$sql_MT_up .= " telD = '$telD' , ";
					$arrayviejo .= " telD = '$telD' , ";}

			if($observaciones != $obsSE )
				{ 	$sql_MT_up .= " obs = '$observaciones' , ";
					$arrayviejo .= " obs = '$obsSE' , ";}

			$sql_MT_up .= " falso = '$falso' ";
			$arrayviejo.= " falso = '$falsoSE' ";
			$sql_MT_up .= " WHERE id_movFor = '$id_movForR' ";
			// TERMINA CREAR SENTENCIA UPDATE

			echo "<hr>";
			//echo $sql_MT_up; // PARA CONTROLAR CREACION CORRECTA DE UPDATE QUERY
			echo "<hr>";

			$sql_MT_up_R = mysqli_query($dbd2, $sql_MT_up);


			if($sql_MT_up_R){ // control cambios
									 
				$sql_up 	= mysqli_real_escape_string($dbd2, $sql_MT_up );
				$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
				$sql_control_cambios = "INSERT INTO controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
						VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
						
				$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
				//TERMINA Control Cambios
				echo "<br><h2>ACTUALIZACION EXITOSA</h2><br>";
				include('trasladoRegistrado.php');
			}
			else
			{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2) . "\n"; // PARA DETECTAR ERROR EN QUERY
			}
/**/
	$subido = 'ok'	;
	}
	else
	{
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786; <br> $errorES </p>";
	}
}


if($subido!='ok'){
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
	 $(document).ready(function()
	{
 
		
         $('#search1').keyup(function()
		{
         var search1 = $('#search1').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search1:search1},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result1').html(data);
					}
				}
			});
        });

		$('#search5').keyup(function()
		{
		 var search5 = $('#search5').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search5:search5},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result5').html(data);
					}
				}
			});
		});

		$('#search19').keyup(function()
		{
		 var search19 = $('#search19').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search19:search19},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result19').html(data);
					}
				}
			});
		});

		$('#search20').keyup(function()
		{
		 var search20 = $('#search20').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search20:search20},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result20').html(data);
					}
				}
			});
		});

		$('#search22').keyup(function()
		{
		 var search22 = $('#search22').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search22:search22},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result22').html(data);
					}
				}
			});
		});

		$('#search33').keyup(function()
		{
		 var search33 = $('#search33').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search33:search33},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result33').html(data);
					}
				}
			});
		});

		$('#search23').keyup(function()
		{
		 var search23 = $('#search23').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search23:search23},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result23').html(data);
					}
				}
			});
		});

		$('#search32').keyup(function()
		{
		 var search32 = $('#search32').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search32:search32},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result32').html(data);
					}
				}
			});
		});
 	});
</script>


<fieldset><legend>Registrar Traslado</legend>
<style>
#alta input {min-width:20px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST'  enctype="multipart/form-data" >
	<h2 style='color:blue;'>EDITAR TRASLADO</h2>

<?php
datosxid($id_unidadSE);

echo "
	<table>
	<tr><td colspan=4>UNIDAD ACTUAL</td></tr>
	<tr><td>Id en Bd:</td><td>{$id_unidadSE}</td><td>Serie:</td><td>{$Serie}</td><tr>
	<tr><td>Economico:</td><td><b>{$Economico}</b></td><td>Tipo:</td><td>{$Vehiculo}</td><tr>
	<tr><td>Placas:</td><td>{$Placas}</td><td>Modelo:</td><td>{$Modelo}</td><tr>
	</table>";
?>

<table id='tablaformato' >
<tr><td colspan=2>

<?php // INICIA BLOQUE DATOS GENERALES ?>

<table style="width:100%;">

<!--		<input type='hidden' name='id_unidad' value="<?php echo $id_unidadSE;?>" > -->

	<tr><th>SERIE DE UNIDAD VEHICULAR<br>
			<input type='text' id='search1'>
		</th>
		<td>
				<div id="result1"></div>
		</td>
	</tr>


		<tr>
			<th>ID CONTRATO <span style="color:orange;">ORIGEN</span> ACTUAL <br>
				<?php echo $id_contratoSE; ?>
			</th>
		<?php
			contratoxid($id_contratoSE);
			clientexid($id_cliente);
			echo "<td>
				<b>ID {$id_alan}</b> ::: N.OFICIAL: {$numero} ::: ALIAS_CTO: {$aliasCto}<br>
				<b>{$razonSocial}</b><br> 
				RFC:{$rfc} ::: ALIAS_CTE:{$alias}
				</td>";
		?>
		</tr>
		<tr>
			<th style="height: 20px;">ID CONTRATO <span style="color:orange;">ORIGEN</span><br>
				<input type='text' id='search33' >
				<?php echo $id_contratoSE; ?>
			</th>
			<td>
					<div id="result33"></div>
			</td>
		</tr>


		<tr style="background-color: #ffe7b3;">
			<th>ID CONTRATO <span style="color:#d0e1e1;">DESTINO</span> ACTUAL <br>
				<?php echo $id_contratoSE; ?>
			</th>
		<?php
			contratoxid($id_contratoDSE);
			clientexid($id_cliente);
			echo "<td>
				<b>ID {$id_alan}</b> ::: N.OFICIAL: {$numero} ::: ALIAS_CTO: {$aliasCto}<br>
				<b>{$razonSocial}</b><br> 
				RFC:{$rfc} ::: ALIAS_CTE:{$alias}
				</td>";
		?>
		</tr>
		<tr style="background-color: #ffe7b3;">
			<th style="height: 20px;">ID CONTRATO <span style="color:#d0e1e1;">DESTINO</span><br>
				<input type='text' id='search32'  >
				<?php echo $id_contratoDSE; ?>
			</th>
			<td>
					<div id="result32"></div>
			</td>
		</tr>

		<tr>
			<th>FOLIO INVENTARIO</th>
			<td>
				<input type='text' 
				name='folio_inv' value="<?php echo $folio_invSE;?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>FOLIO FACTURA</th>
			<td>
				<input type='text' style='text-align: right;'
				name='facturaT' value="<?php echo $facturaTSE;?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>COSTO A/I</th>
			<td>
				<input type="number" lang="nb" step=".01" min="0"  style='text-align: right;' 
				name='costoT' value="<?php echo $costoTSE;?>" placeholder='0.00'  >
			</td>
		</tr>

<?php 
$provTArray = array('','','','','','','','','','','','','','');
$provTArray[$id_provSE] = 'selected';
?>
		<tr>
			<th>PROVEEDOR DEL TRASLADO <?php echo $id_provSE;
			echo $provTArray[$id_provSE];?> </th>
			<td>
				<select name = 'id_prov' >
					<option value = '0' <?php echo $provTArray[0];?> >---</option>
					<option value = '1' <?php echo $provTArray[1];?> >FENIX SERVICIOS DE TRASLADOS, S.A. DE C.V.</option>
					<option value = '2' <?php echo $provTArray[2];?> >TRASLADOS PREMIER, S.A. DE C.V.</option>
					<option value = '3' <?php echo $provTArray[3];?> >VITAL TRASLADO AUTOMOTRIZ, S.A. DE C.V.</option>
					<option value = '4' <?php echo $provTArray[4];?> >TRASLADOS SHEKINA</option>
					<option value = '14' <?php echo $provTArray[14];?> >TRASLADOS VISA</option>
					<option value = '5' <?php echo $provTArray[5];?> >J.V. CANCUN</option>
					<option value = '6' <?php echo $provTArray[6];?> >J.V. CUERNAVACA</option>
					<option value = '7' <?php echo $provTArray[7];?> >J.V. GUANAJUATO</option>
					<option value = '8' <?php echo $provTArray[8];?> >J.V. JUCHITAN</option>
					<option value = '9' <?php echo $provTArray[9];?> >J.V. QUERETARO</option>
					<option value = '10' <?php echo $provTArray[10];?> >J.V. TULANCINGO</option>
					<option value = '11' <?php echo $provTArray[11];?> >J.V. POZA RICA</option>
					<option value = '12' <?php echo $provTArray[12];?> >OTROS</option>
					<option value = '13' <?php echo $provTArray[13];?>  >JET VAN CAR RENTAL, S.A. DE C.V.</option>
				</select>
			</td>
		</tr>

		<tr>
			<th>CONDUCTOR</th>
			<td>
				<input type='text' 
				name='conductor' value="<?php echo $conductorSE;?>" placeholder='' 
				 size="55" >
			</td>
		</tr>

<?php 
$motTArray = array('','','','','','','','','','','','','','');
$motTArray[$motivoMSE] = 'selected';
?>
		<tr>
			<th>MOTIVO DEL MOVIMIENTO</th>
			<td>
				<select name = 'motivoM' >
					<option value = '0' <?php echo $motTArray[0];?>  >---</option>
					<option value = '1' <?php echo $motTArray[1];?>  >Cambio de patio </option>
					<option value = '2' <?php echo $motTArray[2];?>  >Camb​io de proyecto ​por sust.</option>
					<option value = '3' <?php echo $motTArray[3];?>  >Cortesía </option>
					<option value = '4' <?php echo $motTArray[4];?>  >Integración a proyecto </option>
					<option value = '5' <?php echo $motTArray[5];?>  >Recolección </option>
					<option value = '6' <?php echo $motTArray[6];?>  >​Resguardo​</option>
					<option value = '7' <?php echo $motTArray[7];?>  >Sustituto</option>
					<option value = '8' <?php echo $motTArray[8];?>  >Taller o servicio</option>
					<option value = '9' <?php echo $motTArray[9];?>  >Termino de proyecto </option>
					<option value = '10' <?php echo $motTArray[10];?>  >Verificación </option>
					<option value = '11' <?php echo $motTArray[11];?>  >Conversión/equipamiento</option>
					<option value = '12' <?php echo $motTArray[12];?>  >​Venta​</option>
					<option value = '13' <?php echo $motTArray[13];?>  >Regresa a Proyecto</option>
					<option value = '14' <?php echo $motTArray[14];?>  >Reubicación por Dependencia</option>



				</select>
			</td>
		</tr>
</table>

<?php // TERMINA BLOQUE DATOS GENERALES ?>

</td></tr>
<tr><td>


<?php // INICIA BLOQUE DATOS ORIGEN ?>
<table>
		<tr><th colspan=2>ORIGEN</th></tr>
		<tr>
			<th>KILOMETRAJE</th>
			<td>
				<input type="number" lang="nb" step="1" min="0" 
				name='kmO' value="<?php echo $kmOSE;?>" placeholder='0000'  >
			</td>
		</tr>
		
		<tr>
			<th>FECHA</th>
			<td>
				<input type='date' 
				name='fechaO' value="<?php 

				if(isset($fechaOSE) &&  $fechaOSE != ''){echo $fechaOSE;} else {echo date("Y-m-d");}


				//echo date("Y-m-d");?><?php //echo @$_POST['fechaO'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>HORA</th>
			<td>
				<input type='time' 
				name='horaO' value="<?php 

				if(isset($horaOSE) &&  $horaOSE != ''){echo $horaOSE;} else {echo "12:00:00";}
//echo date("h:i:s");

				?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>CIUDAD</th>
			<td>
				<input type='text' 
				name='ciudadO' value="<?php echo $ciudadOSE;?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>CODIGO POSTAL</th>
			<td>
				<input type='number' 
				name='cpO' value="<?php echo $cpOSE;?>" placeholder='' 
				step="1" min="0" max="100000"  >
			</td>
		</tr>		

<?php 
$edoTArray = array( '','','','','','','','','','',
					'','','','','','','','','','',
					'','','','','','','','','','',
					'','','','','','','','','','');
$edoTArray[$estadoOSE] = 'selected';
?>
		<tr>
			<th>ESTADO</th>
			<td>
				<select name = 'estadoO' >
				<?php
					$sqlEstados = "SELECT * FROM estadosR";
					$sqlEstadosR = mysqli_query($dbd2, $sqlEstados);				

					while($row = mysqli_fetch_array($sqlEstadosR)) 
					{
					$id_estado 		= $row['id_estado'];
					$descripcion 	= $row['descripcion'];
					echo "<option value='{$id_estado}' $edoTArray[$id_estado] > 
					".$descripcion."</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<th>PERSONA QUE ENTREGA</th>
			<td>
				<input type='text' 
				name='entregaNO' value="<?php echo $entregaNOSE;?>" placeholder='' >
			</td>
		</tr>

		<tr>
			<th>TELEFONO</th>
			<td>
				<input type='text' 
				name='telO' value="<?php echo $telOSE;?>" placeholder=''  >
			</td>
		</tr>
</table>
<?php // TERMINA BLOQUE DATOS ORIGEN ?>


</td><td>


<?php // INICIA BLOQUE DATOS DESTINO  ?>
<table>
		<tr><th colspan=2>DESTINO</th></tr>
		<tr>
			<th>KILOMETRAJE</th>
			<td>
				<input type="number" lang="nb" step="1" min="0" 
				name='kmD' value="<?php echo $kmDSE;?>" placeholder='0000'  >
			</td>
		</tr>
		
		<tr>
			<th>FECHA</th>
			<td>
				<input type='date' 
				name='fechaD' value="<?php if(isset($fechaDSE) &&  $fechaDSE != ''){echo $fechaDSE;} else {echo date("Y-m-d");}?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>HORA</th>
			<td>
				<input type='time' 
				name='horaD' value="<?php 

				if(isset($horaDSE) &&  $horaDSE != ''){echo $horaDSE;} else {echo "12:00:00";}


				?>" placeholder=''  >
			</td>
		</tr>		

		<tr>
			<th>CIUDAD</th>
			<td>
				<input type='text' 
				name='ciudadD' value="<?php echo $ciudadDSE;?>" placeholder=''  >
			</td>
		</tr>


		<tr>
			<th>CODIGO POSTAL</th>
			<td>
				<input type='number' 
				name='cpD' value="<?php echo $cpDSE;?>" placeholder='' 
				step="1" min="0" max="100000"  >
			</td>
		</tr>		


<?php 
$edoTDArray = array( '','','','','','','','','','',
					'','','','','','','','','','',
					'','','','','','','','','','',
					'','','','','','','','','','');
$edoTDArray[$estadoDSE] = 'selected';
?>
		<tr>
			<th>ESTADO</th>
			<td>
				<select name = 'estadoD' >
				<?php
					$sqlEstados = "SELECT * FROM estadosR";
					$sqlEstadosR = mysqli_query($dbd2, $sqlEstados);				

					while($row = mysqli_fetch_array($sqlEstadosR)) 
					{
					$id_estado 		= $row['id_estado'];
					$descripcion 	= $row['descripcion'];
					echo "<option value='{$id_estado}' $edoTDArray[$id_estado] >
					".$descripcion."</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<th>PERSONA QUE RECIBE</th>
			<td>
				<input type='text' 
				name='recibeND' value="<?php echo $recibeNDSE;?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>TELEFONO</th>
			<td>
				<input type='text' 
				name='telD' value="<?php echo $telDSE;?>" placeholder=''  >
			</td>
		</tr>
</table>
<?php // TERMINA BLOQUE DATOS DESTINO  ?>

</td></tr>

<?php $falsoChkd = ($falsoSE==1)?'checked':'';?>
<tr>	
	<td colspan="2">
		<table style="width:100%;">
			<tr>
				<td style="text-align:center;" >
					<input id='falso' type="checkbox" name="falso" value="1"  <?php echo $falsoChkd;?> >
					<label for='falso'><b>REGISTRAR FALSO</b></label> 
				</td>
				<td>
				<b>OBSERVACIONES</b>
				</td>
				<td>
				<input type='text' 
				name='observaciones' value="<?php echo $obsSE;?>" placeholder='' maxlength='100'  >
				</td>
			</tr>
		</table>
	</td>
</tr>

<tr>
	<td  colspan=2>
		<table style="width:100%;">
			<tr>
				<td style="text-align:center;" >
					<input id="gobutton2" type="submit" name="Datos" value="GUARDAR EDICION"> 
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>


</form>
</fieldset>

<?php
} // CIERRE MOSTRAR FORMULARIO

} // FIN PRIVILEGIO VISTA EJECUTIVOS

include("1footer.php");?>