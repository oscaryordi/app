<?php
include("1header.php");
?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>

  $( function() {
    $( "#currency" ).on( "change", function() {
      $( "#spinner" ).spinner( "option", "culture", $( this ).val() );
    });

    $( "#spinner" ).spinner({
      min: .01,
      max: 1000000000,
      step: .01,
      start: 0,
      numberFormat: "C"
    });

  } );
  </script>


<?php

//tienecontrato($_SESSION["id_usuario"]); // CANDADO A QUE CONTRATO LE PERTENECE
//contratosDelEjecutivo($id_usuario);
$id_usuario 	= $_SESSION["id_usuario"];
$id_contrato 	= $_GET['id_contrato'];
$id_estimacion 	= $_GET['id_estimacion'];
//$id_cliente 	= $_GET['id_cliente'];
$filtroFlotilla 	= $_SESSION["filtroFlotilla"];

tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla);
//echo "Lo tiene $tieneEsteContrato";

if(($_SESSION["estimacionH"] > 0 AND $tieneEsteContrato == 1)   OR $_SESSION["clientes"] > 1 ){ //INICIO  VISTA EJECUTIVOS jet van y administradores de contrato

contratoxid($id_contrato);
clientexid($id_cliente);

/*
echo "<p>RFC ::: $rfc , Razon Social ::: <span style='font-weight:bold;'>$razonSocial</span> , Alias ::: $alias</p>";
echo "<p>Id_Alan ::: <span style='font-weight:bold;color:red;'>$id_alan</span> , #Cto ::: <span style='font-weight:bold;'>$numero</span>, Alias ::: $aliasCto</p>";
*/


echo "<fieldset><legend>CLIENTE / CONTRATO</legend>
	<table>
		<tr>
			<th colspan=2 >CLIENTE</th>
			<th colspan=2 >CONTRATO</th>
		<tr>	
		<tr>
			<th>RFC</th>
			<td>$rfc</td>
			<th>ID_ALAN</th>
			<td><span style='font-weight:bold;
				color:red;
				font-size:2em;'>
				$id_alan</span></td>
		</tr>
		<tr>
			<th>Razon Social</th>
			<td><span style='font-weight:bold;'>$razonSocial</span></td>
			<th>Numero Formal</th>
			<td><span style='font-weight:bold;
				font-size:2em;'>
				$numero</span></td>
		</tr>
		<tr>
			<th>Alias CTE</th>
			<td>$alias</td>
			<th>Alias CTO</th>
			<td>$aliasCto</td>
		</tr>
	</table>
	</fieldset>";


include("estimacionCD.php"); // CREAR RUTA SI NO EXISTE

// INICIA FORMULARIO SUBIR FACTURA
######### ######### ######### ######### ######### 

//echo "<title>Subir Archivo</title>"; // HEADER NO SE OCUPA AQUI
/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/
$url= 'http://sistema.jetvan.com.mx/app'; //la URL - SIN LA BARRA AL FINAL
$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.

//proceso del formulario // si existe "enviar"...
if (isset ($_POST['enviar']))  // INICIO PROCESAR FORMULARIO
{
 
//	$tnTXT = ($ArchivoTN != '')? 'T2015': '' ;
//	$estimacionCreada = ($id_estimacion > 0)? '1': '' ;
//	echo "<br>CREADA SI ES UNO : ".$estimacionCreada."";

	$id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato']);
	$id_cliente 	= mysqli_real_escape_string($dbd2, $_POST['id_cliente']);
	$capturo 	   	= $_SESSION["id_usuario"];

	date_default_timezone_set('America/Mexico_city');
	$fechareg 		= date("Y-m-d H:i:s");


	$flag='ok';

	//INICIA SUBIR ARCHIVO AL SERVIDOR
	//comprobamos si se seleccionaron archivos, los cargamos en el servidor
	if (isset($_FILES['archivo']['tmp_name'])) 
		{
		$i=0;
		do  {
				if($_FILES['archivo']['tmp_name'][$i] !="")
				{
					//INICIA VALIDAR FORMATO DE ARCHIVO
					$target_file		= basename($_FILES['archivo']['name'][$i]);
					$subirAutorizado 	= 1;
					$fileType 			= pathinfo($target_file, PATHINFO_EXTENSION);
					// Algoritmo de validacion de extension
					if( $fileType != "png" &&
						$fileType != "jpg" &&
						$fileType != "tiff" &&
						$fileType != "xls" &&
						$fileType != "xlsx" &&
						$fileType != "doc" &&
						$fileType != "docx" &&
						$fileType != "odp" &&
						$fileType != "odg" &&
						$fileType != "pot" &&
						$fileType != "xml" &&
						$fileType != "pdf" &&
						$fileType != "bmp" &&
						$fileType != "gif" &&
						$fileType != "tif" &&
						$fileType != "ods" &&
						$fileType != "jpeg" &&
						$fileType != "odt" &&
						$fileType != "pptx" &&
						$fileType != "pptx" 
					)
					{
						echo "Formato de ARCHIVO ANEXADO NO VALIDO!!!";
						$subirAutorizado = 0;
					}
					//TERMINA VALIDAR FORMATO DE ARCHIVO

					// INICIA si el formato es correcto lo copiamos
					if($subirAutorizado == 1)
					{
						$fecha 			= time();
						$aleatorio1 	= rand();
						$aleatorio 		= $fecha.'-'.$aleatorio1;
						$nuevonombre 	= $aleatorio.'-'.$_FILES['archivo']['name'][$i];
						$nombreOriginal = $_FILES['archivo']['name'][$i];
						copy($_FILES['archivo']['tmp_name'][$i], '../exp/estima/'.$rutaz.'/'.$nuevonombre);
					}
				}
				$i++;
			} while ($i < $cantidad_archivos);
		}
	echo "<br>	NOMBRE ORIGINAL : $nombreOriginal "; // VARIABLE DE CONTROL
	// TERMINA SUBIR ARCHIVO AL SERVIDOR
	/**/
	/**/
	// INICIA SUBIR DATOS DE ARCHIVO A BASE	
	//comprobamos si todos los campos fueron completados
	if ($_POST['id_contrato']!='' && @$nuevonombre!='' && @$error_archivo=='')
	{
		// PREPARAR VARIABLES

		//$id_estimacion; // DEFINIDA ARRIBA
		$archivo 	= $nuevonombre;
		$tipo 		= mysqli_real_escape_string($dbd2, $_POST['tipo']);
		$obsD 		= mysqli_real_escape_string($dbd2, $_POST['obsD']); // OBSERVACIONES DOCUMENTO
		$importeDto = mysqli_real_escape_string($dbd2, $_POST['importeDto']); // importe del DOCUMENTO
		$ruta 		= $rutaz;
		$extension 	= $fileType;
		$tamanio 	= filesize('../exp/estima/'.$rutaz.'/'.$nuevonombre);
		$nombreO 	= $nombreOriginal;
		//$capturo 	= $_SESSION['id_usuario']; // DEFINIDA ARRIBA
		//$fechareg 	= ''; // DEFINIDA ARRIBA

		//INSERTA EN BD, INICIO, Aqui voy a poner el codigo de inserción a la BD
		//INSERCION EN BASE
		$sql = 	"	INSERT INTO `estimacionDocto` 
				(id_docto, id_estimacion, archivo, tipo, 
				importeDto,
				obs, ruta, extension, tamanio, 
				nombreO, capturo, fechareg ) 
				VALUES 
				(NULL, '$id_estimacion', '$archivo', '$tipo', 
				'$importeDto',
				'$obsD', '$ruta', '$extension', '$tamanio', 
				'$nombreO', '$capturo',  '$fechareg') "; 
		$res = 	mysqli_query($dbd2, $sql ); // conexion dio problemas al definir la correcta

		// CREACION EXITOSA, SUBIDA DE ARCHIVO EXITOSA, REGISTRO EXITOSO DE ARCHIVO, ACTUALIZAR ESTIMACION
		if($res)
		{
			$columnaTipo = '';
			switch($tipo)
			{
				case "1":
					$columnaTipo .= 'd1Factura'; // FACTURA
					break;
				case "2":
					$columnaTipo .= 'd2Estimacion'; // ESTIMACION
					break;
				case "3":
					$columnaTipo .= 'd3OtroSoporte'; // OTRO
					break;
				case "4":
					$columnaTipo .= 'd4Penaliza'; // OTRO
					break;
				case "5":
					$columnaTipo .= 'd5CompPago'; // OTRO
					break;				
				default:
					$columnaTipo .= 'd1Factura'; // FACTURA
					break;
			}

			//echo $tipo."<br>"; // CONTROL
			//echo $columnaTipo."<br>"; // CONTROL
			$sql_UTDEstima = "UPDATE estimacion SET $columnaTipo =  $columnaTipo + 1 WHERE id_estimacion =  $id_estimacion ";
			//echo $sql_UTDEstima."<br>"; // CONTROL
			$sql_UTDEstima_R = mysqli_query($dbd2, $sql_UTDEstima);
		}
		else
			$anadido = "ERROR AL AÑADIR: ".mysqli_error();

	/*
		if($res)
			$folio = ", con el folio: $id_foto "; // Mensaje confirmación de número Consecutivo de insercion
		//INSERTA EN BD, FIN, Aqui termina le codigo de inserción a la BD

		//MENSAJE POR EL ENVIO EXITOSO Y LA INYECCION A LA BASE EXITOSO
		$flag='ok';

		$mensaje='<div id="ok">Sus archivo se ha subido con &eacute;xito<br />  '.$anadido.''.$folio.' <br />Gracias <br /> <a href="index.php">| Ir a inicio | </a></div>';
		echo $tamano; // son los numeros raros que aparecen antes de lo punteado
	*/

	} // TERMINA SUBIR DATOS DE ARCHIVO A BASE

	// include("estimacionResumen.php");
	// PONER DATOS DE ESTIMACION INDIVIDUAL
	echo "id_estimacion = ".$id_estimacion."<br>";
	estimacionxid($id_estimacion);
	include("estimacionIndividual.php");

	include("estimacionArchivosIndividual.php");
	echo "NUEVO ARCHIVO ADJUNTADO CORRECTAMENTE <br>";
	// PONER DATOS DE ESTIMACION INDIVIDUAL

/*
	else  // ELSE PRINCIPAL
	{
		//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
		$flag='err';
		$mensaje='<div id="error">- Los campos marcados con * son requeridos. '.@$error_archivo.'</div>';
	}
*/

} // TERMINA PROCESAR FORMULARIO

?>
		<script async src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- <script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script> -->
		<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
<?php
echo @$mensaje; /*mostramos el estado de envio del form */ 

if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} 

if (@$flag!='ok') {  // INICIA Mostrar formulario
// include("estimacionResumen.php");// MOSTRAR HISTORIAL ESTIMACIONES
	// PONER DATOS DE ESTIMACION INDIVIDUAL
	estimacionxid($id_estimacion);
	include("estimacionIndividual.php");
	include("estimacionArchivosIndividual.php");
	// PONER DATOS DE ESTIMACION INDIVIDUAL




//echo "id_contratoBD: $id_contrato<br>";
//echo "id_clienteBD: $id_cliente<br>";
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>">
<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">	
<br>
<fieldset>
<h2>SUBIR MAS ARCHIVOS</h2>

<!-- 
	<h3>INDICAR LOS SIGUIENTES DATOS:</h3>
<table>
	<tr>
		<th>INDICAR PERIODO</th>
		<td>
			<label for='mesE'><b>MES</b></label>
			<select name='mesE'>
				<option value='01' >ENERO</option>
				<option value='02' >FEBRERO</option>
				<option value='03' >MARZO</option>
				<option value='04' >ABRIL</option>
				<option value='05' >MAYO</option>
				<option value='06' >JUNIO</option>
				<option value='07' >JULIO</option>
				<option value='08' >AGOSTO</option>
				<option value='09' >SEPTIEMBRE</option>
				<option value='10' >OCTUBRE</option>
				<option value='11' >NOVIEMBRE</option>
				<option value='12' >DICIEMBRE</option>
			</select>
			<label for='anioE'><b>AÑO</b></label>
			<select name='anioE'>
				<option value='2017' >2017</option>
				<option value='2016' >2016</option>
				<option value='2015' >2015</option>
				<option value='2014' >2014</option>
				<option value='2013' >2013</option>
			</select>
		</td>
	</tr>

	<tr>
		<th><label for='anioE'>ID CONTRATO</label></th>
		<td>
		<input type="hidden" name="id_contrato" value="<?php //echo $id_contrato; ?>">
		<input type="hidden" name="id_cliente" value="<?php //echo $id_cliente; ?>">
		</td>
	</tr>
-->
<!--	<tr>
		<th>MONTO FACTURA IVA INCLUIDO</th>
		<td><input 
 			type="number" lang="en-150" step="0.01" min="0"
 			pattern="[0-9]+([\.,][0-9]+)?" 
			name="montoEiI" value="<?php //echo @$montoEiI; ?>"
			required style="text-align: right;" max='100000000' > 0000.00 sin comas
		</td>
	</tr>


	<tr>
		<th>OBSERVACIONES ESTIMACION</th>
		<td><input type="text" name="obsEst" value="<?php //echo @$obsEst; ?>">
		</td>
	</tr>

	<tr>
		<th>CANTIDAD DE UNIDADES BASE EN ESTIMACION</th>
		<td><input type="text" name="totalUB" value="<?php //echo @$totalUB; ?>"></td>
	</tr>

</table>
-->



<h4>SUBIR ARCHIVO RELATIVO A ESTIMACION:</h4>
<div id="form">
		<p><strong>INDICAR TIPO DE ARCHIVO A ADJUNTAR</strong>
		<select 
		<?php if (isset ($flag) && $_POST['tipo']=='') { echo 'class="error"';} else {echo 'class=""';} ?>
		value="<?php echo $_POST['tipo'];?>"
		name = "tipo" id=select >
			  <option value='1'>FACTURA</option>
			  <option value='2'>ESTIMACION</option>
			  <option value='3'>OTRO SOPORTE</option>
			  <option value='4'>PENALIZACION Y/O DEDUCTIVA</option>
			  <option value='5'>PAGO/DEPOSITO</option>
		</select></p>

		<p><strong>Elegir Archivo </strong>
			Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.

		<input 
		type="file" class="multi max-<?=$cantidad_archivos?>"  
		name="archivo[]" 
		value="<?=$_FILES['archivos']?>">
		</p>

		<p><strong>Monto Documento</strong><br/>
		<?php 
		if( $_SESSION['id_usuario'] != 103 )
		{
		?>
			$<input 
 			type="number" lang="en-150" step="0.01" min="0"
 			pattern="[0-9]+([\.,][0-9]+)?" 
			name="importeDto" value="<?php //echo @$importeDto; ?>" 
			id="spinner" 
			style="text-align: right;" 
			> 0000.00 sin comas
		<?php 
		}
		else
		{
		?>
			$<input 
 			type="text" 
			name="importeDto" value="<?php //echo @$importeDto; ?>" 
			style="text-align: right;" max='100000000' 
			> 0000.00 sin comas
		<?php 
		}
		?>
		</p>

		<p><strong>Observaciones del Documento</strong><br />	
		<input  size="95%" <?php if (isset ($flag) && $_POST['obsD']=='') { echo 'class="error"';} 
		else {echo 'class="campo"';} ?> type="text" name="obsD" value="<?php // echo @$_POST['obsD'];?>" /></p>

		<p></p>
</div> <!-- end form-->
<div id="boton_S" style="padding:5px 30px;" >
<input  type="submit" name="enviar" value="SUBIR" />
</div>
</fieldset>
</form>


<?php }// TERMINA Mostrar formulario  
######### ######### ######### ######### ######### 
// TERMINA FORMULARIO SUBIR FACTURA




// VOLVER A ESTIMACIONES
	echo "<p>
		<a href='estimacionSubir.php?id_contrato=$id_contrato&id_cliente=$id_cliente' style='text-decoration: none;' title='SUBIR ESTIMACION'>
		<input type='button' value='VOLVER A ESTIMACIONES'>
		</a>
		</p>";
// VOLVER A ESTIMACIONES


// VOLVER AL CLIENTE
	echo "<p>
		<FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
		</FORM>
		</p>";
// VOLVER AL CLIENTE


} // TERMINA VISTA EJECUTIVOS jet van y administradores de contrato
else
{
	echo "<p><h3>USUARIO NO HABILITADO PARA SUBIR ARCHIVOS DE ESTIMACIONES</h3></p>";
}
include("1footer.php");?>