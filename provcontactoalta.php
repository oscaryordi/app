<?php
include '1header.php';
include ("nav_mtto.php");

if($_SESSION["proveedores"] > 0){  // APERTURA PRIVILEGIOS

$id_prov 		= $_GET['id_prov'];
$actualizado 	= '';

echo 	"<h2> idBD ".$id_prov."</h2><br />";

if (isset($_GET['actualizar']) 
	&& $_GET['nombre'] !== '' 
	&& $_GET['correo'] !== '' 
	&& $_GET['telefono'] !== '' 
	)
	{ 
		// FORMATEAR Y LIMPIAR DATOS
			$nombre 	= 	mysqli_real_escape_string($dbd2, $_GET['nombre']);
			$nombre 	=	limpiarVariableTexto($nombre);	
			$correo 	= 	mysqli_real_escape_string($dbd2, $_GET['correo']);
			$correo 	=	limpiarVariableRFC($correo);		
			$telefono 	= 	mysqli_real_escape_string($dbd2, $_GET['telefono']);
			$telefono 	=	limpiarVariableRFC($telefono);
			$extension 	= 	mysqli_real_escape_string($dbd2, $_GET['extension']);
			$extension 	=	limpiarVariableRFC($extension);


			$id_prov 	= 	$_GET['id_prov'];
			$capturo 	= 	$_SESSION["id_usuario"];

		$sql_pcn = " INSERT INTO `jetvantlc`.`provContacto` 
					 (id_contacto, id_prov, nombre, correo, telefono, extension, capturo) 
					 VALUES  
					 (NULL, '$id_prov', '$nombre', '$correo', '$telefono', '$extension', '$capturo') ";
	

		$res_sql_pcn = mysqli_query($dbd2, $sql_pcn);

		if(!$res_sql_pcn){
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else{
			echo "<br><h2>REGISTRO DE CONTACTO EXITOSO</h2><br>";
		}
		$actualizado = 'si';
	}
	
echo "<h2>REGISTRO DE CONTACTO CON PROVEEDOR</h2>";
include ("provconsultado.php");
include ("provcontacto.php");

if ($actualizado == '')
{ ?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO REGISTRO DE CONTACTO</th>
		</tr>
		
		<tr>
			<td>NOMBRE *</td>
			<td>
				<input type="text" name="nombre" value="<?php //echo $nombre; ?>" REQUIRED >
				<input type="hidden" name="id_prov" value="<?php echo $id_prov; ?>"  > 
			</td>
		</tr>
	
		<tr>
			<td>CORREO *</td>
			<td>
				<input type="email" name="correo" value="<?php //echo $correo; ?>"  REQUIRED >
			</td>
		</tr>
		
		<tr>
			<td>TELEFONO *</td>
			<td>
				<input type="text" name="telefono" value="<?php //echo $telefono; ?>"  REQUIRED >
			</td>
		</tr>

		<tr>
			<td>EXTENSION</td>
			<td>
				<input type="text" name="extension" value="<?php //echo $telefono; ?>"   >
			</td>
		</tr>

			
		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Registrar nuevo contacto"> * obligatorios </td>
		</tr>

	</table>
</form>
</fieldset>
<?php 
}; 

include ("provbancario.php");
include ("provsucursal.php");
include ("provdoctos.php");


// BOTON PARA VER PROVEEDOR // IR AL INDEX DE PROVEEDOR
    echo "<p>
        <FORM action='provindex.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_prov' VALUE='$id_prov'>
            <INPUT  TYPE='SUBMIT' NAME='ENVIAR' id='gobutton2' VALUE='Volver a CONSULTA DE PROVEEDOR'>
        </FORM>
        </p>";
 // BOTON PARA VER PROVEEDOR // IR AL INDEX DE PROVEEDOR

} // CIERRE PRIVILEGIOS

include ("1footer.php"); ?>