<?php
include '1header.php';
include ("nav_mtto.php");

if($_SESSION["proveedores"] > 0){  // APERTURA PRIVILEGIOS

$id_sucursal = $_GET['id_sucursal'];
$id_sucursalSE = $_GET['id_sucursal'];

sucursalxid($id_sucursal);
$arrayviejo = "NS:".$nombreSucursal
			.",CN:".$calleNumeroS
			.",CL:".$coloniaS
			.",MP:".$municipioS
			.",EF:".$estadoS
			.",CP:".$cpS
			;
//$id_prov = $_GET['id_prov'];

$actualizado = '';
echo 	"<h2> idBD ".$id_prov."</h2><br />";

if (isset($_GET['actualizar']) 
	&& $_GET['nombreSucursal'] !== '' 
	&& $_GET['calleNumero'] !== '' 
	&& $_GET['colonia'] !== '' 
	&& $_GET['municipio'] !== '' 
	&& $_GET['estado'] !== '' 
	&& $_GET['cp'] !== '' 	
	)
	{ 
		// FORMATEAR Y LIMPIAR DATOS
		$id_sucursal = $_GET['id_sucursal'];
		$nombreSucursal = 	mysqli_real_escape_string($dbd2, $_GET['nombreSucursal'] );
		$nombreSucursal = 	limpiarVariableTexto($nombreSucursal);	
		$calleNumero 	= 	mysqli_real_escape_string($dbd2, $_GET['calleNumero'] );
		$calleNumero 	=	limpiarVariableTexto($calleNumero);		
		$colonia 		= 	mysqli_real_escape_string($dbd2, $_GET['colonia'] );
		$colonia 		=	limpiarVariableTexto($colonia);		
		$municipio 		= 	mysqli_real_escape_string($dbd2, $_GET['municipio'] );
		$municipio 		=	limpiarVariableTexto($municipio);
		$estado 		= 	mysqli_real_escape_string($dbd2, $_GET['estado'] );
		$estado 		=	limpiarVariableTexto($estado);
		$cp 			= 	mysqli_real_escape_string($dbd2, $_GET['cp'] );
		$cp 			=	limpiarVariableTexto($cp);

		//$id_prov 		= $_GET['id_prov'];
		$capturo 		= $_SESSION["id_usuario"];

		$sql_ps = " UPDATE provSucursal 
					SET 
					nombreSucursal 	= '$nombreSucursal', 
					calleNumero 	= '$calleNumero', 
					colonia 		= '$colonia', 
					municipio 		= '$municipio', 
					estado 			= '$estado', 
					cp 				= '$cp' 
					WHERE 
					id_sucursal = '$id_sucursal' 
					";

		$res_sql_ps = mysqli_query($dbd2, $sql_ps );

		if(!$res_sql_ps){
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else
		{
			echo "<br><h2>EDICION DE SURCURSAL EXITOSO</h2><br>";
			// INICIA Control Cambios
			//$arrayviejo = "N:".$nombreCP.",E:".$correoCP.",T:".$telefonoCP.",Ex:".$extensionCP;
			$sql_up 	= str_replace("	", "", $sql_ps);
			$sql_up 	= mysqli_real_escape_string($dbd2, $sql_up );
			$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
			$sql_cc = "INSERT INTO jetvantlc.controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro)
						VALUES 
						(NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";

			$cambio_registrado = mysqli_query($dbd2, $sql_cc);
			//TERMINA Control Cambios
			include ("provconsultado.php");
			include ("provsucursal.php");

		}
		$actualizado = 'si';
	}
	
echo "<h2>EDICION DE SUCURSAL</h2>";




if ($actualizado == '')
{ // mostrar formulario 

include ("provconsultado.php");
include ("provsucursal.php");
$id_sucursal = $_GET['id_sucursal'];
sucursalxid($id_sucursal);
?>
<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO EDICION SUCURSAL</th>
		</tr>
		
		<tr>
			<td>NOMBRE SUCURSAL *</td>
			<td>
				<input type="text" name="nombreSucursal" value="<?php echo $nombreSucursal; ?>"  REQUIRED >
				<input type="hidden" name="id_sucursal" value="<?php echo $id_sucursal; ?>"> 
			</td>
		</tr>
		
		<tr>
			<td>DOMICILIO CALLE Y NUMERO *</td>
			<td>
				<input type="text" name="calleNumero" value="<?php echo $calleNumeroS; ?>"  REQUIRED >
			</td>
		</tr>
		
		<tr>
			<td>COLONIA *</td>
			<td>
				<input type="text" name="colonia" value="<?php echo $coloniaS; ?>"  REQUIRED >
			</td>
		</tr>
		
		<tr>
			<td>MUNICIPIO *</td>
			<td>
				<input type="text" name="municipio" value="<?php echo $municipioS; ?>"  REQUIRED >
			</td>
		</tr>
		
		<tr>
			<td>ESTADO *</td>
			<td>
				<input type="text" name="estado" value="<?php echo $estadoS; ?>"  REQUIRED >
			</td>
		</tr>

		<tr>
			<td>CODIGO POSTAL *</td>
			<td>
				<input type="text" name="cp" value="<?php echo $cpS; ?>"  REQUIRED >
			</td>
		</tr>
		
		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Guardar Cambios"> * obligatorios </td>
		</tr>

	</table>
</form>
</fieldset>
<?php 
}; // mostrar formulario

include ("provbancario.php");
include ("provcontacto.php");
include ("provdoctos.php");

// BOTON PARA VER PROVEEDOR // IR AL INDEX DE PROVEEDOR
    echo "<p>
        <FORM action='provindex.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_prov' VALUE='$id_prov'>
            <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a CONSULTA DE PROVEEDOR'>
        </FORM>
        </p>";
 // BOTON PARA VER PROVEEDOR // IR AL INDEX DE PROVEEDOR

 } // CIERRE PRIVILEGIOS

 include ("1footer.php"); ?>