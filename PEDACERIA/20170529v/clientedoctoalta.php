<?php
include("1header.php");?>
<meta charset='utf-8'>
<?php 
if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS
include ("nav_cliente.php");

$id_cliente 	= $_POST['id_cliente'];
@$id_contrato 	= $_POST['id_contrato'];

if($id_contrato == null){
	$id_contrato = 0;
}


echo "<h2>".$id_cliente." -- ".@$id_contrato." </h2><br />";
include ("clientegral.php");
?>
<title>Subir Archivo</title>
<?php
/*debe estar acompañado de una carpeta con el nombre "archivos" en donde se copiaran los archivos.*/

$url= 'http://www.jetvan.mx/app'; //la URL - SIN LA BARRA AL FINAL
$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.


//proceso del formulario // si existe "enviar"...
if (isset ($_POST['enviar'])) { // INICIO PROCESO DE FORMULARIO

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
					copy($_FILES['archivo']['tmp_name'][$i], '../exp/clientes/2016/'.$nuevonombre); // copy($_FILES['archivo']['tmp_name'][$i], '../jetvan/exp/archivos/'.$nuevonombre); ESTA RUTA FUNCIONO PARA WEBSASTRE.COM
				}	
			$i++;
			} while ($i < $cantidad_archivos);
	}

//comprobamos si todos los campos fueron completados
if ($_POST['id_cliente']!='' && $_POST['tipo']!='' && $nuevonombre!='' && $error_archivo=='') 
	{
		$id_cliente	= $_POST['id_cliente'];    
		$tipo       = $_POST['tipo'];
		$obs        = mysql_real_escape_string($_POST['obs'],$conectar);
		$ruta 		= 'exp/clientes/2016';
		//INICIO INSERTA EN BD, INICIO, Aqui voy aponer el codigo de inserción a la BD


		$capturo = $_SESSION['id_usuario'];
		//INSERCION EN BASE
		 $sql = "INSERT INTO `jetvantlc`.`clfDto` (`id_docto`, id_cliente, `id_contrato`, `archivo`, `tipo`, `obs`, `capturo`, ruta) 
		 VALUES (NULL, '$id_cliente', '$id_contrato', '$nuevonombre', '$tipo', '$obs', '$capturo', '$ruta')"; 
		$res=mysql_query($sql,$conectar); // conexion dio problemas al definir la correcta

			if($res)
				{
					$anadido = "Registrado ".mysql_affected_rows()." archivo"; // Mensaje confirmación de añadido un Registro a la Base de Datos
				}
			else{
					$anadido = "ERROR AL AÑADIR: ".mysql_error();
				}	
			
			$sql_id_sol = "SELECT id_docto FROM clfDto WHERE archivo='$nuevonombre' ";
			$res_id_sol = mysql_query($sql_id_sol,$conectar); // conexion dio problemas al definir la correcta
			$res_id = mysql_fetch_array($res_id_sol);	
				
			if($res_id)
			{
				$folio = ", con el folio: $res_id[id_docto]"; // Mensaje confirmación de número Consecutivo de insercion
			}
		//TERMINA INSERTA EN BD, FIN, Aqui termina le codigo de inserción a la BD
				
		//MENSAJE POR EL ENVIO EXITOSO Y LA INYECCION A LA BASE EXITOSO
		$flag='ok'; 
		$mensaje='<div id="ok">Sus archivo se ha subido con &eacute;xito<br />  '.$anadido.''.$folio.' <br />Gracias <br /> </div>'; // <a href="index.php">| Ir a inicio | </a>
		// include ("u9docto.php");
	} 
	else 
	{	//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
		$flag='err';
		$mensaje='<div id="error">- Los campos marcados con * son requeridos. '.$error_archivo.'</div>';
	}
} // TERMINA PROCESO DE FORMULARIO

?>
		<script async src="js/jquery-1.4.2.min.js"		type="text/javascript"></script>
		<script async src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
		
<?php echo @$mensaje; /*mostramos el estado de envio del form */ ?>

<?php if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} ?>

<?php if (@$flag!='ok') { // INICIO Mostrar formulario ?>
<?php include_once ("base.inc.php"); ?>
<?php // include ("u9docto.php"); ?>

<fieldset><legend>Formulario para subir archivos</legend>
<div id="form">

	<form action="<?php echo $PHP_SELF;?>" method="POST" enctype="multipart/form-data" >
	    <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
	    <input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>">

		<p><strong>Tipo*</strong>
		<select 
		<?php if (isset ($flag) && $_POST['tipo']=='') { echo 'class="error"';} else {echo 'class=""';} ?>
		value="<?php echo $_POST['tipo'];?>"
		name = "tipo" id=select >
			  <option>RFC</option>
			  <option>OTRO</option>
		</select></p>

		<p><strong>Elegir Archivo </strong>
			Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.
		<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>
		
		<p><strong>Observaciones*</strong><br />	
		<input style="font-size:1em;" <?php if (isset ($flag) && $_POST['obs']=='') { echo 'class="error"';} 
		else {echo 'class="campo"';} ?> type="text" name="obs" value="<?php echo @$_POST['obs'];?>" /></p>

		<p><input  type="submit" name="enviar" value="Subir Archivo" /></p>
	</form>
</div> <!-- end form-->
</fieldset>

<?php }   // TERMINA Mostrar Formulario ?>
<?php } // CIERRE PRIVILEGIOS ?>

<?php // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<td>
        </FORM><FORM action='clienteindexuno.php' method='POST'>
			<INPUT TYPE='hidden' NAME='rfc' value='$rfc'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a Cliente'>
		</FORM>
        </td>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA ?> 

<?php include ("1footer.php"); ?>

<?php //$_SESSION["id_usuario"]; ?>