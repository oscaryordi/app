<?php
include '1header.php';

$id_mttoSol = $_GET['id_mttoSol'];
@$tipo 		= $_GET['tipo'];
@$pagina 	= $_GET['pagina'];	// PARA PODER VOLVER AL A PAGINA DE LA QUE VIENE

echo "Tipo: $tipo ";
########## ########## ########## ########## ########## 
$sql_mttoSol 	= "SELECT * FROM `mttoSol` WHERE `id_mttoSol` = '$id_mttoSol' LIMIT 1 ";
$sql_mttoSol_R 	= mysqli_query($dbd2, $sql_mttoSol);
$sql_mttoSol_M 	= mysqli_fetch_array($sql_mttoSol_R);

$id_unidad 		=	$sql_mttoSol_M['id_unidad'];
$id_cliente 	=	$sql_mttoSol_M['id_cliente'];
$id_contrato 	=	$sql_mttoSol_M['id_contrato'];
$fechaEj		=	$sql_mttoSol_M['fechaEj'];
$concepto 		=	strtoupper($sql_mttoSol_M['concepto']);
$importe 		=	$sql_mttoSol_M['importe'];
$km 			= 	$sql_mttoSol_M['km'];
$obs 			=	strtoupper($sql_mttoSol_M['obs']);
$id_prov 		= 	$sql_mttoSol_M['id_prov'];
$id_prov_c		= 	$sql_mttoSol_M['id_prov_c'];
$id_prov_s		= 	$sql_mttoSol_M['id_prov_s'];
$capturo 		=	$sql_mttoSol_M['capturo'];
$autorizadoS 	=	$sql_mttoSol_M['autorizadoS'];
// TIENE DOCUMENTOS
$dC1 		=	$sql_mttoSol_M['dC1'];
$pagado 	=	$sql_mttoSol_M['pagado'];
$facturado 	=	$sql_mttoSol_M['facturado'];
$dF4 		=	$sql_mttoSol_M['dF4'];
$dM5 		=	$sql_mttoSol_M['dM5'];
// TIENE DOCUMENTOS
datosxid($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);
proveedorxid($id_prov);
provCtaxid($id_prov_c);
reembxid($id_mttoSol);

// EJECUTIVO
$sql_ejec 		= "SELECT * FROM `usuarios` WHERE `id_usuario` = '$capturo' LIMIT 1 ";
$res_ejec 		= mysqli_query($dbd2, $sql_ejec);
$matriz_ejec 	= mysqli_fetch_array($res_ejec);
$nombreEjec 	= strtoupper($matriz_ejec['nombre']);
//echo "<br>".$nombreEjec;

usuarioxid($autorizadoS);
$autorizoNombreS = $nombre;
########## ########## ########## ########## ########## 

echo "<h2><span style='color:blue;' >SUBIR ARCHIVOS</span></h2>";
?>

<table>
	<tr>
		<td>
			<b>SOLICITUD DE CHEQUE</b>
			<br>Folio: 
			<?php echo $id_mttoSol; ?>
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
			<?php echo number_format( $importe, 2);?>
			<br>Kilometraje:
			<?php echo $km;?>
			<br>Observaciones: 
			<?php echo $obs;?>
		</td>
	</tr>
</table>

<?php 

include ("mttoSolCreaDir.php"); // Se obtiene la ruta y la crea si no existe

$tipo1 = '';
$tipo2 = '';
$tipo3 = '';
$tipo4 = '';
$tipo5 = '';

switch($tipo)
	{
		case "1":
			$tipo1 = 'selected';
			break;
		case "2":
			$tipo2 = 'selected';
			break;
		case "3":
			$tipo3 = 'selected';
			break;
		case "4":
			$tipo4 = 'selected';
			break;
		case "5":
			$tipo5 = 'selected';
			break;
		default:
				;
	}

