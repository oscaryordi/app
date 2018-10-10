<?php
include("1header.php");

//tienecontrato($_SESSION["id_usuario"]); // CANDADO A QUE CONTRATO LE PERTENECE
//contratosDelEjecutivo($id_usuario);
$id_usuario 	= $_SESSION["id_usuario"];
$id_contrato 	= $_GET['id_contrato'];
//$id_cliente 	= $_GET['id_cliente'];
$filtroFlotilla 	= $_SESSION["filtroFlotilla"];

tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla);

//echo "Lo tiene $tieneEsteContrato";
// caso 1, es supervisor y puede ver todo
// caso 2, es ejecutivo y puede ver sus contratos y hacer estimaciones
// caso 3, es externo y puede ver sus contratos pero no hacer estimaciones
// estimacionV es para ver cualquier contrato

if( ($_SESSION["estimacionH"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["estimacionV"] > 0 ){ 
//INICIO  VISTA EJECUTIVOS jet van y administradores de contrato

// SI PASO CARGAMOS LIBRERIAS PARA JQUERY
?> 
	<!--<script src="js/jquery-1.11.2.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!--<script src="js/jquery-ui.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<script> 
	$.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'dd/mm/yy',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);

	$(function() {
		$( "#fechainicio" ).datepicker({changeYear: true, changeMonth: true});
	});

	$(function() {
		$( "#fechafinal" ).datepicker({changeYear: true, changeMonth: true});
	});
	</script>

<script >
		function buscaSubAreaSD3()
		{
		 var search34 = $('#search34').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search34:search34},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result34').html(data);
					}
				}
			});
		};
</script>
<?php
// SI PASO CARGAMOS LIBERIAS PARA JQUERY

contratoxid($id_contrato);
clientexid($id_cliente);

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

echo "<h2>ESTIMACIONES DEL CONTRATO:</h2>";
include("estimacionCD.php");

// INICIA FORMULARIO SUBIR FACTURA
######### ######### ######### ######### ######### 

//echo "<title>Subir Archivo</title>";

/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/
$url= 'https://sistema.jetvan.com.mx/app'; //la URL - SIN LA BARRA AL FINAL
$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.

