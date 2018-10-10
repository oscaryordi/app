<?php
include '1header.php';
include_once ("base.inc.php");
include_once ("funcion.php");    
    
$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";    
    
include ("u4datos.php");
include ("u5placas.php");

include ("u9doctoaltacreadirectorio.php");


if($_SESSION["documentos"] > 1){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO ?>

<title>Subir Archivo</title>
<?php
/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/
//include_once("conecta.inc.php");// esto es para ingresar datos en la base
$url= 'http://www.jetvan.mx/app'; //la URL - SIN LA BARRA AL FINAL
$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.
?>
<?PHP
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
							$fecha = time();
							$aleatorio1 = rand();
							$aleatorio = $fecha.'-'.$aleatorio1;
							$nuevonombre = $aleatorio.'-'.$_FILES['archivo']['name'][$i];
							copy($_FILES['archivo']['tmp_name'][$i], '../exp/'.$rutaz.'/'.$nuevonombre); // copy($_FILES['archivo']['tmp_name'][$i], '../jetvan/exp/archivos/'.$nuevonombre); ESTA RUTA FUNCIONO PARA WEBSASTRE.COM
						}
					}		
					$i++;
				} while ($i < $cantidad_archivos);
		}




	//comprobamos si todos los campos fueron completados
	if ($_POST['economico']!='' && $_POST['tipo']!='' && @$nuevonombre!='' && @$error_archivo=='') 
	{
		$economico  =$_POST['economico'];
		$id_unidad  =$_POST['id_unidad'];    
		$tipo       =$_POST['tipo'];
		$obs        =mysql_real_escape_string($_POST['obs'],$conectar);
		//INSERTA EN BD, INICIO, Aqui voy aponer el codigo de inserción a la BD
		$dbd=conecta();

		$capturo = $_SESSION['id_usuario'];
		//INSERCION EN BASE
		 $sql = "INSERT INTO `jetvantlc`.`expedientes` (`id`, id_unidad, `economico`, `archivo`, `tipo`, `obs`, `fechareg`, `capturo`, `ruta`) 
		 VALUES (NULL, '$id_unidad', '$economico', '$nuevonombre', '$tipo', '$obs', CURRENT_TIMESTAMP, '$capturo', '$rutaz')"; 

		$res=mysql_query($sql,$conectar); // conexion dio problemas al definir la correcta
		if($res)
			$anadido = "Registrado ".mysql_affected_rows()." archivo"; // Mensaje confirmación de añadido un Registro a la Base de Datos
		else
			$anadido = "ERROR AL AÑADIR: ".mysql_error();
		$sql_id_sol = "SELECT id FROM expedientes WHERE archivo='$nuevonombre' ";
		$res_id_sol = mysql_query($sql_id_sol,$conectar); // conexion dio problemas al definir la correcta
		$res_id = mysql_fetch_array($res_id_sol);	
		if($res_id)
			$folio = ", con el folio: $res_id[id]"; // Mensaje confirmación de número Consecutivo de insercion
		//INSERTA EN BD, FIN, Aqui termina le codigo de inserción a la BD

		//MENSAJE POR EL ENVIO EXITOSO Y LA INYECCION A LA BASE EXITOSO
		$flag='ok'; 
		$mensaje='<div id="ok">Sus archivo se ha subido con &eacute;xito<br />  '.$anadido.''.$folio.' <br />Gracias <br /> <a href="index.php">| Ir a inicio | </a></div>';
		include ("u9docto.php");

	} else 
		{
			//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
			$flag='err';
			$mensaje='<div id="error">- Los campos marcados con * son requeridos. '.@$error_archivo.'</div>';
		}
}

?>
		<script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script>
		<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
		
<?php echo @$mensaje; /*mostramos el estado de envio del form */ ?>

<?php if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} ?>
<?php if (@$flag!='ok') {  // INICIA Mostrar formulario  ?>
	<?php include_once ("base.inc.php"); ?>
	<?php include ("u9docto.php"); ?>

	<fieldset><legend>Formulario para subir archivos</legend>
	<div id="form">

		<form action="" method="post" enctype="multipart/form-data">
			<!--	<p><strong>Economico*</strong> 
			<input  size="10" <?php // if (isset ($flag) && $_POST['economico']=='') { echo 'class="error"';} 

			 // else {echo 'class="campo"';} ?> type="text" name="economico" id='search' value="<?php //echo @$_GET['uNEco'];?>" /></p>
			
			<INPUT TYPE="text" NAME="uNEco" VALUE="<?php //echo $uNEco; ?>" disabled >
		-->	<input type="hidden" name="economico" value="<?php echo $Economico; ?>">
		    <input type="hidden" name="id_unidad" value="<?php echo $id_unidad; ?>">
			
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
<?php }  // TERMINA Mostrar formulario  ?>
<?php } // CIERRE PRIVILEGIOS ?>
<?php // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<p>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </p>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA ?> 
<?php include ("1footer.php"); ?>

<?php //$_SESSION["id_usuario"]; ?>