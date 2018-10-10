<?php
include '1header.php';
	
$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie	 : ".$Serie."</h3><br />";	
echo "SUBIR FOTOS </br>";	


include ("fotoUnidadCD.php"); // CREAR DIRECTORIO PARA CARGA DE FOTO


if($_SESSION["fotoUnidad"] > 0){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO 

echo "<title>Subir Archivo</title>";

/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/
$url= 'https://sistema.jetvan.com.mx/app'; //la URL - SIN LA BARRA AL FINAL
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
						$fileType != "PNG" && 
						$fileType != "jpg" && 
						$fileType != "JPG" && 
						$fileType != "tiff" && 
						$fileType != "TIFF" && 
						$fileType != "pdf" && 
						$fileType != "PDF" && 
						$fileType != "bmp" && 
						$fileType != "BMP" && 
						$fileType != "gif" && 
						$fileType != "GIF" && 
						$fileType != "tif" && 
						$fileType != "TIF" && 
						$fileType != "jpeg" && 
						$fileType != "JPEG"  )	
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
						copy($_FILES['archivo']['tmp_name'][$i], '../exp/fotos/'.$rutaz.'/'.$nuevonombre);
					}
				}		
				$i++;
			} while ($i < $cantidad_archivos);
		}

	//comprobamos si todos los campos fueron completados
	if ($_POST['id_unidad']!='' && $_POST['tipo']!='' && @$nuevonombre!='' && (@$error_archivo=='' OR is_null(@$error_archivo)) ) 
	{
		// PREPARAR VARIABLES
		$id_unidad  = mysqli_real_escape_string($dbd2, $_POST['id_unidad']);	
		$tipo	    = mysqli_real_escape_string($dbd2, $_POST['tipo']);
		$obs		= mysqli_real_escape_string($dbd2, $_POST['obs']);
		$capturo 	= $_SESSION['id_usuario'];
		$tamano 	= filesize('../exp/fotos/'.$rutaz.'/'.$nuevonombre);

		//INSERTA EN BD, INICIO, Aqui voy aponer el codigo de inserción a la BD
		//INSERCION EN BASE
		 $sql = "INSERT INTO `jetvantlc`.`fotoUnidad` 
		 		(`id_foto`, id_unidad, `archivo`, `tipo`, `obs`, `fechareg`, `capturo`, `ruta`, `tamano`) 
		 		VALUES 
		 		(NULL, '$id_unidad', '$nuevonombre', '$tipo', '$obs', CURRENT_TIMESTAMP, '$capturo', '$rutaz', '$tamano')"; 

		$res=mysqli_query($dbd2, $sql ); // conexion dio problemas al definir la correcta
		if($res){
			$anadido = "Registrado ".mysqli_affected_rows($dbd2)." archivo"; // Mensaje confirmación de añadido un Registro a la Base de Datos
			$id_foto = mysqli_insert_id($dbd2);
		}
		else
			$anadido = "ERROR AL AÑADIR: ".mysqli_error($dbd2);
		
		if($res)
			$folio = ", con el folio: $id_foto "; // Mensaje confirmación de número Consecutivo de insercion
		//INSERTA EN BD, FIN, Aqui termina le codigo de inserción a la BD

		//MENSAJE POR EL ENVIO EXITOSO Y LA INYECCION A LA BASE EXITOSO
		$flag='ok';
		include ("u4datos.php");
		include ("u5placas.php");
		$mensaje='<div id="ok">Sus archivo se ha subido con &eacute;xito<br />  '.$anadido.''.$folio.' <br />Gracias <br /> <a href="index.php">| Ir a inicio | </a></div>';
		//include ("u9docto.php");
		echo $tamano; // son los numeros raros que aparecen antes de lo punteado
	}
	else 
	{
		//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
		$flag='err';
		$mensaje='<div id="error">- Los campos marcados con * son requeridos. '.@$error_archivo.'</div>';
	}
}

?>
		<script async src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- <script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script> -->
		<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
		
<?php echo @$mensaje; /*mostramos el estado de envio del form */ 

if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} 
if (@$flag!='ok') {  // INICIA Mostrar formulario

include ("u4datos.php");
include ("u5placas.php");

?>
	<fieldset><legend>Formulario para subir archivos</legend>
		<div id="form">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_unidad" value="<?php echo $id_unidad; ?>">
				<p><strong>Tipo*</strong>
				<select 
				<?php if (isset ($flag) && $_POST['tipo']=='') { echo 'class="error"';} else {echo 'class=""';} ?>
				value="<?php echo $_POST['tipo'];?>"
				name = "tipo" id=select >
					  <option value='1'>FRENTE</option>
					  <option value='2'>LADO CONDUCTOR</option>
					  <option value='3'>ATRAS</option>
					  <option value='4'>LADO COPILOTO</option>
					  <option value='5'>PORTADA CONSULTA</option>
					  <option value='6'>SERIE</option>
					  <option value='7'>SERIE / GPS</option>
				</select></p>

				<p><strong>Elegir Archivo </strong>
					Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.
				<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>
				
				<p><strong>Observaciones</strong><br />	
				<input  size="95%" <?php if (isset ($flag) && $_POST['obs']=='') { echo 'class="error"';} 
				else {echo 'class="campo"';} ?> type="text" name="obs" value="<?php echo @$_POST['obs'];?>" /></p>

				<p><input  type="submit" name="enviar" value="enviar" /></p>
			</form>
		</div> <!-- end form-->
	</fieldset>
<?php }// TERMINA Mostrar formulario  
}// CIERRE PRIVILEGIOS 
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</p>";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 
include ("1footer.php"); ?>