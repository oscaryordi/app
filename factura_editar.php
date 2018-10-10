<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["datos"] > 1){  // APERTURA PRIVILEGIOS

$uNEco = $_GET['uNEco'];

$arrayviejo = "Proveedor ".$_GET['Proveedor'].", FechaFactura ".$_GET['FechaFactura'].", FolioFactura ".$_GET['FolioFactura'].", importe ".$_GET['importe'];

echo "<h2>".$uNEco."</h2><br />";

include ("1datos.php");
include ("1placas.php");

$subido = '';

if(isset($_POST['Datos']))
{
	if($_POST['proveedor']!='' 
	&& $_POST['fechafactura']!=''
	&& $_POST['foliofactura']!='' 
	&& $_POST['importeivainc']!='' )
	{
			$coma = ',';
			$proveedor=$_POST['proveedor'];
			$fechafactura=$_POST['fechafactura'];
			$foliofactura=$_POST['foliofactura'];
			$importeivainc=$_POST['importeivainc'];
			$importeivainc= str_replace($coma,"",$importeivainc);
			$capturo = $_SESSION["id_usuario"];
			
			// hacer UPDATE para actualizar datos de factura			
			$sql_factura_up = " UPDATE `jetvantlc`.`facturaunidad` SET 
			 Proveedor ='$proveedor', FechaFactura ='$fechafactura', 
			 FolioFactura = '$foliofactura', Importe = '$importeivainc', 
			 capturo='$capturo' WHERE Economico = '$uNEco' LIMIT 1 " ;
			
			$factura_registrada_up = mysqli_query($dbd2, $sql_factura_up);
			/*
			UPDATE `jetvantlc`.`facturaunidad` SET `Proveedor` = 'VAMSA  AGUASCALIENTES, S.A. DE C.V.',
			`FechaFactura` = 'miércoles,  04 de mayo de 2011',
			`FolioFactura` = '3 1078',
			`Importe` = '106628.01',
			`capturo` = '1' WHERE `facturaunidad`.`id` =1 LIMIT 1 ;
			*/

			if($factura_registrada_up)
			{ 
			$sql_factura_up = mysqli_real_escape_string($dbd2, $sql_factura_up );
			$arrayviejo 	= mysqli_real_escape_string($dbd2, $arrayviejo );
			
			$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
			(id_cambios, capturo, updatequery, arrayviejo, fecharegistro) 
			VALUES 
			(NULL, '$capturo', '$sql_factura_up', '$arrayviejo', CURRENT_TIMESTAMP ) ";
			
			$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);

			//			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2) . "\n"; // PARA DETECTAR ERROR EN QUERY
			
				if($cambio_registrado)
				{
					echo '<h2>DATOS DE FACTURA ACTUALIZADOS CORRECTAMENTE</h2>';
					include ("1factura.php");
				}
			}
			$subido = 'ok'	;
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}


if($subido!='ok')
{?>

<fieldset><legend>Editar datos de Factura</legend>
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>ACTUALIZAR DATOS DE FACTURA</h2>

<table>
	<tr><th>PROVEEDOR</th>
	<td><input type='text' name='proveedor' value="<?php echo @$_GET['Proveedor'];?>" placeholder='proveedor'></td></tr>
	
	<tr><th>FECHA DE FACTURA</th>
	<td><input type='text' name='fechafactura' value="<?php echo @$_GET['FechaFactura'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td></tr>
	
	<tr><th>FOLIO DE FACTURA</th>
	<td><input type='text' name='foliofactura' value="<?php echo @$_GET['FolioFactura'];?>" placeholder='folio factura'></td></tr>
	
	<tr><th>IMPORTE IVA INCLUIDO</th>
	<td><input type='text' name='importeivainc' value="<?php echo @$_GET['importe'];?>"	 placeholder='0000.00'></td></tr>

	<tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="Datos" value="Actualizar Datos de Factura"> 
	</td>
	</tr>
</table>
</form>
</fieldset>

<?php 
} 
} // CIERRE PRIVILEGIOS 
include ("1footer.php");?>