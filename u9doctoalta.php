<?php
include '1header.php';

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
		$( "#expedicion" ).datepicker({changeYear: true, changeMonth: true});
		});

		$(function() {
		$( "#vencimiento" ).datepicker({changeYear: true, changeMonth: true});
		});
	</script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />
	<?php

$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";    

include ("u4datos.php");
include ("u5placas.php");
include ("u9doctoaltacreadirectorio.php");


if($_SESSION["documentos"] > 1){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO 

echo "<title>Subir Archivo</title>";

/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/
//include_once("conecta.inc.php");// esto es para ingresar datos en la base
//$url= 'http://sistema.jetvan.com.mx/app'; //la URL - SIN LA BARRA AL FINAL
$url= 'http://www.sistema.jetvan.com.mx/app'; //la URL - SIN LA BARRA AL FINAL
$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.

//proceso del formulario // si existe "enviar"...
if (isset ($_POST['enviar'])) 
{
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
								$fileType != "XML" &&
								$fileType != "pdf" &&
								$fileType != "PDF" &&
								$fileType != "bmp" &&
								$fileType != "gif" &&
								$fileType != "tif" &&
								$fileType != "ods" &&
								$fileType != "jpeg" &&
								$fileType != "odt" &&
								$fileType != "pptx" &&
								$fileType != "pptx" 
							 )	{
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
							copy($_FILES['archivo']['tmp_name'][$i], '../exp/'.$rutaz.'/'.$nuevonombre); // copy($_FILES['archivo']['tmp_name'][$i], '../jetvan/exp/archivos/'.$nuevonombre); ESTA RUTA FUNCIONO PARA WEBSASTRE.COM
						}
					}		
					$i++;
				} while ($i < $cantidad_archivos);
		}

	//comprobamos si todos los campos fueron completados
	if ($_POST['id_unidad']!='' && $_POST['tipo']!='' && @$nuevonombre!='' && @$error_archivo=='') 
	{
		$id_unidad  = $_POST['id_unidad'];
		$tipo       = $_POST['tipo'];
		$obs        = mysqli_real_escape_string($dbd2, $_POST['obs'] );

		$expedicion = $_POST['expedicion'];
		// VALIDA FORMATO DE FECHA
		function validateDate($date, $format = 'Y-m-d H:i:s')
			{
				$d = DateTime::createFromFormat($format, $date);
				return $d && $d->format($format) == $date;
			}

		if( $expedicion == '' )
			{ $expedicion = null ;}
		elseif( validateDate($expedicion, 'Y-m-d') == true )
			{ ;}
		else
			{ 
				$date 		= str_replace('/', '-', $expedicion);
				$expedicion = date('Y-m-d', strtotime($date));
			}
		// VALIDA FORMATO DE FECHA

		$vencimiento = $_POST['vencimiento'];
		// VALIDA FORMATO DE FECHA
		/*function validateDate($date, $format = 'Y-m-d H:i:s')
			{
				$d = DateTime::createFromFormat($format, $date);
				return $d && $d->format($format) == $date;
			}*/
		if( $vencimiento == '' )
			{ $vencimiento = null ;}
		elseif( validateDate($vencimiento, 'Y-m-d') == true )
			{ ;}
		else
			{ 
				$date = str_replace('/', '-', $vencimiento);
				$vencimiento = date('Y-m-d', strtotime($date));
			}
		// VALIDA FORMATO DE FECHA



		//INSERTA EN BD, INICIO, Aqui voy aponer el codigo de inserción a la BD
		$dbd = conecta();

		$valorExpedicion 	= ($expedicion == null)? 'NULL' : "'".$expedicion."'" ;
		$valorVencimiento 	= ($vencimiento == null)? 'NULL' : "'".$vencimiento."'" ;
		
		$importeDto 		= 0;
		$importeDto 		+= mysqli_real_escape_string($dbd2, $_POST['importeDto']); // importe del DOCUMENTO
		

		$capturo = $_SESSION['id_usuario'];
		//INSERCION EN BASE
		 $sql = "INSERT INTO `jetvantlc`.`expedientes` 
		 		(`id`, id_unidad,  `archivo`, `tipo`, `obs`, 
		 		`expedicion`,  vencimiento, importeDto , `fechareg`,  `capturo`, 
		 		`ruta`) 
		 		VALUES 
		 		(NULL, '$id_unidad', '$nuevonombre', '$tipo', '$obs', 
		 		$valorExpedicion, $valorVencimiento, '$importeDto' ,  CURRENT_TIMESTAMP, '$capturo', 
		 		'$rutaz')";
		 	//echo "<br> $sql </br>";
		// ECHO $sql." SENTENCIA COMPUTADA <BR>";

		$res=mysqli_query($dbd2, $sql ); // conexion dio problemas al definir la correcta
		if($res)
			$anadido = "Registrado ".mysqli_affected_rows($dbd2)." archivo"; // Mensaje confirmación de añadido un Registro a la Base de Datos
		else
			$anadido = "ERROR AL AÑADIR: ".mysqli_error($dbd2);
		$sql_id_sol = "SELECT id FROM expedientes WHERE archivo='$nuevonombre' ";
		$res_id_sol = mysqli_query($dbd2, $sql_id_sol ); // conexion dio problemas al definir la correcta
		$res_id 	= mysqli_fetch_array($res_id_sol);	
		if($res_id)
			$folio = ", con el folio: $res_id[id]"; // Mensaje confirmación de número Consecutivo de insercion
		//INSERTA EN BD, FIN, Aqui termina le codigo de inserción a la BD

		//MENSAJE POR EL ENVIO EXITOSO Y LA INYECCION A LA BASE EXITOSO
		$flag='ok'; 
		$mensaje='<div id="ok">Sus archivo se ha subido con &eacute;xito<br />  '
				.$anadido.''.$folio
				.' <br />Gracias <br /> <a href="index.php">| Ir a inicio | </a></div>';
		include ("u9docto.php");

	}
	else 
	{
		//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
		$flag='err';
		$mensaje='<div id="error">- Los campos marcados con * son requeridos. '.@$error_archivo.'</div>';
	}
}

