<?php
include("1header.php");


$id_siniestro 	= mysqli_real_escape_string($dbd2, $_GET['id_siniestro']);

if(($_SESSION["siniestro"] > 1)){ //INICIO  VISTA EJECUTIVOS jet van y administradores de contrato

echo "<script defer src='https://use.fontawesome.com/releases/v5.0.9/js/all.js' 
	integrity='sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl' 
	crossorigin='anonymous'></script>";

include("nav_sin.php");
echo "<h2>DETALLE DE SINIESTRO</h2>";
echo "<h3>$id_siniestro</h3>";


	$sql_sin = 'SELECT `id_unidad`, id_siniestro, `cdSin`, 
					`motivo`, `fechaSin`, `numSin`, `status`, id_cliente  
					FROM `siniestro` '
				. "  WHERE id_siniestro = '$id_siniestro' ";

	include('sinResultSet.php');

echo "<br><br>";
//include ("movCD.php");
include ("sinCD.php");
echo "<h3>SUBIR ESCANEO DE DOCUMENTOS RELACIONADOS AL SINIESTRO</h3>";

// INICIA FORMULARIO SUBIR FACTURA
######### ######### ######### ######### ######### 

/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/
$url= $urlPrincipal; //la URL - SIN LA BARRA AL FINAL
$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.


//proceso del formulario // si existe "enviar"...
if (isset ($_POST['enviar']))  // INICIO PROCESAR FORMULARIO
{
	$id_siniestro 	=mysqli_real_escape_string($dbd2, $_POST['id_siniestro']);
	$capturo	   	= $_SESSION["id_usuario"];

	date_default_timezone_set('America/Mexico_city');
	$fechareg 		= date("Y-m-d H:i:s");

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
											copy($_FILES['archivo']['tmp_name'][$i], '../exp/siniestro/'.$rutaz.'/'.$nuevonombre);
										} 
										// TERMINA si el formato es correcto lo copiamos
									}	
								$i++;
								} while ($i < $cantidad_archivos);

							// INICIA SI LA CARGA FUE CORRECTA registramos en base de datos
							if(file_exists('../exp/siniestro/'.$rutaz.'/'.@$nuevonombre) && @$nuevonombre != '')
							{
									
								//$id_estimacion; // DEFINIDA ARRIBA
								$archivo 	= $nuevonombre;
								$tipo 		= 0;//mysqli_real_escape_string($dbd2, $_POST['tipo']);
								$obsD 		= 0;//mysqli_real_escape_string($dbd2, $_POST['obsD']); // OBSERVACIONES DOCUMENTO
								$importeDto = 0;//mysqli_real_escape_string($dbd2, $_POST['importeDto']); // importe del DOCUMENTO
								$ruta 		= $rutaz;
								$extension 	= $fileType;
								$tamanio 	= filesize('../exp/siniestro/'.$rutaz.'/'.$nuevonombre);
								$nombreO 	= $nombreOriginal;
								//$capturo 	= $_SESSION['id_usuario']; // DEFINIDA ARRIBA
								//$fechareg 	= ''; // DEFINIDA ARRIBA

								//INSERTA EN BD, INICIO, Aqui voy a poner el codigo de inserción a la BD
								//INSERCION EN BASE
								$sqlMovArch = 	"	INSERT INTO `sinDocto` 
										(id_docto, id_siniestro, archivo, tipo, 
										importeDto,
										obs, ruta, extension, tamanio, 
										nombreO, capturo, fechareg ) 
										VALUES 
										(NULL, '$id_siniestro', '$archivo', '$tipo', 
										'$importeDto',
										'$obsD', '$ruta', '$extension', '$tamanio', 
										'$nombreO', '$capturo',  '$fechareg') "; 
								$sqlMovArchR 	= mysqli_query($dbd2, $sqlMovArch ); // conexion dio problemas al definir la correcta
								$sqlMovArchID 	= mysqli_insert_id($dbd2);

								if(!$sqlMovArchR)
								{
										echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL CARGAR ARCHIVO\n";
								}
								else
								{
									$flag = 'ok';
								}
							} // TERMINA SI LA CARGA FUE CORRECTA registramos en base de datos
						} // TERMINA SI EXISTE EL ARCHIVO
	include'sinDoctoRes.php';
	echo "<h4>NOMBRE ORIGINAL : $nombreOriginal </h4>"; // VARIABLE DE CONTROL
	// TERMINA SUBIR ARCHIVO AL SERVIDOR
	echo "<h4>ARCHIVO SUBIDO Y REGISTRADO CORRECTAMENTE CON EL FOLIO $sqlMovArchID (docto) </h4>";
	echo "<h5><a href='sinDoctoAlta.php?id_siniestro=$id_siniestro'>SUBIR OTRO DOCUMENTO RELATIVO A ESTE SINIESTRO</a></h5>";
	// PONER DATOS DE ESTIMACION INDIVIDUAL
} // TERMINA PROCESAR FORMULARIO

?>
		<script async src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- <script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script> -->
		<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
<?php
echo @$mensaje; /*mostramos el estado de envio del form */ 

if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} 

if (@$flag!='ok') {  // INICIA Mostrar formulario
	include'sinDoctoRes.php';
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_siniestro" value="<?php echo $id_siniestro; ?>">
<br>
<fieldset>
<h4>SUBIR ESCANEO DE DOCUMENTO:</h4>
<div id="form">

		<p><strong>Elegir Archivo </strong>
			Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.

		<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>

</div> <!-- end form-->
<div id="boton_S" style="padding:5px 30px;" >
<input  type="submit" name="enviar" value="SUBIR" />
</div>
</fieldset>
</form>

<?php }// TERMINA Mostrar formulario  
######### ######### ######### ######### ######### 
// TERMINA FORMULARIO SUBIR 

} // TERMINA VISTA 
include("1footer.php");?>