if($_SESSION["mttos"] > 1){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO ?>

<title>Subir Archivo</title>
<?php
/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/
//include_once("conecta.inc.php");// esto es para ingresar datos en la base
$url= 'https://sistema.jetvan.com.mx/app'; //la URL - SIN LA BARRA AL FINAL
$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.

//proceso del formulario // si existe "enviar"...
if (isset ($_POST['enviar'])) 
{
	//comprobamos si se seleccionaron archivos, los cargamos en el servidor
	if (isset($_FILES['archivo']['tmp_name'])) 
		{
			$i=0;
			do
			{
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
						$fileType != "pdf" &&
						$fileType != "bmp" &&
						$fileType != "gif" &&
						$fileType != "tif" &&
						$fileType != "ods" &&
						$fileType != "jpeg" &&
						$fileType != "odt" &&

						$fileType != "pptx" &&
						$fileType != "ppt" &&
						$fileType != "msg" &&
						$fileType != "eml" &&

						$fileType != "PNG" &&
						$fileType != "JPG" &&
						$fileType != "TIFF" &&
						$fileType != "XLS" &&
						$fileType != "XLSX" &&
						$fileType != "DOC" &&
						$fileType != "DOCX" &&
						$fileType != "ODP" &&
						$fileType != "ODG" &&
						$fileType != "POT" &&
						$fileType != "XML" &&
						$fileType != "PDF" &&
						$fileType != "BMP" &&
						$fileType != "GIF" &&
						$fileType != "TIF" &&
						$fileType != "ODS" &&
						$fileType != "JPEG" &&
						$fileType != "ODT" &&

						$fileType != "PPTX" &&
						$fileType != "PPT" &&
						$fileType != "MSG" &&
						$fileType != "EML"
					 )	{
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
							$nuevonombre	= str_replace("%","",$nuevonombre); // QUITAR % str_replace($comillasimple,"",$VariableDisponible); str_replace("%","",$nuevonombre);
							// YA QUE LOS NOMBRES CON SIMBOLO % PORCENTAJE NO SE PUEDEN VER EN EL NAVEGADOR, LO MALINTERPRETA
							$nuevonombre	= str_replace("#","",$nuevonombre); // QUITAR # , lo anterior 
							copy($_FILES['archivo']['tmp_name'][$i], '../exp/mtto/'.$rutaz.'/'.$nuevonombre);
						} 
						// TERMINA si el formato es correcto lo copiamos
				}
				$i++;
			} while ($i < $cantidad_archivos);
		}
	//comprobamos si todos los campos fueron completados

	if ($_POST['id_mttoSol']!='' && $_POST['tipo']!='' && file_exists('../exp/mtto/'.$rutaz.'/'.@$nuevonombre) && @$nuevonombre != '') 
	{
		$id_mttoSol = mysqli_real_escape_string($dbd2, $_POST['id_mttoSol'] );
		$tipo	   	= mysqli_real_escape_string($dbd2, $_POST['tipo'] );

		//INSERTA EN BD, INICIO, Aqui voy aponer el codigo de inserción a la BD
		$capturo 	= $_SESSION['id_usuario'];

		//INSERCION EN BASE
		date_default_timezone_set('America/Mexico_city');
		$fechaReg = date("Y-m-d H:i:s");

		$sql = " 	INSERT INTO `jetvantlc`.`mttoDocto` 
					(`id_docto`, id_mttoSol, `archivo`, `tipo`, ruta, `id_capturo`, `fechareg`) 
		 			VALUES 
		 			(NULL, '$id_mttoSol', '$nuevonombre', '$tipo', '$rutaz', '$capturo', '$fechaReg')"; 
		$res=mysqli_query($dbd2, $sql ); // conexion dio problemas al definir la correcta

		if($res)
			$anadido = "Registrado ".mysqli_affected_rows($dbd2)." archivo"; // Mensaje confirmación de añadido un Registro a la Base de Datos
		else
			$anadido = "ERROR AL AÑADIR: ".mysqli_error($dbd2);

		$res_id = mysqli_insert_id($dbd2);
		if($res_id)
			$folio = ", con el folio: $res_id"; // Mensaje confirmación de número Consecutivo de insercion
		//INSERTA EN BD, FIN, Aqui termina le codigo de inserción a la BD


		// INICIO ACTUALIZAR INDICAR TIPO DE DOCUMENTO SUBIDO
		$tipoActualizar;
		$dC1 		+=	1;
		$pagado 	+=	1;
		$facturado 	+=	1;
		$dF4 		+=	1;
		$dM5 		+=	1;
		switch($tipo)
		{
			case "1":
				$tipoActualizar = ' dC1 = '.$dC1;
				break;
			case "2":
				$tipoActualizar = ' pagado = '.$pagado;
				break;
			case "3":
				$tipoActualizar = ' facturado = '.$facturado;
				break;
			case "4":
				$tipoActualizar = ' dF4 = '.$dF4;
				break;
			case "5":
				$tipoActualizar = ' dM5 = '.$dM5;
				break;	
	 		default:
				;
		}
		if($autorizadoS == 1 ){ $reseteaAuS = '';}else{ $reseteaAuS = "  autorizadoS = '0', "; } // ENVIA LA SOLICITUD A REVISION DE NUEVO
		$sql_mS_tipoDoc = "UPDATE mttoSol SET ";
		$sql_mS_tipoDoc .= $reseteaAuS;
		$sql_mS_tipoDoc .= $tipoActualizar;
		$sql_mS_tipoDoc .= " WHERE id_mttoSol =  '$id_mttoSol' ";
		$tipoDoc_R = mysqli_query($dbd2, $sql_mS_tipoDoc);
		if($tipoDoc_R)
			$mttoSolUpR = "Update OK ".mysqli_affected_rows($dbd2)." "; // Mensaje confirmación de añadido un Registro a la Base de Datos
		else
			$mttoSolUpR = "Update Failed: ".mysqli_error($dbd2);
		// TERMINA ACTUALIZAR INDICAR TIPO DE DOCUME'NTO SUBIDO


		//MENSAJE POR EL ENVIO EXITOSO Y LA INYECCION A LA BASE EXITOSO
		$flag='ok'; 
		$mensaje=	'<div id="ok">Sus archivo se ha subido con &eacute;xito<br />  '.$anadido.''.$folio.$mttoSolUpR.
					" <br />Gracias <br /> <a href='index.php'>| Ir a inicio | </a>
					| <a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=0&pagina=$pagina&id_usuario=$capturo'  
				style='text-decoration:none;'  title='SUBIR ARCHIVO' >
				<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='SUBIR ARCHIVO' > SUBIR OTRO ARCHIVO
		</a> | </div>";

	}
	else 
	{
		//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
		$flag='err';
		$mensaje='<div id="error">- Falla al subir el archivo. '.@$error_archivo.$mttoSolUpR.'</div>';
	}
}