?>
	<script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script>
	<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
<?php 
echo @$mensaje; /*mostramos el estado de envio del form */

if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} 
if (@$flag!='ok') 
{  // INICIA Mostrar formulario  

	include ("u9docto.php"); 
	?>

	<fieldset><legend>Formulario para subir archivos</legend>
	<div id="form">

		<form action="" method="post" enctype="multipart/form-data">
			<!--	<p><strong>Economico*</strong> 
			<input  size="10" <?php // if (isset ($flag) && $_POST['economico']=='') { echo 'class="error"';} 

			 // else {echo 'class="campo"';} ?> type="text" name="economico" id='search' value="<?php //echo @$_GET['uNEco'];?>" /></p>
			
			<INPUT TYPE="text" NAME="uNEco" VALUE="<?php //echo $uNEco; ?>" disabled >
		<input type="hidden" name="economico" value="<?php echo $Economico; ?>">
		-->	<input type="hidden" name="id_unidad" value="<?php echo $id_unidad; ?>">
			
			<p><strong>Tipo*</strong>
			<select 
			<?php if (isset ($flag) && $_POST['tipo']=='') { echo 'class="error"';} else {echo 'class=""';} ?>
			value="<?php echo $_POST['tipo'];?>"
			name = "tipo" id=select >
				  <option value='1'>FACTURA</option>
				  <option value='2'>POLIZA DE SEGURO</option>
				  <option value='3'>TARJETA DE CIRCULACION</option>
				  <option value='4'>VERIFICACION AMBIENTAL</option>
				  <option value='5'>TENENCIA</option>
				  <option value='6'>OTRO</option>
				  <option value='7'>INVENTARIO</option>
			</select></p>

			<p><strong>Elegir Archivo </strong>
				Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.
			<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>
			
			<p><strong>Observaciones</strong><br/>	
			<input  size="95%" <?php if (isset ($flag) && $_POST['obs']=='') { echo 'class="error"';} 
			else {echo 'class="campo"';} ?> type="text" name="obs" value="<?php echo @$_POST['obs'];?>" /></p>

			<p><strong>Fecha de Expedición</strong><br/>	
				<input type='text' id='expedicion' name='expedicion' placeholder='dd/mm/aaaa'     /> <!-- readonly='true' -->
			</p>

			<p><strong>Fecha de Vencimiento</strong><br/>	
				<input type='text' id='vencimiento' name='vencimiento' placeholder='dd/mm/aaaa'    /> <!-- readonly='true' -->
			</p>

			<p><strong>Monto Documento</strong><br/>
			$<input 
	 			type="number" lang="en-150" step="0.01" min="0"
	 			pattern="[0-9]+([\.,][0-9]+)?" 
				name="importeDto" value="<?php //echo @$importeDto; ?>"
				style="text-align: right;" max='100000000' 
				> 0000.00 sin comas
			</p>

			<p><input  type="submit" name="enviar" value="enviar" /></p>
		</form>

	</div> <!-- end form-->
	</fieldset>
<?php 
}  // TERMINA Mostrar formulario
} // CIERRE PRIVILEGIOS
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<p>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </p>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
include ("1footer.php"); ?>