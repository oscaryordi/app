<?php
include '1header.php';
include ("nav_mtto.php");

if($_SESSION["mttos"] > 1){  // APERTURA PRIVILEGIOS


$id_prov = $_GET['id_prov'];
$actualizado = '';
echo 	"<h2> idBD ".$id_prov."</h2><br />";



if (isset($_GET['actualizar']) 
	&& $_GET['banco'] !== '' 
	&& $_GET['cuenta'] !== '' 
	&& $_GET['clabe'] !== '' 
	)
	{ 
		// FORMATEAR Y LIMPIAR DATOS
			$banco = 	mysqli_real_escape_string($dbd2, $_GET['banco']);
			$banco =	limpiarVariableRFC($banco);	
			$cuenta = 	mysqli_real_escape_string($dbd2, $_GET['cuenta'] );
			$cuenta =	limpiarVariableRFC($cuenta);		
			$clabe = 	mysqli_real_escape_string($dbd2, $_GET['clabe'] );
			$clabe =	limpiarVariableRFC($clabe);		
			$sucursal = mysqli_real_escape_string($dbd2, $_GET['sucursal'] );
			$sucursal =	limpiarVariableRFC($sucursal);
			$id_prov = $_GET['id_prov'];
			$capturo = $_SESSION["id_usuario"];

		$sql_pbn = "INSERT INTO `jetvantlc`.`provBanco` (id_cuenta, id_prov, banco, cuenta, clabe, sucursal, capturo) 
					VALUES  
					(NULL, '$id_prov', '$banco', '$cuenta', '$clabe', '$sucursal', '$capturo') ";
						

		$res_sql_pbn = mysqli_query($dbd2, $sql_pbn );

		if(!$res_sql_pbn){
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else{
			echo "<br><h2>REGISTRO EXITOSO</h2><br>";
		}
		$actualizado = 'si';
	}
	
echo "<h2>REGISTRO DE CUENTA BANCARIA DE PROVEEDOR</h2>";
include ("provconsultado.php");
include ("provbancario.php");

if ($actualizado == ''){
?>
<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO REGISTRAR CUENTA BANCARIA</th>
		</tr>
		
		<tr>
			<td>BANCO *</td>
			<td>
				<input type="text" name="banco" value="<?php //echo $banco; ?>" REQUIRED >
				<input type="hidden" name="id_prov" value="<?php echo $id_prov; ?>"  > 
			</td>
		</tr>
		
		<tr>
			<td>CUENTA *</td>
			<td>
				<input type="text" name="cuenta" value="<?php //echo $cuenta; ?>" REQUIRED  >
			</td>
		</tr>
		
		<tr>
			<td>CLABE *</td>
			<td>
				<input type="text" name="clabe" value="<?php //echo $clabe; ?>"  REQUIRED >
			</td>
		</tr>
		
		<tr>
			<td>SUCURSAL</td>
			<td>
				<input type="text" name="sucursal" value="<?php //echo $sucursal; ?>" >
			</td>
		</tr>

		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Registrar nueva cuenta"> * obligatorios </td>
		</tr>

	</table>
</form>
</fieldset>

<?php };

include ("provcontacto.php");
include ("provsucursal.php");
include ("provdoctos.php");

// BOTON PARA VER PROVEEDOR // IR AL INDEX DE PROVEEDOR
    echo "<p>
        <FORM action='provindex.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_prov' VALUE='$id_prov'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a CONSULTA DE PROVEEDOR'>
        </FORM>
        </p>";
 // BOTON PARA VER PROVEEDOR // IR AL INDEX DE PROVEEDOR

} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>