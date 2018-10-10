<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["rh"] > 1){  // APERTURA PRIVILEGIOS 

include'nav_RH.php';


$subido = '';


if(isset($_POST['AltaRH']))
{
	


/*
	if($_POST['serie']!='' 			&& strlen($_POST['serie'])==17 && $_POST['marca']!=''  
	&& $_POST['tipo']!=''			&& $_POST['modelo']!='' 
	&& $_POST['color']!=''			&& $_POST['motor']!='' 
	&& $_POST['clavevehicular']!=''	&& $_POST['proveedor']!='' 
	&& $_POST['fechafactura']!=''	&& $_POST['foliofactura']!='' 
	&& $_POST['importeivainc']!='' )
	{
			$serie 			= mysqli_real_escape_string($dbd2, $_POST['serie']);
			$marca 			= mysqli_real_escape_string($dbd2, $_POST['marca']);
			$tipo 			= mysqli_real_escape_string($dbd2, $_POST['tipo']);
			$modelo 		= mysqli_real_escape_string($dbd2, $_POST['modelo']);
			$color 			= mysqli_real_escape_string($dbd2, $_POST['color']);
			$motor 			= mysqli_real_escape_string($dbd2, $_POST['motor']);
			$clavevehicular = mysqli_real_escape_string($dbd2, $_POST['clavevehicular']);
			$proveedor 		= mysqli_real_escape_string($dbd2, $_POST['proveedor']);
			$fechafactura 	= mysqli_real_escape_string($dbd2, $_POST['fechafactura']);
			$foliofactura 	= mysqli_real_escape_string($dbd2, $_POST['foliofactura']);
			$importeivainc 	= mysqli_real_escape_string($dbd2, $_POST['importeivainc']);
			$nOrdenC 		= mysqli_real_escape_string($dbd2, $_POST['nOrdenC']);
			$cliente 		= mysqli_real_escape_string($dbd2, $_POST['cliente']);
			$ubicacion   	= mysqli_real_escape_string($dbd2, $_POST['ubicacion']);
			$fechaRegistro  = $fechafactura;

		# VERIFICAR QUE NO SE REPITA
		$usuarioExiste 	= "SELECT usuario FROM `usuarioS` WHERE `usuario` = '$usuario' LIMIT 1";
		$existe 		= mysqli_query($dbd2, $usuarioExiste);
		
		if( mysqli_affected_rows($dbd2) == 0 )
		{  ########## ########## ########## ##########
			//echo "registro nuevo";
			$consecutivoAnterior 	= 'SELECT MAX(`id`) FROM `ubicacion` '; 
			$maxAnterior 			= mysqli_query($dbd2, $consecutivoAnterior);
			
			while($rowMaxAnterior = mysqli_fetch_assoc($maxAnterior))
			{
				$ecoTemp = $rowMaxAnterior['MAX(`id`)'];
				$ecoTemp = $ecoTemp + 1;

				$ecoTemp = "id".$ecoTemp;
				$capturo = $_SESSION["id_usuario"];
				
				//INSERTAR EN BD
				//INSERTAR EN UBICACION (UNIDAD) 
				$sql_alta = 'INSERT INTO `ubicacion` 
							(`id`, `Economico`, marca,`Serie`, `Vehiculo`, 
							`Modelo`, `Color`, `Motor`, claveVehicular,`capturo`) 
							VALUES ';
				$sql_alta .= "(NULL, '$ecoTemp', '$marca', '$serie', '$tipo', 
							'$modelo', '$color', '$motor', '$clavevehicular','$capturo');";
				
				$alta_ejecutada = mysqli_query($dbd2, $sql_alta);
				$id_unidad 		= mysqli_insert_id($dbd2);

				//echo "<br>$sql_alta<br>";

				if(!$alta_ejecutada){
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR \n";;
				}

				
				//INSERTAR EN FACTURA UNIDAD
				$sql_factura = 'INSERT INTO `facturaunidad` 
								(`id`, id_unidad, `Economico`, `Proveedor`, 
								`FechaFactura`, `FolioFactura`, `Importe`, `capturo`, nOrdenC) 
								VALUES ';
				$sql_factura .= "(NULL, '$id_unidad', '$ecoTemp', '$proveedor', 
								'$fechafactura', '$foliofactura', '$importeivainc', '$capturo', 
								'$nOrdenC') ;" ;
				$factura_registrada = mysqli_query($dbd2, $sql_factura);

				if(!$factura_registrada){
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR \n";;
				}


				//INSERTAR MOVIMIENTOS
				$sql_uba = 'INSERT INTO `movimientos` 
							(`id`, `id_unidad`, `cliente`, `ubicacion`, `fechaRegistro`, 
							`capturo`) VALUES ';
				$sql_uba .= "(NULL, '$id_unidad', '$cliente', '$ubicacion','$fechaRegistro', 
							'$capturo') ;" ;
				$uba_registrada = mysqli_query($dbd2, $sql_uba );

				if(!$uba_registrada){
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR \n";;
				}

				
				if($alta_ejecutada && $factura_registrada && $uba_registrada)
				{ 
					echo '<h2>ALTA REGISTRADA CORRECTAMENTE</h2>';
					echo '<h2>FACTURA REGISTRADA CORRECTAMENTE</h2>';
					echo '<h2>UBICACION REGISTRADA CORRECTAMENTE</h2>';
				}
				
				$subido = 'ok'	;// flag muestra formulario
			}
		}
		else
		{
			while($rowexiste = mysqli_fetch_assoc($existe))
			{
				$serieYaExiste 		= $rowexiste['Serie'];
				$filasEncontradas 	= mysqli_affected_rows($dbd2);
				
				if($filasEncontradas !== '')
				{
					echo "<p style='background-color:#FFFF99;'> $serieYaExiste No se puede registrar ya existe </p>";
				}
			}
		}
		// echo "<br>llenado completo";
	}
	else
	{
	echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
*/

echo "<h2>EN CONSTRUCCION</h2>";


}

if($subido!='ok'){  // INICIA MOSTRAR FORMULARIO?>

<form id='alta'  action='' method='POST' >
	<h2>ALTA DE USUARIO</h2>

<table>

	<tr>
		<th>USUARIO / EMAIL</th>
		<td><input type='mail' name='usuario' value="<?php echo @$_POST['usuario'];?>" placeholder='el usuario debe ser un email valido' required ></td>
	</tr>

	<tr>
		<th>NOMBRE(S)</th>
		<td><input type='text' name='nombres' value="<?php echo @$_POST['nombres'];?>" placeholder='Nombre(s)' required ></td>
	</tr>

	<tr>
		<th>APELLIDO PATERNO</th>
		<td><input type='text' name='paterno' value="<?php echo @$_POST['paterno'];?>" placeholder='Apellido Paterno' required ></td>
	</tr>

	<tr>
		<th>APELLIDO MATERNO</th>
		<td><input type='text' name='materno' value="<?php echo @$_POST['materno'];?>" placeholder='Apellido Materno' required ></td>
	</tr>

	<tr>
		<th>CLAVE</th>
		<td><input type='password' name='clave' value="<?php echo @$_POST['clave'];?>" placeholder='' required ></td>
	</tr>


	<tr>
		<th>PUESTO</th>
		<td><input type='text' name='puesto' value="<?php echo @$_POST['puesto'];?>" placeholder='' required ></td>
	</tr>



	<tr>
		<th colspan="2">PRIVILEGIOS</th>
	</tr>



	<tr>
		<th>Consulta Listado</th>
		<td>

		<input type='radio' name='consultaB' value="0" id='consultaB0' >
		<label for='consultaB0'>NINGUNO</label>

		<input type='radio' name='consultaB' value="1" id='consultaB1' >
		<label for='consultaB1'>VER</label>

		<input type='radio' name='consultaB' value="2" id='consultaB2' >
		<label for='consultaB2'>CREAR</label>

		<input type='radio' name='consultaB' value="3" id='consultaB3' >
		<label for='consultaB3'>EDITAR</label>

		<input type='radio' name='consultaB' value="4" id='consultaB4' >
		<label for='consultaB4'>BORRAR</label>

		<input type='radio' name='consultaB' value="5" id='consultaB5' >
		<label for='consultaB5'>MAXIMO</label>

		</td>
	</tr>























































































<!--
	<tr><th>AÑO DEL MODELO</th>
	<td><input type='number' step="1" min ="2000" max = "2050" name='modelo' value="<?php echo @$_POST['modelo'];?>" placeholder='año modelo' required ></td></tr>
	

	<tr><th>FECHA DE FACTURA</th>
	<td><input type='date' name='fechafactura' value="<?php echo @$_POST['fechafactura'];?>" placeholder='aaaa-mm-dd' required ></td></tr>

	<tr><th>IMPORTE IVA INCLUIDO</th>
		<td><input  type="number" lang="nb" step="0.01" min="0" 
		name='importeivainc' value="0<?php echo @$_POST['importeivainc'];?>"	 
		placeholder='0000.00' required ></td>
	</tr>
 -->


	<tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="AltaRH" value="Dar de Alta">
	</td>
	</tr>

</table>
</form>

<?php } // TERMINA MOSTRAR FORMULARIO
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>