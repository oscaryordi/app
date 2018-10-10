<?php
include '1header.php';
include ("nav_mtto.php");

$id_prov = $_GET['id_prov'];
echo "<h2> idBD ".$id_prov."</h2><br />";
echo "<h2>SUBIR DOCUMENTOS DE SOPORTE</h2>";
 
include ("provconsultado.php");

//include ("provdoctos.php");

if($_SESSION["mttos"] > 1){ // APERTURA PRIVILEGIOS?>

<title>Subir Documento</title>
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
			do  {
					if($_FILES['archivo']['tmp_name'][$i] !="")
						{
							$fecha = time();
							$aleatorio1 = rand();
							$aleatorio = $fecha.'-'.$aleatorio1;
							$nuevonombre = $aleatorio.'-'.$_FILES['archivo']['name'][$i];
							copy($_FILES['archivo']['tmp_name'][$i], '../exp/prov/2016/'.$nuevonombre); // copy($_FILES['archivo']['tmp_name'][$i], '../jetvan/exp/archivos/'.$nuevonombre); ESTA RUTA FUNCIONO PARA WEBSASTRE.COM
						}	
				$i++;					
				} 
			while ($i < $cantidad_archivos);
		}
	//comprobamos si todos los campos fueron completados ###################################################################
	if ($_POST['id_prov']!='' && $_POST['tipo']!='' && $nuevonombre!='' && $error_archivo=='') {
		$id_prov=$_POST['id_prov'];
		$tipo=$_POST['tipo'];
		$obs=$_POST['obs'];
		$ruta = 'prov/2016';
		
	//INSERTA EN BD, INICIO, Aqui voy aponer el codigo de inserción a la BD
	$dbd=conecta();


	$capturo = $_SESSION['id_usuario'];
	//INSERCION EN BASE
	 $sql_prodocalta = "INSERT INTO `jetvantlc`.`provDocto` (`id_docto`, `id_prov`, `archivo`, `tipo`, `obs`, ruta, `capturo`) 
	 VALUES (NULL, '$id_prov', '$nuevonombre', '$tipo', '$obs', '$ruta','$capturo')"; 

	$res_prodocalta=mysqli_query($dbd2, $sql_prodocalta ); // conexion dio problemas al definir la correcta
	if($res_prodocalta)
		$anadido = "Registrado ".mysqli_affected_rows($dbd2)." archivo"; // Mensaje confirmación de añadido un Registro a la Base de Datos
	else
		$anadido = "ERROR AL AÑADIR: ".mysqli_error($dbd2);
	$sql_id_prodoc = "SELECT id_docto FROM provDocto WHERE archivo='$nuevonombre' ";
	$res_id_prodoc = mysqli_query($dbd2, $sql_id_prodoc); // conexion dio problemas al definir la correcta
	$res_id_prodoc = mysqli_fetch_array($res_id_prodoc);	
	if($res_id_prodoc)
		$folio = ", con el folio: $res_id_prodoc[id_docto]"; // Mensaje confirmación de número Consecutivo de insercion
	//INSERTA EN BD, FIN, Aqui termina le codigo de inserción a la BD

	//MENSAJE POR EL ENVIO EXITOSO Y LA INYECCION A LA BASE EXITOSO
	$flag='ok'; 
	$mensaje='<div id="ok">Sus archivo se ha subido con &eacute;xito<br />  '.$anadido.''.$folio.' <br />Gracias <br /> <a href="index.php">| Ir a inicio | </a></div>';
	include ("provdoctos.php");

	} else {
		
	//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
	$flag='err';
	$mensaje='<div id="error">- Los campos marcados con * son requeridos. '.$error_archivo.'</div>';
	}
}

?>
		<script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script>
		<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
<?php echo @$mensaje; /*mostramos el estado de envio del form */ 
if($cantidad_archivos > 1) {$plural='s';} else {$plural='';}
if (@$flag!='ok') { // MOSTRAR FORMULARIO 

include ("provdoctos.php"); ?>

<fieldset><legend>Formulario para subir archivos</legend>
	<div id="form">

		<form action="<?php echo $PHP_SELF;?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id_prov" value="<?php echo $id_prov; ?>">
			
			<p><strong>Tipo*</strong>
			<select 
			<?php if (isset ($flag) && $_POST['tipo']=='') { echo 'class="error"';} else {echo 'class=""';} ?>
			value="<?php echo $_POST['tipo'];?>"
			name = "tipo" id=select >
				  <option>RFC CEDULA DE IDENTIFICACION FISCAL</option>
				  <option>HOJA DE DATOS BANCARIOS</option>
				  <option>CONVENIO</option>
				  <option>OTRO</option>
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

<?php } // MOSTRAR FORMULARIO


include ("provbancario.php");
include ("provcontacto.php");
include ("provsucursal.php");



// BOTON PARA VER PROVEEDOR // IR AL INDEX DE PROVEEDOR
    echo "<p>
        <FORM action='provindex.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_prov' VALUE='$id_prov'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a CONSULTA DE PROVEEDOR'>
        </FORM>
        </p>";
 // BOTON PARA VER PROVEEDOR // IR AL INDEX DE PROVEEDOR



} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>