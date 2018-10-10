<?php
include '1header.php';
include ("nav_mtto.php");

echo "<h2>EDITAR CONTACTO</h2>";

if($_SESSION["proveedores"] > 0){  // APERTURA PRIVILEGIOS

$id_contacto 		= $_GET['id_contacto'];
asesorxid($id_contacto);
$arrayviejo = "N:".$nombreCP.",E:".$correoCP.",T:".$telefonoCP.",Ex:".$extensionCP;

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
		//$id_prov 	= 	$_GET['id_prov'];
		$capturo 	= 	$_SESSION["id_usuario"];

		$sql_pcn = "UPDATE provContacto 
					SET 
					nombre 		= '$nombre', 
					correo 		= '$correo', 
					telefono 	= '$telefono', 
					extension 	= '$extension' 
					WHERE 
					id_contacto = '$id_contacto' 
					";

		$res_sql_pcn = mysqli_query($dbd2, $sql_pcn);

		if(!$res_sql_pcn){
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else
		{
			echo "<br><h2>EDICION DE CONTACTO EXITOSO</h2><br>";
			include ("provconsultado.php");
			include ("provcontacto.php"); // PARA MOSTRAR CAMBIOS REALIZADOS

			// INICIA Control Cambios
			//$arrayviejo = "N:".$nombreCP.",E:".$correoCP.",T:".$telefonoCP.",Ex:".$extensionCP;
			$sql_up 	= str_replace("	", "", $sql_pcn);
			$sql_up 	= mysqli_real_escape_string($dbd2, $sql_up );
			$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
			$sql_cc = "INSERT INTO jetvantlc.controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro)
						VALUES 
						(NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";

			$cambio_registrado = mysqli_query($dbd2, $sql_cc);
			//TERMINA Control Cambios

		}
		$actualizado = 'si';
	}
	
echo "<h2>EDITAR CONTACTO</h2>";


if ($actualizado == '')
{ 
include ("provconsultado.php");
include ("provcontacto.php"); // PARA MOSTRAR INFORMACION ANTES DE REALIZAR CAMBIOS
$id_contacto 		= $_GET['id_contacto']; // PARA QUE NO FALLE A QUE CONTACTO NOS REFERIMOS
asesorxid($id_contacto);
?>
<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO EDITAR CONTACTO</th>
		</tr>
		
		<tr>
			<td>NOMBRE *</td>
			<td>
				<input type="text" name="nombre" value="<?php echo $nombreCP; ?>" REQUIRED >
				<input type="hidden" name="id_prov" value="<?php echo $id_prov; ?>"  >
				<input type="hidden" name="id_contacto" value="<?php echo $id_contacto; ?>"  > 
			</td>
		</tr>
	
		<tr>
			<td>CORREO *</td>
			<td>
				<input type="email" name="correo" value="<?php echo $correoCP; ?>"  REQUIRED >
			</td>
		</tr>
		
		<tr>
			<td>TELEFONO *</td>
			<td>
				<input type="text" name="telefono" value="<?php echo $telefonoCP; ?>"  REQUIRED >
			</td>
		</tr>

		<tr>
			<td>EXTENSION</td>
			<td>
				<input type="text" name="extension" value="<?php echo $extensionCP; ?>"  >
			</td>
		</tr>		
			
		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Guardar Cambios"> * obligatorios </td>
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