?>
<script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script>
<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
<?php 

echo @$mensaje; /*mostramos el estado de envio del form */
if($cantidad_archivos > 1) {$plural='s';} else {$plural='';}
if (@$flag!='ok') {  // INICIA Mostrar formulario  ?>

<fieldset><legend>Formulario para subir archivos</legend>
<div id="form">
	<form action="" method="post" enctype="multipart/form-data" >
		<input type="hidden" name="id_mttoSol" value="<?php echo $id_mttoSol; ?>">
			<p><strong>Tipo*</strong>
			<select name = "tipo" >
				  <option value='1' <?php echo $tipo1; ?>>COTIZACION</option>
				  <option value='2' <?php echo $tipo2; ?>>DEPOSITO</option>
				  <option value='3' <?php echo $tipo3; ?>>FACTURA</option>
				  <option value='4' <?php echo $tipo4; ?>>FOTO</option>
				  <option value='5' <?php echo $tipo5; ?>>MAIL</option>
			</select></p>
			<p><strong>Elegir Archivo </strong>
				Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.
		<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>
			<p><input  type="submit" name="enviar" value="enviar" /></p>
	</form>
</div> <!-- end form-->
</fieldset>
<?php }  // TERMINA Mostrar formulario

include('mttoSolDoctoList.php');

} // CIERRE PRIVILEGIOS

echo '<p>'; // INICIO BOTONES
// BOTON PARA VER LA UNIDAD
	echo "
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		";
// BOTON PARA VER LA UNIDAD

// BOTON REGRESAR AL RESUMEN
	echo "
		<a href='mttoSolRes.php?pagina=$pagina' style='text-decoration:none;'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen de Mantenimiento'></a>
		 ";
// BOTON REGRESAR AL RESUMEN

// BOTON REGRESAR DEPOSITOS
if($_SESSION["mttoSolDep"] > 0){
	echo "
		<a href='mttoSolResDep.php?pagina=$pagina' style='text-decoration:none;'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a Depositos Pendientes'></a>
		 ";
}
// BOTON REGRESAR DEPOSITOS
echo '</p>'; // TERMINA BOTONES
include ("1footer.php"); ?>