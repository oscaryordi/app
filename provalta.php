<?php
include("1header.php");

if($_SESSION["proveedores"] > 0)
{  // APERTURA PRIVILEGIOS
	$subido = '';
	include("nav_mtto.php");

	if(isset($_POST['Alta']))
	{
	//rfc razonSocial calleNumero colonia municipio estado cp
	$rfc 	= mysqli_real_escape_string($dbd2, $_POST['rfc'] );
	$rfc 	= limpiarVariableRFC($rfc);

		if($rfc!='' && strlen($rfc)<=13 && strlen($rfc)>=12 
		&& $_POST['razonSocial']	!=''  
		&& $_POST['calleNumero']	!='' 
		&& $_POST['colonia']		!='' 
		&& $_POST['municipio']		!=''
		&& $_POST['estado']			!='' 
		&& $_POST['cp']				!=''
		)
		{

			$razonSocial 	= mysqli_real_escape_string($dbd2, $_POST['razonSocial'] );
			$razonSocial 	= limpiarVariableTexto($razonSocial);
			$aliasProv 		= mysqli_real_escape_string($dbd2, $_POST['aliasProv'] );
			$aliasProv 		= limpiarVariableTexto($aliasProv);
			$calleNumero 	= mysqli_real_escape_string($dbd2, $_POST['calleNumero'] );
			$calleNumero 	= limpiarVariableTexto($calleNumero);
			$colonia 		= mysqli_real_escape_string($dbd2, $_POST['colonia'] );
			$colonia 		= limpiarVariableTexto($colonia);
			$municipio 		= mysqli_real_escape_string($dbd2, $_POST['municipio'] );
			$municipio 		= limpiarVariableTexto($municipio);
			$estado 		= mysqli_real_escape_string($dbd2, $_POST['estado'] );
			$estado 		= limpiarVariableTexto($estado);
			$cp 			= mysqli_real_escape_string($dbd2, $_POST['cp'] );
			$cp 			= limpiarVariableTexto($cp);

		$provexiste = " SELECT `id_prov`, rfc FROM `provAlta` WHERE `rfc` = '$rfc' LIMIT 1";
		$existe 	= mysqli_query($dbd2, $provexiste); // CANDADO NO SE REPITA RFC

		if( mysqli_affected_rows($dbd2) == 0 ) // CANDADO NO SE REPITA RFC
		{
			echo "registro nuevo";

			$capturo = $_SESSION["id_usuario"];
			
			$sql_alta_prov = ' 	INSERT INTO `jetvantlc`.`provAlta` 
								(`id_prov`, `rfc`, razonSocial,`aliasProv`,`calleNumero`, 
								`colonia`, `municipio`, `estado`, `cp`, `capturo`) 
								VALUES ';
			$sql_alta_prov .= "	(NULL, '$rfc', '$razonSocial','$aliasProv','$calleNumero', 
								'$colonia', '$municipio', '$estado', '$cp','$capturo');";
			
			$alta_ejecutada_prov = mysqli_query($dbd2, $sql_alta_prov);

			$id_prov 		= mysqli_insert_id($dbd2);


			date_default_timezone_set('America/Mexico_city');
			$fechareg = date('Y-m-d H:i:s'); // CURRENT_TIMESTAMP

			// DOMICILIO SUCURSAL
			$sql_suc = " INSERT INTO provSucursal 
						 (id_sucursal, id_prov, nombreSucursal, calleNumero, colonia, 
						 municipio, estado, cp, tipo, capturo, fechareg)
						 VALUES 
						 ( NULL, '$id_prov', 'MATRIZ', '$calleNumero', '$colonia', 
						 '$municipio', '$estado', '$cp', '1', '$capturo', '$fechareg') ";
			$sql_sucR = mysqli_query($dbd2, $sql_suc);
			// DOMICILIO SUCURSAL

			if($sql_sucR){echo "<BR>DIRECCION SUC OK";}else{echo "<BR>DIRECCION FALLO ... ";}

			if($alta_ejecutada_prov )
				{
					echo '<h2>PROVEEDOR REGISTRADO CORRECTAMENTE</h2>';
					
					echo "<table class='ResTabla'>\n";
					echo "<tr>
							<th>RFC</th>
							<th>RAZON SOCIAL</th>
							<th>ALIAS</th>
							<th>MUNICIPIO</th>
							<th>ESTADO</th>
							<th>VER</th>
						 </tr>";

					echo "<tr>";
					echo "<td>{$rfc}</td>";
					echo "<td>{$razonSocial}</td>";
					echo "<td>{$aliasProv}</td>";
					echo "<td>{$municipio}</td>";
					echo "<td>{$estado}</td>"; 
					echo "<td>
							<FORM action='provindex.php' method='POST'>
								<INPUT type='hidden' name='rfc' value='$rfc'>
								<INPUT type='SUBMIT' name='ENVIAR' value='ver'>
							</FORM>	
						  </td>"; 
					echo "</tr>";
					echo "</table>";

					echo "<h3 style='color:blue;'>
						PARA PODER UTILIZAR AL PROVEEDOR DEBES REGISTRAR AL MENOS UNA CUENTA BANCARIA
						  </h3>";
					
					provXrfc($rfc);
					include ("provconsultado.php");
					include ("provbancario.php");
					include ("provcontacto.php");
					include ("provsucursal.php");
					include ("provdoctos.php");
				}
			$subido = 'ok'	;
		}
		else
		{
			while($rowexiste = mysqli_fetch_assoc($existe))
			{
				$rfcYaExiste 		= $rowexiste['rfc'];
				$filasEncontradas 	= mysqli_affected_rows($dbd2);
			
				if($filasEncontradas !== '')
				{
					echo "<p style='background-color:#FFFF99;'> 
							$rfcYaExiste No se puede registrar PROVEEDOR ya existe
						  </p>";
				}
			}
		}
	}
else
	{	
	echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}


if($subido!='ok') // MOSTRAR FORMULARIO
{?>

<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' >
	<h2>ALTA DE PROVEEDOR</h2>
<table>
	<tr>
		<th>RFC</th>
		<td><input type='text' name='rfc' 
		value="<?php echo @$_POST['rfc'];?>" 
		placeholder='RFC' required >
		</td>
	</tr>
	
	<tr>
		<th>RAZON SOCIAL O NOMBRE</th>
		<td><input type='text' name='razonSocial' 
		value="<?php echo @$_POST['razonSocial'];?>" 
		placeholder='Razón Social o Nombre' required >
		</td>
	</tr>

	<tr>
		<th>ALIAS (PM) O NOMBRE COMERCIAL (PF) </th>
		<td><input type='text' name='aliasProv' 
		value="<?php echo @$_POST['aliasProv'];?>" 
		placeholder='Alias Persona Moral / Nombre Comercial Persona Física'>
		</td>
	</tr>
	
	<tr>
		<th>CALLE Y NUMERO</th>
		<td><input type='text' name='calleNumero' 
		value="<?php echo @$_POST['calleNumero'];?>" 
		placeholder='Calle y Numero' required >
		</td>
	</tr>
	
	<tr>
		<th>COLONIA</th>
		<td><input type='text' name='colonia' 
		value="<?php echo @$_POST['colonia'];?>" 
		placeholder='Colonia' required >
		</td>
	</tr>
	
	<tr>
		<th>MUNICIPIO</th>
		<td><input type='text' name='municipio' 
		value="<?php echo @$_POST['municipio'];?>" 
		placeholder='Municipio' required >
		</td>
	</tr>

	<tr>
		<th>ESTADO</th>
		<td><input type='text' name='estado' 
		value="<?php echo @$_POST['estado'];?>" 
		placeholder='Estado' required >
		</td>
	</tr>
	
	<tr>
		<th>CODIGO POSTAL</th>
		<td><input type='text' name='cp' 
		value="<?php echo @$_POST['cp'];?>" 
		placeholder='Codigo Postal' required >
		</td>
	</tr>
	
	<tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Alta" value="Dar de Alta">
		</td>
	</tr>

</table>
</form>

<?php 
} // MOSTRAR FORMULARIO

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>