<?php
include("1header.php");
echo "<meta charset='utf-8'>";
date_default_timezone_set('America/Mexico_city');

if($_SESSION["direccion"] > 0 || $_SESSION["compra"] > 0 || $_SESSION["movForaneo"] > 0)
{  // APERTURA PRIVILEGIOS
	$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie	 : ".$Serie."</h3><br />";
include ("u4datos.php");
include ("u5placas.php");

$subido = '';

if(isset($_POST['Datos']))
{
	$fechaRegistro  =	mysqli_real_escape_string($dbd2, $_POST['fechaRegistro']);
	$horaRegistro  	=	mysqli_real_escape_string($dbd2, $_POST['horaRegistro']);
	$fechaRegistro 	= 	$fechaRegistro." ".$horaRegistro;

	ECHO $fechaRegistro;

	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	$proceder = 'no' ;
    if( validateDate($fechaRegistro, 'Y-m-d H:i:s') == true )
	{ $proceder = 'ok' ;}
	else
	{ $proceder = ', favor de usar formato de Fecha aaaa-mm-dd hh:mm:ss' ;}

	if(
	$_POST['cliente']!='' && 
	$_POST['ubicacion']!='' && 
	$proceder == 'ok' 
	)
	{
		$cliente 		=mysqli_real_escape_string($dbd2, $_POST['cliente']);
		$ubicacion   	=mysqli_real_escape_string($dbd2, $_POST['ubicacion']);
 		$capturo		= $_SESSION["id_usuario"];

		$sql_uba = 'INSERT INTO `jetvantlc`.`movimientos` 
					(`id`, `id_unidad`, `cliente`, `ubicacion`, `fechaRegistro`, 
					`capturo`) VALUES ';
		$sql_uba .= "(NULL, '$id_unidad', '$cliente', '$ubicacion','$fechaRegistro', 
					'$capturo') ;" ;

		$uba_registrada = mysqli_query($dbd2, $sql_uba );

		if($uba_registrada)
		{ 
			echo '<h2>UBICACION ACTUALIZADA CORRECTAMENTE</h2>';
			include ("u6ubicacion.php");
		}
		$subido = 'ok'	;
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786; $proceder</p>";
	}
}

if($subido!='ok'){ // INICIO FORMULARIO

include ("u6ubicacion.php");
?>
<style>
	#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
<h2>ACTUALIZAR UBICACION</h2>
<table>
	<tr>
		<th>CLIENTE</th>
		<td><input type='text' name='cliente' 
			value="<?php echo @$_POST['cliente'];?>" 
			placeholder='cliente'>
		</td>
	</tr>
	<?php 
	$ubicacionCompra = '';
	if($_SESSION["compra"] == 1){ // PARA QUE SUPERVISOR COMPRAS PONGA UBICACION ORDEN DE COMPRA
		$ubicacionCompra = 'ORDEN DE COMPRA';
		}
	?>
	<tr>
		<th>UBICACION</th>
		<td><input type='text' name='ubicacion' 
			value="<?php echo @$_POST['ubicacion'];?><?php echo $ubicacionCompra;?>" 
			placeholder='ubicacion'>
		</td>
	</tr>
	<tr>
		<th>FECHA DEL REGISTRO</th>
		<td><input type='date' name='fechaRegistro' 
			value="<?php echo @$_POST['fechaRegistro'];?>" 
			placeholder='aaaa-mm-dd'>aaaa-mm-dd 
		</td>
	</tr>
	<tr>
		<th>HORA</th>
		<td><input type='time' name='horaRegistro' 
			value="<?php  echo date("H:i:s");;?>" 
			placeholder='00:00:00'>
		</td>
	</tr>
	<tr>
	   <td colspan=2 style="text-align:center;" >
	   <input id="gobutton2" type="submit" name="Datos" value="Actualizar Ubicacion"> 
	   </td>
	</tr>
</table>
</form>
<?php } // CIERRE FORMULARIO
} // CIERRE PRIVILEGIOS

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<td>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</td>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 
include ("1footer.php");
?>