<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["datos"] > 1){  // APERTURA PRIVILEGIOS 

$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie : ".$Serie."</h3><br />";

include ("u4datos.php");
include ("u5placas.php");

$arrayviejo = "Proveedor ".$_GET['Proveedor']
			.", FechaFactura ".$_GET['FechaFactura']
			.", FolioFactura ".$_GET['FolioFactura']
			.", importe ".$_GET['importe'];

$subido = '';

if(isset($_POST['Datos'])){
	
	if($_POST['proveedor']!='' 
	&& $_POST['fechafactura']!=''
	&& $_POST['foliofactura']!='' 
	&& $_POST['importeivainc']!='' )
	{
		
		$proveedor 		=mysqli_real_escape_string($dbd2, $_POST['proveedor'] );
		$fechafactura   =mysqli_real_escape_string($dbd2, $_POST['fechafactura'] );
		$foliofactura   =mysqli_real_escape_string($dbd2, $_POST['foliofactura'] );
		$importeivainc  =mysqli_real_escape_string($dbd2, $_POST['importeivainc'] );	
		$coma 			= ',';
		$importeivainc	= str_replace($coma,"",$importeivainc);
		$capturo 		= $_SESSION["id_usuario"];
			
// hacer UPDATE para actualizar datos de factura
		$sql_factura_up = "UPDATE `jetvantlc`.`facturaunidad` SET 
			 Proveedor ='$proveedor', FechaFactura ='$fechafactura', 
			 FolioFactura = '$foliofactura', Importe = '$importeivainc', 
			 capturo='$capturo' WHERE id_unidad = '$id_unidad' LIMIT 1 " ;
			
		$factura_registrada_up = mysqli_query($dbd2, $sql_factura_up);

		if($factura_registrada_up)
		{ 
			$sql_factura_up = mysqli_real_escape_string($dbd2, $sql_factura_up );
			$arrayviejo 	= mysqli_real_escape_string($dbd2, $arrayviejo );
			
			$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
			(id_cambios, capturo, updatequery, arrayviejo, fecharegistro) 
			VALUES (NULL, '$capturo', '$sql_factura_up', '$arrayviejo', CURRENT_TIMESTAMP ) ";
			
			$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);

		
			if($cambio_registrado)
			{
				echo '<h2>DATOS DE FACTURA ACTUALIZADOS CORRECTAMENTE</h2>';
				include ("u7factura.php");
			}
		}
		$subido = 'ok'	;
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}


if($subido!='ok'){
include ("u7factura.php");
?>

<fieldset><legend>Editar datos de Factura</legend>
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>ACTUALIZAR DATOS DE FACTURA</h2>

<table>
	<tr><th>PROVEEDOR</th>
	<td><input type='text' name='proveedor' value="<?php echo @$_GET['Proveedor'];?>" placeholder='proveedor' required ></td></tr>
	
	<tr><th>FECHA DE FACTURA</th>
	<td><input type='date' name='fechafactura' value="<?php echo @$_GET['FechaFactura'];?>" placeholder='aaaa-mm-dd' required >aaaa-mm-dd </td></tr>
	
	<tr><th>FOLIO DE FACTURA</th>
	<td><input type='text' name='foliofactura' value="<?php echo @$_GET['FolioFactura'];?>" placeholder='folio factura' required ></td></tr>
	
	<tr><th>IMPORTE IVA INCLUIDO</th>
	<td><input type="number" lang="nb" step="0.01" min="0" name='importeivainc' value="<?php echo @$_GET['importe'];?>"	 placeholder='0000.00' required > 0000.00 sin comas</td></tr>

	<tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="Datos" value="Actualizar Datos de Factura"> 
	</td>
	</tr>

</table>
</form>
</fieldset>

<?php }

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</p>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>