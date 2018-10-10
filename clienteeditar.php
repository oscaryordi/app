<?php
include '1header.php';
include ("nav_cliente.php");

echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS

@$id_cliente = $_POST['id_cliente'];

if($id_cliente == ''){$id_cliente = $_GET['id_cliente'];}

echo "<h3 style='color:red';>Datos Viejos</h3>";

include ("clientegral.php");

$actualizado = '';

// INICIO Array viejo -- Para Control de Cambios
$arrayviejo =  "id_cliente = ".$id_cliente.",  rfc = ".$rfc
				.",  razonSocial = ".$razonSocial
				.",  alias = ".$alias.",  calleNumero = ".$calleNumero.",  colonia = ".$colonia
				.",  municipio = ".$municipio.",  estado = ".$estado.",  cp = ".$cp ;
// TERMINA Array viejo -- Para Control de Cambios

// INICIO Procesar formulario
if(isset($_GET['Alta'])){
	$rfc = 	mysqli_real_escape_string($dbd2, $_GET['rfc']);
	$rfc =	limpiarVariableRFC($rfc);
	
	if($rfc!='' && strlen($rfc)<=13 && strlen($rfc)>=12 
	&& $_GET['razonSocial']!=''  
	&& $_GET['calleNumero']!='' 
	&& $_GET['colonia']!='' 
	&& $_GET['municipio']!=''
	&& $_GET['estado']!='' 
	&& $_GET['cp']!=''
		)
	{
		// INICIO Formatear y limpiar datos
			$razonSocial = 	mysqli_real_escape_string($dbd2, $_GET['razonSocial']);
			$razonSocial = 	limpiarVariableTexto($razonSocial);
			$alias = 		mysqli_real_escape_string($dbd2, $_GET['alias']);
			$alias = 		limpiarVariableTexto($alias);
			$calleNumero = 	mysqli_real_escape_string($dbd2, $_GET['calleNumero']);
			$calleNumero =	limpiarVariableTexto($calleNumero);
			$colonia = 		mysqli_real_escape_string($dbd2, $_GET['colonia']);
			$colonia =		limpiarVariableTexto($colonia);
			$municipio = 	mysqli_real_escape_string($dbd2, $_GET['municipio']);
			$municipio =	limpiarVariableTexto($municipio);
			$estado = 		mysqli_real_escape_string($dbd2, $_GET['estado']);
			$estado =		limpiarVariableTexto($estado);
			$cp =			mysqli_real_escape_string($dbd2, $_GET['cp']);
			$cp =			limpiarVariableTexto($cp);
		// TERMINA Formatear y limpiar datos

			$id_cliente = $_GET['id_cliente'];
			$capturo 	= $_SESSION["id_usuario"];

		// INICIA Validar cliente existe una vez o no existe		
		$provexiste = "	SELECT `id_cliente`, rfc 
						FROM `claCliente` 
						WHERE `rfc` = '$rfc' 
						LIMIT 1";		
		$existe 	= mysqli_query($dbd2, $provexiste);
		// TERMINA Validar cliente existe una vez o no existe

		
		if( mysqli_affected_rows($dbd2) < 2 )
		{
			echo "Actualizar Cliente";

			// INICIO Update BD
			$sql_cte_up = "UPDATE  `jetvantlc`.`claCliente`  SET 
							rfc 		= '$rfc' , 
							razonSocial = '$razonSocial' ,  
							alias 		= '$alias',  
							calleNumero = '$calleNumero',  
							colonia 	= '$colonia',  
							municipio 	= '$municipio',  
							estado 		= '$estado',  
							cp 			= '$cp',  
							capturo 	= '$capturo' 
							WHERE id_cliente = '$id_cliente' LIMIT 1 ";
			$res_cte_up = mysqli_query($dbd2, $sql_cte_up );
			// TERMINA Update DB
			
			if(!$res_cte_up)
				{
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
				}
			else{
					// INICIA Control Cambios
					if($res_cte_up)
						{ 
							$sql_up 	= mysqli_real_escape_string($dbd2, $sql_cte_up);
							$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo);
							
							$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
							(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
							VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
							
							$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
							//TERMINA Control Cambios

							echo "<br><h2>ACTUALIZACION DE CLIENTE EXITOSO</h2><br>";
						}
					$actualizado = 'ok';
					echo "<h3 style='color:red;'>Datos Nuevos</h3>";
					include ("clientegral.php");
				}
		}
		
		else
		{
			while($rowexiste = mysqli_fetch_assoc($existe))
			{
				$rfcYaExiste = $rowexiste['rfc'];
				$filasEncontradas = mysqli_affected_rows($dbd2);
			
				if($filasEncontradas !== '')
				{
					echo "<p style='background-color:#FFFF99;'> $rfcYaExiste No se puede actualizar CLIENTE ya existe mas de una vez :( </p>";
				}
			}
		}
	}
else
	{	
	echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
} // TERMINA Procesar Formulario


if($actualizado!='ok'){

echo "<h2>EDITAR CLIENTE</h2>";
?>

<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action="<?php echo $_SERVER['PHP_SELF'];?>" method='GET' >

<table>
	<tr>
		<th>RFC</th>
		<td><input type='text' name='rfc' 
		value="<?php echo $rfc;?>" 
		required >

		<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">

		</td>
	</tr>
	
	<tr>
		<th>RAZON SOCIAL O NOMBRE</th>
		<td><input type='text' name='razonSocial' 
		value="<?php echo $razonSocial;?>" 
		placeholder='Razón Social o Nombre' 
		required >
		</td>
		<td>Nombre Formal como se encuentra escrita en el alta ante la S.H.C.P.</td>
	</tr>

	<tr>
		<th>ALIAS</th>
		<td><input type='text' name='alias' 
		value="<?php echo $alias;?>" 
		placeholder='SIGLAS' 
		 >
		</td>
		<td>Abreviatura, Siglas, Nombre Corto</td>
	</tr>
	
	<tr>
		<th>CALLE Y NUMERO</th>
		<td><input type='text' name='calleNumero' 
		value="<?php echo $calleNumero;?>" 
		placeholder='Calle y Numero' 
		required >
		</td>
	</tr>
	
	<tr>
		<th>COLONIA</th>
		<td><input type='text' name='colonia' 
		value="<?php echo $colonia;?>" 
		placeholder='Colonia' 
		required >
		</td>
	</tr>
	
	<tr>
		<th>MUNICIPIO</th>
		<td><input type='text' name='municipio' 
		value="<?php echo $municipio;?>" 
		placeholder='Municipio' 
		required >
		</td>
	</tr>

	<tr>
		<th>ESTADO</th>
		<td><input type='text' name='estado' 
		value="<?php echo $estado;?>" 
		placeholder='Estado' 
		required >
		</td>
	</tr>
	
	<tr>
		<th>CODIGO POSTAL</th>
		<td><input type='text' name='cp' 
		value="<?php echo $cp;?>" 
		placeholder='Codigo Postal' 
		required >
		</td>
	</tr>
	
	<tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Alta" value="Actualizar CLIENTE">
		</td>
	</tr>

</table>
</form>

<?php }



// BOTON PARA VER LA CLIENTE // IR AL INDEX DE CLIENTE CONSULTADO
    echo "<td>
        <FORM action='clienteindexuno.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
        </FORM>
        </td>";

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>