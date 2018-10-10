<?php
######################33 ACTUALIZAR PARA INFRACCION
include("1header.php");
echo "<meta charset='utf-8'>";

$id_unidad = $_GET['id_unidad'];
datosxid($id_unidad);

if($_SESSION["infraccionH"] > 0){  // PRIVILEGIO HACER INFRACCION


$id_contrato = 0;
echo "<h3>ID en bd : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie : ".$Serie."</h3><br />";

include ("u4datos.php");
include ("u5placas.php");
include ("u11asignacion.php");

/*
$arrayviejo = "Proveedor ".$_GET['Proveedor']
			.", FechaFactura ".$_GET['FechaFactura']
			.", FolioFactura ".$_GET['FolioFactura']
			.", importe ".$_GET['importe'];
*/

$subido = '';

if(isset($_POST['Infraccionar']))
{

	if($_POST['id_unidad']!='' 
	&& $_POST['id_contrato']!=''
	&& $_POST['folioInf']!='' 
	&& $_POST['importe']!='' )
	{
		$id_unidad 		= mysqli_real_escape_string($dbd2, $_POST['id_unidad'] );
		$id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato'] );
		$folioInf   	= mysqli_real_escape_string($dbd2, $_POST['folioInf'] );
		$fechaInf 		= mysqli_real_escape_string($dbd2, $_POST['fechaInf'] );
		$descripcion 	= mysqli_real_escape_string($dbd2, $_POST['descripcion'] );
		$importe 		= mysqli_real_escape_string($dbd2, $_POST['importe'] );
		$entidad 		= mysqli_real_escape_string($dbd2, $_POST['entidad'] );
		$pagada 		= mysqli_real_escape_string($dbd2, $_POST['pagada'] );
		$coma 			= ',';
		$importe		= str_replace($coma,"",$importe);
		$capturo 		= $_SESSION["id_usuario"];
			
// hacer UPDATE para actualizar datos de factura
		$sql_infAlta = " INSERT INTO infraccion 
		(`id_inf`, `id_unidad`, `id_contrato`, `fechaInf`, `folioInf`, 
		`descripcion`, `importe`, `entidad`, `capturo`, `pagada`) 
		VALUES 
		(NULL, '$id_unidad', '$id_contrato', '$fechaInf', '$folioInf', 
		'$descripcion', '$importe', '$entidad', '$capturo', '$pagada') " ;

		$sql_infAlta_R = mysqli_query($dbd2, $sql_infAlta);

		if($sql_infAlta_R)
		{
			echo '<h2>INFRACCION DADA DE ALTA CORRECTAMENTE</h2>';
			$subido = 'ok'	;
		}
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos, 
		Datos marcados con asterisco son obligatorios  &#9786;</p>";
	}		
}


/*
	$fechaInf 	= $row['fechaInf']; // asignacion corresponde al equipo configurado
	$folioInf 	= $row['folioInf'];
	$descripcion= $row['descripcion'];
	$importe 	= $row['importe'];
*/

if($subido!='ok'){ // ver formulario
?>

<fieldset><legend>Registrar Infracción</legend>
<style>
#alta input {min-width:20px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>REGISTRAR INFRACCION</h2>

<table>
	<input type='hidden' name='id_unidad' value="<?php echo $id_unidad;?>" required>
	<input type='hidden' name='id_contrato' value="<?php echo $id_contrato;?>" required>

	<tr><th>FOLIO *</th>
	<td><input type='text' name='folioInf' value="<?php echo @$_GET['folioInf'];?>" placeholder='folio Infraccion' required ></td>
	</tr>

	<tr><th>FECHA DE INFRACCION *</th>
	<td><input type='date' name='fechaInf' value="<?php echo @$_GET['fechaInf'];?>" placeholder='aaaa-mm-dd' required >aaaa-mm-dd </td>
	</tr>
	
	<tr><th>DESCRIPCION</th>
	<td><input type='text' name='descripcion' value="<?php echo @$_GET['descripcion'];?>" placeholder='descripcion' required ></td>
	</tr>
	
	<tr><th>IMPORTE *</th>
	<td><input type="number" lang="nb" step="0.01" min="0" name='importe' value="<?php echo @$_GET['importe'];?>"	 placeholder='0000.00' required > 0000.00 sin comas</td>
	</tr>

	<tr>
	<th>ENTIDAD CORRESPONDIENTE</th>
	<td>
		<select name = 'entidad' >
			<option value = '0' >---</option>
			<option value = '1' >Aguascalientes</option>
			<option value = '2' >Baja California</option>
			<option value = '3' >Baja California Sur</option>
			<option value = '4' >Campeche</option>
			<option value = '5' >Chiapas</option>
			<option value = '6' >Chihuahua</option>
			<option value = '7' >Ciudad de México</option>
			<option value = '8' >Coahuila de Zaragoza</option>
			<option value = '9' >Colima</option>
			<option value = '10' >Durango</option>
			<option value = '11' >Estado de México</option>
			<option value = '12' >Guanajuato</option>
			<option value = '13' >Guerrero</option>
			<option value = '14' >Hidalgo</option>
			<option value = '15' >Jalisco</option>
			<option value = '16' >Michoacán de Ocampo</option>
			<option value = '17' >Morelos</option>
			<option value = '18' >Nayarit</option>
			<option value = '19' >Nuevo León</option>
			<option value = '20' >Oaxaca</option>
			<option value = '21' >Puebla</option>
			<option value = '22' >Querétaro</option>
			<option value = '23' >Quintana Roo</option>
			<option value = '24' >San Luis Potosí</option>
			<option value = '25' >Sinaloa</option>
			<option value = '26' >Sonora</option>
			<option value = '27' >Tabasco</option>
			<option value = '28' >Tamaulipas</option>
			<option value = '29' >Tlaxcala</option>
			<option value = '30' >Veracruz de Ignacio de la Llave</option>
			<option value = '31' >Yucatán</option>
			<option value = '32' >Zacatecas</option>
		</select>
	</td>
	</tr>

	<tr>
		<th>STATUS PAGO</th>
		<td>
			<input type='radio' name='pagada' id='SI' value='1'
			class='statusI' >
			<label for="SI" class='statusL'>SI<br></label>
			
			<input type='radio' name='pagada' id='NO'  value='0' checked 
			class='statusI' >
			<label for="NO" class='statusL'>NO</label>
		</td>
	</tr>	

	<tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="Infraccionar" value="REGISTRAR INFRACCION"> 
	</td>
	</tr>

</table>
</form>
</fieldset>

<?php } // ver formulario


} // PRIVILEGIO HACER INFRACCION


// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</p>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
//} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>