//proceso del formulario // si existe "enviar"...
if (isset ($_POST['enviar']))  // INICIO PROCESAR FORMULARIO
{
	// INICIA GENERAR NUEVA ESTIMACION
	if(
		$_POST['fechainicio']	!='' && 
		$_POST['fechafinal']	!='' && 
		$_POST['montoEiI']		!='' && 
		$_POST['id_contrato']	!='' 
	) 
	{

	$fechainicio 	= $_POST['fechainicio'];
	$fechafinal 	= $_POST['fechafinal'];

	// VALIDA FORMATO DE FECHA
	   function validateDate($date, $format = 'Y-m-d H:i:s')
	        {
	            $d = DateTime::createFromFormat($format, $date);
	            return $d && $d->format($format) == $date;
	        }

	    if( validateDate($fechainicio, 'Y-m-d') == true )
	        { ;}
	    else
	        { 
	        	$date = str_replace('/', '-', $fechainicio);
				$fechainicio = date('Y-m-d', strtotime($date));
	        }

	    if( validateDate($fechafinal, 'Y-m-d') == true )
	        { ;}
	    else
	        { 
	        	$date = str_replace('/', '-', $fechafinal);
				$fechafinal = date('Y-m-d', strtotime($date));
	        }
	// VALIDA FORMATO DE FECHA

	$fechaIn = $fechainicio ;
	$fechaFn = $fechafinal ;

	$mesE 			=0;
	$anioE 			=0;
	$mesE 			+= mysqli_real_escape_string($dbd2, @$_POST['mesE'] );
	$anioE 			+= mysqli_real_escape_string($dbd2, @$_POST['anioE'] );

	$montoEiI 		= mysqli_real_escape_string($dbd2, $_POST['montoEiI'] );
	$id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato'] );
	$id_cliente 	= mysqli_real_escape_string($dbd2, $_POST['id_cliente'] );
	$id_subDiv2 	= @(mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']) != '' 
					AND mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']))? mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']):'0';
	$id_subDiv3 	= @(mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']) != '' 
					AND mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']))? mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']):'0';
	$obs 			=strtoupper( mysqli_real_escape_string($dbd2, $_POST['obsEst']) );
	$capturo	   	= $_SESSION["id_usuario"];

	date_default_timezone_set('America/Mexico_city');
	$fechareg = date("Y-m-d H:i:s");

	echo "
	$mesE 		||	
	$anioE 		||	
	$montoEiI 	||	
	$id_contrato ||	
	$id_cliente 	||
	$obs || 
	$capturo || 
	$fechareg 
	<br>";

	$sql_Estima = "	INSERT INTO estimacion "
					." (id_estimacion, id_cliente, id_contrato, "
					." id_subDiv2,  id_subDiv3, "
					." fechaIn, fechaFn , "
					." mesE, anioE, montoEiI, "
					." obs, fechareg, capturo) "
					." VALUES "
					." (NULL, '$id_cliente', '$id_contrato', "
					." '$id_subDiv2', '$id_subDiv3', "
					." '$fechaIn', '$fechaFn', "
					." '$mesE', '$anioE', '$montoEiI', "
					." '$obs', '$fechareg', '$capturo') ";

	$sql_Estima_R 	= mysqli_query($dbd2, $sql_Estima);
	if(!$sql_Estima_R){
	echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2)
	. " FALLO AL REGISTRAR LA SOLICITUD, SI VES ESTE MENSAJE SACALE 
	UNA FOTO Y MANDALA A SISTEMAS odesales@jetvan.com.mx \n";
	}

	$id_estimacion 	= mysqli_insert_id($dbd2);

	echo "<br> ".$id_estimacion;

	}
	// TERMINA GENERAR NUEVA ESTIMACION

	//$tnTXT = ($ArchivoTN != '')? 'T2015': '' ;
	$estimacionCreada = ($id_estimacion > 0)? '1': '' ;
	echo "<br>CREADA SI ES UNO : ".$estimacionCreada."";

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
					$target_file	= basename($_FILES['archivo']['name'][$i]);
					$subirAutorizado = 1;
					$fileType 		= pathinfo($target_file, PATHINFO_EXTENSION);
					// Algoritmo de validacion de extension
					if( $fileType != "png"  &&
						$fileType != "jpg"  &&
						$fileType != "tiff" &&
						$fileType != "xls"  &&
						$fileType != "xlsx" &&
						$fileType != "doc"  &&
						$fileType != "docx" &&
						$fileType != "odp"  &&
						$fileType != "odg"  &&
						$fileType != "pot"  &&
						$fileType != "xml"  &&
						$fileType != "pdf"  &&
						$fileType != "bmp"  &&
						$fileType != "gif"  &&
						$fileType != "tif"  &&
						$fileType != "ods"  &&
						$fileType != "jpeg" &&
						$fileType != "odt"  &&
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
						$fecha 		= time();
						$aleatorio1 = rand();
						$aleatorio 	= $fecha.'-'.$aleatorio1;
						$nuevonombre = $aleatorio.'-'.$_FILES['archivo']['name'][$i];
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
		$sql = "	INSERT INTO `estimacionDocto` 
				(id_docto, id_estimacion, archivo, tipo, 
				importeDto,
				obs, ruta, extension, tamanio, 
				nombreO, capturo, fechareg ) 
				VALUES 
				(NULL, '$id_estimacion', '$archivo', '$tipo', 
				'$importeDto',
				'$obsD', '$ruta', '$extension', '$tamanio', 
				'$nombreO', '$capturo',  '$fechareg') "; 
		$res=mysqli_query($dbd2, $sql ); // conexion dio problemas al definir la correcta

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
				default:
					$columnaTipo .= 'd1Factura'; // FACTURA
					break;
			}

			//echo $tipo."<br>"; // CONTROL
			//echo $columnaTipo."<br>"; // CONTROL
			$sql_UTDEstima = "  UPDATE estimacion 
								SET $columnaTipo =  $columnaTipo + 1 
								WHERE id_estimacion =  $id_estimacion ";
			//echo $sql_UTDEstima."<br>"; // CONTROL
			$sql_UTDEstima_R = mysqli_query($dbd2, $sql_UTDEstima);
		}
		else
			$anadido = "ERROR AL AÑADIR: ".mysqli_error($dbd2);
	} // TERMINA SUBIR DATOS DE ARCHIVO A BASE

	include("estimacionResumen.php");


// VOLVER A ESTIMACIONES
	echo "<p>
		<a href='estimacionSubir.php?id_contrato=$id_contrato&id_cliente=$id_cliente' style='text-decoration: none;' title='SUBIR ESTIMACION'>
		<input type='button' value='SUBIR OTRA ESTIMACION'>
		</a>
		</p>";
// VOLVER A ESTIMACIONES


} // TERMINA PROCESAR FORMULARIO

?>
	<!--	<script async src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		 <script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script> -->
		<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
<?php
echo @$mensaje; /*mostramos el estado de envio del form */ 

if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} 

