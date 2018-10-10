<?php
include '1header.php';
// EDITAR SINIESTRO

$id_siniestro = $_GET['id_siniestro'];

// if(){;}
$pagina 	= @$_GET['pagina'];   // PARA PODER VOLVER AL A PAGINA DE LA QUE VIENE


if($_SESSION["siniestro"] > 1){  // APERTURA PRIVILEGIOS


########## ########## ########## ########## ########## 
$sql_sin 	= "SELECT * FROM `siniestro` WHERE `id_siniestro` = '$id_siniestro' LIMIT 1 ";
$sql_sin_R 	= mysqli_query($dbd2, $sql_sin);
$sql_sin_M 	= mysqli_fetch_array($sql_sin_R);

$id_siniestro 		=	$sql_sin_M['id_siniestro'];
$id_unidad 			=	$sql_sin_M['id_unidad'];
$id_cliente 		=	$sql_sin_M['id_cliente'];
$id_contrato 		=	$sql_sin_M['id_contrato'];

$edoSinSE			=	$sql_sin_M['edoSin'];
$cdSinSE 			=	$sql_sin_M['cdSin'];
$domSinSE 			=	$sql_sin_M['domSin'];
$motivoSE 			= 	$sql_sin_M['motivo'];
$aseguradoraSE 		=	$sql_sin_M['aseguradora'];
$fechaSinSE 		= 	$sql_sin_M['fechaSin'];
$numSinSE			= 	$sql_sin_M['numSin'];
$numPolizaSE		= 	$sql_sin_M['numPoliza'];
$numIncisoSE 		=	$sql_sin_M['numInciso'];

$numReporteSE 		=	$sql_sin_M['numReporte'];
$fechaRepSE 		=	$sql_sin_M['fechaRep'];
$tipoSinSE 			=	$sql_sin_M['tipoSin'];

$telCondSE 			=	$sql_sin_M['telCond'];
$edadCondSE 		=	$sql_sin_M['edadCond'];
$nomConductorSE 	=	$sql_sin_M['nomConductor'];

$statusSE			=	$sql_sin_M['status'];
$responsabilidadSE 	=	$sql_sin_M['responsabilidad'];
$ejecutivoAsgSE 	=	$sql_sin_M['ejecutivoAsg'];
$corralonSE 		= 	$sql_sin_M['corralon'];
$contactoCteSE 		=	$sql_sin_M['contactoCte'];
$datosCteSE 		= 	$sql_sin_M['datosCte'];
$contactoAsgSE		= 	$sql_sin_M['contactoAsg'];
$telAsgSE			= 	$sql_sin_M['telAsg'];
$fechaAsigAsgSE 	=	$sql_sin_M['fechaAsigAsg'];
$gestorJVSE 		=	$sql_sin_M['gestorJV'];

$telGJVSE			=	$sql_sin_M['telGJV'];
$fechaAcredPropSE 	=	$sql_sin_M['fechaAcredProp'];
$fechaICrrlnSE 		=	$sql_sin_M['fechaICrrln'];
$fechaECrrlnSE 		= 	$sql_sin_M['fechaECrrln'];
$multaSE 			=	$sql_sin_M['multa'];
$costoCrrlnSE 		= 	$sql_sin_M['costoCrrln'];
$gastosCrrlnSE		= 	$sql_sin_M['gastosCrrln'];
$agenciaTallerSE	= 	$sql_sin_M['agenciaTaller'];
$obsSinSE 			=	$sql_sin_M['obsSin'];
$cartaFactSE 		=	$sql_sin_M['cartaFact'];

$factSE				=	$sql_sin_M['fact'];
$tcSE 				=	$sql_sin_M['tc'];
$tenenciaSE 		=	$sql_sin_M['tenencia'];
$denunciaMPSE 		= 	$sql_sin_M['denunciaMP'];
$acredDtoSE 		=	$sql_sin_M['acredDto'];
$oficioLibSE 		= 	$sql_sin_M['oficioLib'];
$otrosDocSE			= 	$sql_sin_M['otrosDoc'];
$obsDesarrolloSE	= 	$sql_sin_M['obsDesarrollo'];
$capturoSE 			=	$sql_sin_M['capturo'];

$arrayviejo 		= " id_siniestro = $id_siniestro , ";

datosxid($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);

########## ########## ########## ########## ########## 

echo "<h2><span style='color:blue;' >HISTORIAL DEL SINIESTRO</span></h2>";
?>
<table>
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
			<b>PROYECTO-CLIENTE</b>  
			<br>Cliente:
			<?php echo   $razonSocial;?>
			<br>Contrato:
			<?php echo "id ::: ".$id_alan." ::: ".$numero ;?>			
		</td>
		<td>
		</td>
	</tr>
</table>
<?php 

$flag= '';

if($_SESSION["siniestro"] > 1){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO


//proceso del formulario // si existe "enviar"...
if (isset ($_POST['Guardar'])) 
{

$edoSinE  		=  mysqli_real_escape_string($dbd2, $_POST['edoSinE']);
$cdSinE   		=  mysqli_real_escape_string($dbd2, $_POST['cdSinE']);
$domSinE   		=  mysqli_real_escape_string($dbd2, $_POST['domSinE']);
$motivoE   		=  mysqli_real_escape_string($dbd2, $_POST['motivoE']);
$aseguradoraE   =  mysqli_real_escape_string($dbd2, $_POST['aseguradoraE']);
$fechaSinE   	=  mysqli_real_escape_string($dbd2, $_POST['fechaSinE']);
$numSinE  		=  mysqli_real_escape_string($dbd2, $_POST['numSinE']);
$numPolizaE  	=  mysqli_real_escape_string($dbd2, $_POST['numPolizaE']);
$numIncisoE   	=  mysqli_real_escape_string($dbd2, $_POST['numIncisoE']);
$numReporteE   	=  mysqli_real_escape_string($dbd2, $_POST['numReporteE']);
$fechaRepE   	=  mysqli_real_escape_string($dbd2, $_POST['fechaRepE']);
$tipoSinE   	=  mysqli_real_escape_string($dbd2, $_POST['tipoSinE']);
$telCondE   	=  mysqli_real_escape_string($dbd2, $_POST['telCondE']);
$edadCondE  	=  mysqli_real_escape_string($dbd2, $_POST['edadCondE']);
$nomConductorE  =  mysqli_real_escape_string($dbd2, $_POST['nomConductorE']);
$statusE  		=  mysqli_real_escape_string($dbd2, $_POST['statusE']);
$responsabilidadE  =  mysqli_real_escape_string($dbd2, $_POST['responsabilidadE']);
$ejecutivoAsgE  =  mysqli_real_escape_string($dbd2, $_POST['ejecutivoAsgE']);
$corralonE   	=  mysqli_real_escape_string($dbd2, $_POST['corralonE']);
$contactoCteE   =  mysqli_real_escape_string($dbd2, $_POST['contactoCteE']);
$datosCteE   	=  mysqli_real_escape_string($dbd2, $_POST['datosCteE']);
$contactoAsgE  	=  mysqli_real_escape_string($dbd2, $_POST['contactoAsgE']);
$telAsgE  		=  mysqli_real_escape_string($dbd2, $_POST['telAsgE']);
$fechaAsigAsgE  =  mysqli_real_escape_string($dbd2, $_POST['fechaAsigAsgE']);
$gestorJVE   	=  mysqli_real_escape_string($dbd2, $_POST['gestorJVE']);
$telGJVE  		=  mysqli_real_escape_string($dbd2, $_POST['telGJVE']);
$fechaAcredPropE=  mysqli_real_escape_string($dbd2, $_POST['fechaAcredPropE']);
$fechaICrrlnE   =  mysqli_real_escape_string($dbd2, $_POST['fechaICrrlnE']);
$fechaECrrlnE   =  mysqli_real_escape_string($dbd2, $_POST['fechaECrrlnE']);
$multaE   		=  mysqli_real_escape_string($dbd2, $_POST['multaE']);
$costoCrrlnE   	=  mysqli_real_escape_string($dbd2, $_POST['costoCrrlnE']);
$gastosCrrlnE  	=  mysqli_real_escape_string($dbd2, $_POST['gastosCrrlnE']);
$agenciaTallerE =  mysqli_real_escape_string($dbd2, $_POST['agenciaTallerE']);
$obsSinE   		=  mysqli_real_escape_string($dbd2, $_POST['obsSinE']);
$cartaFactE   	=  mysqli_real_escape_string($dbd2, $_POST['cartaFactE']);
$factE  		=  mysqli_real_escape_string($dbd2, $_POST['factE']);
$tcE   			=  mysqli_real_escape_string($dbd2, $_POST['tcE']);
$tenenciaE   	=  mysqli_real_escape_string($dbd2, $_POST['tenenciaE']);
$denunciaMPE   	=  mysqli_real_escape_string($dbd2, $_POST['denunciaMPE']);
$acredDtoE   	=  mysqli_real_escape_string($dbd2, $_POST['acredDtoE']);
$oficioLibE   	=  mysqli_real_escape_string($dbd2, $_POST['oficioLibE']);
$otrosDocE  	=  mysqli_real_escape_string($dbd2, $_POST['otrosDocE']);
$obsDesarrolloE =  mysqli_real_escape_string($dbd2, $_POST['obsDesarrolloE']);
$capturoE   	=  mysqli_real_escape_string($dbd2, $_POST['capturoE']);

	// CREAR UPDATE QUERY
	$sql_SUP = "UPDATE siniestro SET ";

	if($edoSinE != $edoSinSE )
	{ 	$sql_SUP 	.= " edoSin = '$edoSinE' , ";
		$arrayviejo .= " edoSin = '$edoSinSE' , ";}
	if($cdSinE != $cdSinSE )
	{ 	$sql_SUP 	.= " cdSin = '$cdSinE' , ";
		$arrayviejo .= " cdSin = '$cdSinSE' , ";}
	if($domSinE != $domSinSE )
	{ 	$sql_SUP 	.= " domSin = '$domSinE' , ";
		$arrayviejo .= " domSin = '$domSinSE' , ";}
	if($motivoE != $motivoSE )
	{ 	$sql_SUP 	.= " motivo = '$motivoE' , ";
		$arrayviejo .= " motivo = '$motivoSE' , ";}
	if($aseguradoraE != $aseguradoraSE )
	{ 	$sql_SUP 	.= " aseguradora = '$aseguradoraE' , ";
		$arrayviejo .= " aseguradora = '$aseguradoraSE' , ";}
	if($fechaSinE != $fechaSinSE )
	{ 	$sql_SUP 	.= " fechaSin = '$fechaSinE' , ";
		$arrayviejo .= " fechaSin = '$fechaSinSE' , ";}
	if($numSinE != $numSinSE )
	{ 	$sql_SUP 	.= " numSin = '$numSinE' , ";
		$arrayviejo .= " numSin = '$numSinSE' , ";}
	if($numPolizaE != $numPolizaSE )
	{ 	$sql_SUP 	.= " numPoliza = '$numPolizaE' , ";
		$arrayviejo .= " numPoliza = '$numPolizaSE' , ";}
	if($numIncisoE != $numIncisoSE )
	{ 	$sql_SUP 	.= " numInciso = '$numIncisoE' , ";
		$arrayviejo .= " numInciso = '$numIncisoSE' , ";}
	if($numReporteE != $numReporteSE )
	{ 	$sql_SUP 	.= " numReporte = '$numReporteE' , ";
		$arrayviejo .= " numReporte = '$numReporteSE' , ";}
	if($fechaRepE != $fechaRepSE )
	{ 	$sql_SUP 	.= " fechaRep = '$fechaRepE' , ";
		$arrayviejo .= " fechaRep = '$fechaRepSE' , ";}		
	if($tipoSinE != $tipoSinSE )
	{ 	$sql_SUP 	.= " tipoSin = '$tipoSinE' , ";
		$arrayviejo .= " tipoSin = '$tipoSinSE' , ";}
	if($telCondE != $telCondSE )
	{ 	$sql_SUP 	.= " telCond = '$telCondE' , ";
		$arrayviejo .= " telCond = '$telCondSE' , ";}
	if($edadCondE != $edadCondSE )
	{ 	$sql_SUP 	.= " edadCond = '$edadCondE' , ";
		$arrayviejo .= " edadCond = '$edadCondSE' , ";}
	if($nomConductorE != $nomConductorSE )
	{ 	$sql_SUP 	.= " nomConductor = '$nomConductorE' , ";
		$arrayviejo .= " nomConductor = '$nomConductorSE' , ";}
	if($statusE != $statusSE )
	{ 	$sql_SUP 	.= " status = '$statusE' , ";
		$arrayviejo .= " status = '$statusSE' , ";}
	if($responsabilidadE != $responsabilidadSE )
	{ 	$sql_SUP 	.= " responsabilidad = '$responsabilidadE' , ";
		$arrayviejo .= " responsabilidad = '$responsabilidadSE' , ";}
	if($ejecutivoAsgE != $ejecutivoAsgSE )
	{ 	$sql_SUP 	.= " ejecutivoAsg = '$ejecutivoAsgE' , ";
		$arrayviejo .= " ejecutivoAsg = '$ejecutivoAsgSE' , ";}
	if($corralonE != $corralonSE )
	{ 	$sql_SUP 	.= " corralon = '$corralonE' , ";
		$arrayviejo .= " corralon = '$corralonSE' , ";}
	if($contactoCteE != $contactoCteSE )
	{ 	$sql_SUP 	.= " contactoCte = '$contactoCteE' , ";
		$arrayviejo .= " contactoCte = '$contactoCteSE' , ";}
	if($datosCteE != $datosCteSE )
	{ 	$sql_SUP 	.= " datosCte = '$datosCteE' , ";
		$arrayviejo .= " datosCte = '$datosCteSE' , ";}
	if($contactoAsgE != $contactoAsgSE )
	{ 	$sql_SUP 	.= " contactoAsg = '$contactoAsgE' , ";
		$arrayviejo .= " contactoAsg = '$contactoAsgSE' , ";}
	if($telAsgE != $telAsgSE )
	{ 	$sql_SUP 	.= " telAsg = '$telAsgE' , ";
		$arrayviejo .= " telAsg = '$telAsgSE' , ";}
	if($fechaAsigAsgE != $fechaAsigAsgSE )
	{ 	$sql_SUP 	.= " fechaAsigAsg = '$fechaAsigAsgE' , ";
		$arrayviejo .= " fechaAsigAsg = '$fechaAsigAsgSE' , ";}
	if($gestorJVE != $gestorJVSE )
	{ 	$sql_SUP 	.= " gestorJV = '$gestorJVE' , ";
		$arrayviejo .= " gestorJV = '$gestorJVSE' , ";}
	if($telGJVE != $telGJVSE )
	{ 	$sql_SUP 	.= " telGJV = '$telGJVE' , ";
		$arrayviejo .= " telGJV = '$telGJVSE' , ";}
	if($fechaAcredPropE != $fechaAcredPropSE )
	{ 	$sql_SUP 	.= " fechaAcredProp = '$fechaAcredPropE' , ";
		$arrayviejo .= " fechaAcredProp = '$fechaAcredPropSE' , ";}
	if($fechaICrrlnE != $fechaICrrlnSE )
	{ 	$sql_SUP 	.= " fechaICrrln = '$fechaICrrlnE' , ";
		$arrayviejo .= " fechaICrrln = '$fechaICrrlnSE' , ";}
	if($fechaECrrlnE != $fechaECrrlnSE )
	{ 	$sql_SUP 	.= " fechaECrrln = '$fechaECrrlnE' , ";
		$arrayviejo .= " fechaECrrln = '$fechaECrrlnSE' , ";}
	if($multaE != $multaSE )
	{ 	$sql_SUP 	.= " multa = '$multaE' , ";
		$arrayviejo .= " multa = '$multaSE' , ";}
	if($costoCrrlnE != $costoCrrlnSE )
	{ 	$sql_SUP 	.= " costoCrrln = '$costoCrrlnE' , ";
		$arrayviejo .= " costoCrrln = '$costoCrrlnSE' , ";}
	if($gastosCrrlnE != $gastosCrrlnSE )
	{ 	$sql_SUP 	.= " gastosCrrln = '$gastosCrrlnE' , ";
		$arrayviejo .= " gastosCrrln = '$gastosCrrlnSE' , ";}
	if($agenciaTallerE != $agenciaTallerSE )
	{ 	$sql_SUP 	.= " agenciaTaller = '$agenciaTallerE' , ";
		$arrayviejo .= " agenciaTaller = '$agenciaTallerSE' , ";}
	if($obsSinE != $obsSinSE )
	{ 	$sql_SUP 	.= " obsSin = '$obsSinE' , ";
		$arrayviejo .= " obsSin = '$obsSinSE' , ";}
	if($cartaFactE != $cartaFactSE )
	{ 	$sql_SUP 	.= " cartaFact = '$cartaFactE' , ";
		$arrayviejo .= " cartaFact = '$cartaFactSE' , ";}
	if($factE != $factSE )
	{ 	$sql_SUP 	.= " fact = '$factE' , ";
		$arrayviejo .= " fact = '$factSE' , ";}
	if($tcE != $tcSE )
	{ 	$sql_SUP 	.= " tc = '$tcE' , ";
		$arrayviejo .= " tc = '$tcSE' , ";}
	if($tenenciaE != $tenenciaSE )
	{ 	$sql_SUP 	.= " tenencia = '$tenenciaE' , ";
		$arrayviejo .= " tenencia = '$tenenciaSE' , ";}
	if($denunciaMPE != $denunciaMPSE )
	{ 	$sql_SUP 	.= " denunciaMP = '$denunciaMPE' , ";
		$arrayviejo .= " denunciaMP = '$denunciaMPSE' , ";}
	if($acredDtoE != $acredDtoSE )
	{ 	$sql_SUP 	.= " acredDto = '$acredDtoE' , ";
		$arrayviejo .= " acredDto = '$acredDtoSE' , ";}
	if($oficioLibE != $oficioLibSE )
	{ 	$sql_SUP 	.= " oficioLib = '$oficioLibE' , ";
		$arrayviejo .= " oficioLib = '$oficioLibSE' , ";}
	if($otrosDocE != $otrosDocSE )
	{ 	$sql_SUP 	.= " otrosDoc = '$otrosDocE' , ";
		$arrayviejo .= " otrosDoc = '$otrosDocSE' , ";}
	if($obsDesarrolloE != $obsDesarrolloSE )
	{ 	$sql_SUP 	.= " obsDesarrollo = '$obsDesarrolloE' , ";
		$arrayviejo .= " obsDesarrollo = '$obsDesarrolloSE' , ";}

	$sql_SUP 	.= " capturo = '$capturoSE' ";
	$sql_SUP 	.= " WHERE id_siniestro = '$id_siniestro' ";

	$sql_SUPR = mysqli_query($dbd2, $sql_SUP);

	$capturo = $_SESSION['id_usuario'];


	if($sql_SUPR)
	{ // control cambios
									 
		$sql_up 	= mysqli_real_escape_string($dbd2, $sql_SUP);
		$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo);
						
		$sql_control_cambios = "INSERT INTO controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
						VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
						
		$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
				//TERMINA Control Cambios
		echo "<br><h2>ACTUALIZACION EXITOSA</h2><br>";
		//include('trasladoRegistrado.php');
		$flag = 'ok';		
	}
	else
	{
		echo mysqli_errno($dbd2) .": ".mysqli_error($dbd2)."\n"; // PARA DETECTAR ERROR EN QUERY
	}

}


echo @$mensaje; /*mostramos el estado de envio del form */ 

if (@$flag!='ok') {  // INICIA Mostrar formulario  ?>


<form action='' method='POST'  >
<table style='table-layout: fixed;'  >

<?php 
$edoSinArray = array( '','','','','','','','','','',
					'','','','','','','','','','',
					'','','','','','','','','','',
					'','','','','','','','','','');
$edoSinArray[$edoSinSE] = 'selected';
?>
		<tr>
			<th>ESTADO OCURRIO</th>
			<td>
				<select name = 'edoSinE' >
				<?php
					$sqlEstados = "SELECT * FROM estadosR";
					$sqlEstadosR = mysqli_query($dbd2, $sqlEstados);				

					while($row = mysqli_fetch_array($sqlEstadosR)) 
					{
					$id_estado 		= $row['id_estado'];
					$descripcion 	= $row['descripcion'];
					echo "<option value='{$id_estado}' $edoSinArray[$id_estado] >
					".$descripcion."</option>";
					}
				?>
				</select>
			</td>
		</tr>

<tr><th>Ciudad ocurrio</th>
	<td><input type = 'text' size="100"  name='cdSinE' value=  '<?php echo $cdSinSE ; ?>' ></td>
</tr>
<tr><th>Domicilio</th>
	<td><input type = 'text' size="100"  name='domSinE' value=  '<?php echo $domSinSE ; ?>' ></td>
</tr>
<tr><th>Motivo</th>
	<td><input type = 'text' size="100"  name='motivoE' value=  '<?php echo $motivoSE ; ?>' ></td>
</tr>
<tr><th>Aseguradora</th>
	<td><input type = 'text' size="100"  name='aseguradoraE' value=  '<?php echo $aseguradoraSE ; ?>' ></td>
</tr>
<tr><th>Fecha del Siniestro</th>
	<td><input type = 'text' size="100"  name='fechaSinE' value=  '<?php echo $fechaSinSE ; ?>' ></td>
</tr>
<tr><th>Numero de Siniestro</th>
	<td><input type = 'text' size="100"  name='numSinE' value=  '<?php echo $numSinSE; ?>' ></td>
</tr>
<tr><th>Numero de Poliza</th>
	<td><input type = 'text' size="100"  name='numPolizaE' value=  '<?php echo $numPolizaSE; ?>' ></td>
</tr>
<tr><th>Numero de Inciso</th>
	<td><input type = 'text' size="100"  name='numIncisoE' value=  '<?php echo $numIncisoSE ; ?>' ></td>
</tr>

<tr><th>Numero de Reporte</th>
	<td><input type = 'text' size="100"  name='numReporteE' value=  '<?php echo $numReporteSE ; ?>' ></td>
</tr>
<tr><th>Fecha de Reporte</th>
	<td><input type = 'text' size="100"  name='fechaRepE' value=  '<?php echo $fechaRepSE ; ?>' ></td>
</tr>
<tr><th>Tipo de Siniestro</th>
	<td><input type = 'text' size="100"  name='tipoSinE' value=  '<?php echo $tipoSinSE ; ?>' ></td>
</tr>

<tr><th>Telefono Conductor</th>
	<td><input type = 'text' size="100"  name='telCondE' value=  '<?php echo $telCondSE ; ?>' ></td>
</tr>
<tr><th>Edad Conductor</th>
	<td><input type = 'text' size="100"  name='edadCondE' value=  '<?php echo $edadCondSE ; ?>' ></td>
</tr>
<tr><th>Nombre Conductor</th>
	<td><input type = 'text' size="100"  name='nomConductorE' value=  '<?php echo $nomConductorSE ; ?>' ></td>
</tr>

<tr><th>STATUS</th>
	<td><input type = 'text' size="100"  name='statusE' value=  '<?php echo $statusSE; ?>' ></td>
</tr>
<tr><th>Responsabilidad</th>
	<td><input type = 'text' size="100"  name='responsabilidadE' value=  '<?php echo $responsabilidadSE; ?>' ></td>
</tr>
<tr><th>Ejecutivo Asignado Asg</th>
	<td><input type = 'text' size="100"  name='ejecutivoAsgE' value=  '<?php echo $ejecutivoAsgSE ; ?>' ></td>
</tr>
<tr><th>Corralon</th>
	<td><input type = 'text' size="100"  name='corralonE' value=  '<?php echo $corralonSE ; ?>' ></td>
</tr>
<tr><th>Contacto Cliente</th>
	<td><input type = 'text' size="100"  name='contactoCteE' value=  '<?php echo $contactoCteSE ; ?>' ></td>
</tr>
<tr><th>Datos Cliente</th>
	<td><input type = 'text' size="100"  name='datosCteE' value=  '<?php echo $datosCteSE ; ?>' ></td>
</tr>
<tr><th>Contacto Aseguradora</th>
	<td><input type = 'text' size="100"  name='contactoAsgE' value=  '<?php echo $contactoAsgSE; ?>' ></td>
</tr>
<tr><th>Telefono Aseguradora</th>
	<td><input type = 'text' size="100"  name='telAsgE' value=  '<?php echo $telAsgSE; ?>' ></td>
</tr>
<tr><th>Fecha Asignacion Aseguradora</th>
	<td><input type = 'text' size="100"  name='fechaAsigAsgE' value=  '<?php echo $fechaAsigAsgSE ; ?>' ></td>
</tr>
<tr><th>Gestor Jet Van</th>
	<td><input type = 'text' size="100"  name='gestorJVE' value=  '<?php echo $gestorJVSE ; ?>' ></td>
</tr>

<tr><th>Telefono Gestor Jet Van</th>
	<td><input type = 'text' size="100"  name='telGJVE' value=  '<?php echo $telGJVSE; ?>' ></td>
</tr>
<tr><th>Fecha Acreditacion Propiedad</th>
	<td><input type = 'text' size="100"  name='fechaAcredPropE' value=  '<?php echo $fechaAcredPropSE; ?>' ></td>
</tr>
<tr><th>Fecha INGRESO Corralon</th>
	<td><input type = 'text' size="100"  name='fechaICrrlnE' value=  '<?php echo $fechaICrrlnSE ; ?>' ></td>
</tr>
<tr><th>Fecha EGRESO Corralon</th>
	<td><input type = 'text' size="100"  name='fechaECrrlnE' value=  '<?php echo $fechaECrrlnSE ; ?>' ></td>
</tr>
<tr><th>Multa</th>
	<td><input type = 'text' size="100"  name='multaE' value=  '<?php echo $multaSE ; ?>' ></td>
</tr>
<tr><th>Costo Corralon</th>
	<td><input type = 'text' size="100"  name='costoCrrlnE' value=  '<?php echo $costoCrrlnSE ; ?>' ></td>
</tr>
<tr><th>Gastos Corralon</th>
	<td><input type = 'text' size="100"  name='gastosCrrlnE' value=  '<?php echo $gastosCrrlnSE; ?>' ></td>
</tr>
<tr><th>Agencia o Taller</th>
	<td><input type = 'text' size="100"  name='agenciaTallerE' value=  '<?php echo $agenciaTallerSE; ?>' ></td>
</tr>
<tr><th>Observaciones SINIESTRO (Hecho)</th>
	<td><input type = 'text' size="100"  name='obsSinE' value=  '<?php echo $obsSinSE ; ?>' ></td>
</tr>
<tr><th>Carta Factura</th>
	<td><input type = 'text' size="100"  name='cartaFactE' value=  '<?php echo $cartaFactSE ; ?>' ></td>
</tr>

<tr><th>Factura</th>
	<td><input type = 'text' size="100"  name='factE' value=  '<?php echo $factSE; ?>' ></td>
</tr>
<tr><th>Tarjeta de Circulación</th>
	<td><input type = 'text' size="100"  name='tcE' value=  '<?php echo $tcSE ; ?>' ></td>
</tr>
<tr><th>Tenencia</th>
	<td><input type = 'text' size="100"  name='tenenciaE' value=  '<?php echo $tenenciaSE ; ?>' ></td>
</tr>
<tr><th>Denuncia MP</th>
	<td><input type = 'text' size="100"  name='denunciaMPE' value=  '<?php echo $denunciaMPSE ; ?>' ></td>
</tr>
<tr><th>Acreditación</th>
	<td><input type = 'text' size="100"  name='acredDtoE' value=  '<?php echo $acredDtoSE ; ?>' ></td>
</tr>
<tr><th>Oficio Liberación</th>
	<td><input type = 'text' size="100"  name='oficioLibE' value=  '<?php echo $oficioLibSE ; ?>' ></td>
</tr>
<tr><th>Otros Documentos</th>
	<td><input type = 'text' size="100"  name='otrosDocE' value=  '<?php echo $otrosDocSE; ?>' ></td>
</tr>
<tr><th>Observaciones DESARROLLO</th>
	<td><input type = 'text' size="100"  name='obsDesarrolloE' value=  '<?php echo $obsDesarrolloSE; ?>' ></td>
</tr>


<tr><th>SEGUIMIENTO</th>
	<td><input type = 'hidden' size="100"  name='capturoE' value=  '<?php echo $capturoSE ; ?>' ></td>
</tr>

<tr><td colspan='2'>
	<input type = 'submit' name='Guardar' value='Guardar Cambios'></td>
</tr>
</table>
</form>

<?php

	}  // TERMINA Mostrar formulario  
} // CIERRE PRIVILEGIOS 


} // CIERRA PRIVILEGIOS

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
       ";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    echo "
        <a href='sinRes.php?pagina=$pagina' style='text-decoration:none;'>
        <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen SINIESTROS'>
        </a>
         ";
 // BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
echo '</p>';

include ("1footer.php"); ?>