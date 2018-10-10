<?php
include("1header.php");

if($_SESSION["id_usuario"] > 0)
{ 
$id_usuario = $_SESSION["id_usuario"];

$actualizado = '';

if(isset($_POST['actualizar']))
{
	//echo "recibiendo datos<br>";
	$claveActual = mysqli_real_escape_string($dbd2, $_POST['claveActual']);
	$claveNueva1 = mysqli_real_escape_string($dbd2, $_POST['claveNueva1']);
	$claveNueva2 = mysqli_real_escape_string($dbd2, $_POST['claveNueva2']);
	//echo $claveActual."<br>";
	//echo $claveNueva1."<br>";
	//echo $claveNueva2."<br>";
	if($claveNueva1 === $claveNueva2)
	{
		//echo "<br>SEGUIMOS CON EL PROCESO DE ACTUALIZACION, CLAVE NUEVA Y CONFIRMACION COINCIDEN<br>";
		$sqlPW 	= "SELECT clave FROM usuarios WHERE id_usuario = '$id_usuario' LIMIT 1  ";
		$sqlPWR = mysqli_query($dbd2, $sqlPW);
		$sqlPWM = mysqli_fetch_assoc($sqlPWR);
		$claveAtualBase = $sqlPWM['clave'];

		if($claveActual === $claveAtualBase)
		{
			//echo "<br>SEGUIMOS CON EL PROCESO DE ACTUALIZACION LA CONTRASEÑA ACTUAL COINCIDE<br>";
			$sqlPWup 	= "	UPDATE usuarios 
							SET clave = '$claveNueva1' 
							WHERE  id_usuario = '$id_usuario' 
							LIMIT 1  ";
			$sqlPWupR 	= mysqli_query($dbd2, $sqlPWup);

			if($sqlPWupR)
			{
				echo "<br>CONTRASEÑA ACTUALIZADA CORRECTAMENTE <br>";
				$arrayviejo = "CLAVE VIEJA: ".$claveActual;
				$capturo = $id_usuario;
				// control cambios
				$sqlUp 			= mysqli_real_escape_string($dbd2, str_replace('	', '', $sqlPWup) );
				$arrayviejo 	= mysqli_real_escape_string($dbd2, $arrayviejo );
				
				$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
				(id_cambios, capturo, updatequery, arrayviejo, fecharegistro) 
				VALUES (NULL, '$capturo', '$sqlUp', '$arrayviejo', CURRENT_TIMESTAMP ) ";
				
				$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
				// control cambios

				$actualizado = 'ok';
			}
			else
			{
				echo mysqli_errno($dbd2) .": ". mysqli_error($dbd2)."<br>";
			}
		}
		else
		{
			echo "<br>CONTRASEÑA ACTUAL NO COINCIDE CON INFORMACION EN BASE DE DATOS <br>";
		}
	}
	else
	{
		echo "<br>CONTRASEÑA NO COINCIDE CON CONFIRMACION<br>";

	}
}


if($actualizado == '') // MOSTRAR FORMULARIO
{
?>

<fieldset>
<h3>ACTUALIZAR CONTRASEÑA</h3>
<form action='' method='POST' >
	Contraseña actual
	<input type="password" name="claveActual" maxlength="30" minlength="4" required ><br>
	Nueva contraseña
	<input type="password" name="claveNueva1"  maxlength="30" minlength="4"  required ><br>
	Confirmar nueva contraseña
	<input type="password" name="claveNueva2"  maxlength="30" minlength="4"  required ><br>

	<input type='submit' name='actualizar' value='Actualizar'>
</form>
</fieldset>

<?php
} // MOSTRAR FORMULARIO


} // existe sesion

include("1footer.php");
?>