if (@$flag!='ok' ) {  // INICIA Mostrar formulario

include("estimacionResumen.php");// MOSTRAR HISTORIAL ESTIMACIONES
if($_SESSION['externo'] == 0 OR ($_SESSION["estimacionH"] > 0 AND $tieneEsteContrato == 1) ){ // MOSTRAR FORMULAIRO A INTERNOS
echo "<br>";
echo "<div style='background-color:#c0d9e5;padding:3px;margin:3px;border-radius:5px;'>"; // DIV FONDO FORMULARIO CREAR ESTIMACION

echo "<h2>CREAR ESTIMACION</h2>";
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>">
<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">	
	<fieldset><legend>FORMULARIO PARA CREAR NUEVA ESTIMACION</legend>
	<h3>INDICAR LOS SIGUIENTES DATOS:</h3>
<table>
	<tr>
		<th>INDICAR PERIODO</th>
		<td>
			Fecha Inicio->
			<input type='text' id='fechainicio' 
			name='fechainicio' placeholder='dd/mm/aaaa'  
			readonly='true' />
			Fecha Final->
			<input type='text' id='fechafinal' 
			name='fechafinal' placeholder='dd/mm/aaaa'   
			readonly='true' />

		</td>
	</tr>
	<tr>
		<th>MONTO FACTURA IVA INCLUIDO</th>
		<td>$<input 
 			type="number" lang="en-150" step="0.01" min="0"
 			pattern="[0-9]+([\.,][0-9]+)?" 
			name="montoEiI" value="<?php //echo @$montoEiI; ?>"
			required style="text-align: right;" max='100000000' > 0000.00 sin comas
		</td>
	</tr>

	<tr><th>AREA ADMINISTRATIVA</th>
		<td>
<?php
		$sql26 = 'SELECT id_cliente, id_contrato, id_subDiv2, descripcion '
		. ' FROM '
		. ' clbSubDiv2 '
		. " WHERE id_contrato = '$id_contrato' ORDER BY descripcion ASC LIMIT 200 ";
		
		$search_query26 = mysqli_query($dbd2, $sql26);
		if(!$search_query26) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_subDiv2'  id='search34' 
				 onchange='buscaSubAreaSD3(this);'   >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query26)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_subDiv2 	= $row['id_subDiv2'];
				$descripcion 	= $row['descripcion'];

				$selected	= ($id_subDiv2Esta == $id_subDiv2)? 'selected':'';

				$sql_unidadesSD 		= "SELECT count( id_unidad ) unidades "
										."	FROM asignaUactual "
										."	WHERE id_subDiv2 = '$id_subDiv2' ";
				$sql_unidadesSD_res 	= mysqli_query($dbd2, $sql_unidadesSD);
				$unidades_matrizSD		= mysqli_fetch_array($sql_unidadesSD_res);
				$unidadesCtoSD 			= $unidades_matrizSD['unidades'];

					echo "<option value='{$id_subDiv2}'  $selected   >ctebd-{$id_cliente} ctobd-{$id_contrato} ::: AreaAdva {$id_subDiv2} ::: UNIDADES  <b>{$unidadesCtoSD} ::: {$descripcion}</b> </option>";

		}
		echo "</select>"; 
	$filas26 = mysqli_num_rows($search_query26);
	$xz26 = ($filas26 > 0)?"":"No hay coincidencias en BD";
	echo $xz26;
?>
		</td>
	</tr>

	<tr><th>SUBAREA</th>
		<td>
			<div  id="result34"></div>
		</td>
	</tr>

	<tr>
		<th>OBSERVACIONES ESTIMACION</th>
		<td><input type="text" name="obsEst" value="<?php //echo @$obsEst; ?>">
		</td>
	</tr>
</table>

<h4>SUBIR ARCHIVO RELATIVO A NUEVA ESTIMACION:</h4>
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
		</select></p>

		<p><strong>Elegir Archivo </strong>
			Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.

		<input type="file" class="multi max-<?=$cantidad_archivos?>"  
		name="archivo[]" value="<?=$_FILES['archivos']?>"></p>


		<p><strong>Monto Documento</strong><br/>
		$<input 
 			type="number" lang="en-150" step="0.01" min="0"
 			pattern="[0-9]+([\.,][0-9]+)?" 
			name="importeDto" value="0<?php //echo @$importeDto; ?>"
			style="text-align: right;" max='100000000' > 0000.00 sin comas
		</p>

		<p><strong>Observaciones del Documento</strong><br />	
		<input  size="95%" <?php if (isset ($flag) && $_POST['obsD']=='') { echo 'class="error"';} 
		else {echo 'class="campo"';} ?> type="text" name="obsD" value="<?php // echo @$_POST['obsD'];?>" /></p>

		<p></p>

</div> <!-- end form-->
<div id="boton_S" style="padding:5px 30px;" >
<input  type="submit" name="enviar" value="CREAR ESTIMACION" />
</div>
</fieldset>
</form>

<?php 
echo "</div>"; // DIV FONDO FORMULARIO CREAR ESTIMACION
} // MOSTRAR FORMULARIO A INTERNOS



if($_SESSION['estimacionH'] == 0 )
{
	echo "<p><h3>USUARIO NO HABILITADO PARA CREAR ESTIMACIONES</h3></p>";
}




}// TERMINA Mostrar formulario
######### ######### ######### ######### ######### 
// TERMINA FORMULARIO SUBIR FACTURA

echo"<br>";



echo"
	<p>
	  <FORM action='ctoIndex.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
	  </FORM>
	</p>";

// VOLVER AL CLIENTE
	echo "<p>
		<FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
		</FORM>
		</p>";
// VOLVER AL CLIENTE

} // TERMINA VISTA EJECUTIVOS jet van y administradores de contrato
include("1footer.php");?>
<link rel="stylesheet" 
href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />