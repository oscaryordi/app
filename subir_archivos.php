<?php
$TipoBusqueda = 'Subir Archivo';

include '1header.php';

$uNEco = $_GET['uNEco'];

echo "<h2>".$uNEco."</h2><br />";

include ("1datos.php");
include ("1placas.php");


if($_SESSION["documentos"] > 1){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO ?>

<title>Subir Archivo</title>
<?php
/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/
include_once("conecta.inc.php");// esto es para ingresar datos en la base
$url= 'http://sistema.jetvan.com.mx/app'; //la URL - SIN LA BARRA AL FINAL
$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.
?>
<?PHP
//proceso del formulario // si existe "enviar"...
if (isset ($_POST['enviar'])) {
//comprobamos si se seleccionaron archivos, los cargamos en el servidor
if (isset($_FILES['archivo']['tmp_name'])) {
	$i=0;
	do  {
		if($_FILES['archivo']['tmp_name'][$i] !="")
			{
			$fecha		= time();
			$aleatorio1 = rand();
			$aleatorio 	= $fecha.'-'.$aleatorio1;
			$nuevonombre = $aleatorio.'-'.$_FILES['archivo']['name'][$i];
			copy($_FILES['archivo']['tmp_name'][$i], '../exp/2016/mayo/'.$nuevonombre); // copy($_FILES['archivo']['tmp_name'][$i], '../jetvan/exp/archivos/'.$nuevonombre); ESTA RUTA FUNCIONO PARA WEBSASTRE.COM
			}	
			$i++;			
		} while ($i < $cantidad_archivos);
}
//comprobamos si todos los campos fueron completados
if ($_POST['economico']!='' && $_POST['tipo']!='' && $nuevonombre!='' && $error_archivo=='') {
$economico=$_POST['economico'];
$tipo=$_POST['tipo'];
$obs=$_POST['obs'];

//INSERTA EN BD, INICIO, Aqui voy aponer el codigo de inserción a la BD
$dbd=conecta();


$capturo = $_SESSION['id_usuario'];
//INSERCION EN BASE
 $sql = "	INSERT INTO `jetvantlc`.`expedientes` 
 			(`id`, `economico`, `archivo`, `tipo`, `obs`, `fechareg`, `capturo`) 
 			VALUES 
 			(NULL, '$economico', '$nuevonombre', '$tipo', '$obs', CURRENT_TIMESTAMP, '$capturo')"; 

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
$mensaje='<div id="ok">Sus archivo se ha subido con &eacute;xito<br />  '.$anadido.''.$folio.' <br />Gracias <br /> <a href="index.php">| Ir a inicio | </a></div>';
include ("1documentos.php");

} else {
	
//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
$flag='err';
$mensaje='<div id="error">- Los campos marcados con * son requeridos. '.$error_archivo.'</div>';
}
}

?>
		<script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script>
		<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
		
<!--<h2>Subir Archivos</h2>
<p>Formulario para subir archivos</p>
-->
<?php echo @$mensaje; /*mostramos el estado de envio del form */

if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} 

if (@$flag!='ok') {
include ("1documentos.php"); 
?>
<fieldset><legend>Formulario para subir archivos</legend>
<div id="form">

<form action="<?php echo $PHP_SELF;?>" method="post" enctype="multipart/form-data">
	
<!--	<p><strong>Economico*</strong> 
	<input  size="10" <?php // if (isset ($flag) && $_POST['economico']=='') { echo 'class="error"';} 

	 // else {echo 'class="campo"';} ?> type="text" name="economico" id='search' value="<?php //echo @$_GET['uNEco'];?>" /></p>
	
	<INPUT TYPE="text" NAME="uNEco" VALUE="<?php //echo $uNEco; ?>" disabled >
-->	<input type="hidden" name="economico" value="<?php echo $uNEco; ?>">
	
	
	
	<p><strong>Tipo*</strong>
	<select 
	<?php if (isset ($flag) && $_POST['tipo']=='') { echo 'class="error"';} else {echo 'class=""';} ?>
	value="<?php echo $_POST['tipo'];?>"
	name = "tipo" id=select >
		  <option>FACTURA</option>
		  <option>POLIZA DE SEGURO</option>
		  <option>TARJETA DE CIRCULACION</option>
		  <option>VERIFICACION AMBIENTAL</option>
		  <option>TENENCIA</option>
		  <option>SINIESTRO</option>
		  <option>MANTENIMIENTO</option>
		  <option>OTRO</option>
	</select></p>

	<p><strong>Elegir Archivo </strong>
		Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.
	<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>
	
	<p><strong>Observaciones*</strong><br />	
	<input  size="95%" <?php if (isset ($flag) && $_POST['obs']=='') { echo 'class="error"';} 
	else {echo 'class="campo"';} ?> type="text" name="obs" value="<?php echo @$_POST['obs'];?>" /></p>

	<p><input  type="submit" name="enviar" value="enviar" /></p>
	</form>
<?php } ?>
</div> <!-- end form-->
</fieldset>


<?php } // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>