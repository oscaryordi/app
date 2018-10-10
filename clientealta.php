<?php
include("1header.php");
echo "<meta charset='utf-8'>";
if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS 

$subido = '';
include("nav_cliente.php");

if(isset($_POST['Alta'])){

//rfc razonSocial calleNumero colonia municipio estado cp

	$rfc = 	mysqli_real_escape_string($dbd2, $_POST['rfc'] );
	$rfc =	limpiarVariableRFC($rfc);
	
	if($rfc!='' && strlen($rfc)<=13 && strlen($rfc)>=12 
	&& $_POST['razonSocial']!=''  
	&& $_POST['calleNumero']!='' 
	&& $_POST['colonia']!='' 
	&& $_POST['municipio']!=''
	&& $_POST['estado']!='' 
	&& $_POST['cp']!=''
		)
	{
			$razonSocial = 	mysqli_real_escape_string($dbd2, $_POST['razonSocial']);
			$razonSocial = 	limpiarVariableTexto($razonSocial);
			$alias = 	mysqli_real_escape_string($dbd2, $_POST['alias']);
			$alias = 	limpiarVariableTexto($alias);
			$calleNumero = 	mysqli_real_escape_string($dbd2, $_POST['calleNumero']);
			$calleNumero =	limpiarVariableTexto($calleNumero);
			$colonia = 		mysqli_real_escape_string($dbd2, $_POST['colonia']);
			$colonia =		limpiarVariableTexto($colonia);
			$municipio = 	mysqli_real_escape_string($dbd2, $_POST['municipio']);
			$municipio =	limpiarVariableTexto($municipio);
			$estado = 		mysqli_real_escape_string($dbd2, $_POST['estado']);
			$estado =		limpiarVariableTexto($estado);
			$cp =			mysqli_real_escape_string($dbd2, $_POST['cp']);
			$cp =			limpiarVariableTexto($cp);
		
		$provexiste = "	SELECT `id_cliente`, rfc 
						FROM `claCliente` 
						WHERE `rfc` = '$rfc' 
						LIMIT 1";
		
		$existe = mysqli_query($dbd2, $provexiste);
		
		if( mysqli_affected_rows($dbd2) == 0 )
		{
			echo "registro nuevo";

			$rfc;
			$razonSocial;
			$calleNumero;
			$colonia;
			$municipio;
			$estado;
			$cp;
			$capturo = $_SESSION["id_usuario"];
			
			$sql_alta_prov = '	INSERT INTO `jetvantlc`.`claCliente` 
								(`id_cliente`, `rfc`, razonSocial, alias,
								`calleNumero`, `colonia`, `municipio`, `estado`, 
								`cp`, `capturo`) 
								VALUES ';
			$sql_alta_prov .= "	(NULL, '$rfc', '$razonSocial', '$alias',
								'$calleNumero', '$colonia', '$municipio', '$estado', 
								'$cp','$capturo');";
			
			$alta_ejecutada_prov = mysqli_query($dbd2, $sql_alta_prov);
			
			if($alta_ejecutada_prov )
				{ 
					echo '<h2>CLIENTE REGISTRADO CORRECTAMENTE</h2>';
					
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
					echo "<td>{$alias}</td>";
					echo "<td>{$municipio}</td>";
					echo "<td>{$estado}</td>"; 
					echo "<td>
							<FORM action='clienteindexuno.php' method='POST'>
								<INPUT TYPE='hidden' NAME='rfc' value='$rfc'>
								<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ver'>
							</FORM>	
							</td>"; 
					echo "</tr>";
					echo "</table>";
				}
			
			$subido = 'ok'	;			
		}
		
		else
		{
			while($rowexiste = mysqli_fetch_assoc($existe))
			{
				$rfcYaExiste = $rowexiste['rfc'];
				$filasEncontradas = mysqli_affected_rows($dbd2);
			
				if($filasEncontradas !== '')
				{
					echo "<p style='background-color:#FFFF99;'> $rfcYaExiste No se puede registrar CLIENTE ya existe </p>";
				}
			}
		}
	}
else
	{	
	echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}


if($subido!='ok'){?>


<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' >
	<h2>ALTA DE CLIENTE</h2>

<table>
	<tr>
		<th>RFC</th>
		<td><input type='text' name='rfc' 
		value="<?php echo @$_POST['rfc'];?>" 
		placeholder='RFC'>
		</td>
	</tr>
	
	<tr>
		<th>RAZON SOCIAL O NOMBRE</th>
		<td><input type='text' name='razonSocial' 
		value="<?php echo @$_POST['razonSocial'];?>" 
		placeholder='Razón Social o Nombre'>
		</td>
		<td>Nombre Formal como se encuentra escrita en el alta ante la S.H.C.P.</td>
	</tr>

	<tr>
		<th>ALIAS</th>
		<td><input type='text' name='alias' 
		value="<?php echo @$_POST['alias'];?>" 
		placeholder='SIGLAS' >
		</td>
		<td>Abreviatura, Siglas, Nombre Corto</td>
	</tr>
	
	<tr>
		<th>CALLE Y NUMERO</th>
		<td><input type='text' name='calleNumero' 
		value="<?php echo @$_POST['calleNumero'];?>" 
		placeholder='Calle y Numero'>
		</td>
	</tr>
	
	<tr>
		<th>COLONIA</th>
		<td><input type='text' name='colonia' 
		value="<?php echo @$_POST['colonia'];?>" 
		placeholder='Colonia'>
		</td>
	</tr>
	
	<tr>
		<th>MUNICIPIO</th>
		<td><input type='text' name='municipio' 
		value="<?php echo @$_POST['municipio'];?>" 
		placeholder='Municipio'>
		</td>
	</tr>

	<tr>
		<th>ESTADO</th>
		<td><input type='text' name='estado' 
		value="<?php echo @$_POST['estado'];?>" 
		placeholder='Estado'>
		</td>
	</tr>
	
	<tr>
		<th>CODIGO POSTAL</th>
		<td><input type='text' name='cp' 
		value="<?php echo @$_POST['cp'];?>" 
		placeholder='Codigo Postal'>
		</td>
	</tr>
	
	<tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Alta" value="Dar de Alta">
		</td>
	</tr>

</table>
</form>

<?php }
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>