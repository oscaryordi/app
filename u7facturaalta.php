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

$subido = '';

if(isset($_POST['Datos']))
    {
	
        if($_POST['proveedor']!='' 
        && $_POST['fechafactura']!=''
        && $_POST['foliofactura']!='' 
        && $_POST['importeivainc']!='' )
            {		
                $proveedor      =mysqli_real_escape_string($dbd2, $_POST['proveedor'] );
                $fechafactura   =mysqli_real_escape_string($dbd2, $_POST['fechafactura'] );
                $foliofactura   =mysqli_real_escape_string($dbd2, $_POST['foliofactura'] );
                $importeivainc  =mysqli_real_escape_string($dbd2, $_POST['importeivainc'] );	
                $capturo        = $_SESSION["id_usuario"];
            
                $sql_factura = 'INSERT INTO `jetvantlc`.`facturaunidad` 
                				(`id`, `id_unidad`, `Economico`, `Proveedor`, `FechaFactura`, 
                				`FolioFactura`, `Importe`, `capturo`) VALUES ';
                $sql_factura .= "(NULL, '$id_unidad', '$Economico', '$proveedor', '$fechafactura', 
                				'$foliofactura', '$importeivainc', '$capturo') ;" ;

                $factura_registrada = mysqli_query($dbd2, $sql_factura );

                if($factura_registrada){ 
                    echo '<h2>DATOS DE FACTURA REGISTRADOS CORRECTAMENTE</h2>';
                    include ("u7factura.php");
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

<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>REGISTRAR DATOS DE FACTURA</h2>

<table>
	<tr><th>PROVEEDOR</th>
	<td><input type='text' name='proveedor' 
		value="<?php echo @$_POST['proveedor'];?>" placeholder='proveedor' required >
	</td></tr>
	
	<tr><th>FECHA DE FACTURA</th>
	<td><input type='date' name='fechafactura' 
		value="<?php echo @$_POST['fechafactura'];?>" placeholder='aaaa-mm-dd' required >
	aaaa-mm-dd </td></tr>
	
	<tr><th>FOLIO DE FACTURA</th>
	<td><input type='text' name='foliofactura' 
		value="<?php echo @$_POST['foliofactura'];?>" placeholder='folio factura' required >
	</td></tr>
	
	<tr><th>IMPORTE IVA INCLUIDO</th>
	<td><input type="number" lang="nb" step="0.01" min="0" name='importeivainc' 
		value="<?php echo @$_POST['importeivainc'];?>"	 placeholder='0000.00' required >
	</td></tr>

	<tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="Datos" value="Registrar Datos de Factura"> 
	</td>
	</tr>

</table>
</form>

<?php } 

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<td>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </td>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
} // CIERRE PRIVILEGIOS 
include ("1footer.php");?>