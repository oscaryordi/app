<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["mttos"] > 1){  // APERTURA PRIVILEGIOS 

$subido = ''; 
include("nav_mtto.php");

$id_prov = $_GET['id_prov'];
proveedorxid($id_prov);
echo 	"<h2> idBD ".$id_prov."</h2><br />";

$arrayviejo = 	'razonSocial 	= '.$PrazonSocial.' ,
				`aliasProv` 	= '.$PaliasProv.' ,
				`calleNumero`  	= '.$PcalleNumero.', 
				`colonia`  		= '.$Pcolonia.', 
				`municipio` 	= '.$Pmunicipio.', 
				`estado` 		= '.$Pestado.', 
				`cp` 			= '.$Pcp ;

if(isset($_POST['Editar']))
{
	// INICIA VALIDAR QUE EXISTAN CAMBIOS
	$proceder = 0;
	if($PrazonSocial 	!= $_POST['razonSocial'])	{$proceder += 1;}
	if($PaliasProv 		!= $_POST['aliasProv'])		{$proceder += 1;}
	if($PcalleNumero 	!= $_POST['calleNumero'])	{$proceder += 1;}
	if($Pcolonia 		!= $_POST['colonia'])		{$proceder += 1;}
	if($Pmunicipio 		!= $_POST['municipio'])		{$proceder += 1;}
	if($Pestado 		!= $_POST['estado'])		{$proceder += 1;}
	if($Pcp 			!= $_POST['cp'])			{$proceder += 1;}
	// TERMINA VALIDAR QUE EXISTAN CAMBIOS

	if( //$rfc!='' && strlen($rfc)<=13 && strlen($rfc)>=12 &&
	 $_POST['razonSocial']!=''  
	&& $_POST['calleNumero']!='' 
	&& $_POST['colonia']!='' 
	&& $_POST['municipio']!=''
	&& $_POST['estado']!='' 
	&& $_POST['cp']!='' 
	&& $proceder > 0
		)
	{
			$razonSocial = 	mysqli_real_escape_string($dbd2, $_POST['razonSocial'] );
			$razonSocial = 	limpiarVariableTexto($razonSocial);

			$aliasProv = 	mysqli_real_escape_string($dbd2, $_POST['aliasProv'] );
			$aliasProv = 	limpiarVariableTexto($aliasProv);

			$calleNumero = 	mysqli_real_escape_string($dbd2, $_POST['calleNumero'] );
			$calleNumero =	limpiarVariableTexto($calleNumero);
			$colonia = 		mysqli_real_escape_string($dbd2, $_POST['colonia'] );
			$colonia =		limpiarVariableTexto($colonia);
			$municipio = 	mysqli_real_escape_string($dbd2, $_POST['municipio'] );
			$municipio =	limpiarVariableTexto($municipio);
			$estado = 		mysqli_real_escape_string($dbd2, $_POST['estado'] );
			$estado =		limpiarVariableTexto($estado);
			$cp =			mysqli_real_escape_string($dbd2, $_POST['cp'] );
			$cp =			limpiarVariableTexto($cp);
	
			$capturo = $_SESSION["id_usuario"];
			
			$sql_EP = "UPDATE `jetvantlc`.`provAlta` SET 
						razonSocial  	= '$razonSocial' ,
						aliasProv  		= '$aliasProv' ,
						`calleNumero`  	= '$calleNumero', 
						`colonia`  		= '$colonia', 
						`municipio` 	= '$municipio', 
						`estado` 		= '$estado', 
						`cp` 			= '$cp'
						WHERE	`id_prov`	= '$id_prov' LIMIT 1 ";
			$sql_R_EP = mysqli_query($dbd2, $sql_EP);

			if(!$sql_R_EP)
			{
				echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR ACTUALIZACION 59 \n";
			}
			else
			{
					echo "<h2>REGISTRO DE ACTUALIZACION EXITOSO</h2>";
				// INICIA Control Cambios
					$sql_up 	= mysqli_real_escape_string($dbd2, $sql_EP );
					$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
					$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
						VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
					$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
				//TERMINA Control Cambios
					
					proveedorxid($id_prov);

					echo '<h2>PROVEEDOR REGISTRADO CORRECTAMENTE</h2>';
					
					echo "<table class='ResTabla'>\n";
					echo "<tr>
							<th>RFC</th>
							<th>RAZON SOCIAL</th>
							<th>MUNICIPIO</th>
							<th>ESTADO</th>
							<th>VER</th>
						</tr>";
					echo "<tr>";
					echo "<td>{$Prfc}</td>";
					echo "<td>{$PrazonSocial}</td>";
					echo "<td>{$Pmunicipio}</td>";
					echo "<td>{$Pestado}</td>"; 
					echo "<td>
							<FORM action='provindex.php' method='POST'>
								<INPUT TYPE='hidden' NAME='rfc' value='$Prfc'>
								<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ver'>
							</FORM>	
							</td>"; 
					echo "</tr>";
					echo "</table>";
					echo "<h3 style='color:blue;'>PARA PODER UTILIZAR AL PROVEEDOR DEBES REGISTRAR AL MENOS UNA CUENTA BANCARIA</h3>";

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
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos o cambios &#9786;</p>";
	}
}


if($subido!='ok'){  // APERTURA MOSTRAR FORMULARIO  ?>

<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' >
	<h2>EDITAR PROVEEDOR</h2>

<table>
	<tr>
		<th>RFC</th>
		<td><input type='text' name='rfc' 
		value="<?php echo $Prfc;?>" 
		placeholder='RFC' DISABLED >
		</td>
	</tr>
	
	<tr>
		<th>RAZON SOCIAL O NOMBRE</th>
		<td><input type='text' name='razonSocial' 
		value="<?php echo $PrazonSocial;?>" 
		placeholder='Razón Social o Nombre' required >
		</td>
	</tr>

	<tr>
		<th>ALIAS (PM) O NOMBRE COMERCIAL (PF) </th>
		<td><input type='text' name='aliasProv' 
		value="<?php echo $PaliasProv;?>" 
		placeholder='Alias Persona Moral / Nombre Comercial Persona Física'>
		</td>
	</tr>
	 	
	<tr>
		<th>CALLE Y NUMERO</th>
		<td><input type='text' name='calleNumero' 
		value="<?php echo $PcalleNumero;?>" 
		placeholder='Calle y Numero'  required >
		</td>
	</tr>
	
	<tr>
		<th>COLONIA</th>
		<td><input type='text' name='colonia' 
		value="<?php echo $Pcolonia;?>" 
		placeholder='Colonia'  required >
		</td>
	</tr>
	
	<tr>
		<th>MUNICIPIO</th>
		<td><input type='text' name='municipio' 
		value="<?php echo $Pmunicipio;?>" 
		placeholder='Municipio'  required >
		</td>
	</tr>

	<tr>
		<th>ESTADO</th>
		<td><input type='text' name='estado' 
		value="<?php echo $Pestado;?>" 
		placeholder='Estado'  required >
		</td>
	</tr>
	
	<tr>
		<th>CODIGO POSTAL</th>
		<td><input type='text' name='cp' 
		value="<?php echo $Pcp;?>" 
		placeholder='Codigo Postal'  required >
		</td>
	</tr>
	
	<tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Editar" value="Editar">
		</td>
	</tr>

</table>
</form>

<?php } // CIERRE MOSTRAR FORMULARIO

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