<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["datos"] > 1){  // APERTURA PRIVILEGIOS 

$uNEco = $_GET['uNEco'];

echo "<h2>".$uNEco."</h2><br />";


include ("1datos.php");
include ("1placas.php");

$subido = '';

if(isset($_POST['Datos'])){
	
	if($_POST['proveedor']!='' 
	&& $_POST['fechafactura']!=''
	&& $_POST['foliofactura']!='' 
	&& $_POST['importeivainc']!='' ){
		
			$proveedor=$_POST['proveedor'];
			$fechafactura=$_POST['fechafactura'];
			$foliofactura=$_POST['foliofactura'];
			$importeivainc=$_POST['importeivainc'];	
			$capturo = $_SESSION["id_usuario"];

			$sql_factura = 'INSERT INTO `jetvantlc`.`facturaunidad` 
			(`id`, `Economico`, `Proveedor`, `FechaFactura`, `FolioFactura`, `Importe`, `capturo`) VALUES ';
			$sql_factura .= "(NULL, '$uNEco', '$proveedor', '$fechafactura', '$foliofactura', '$importeivainc', '$capturo') ;" ;
			
			$factura_registrada = mysqli_query($dbd2, $sql_factura);
			
			if($factura_registrada){ 
				echo '<h2>DATOS DE FACTURA REGISTRADOS CORRECTAMENTE</h2>';
				include ("1factura.php");
				}
			
			$subido = 'ok'	;			
			}
			else
				{	
				echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
				}
}

?>

<?php if($subido!='ok'){?>


<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>REGISTRAR DATOS DE FACTURA</h2>

<table>
	<tr><th>PROVEEDOR</th>
	<td><input type='text' name='proveedor' value="<?php echo @$_POST['proveedor'];?>" placeholder='proveedor'></td></tr>
	
	<tr><th>FECHA DE FACTURA</th>
	<td><input type='text' name='fechafactura' value="<?php echo @$_POST['fechafactura'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td></tr>
	
	<tr><th>FOLIO DE FACTURA</th>
	<td><input type='text' name='foliofactura' value="<?php echo @$_POST['foliofactura'];?>" placeholder='folio factura'></td></tr>
	
	<tr><th>IMPORTE IVA INCLUIDO</th>
	<td><input type='text' name='importeivainc' value="<?php echo @$_POST['importeivainc'];?>"	 placeholder='0000.00'></td></tr>

	<tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="Datos" value="Registrar Datos de Factura"> 
	</td>
	</tr>

</table>
</form>

<?php }

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>