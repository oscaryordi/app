<?php
include '1header.php';
include ("nav_cliente.php");

//<!-- CANDADO PRIVILEGIO -->
if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS 

//$id_cliente		= $_GET['id_cliente'];
//$id_contrato	= $_GET['id_contrato'];
//$id_contrato	= $_GET['id_partida'];

/* 
$id_cliente		= $_POST['id_cliente'];
$id_contrato	= $_POST['id_contrato'];
$id_clienteE	= $_POST['id_cliente'];
$id_contratoE	= $_POST['id_contrato'];
$id_partidaE	= $_POST['id_partida'];
*/
if(
@$_POST['id_cliente'] &&
$_POST['id_contrato'] && 
$_POST['id_partida'] 
)
{
	$id_cliente		= $_POST['id_cliente'];
	$id_contrato	= $_POST['id_contrato'];
	$id_clienteE	= $_POST['id_cliente'];
	$id_contratoE	= $_POST['id_contrato'];
	$id_partidaE	= $_POST['id_partida'];
}
else
{
	$id_cliente		= $_GET['id_cliente'];
	$id_contrato	= $_GET['id_contrato'];
	$id_clienteE	= $_GET['id_cliente'];
	$id_contratoE	= $_GET['id_contrato'];
	$id_partidaE	= $_GET['id_partidaE'];
}


########## INICIA OBTENER INFORMACION DE PARTIDA A EDITAR
$sql_partidaE 	= "SELECT * FROM ctoPartidas WHERE id_partida = '$id_partidaE' LIMIT 1 ";
$sql_partidaE_R = mysqli_query($dbd2, $sql_partidaE);
$matrizPE		= mysqli_fetch_array($sql_partidaE_R);
$id_partidaE 	= $matrizPE['id_partida'];
$id_clienteE 	= $matrizPE['id_cliente'];
$id_contratoE 	= $matrizPE['id_contrato'];
$clasifE 		= $matrizPE['clasif'];
$descripcionE 	= $matrizPE['descripcion'];
$marcasE 		= $matrizPE['marcas'];
$modelosE 		= $matrizPE['modelos'];
$cilindrosE 	= $matrizPE['cilindros'];
$precioDE 		= $matrizPE['precioD'];
$calculoPDE		= $matrizPE['calculoPD'];
$precioME 		= $matrizPE['precioM'];
$calculoPME		= $matrizPE['calculoPM'];
$capturoE 		= $matrizPE['capturo'];
$minimoPE 		= $matrizPE['minimoP'];
$maximoPE 		= $matrizPE['maximoP'];
$minUE 			= $matrizPE['minU'];
$maxUE 			= $matrizPE['maxU'];
//$arrayviejo 	= serialize($matrizPE);
$sql_partidaE_R = mysqli_query($dbd2, $sql_partidaE);
$matrizPE		= mysqli_fetch_assoc($sql_partidaE_R);
//$matrizPE 		= array_values($sql_partidaE_R);
$arrayviejo 	= json_encode($matrizPE);
//print_r($matrizPE);
########## TERMINA OBTENER INFORMACION DE PARTIDA A EDITAR

echo "<br>";

include ("clientegral.php");

$actualizado = '';


if (isset($_GET['actualizar'])
	&& $_GET['id_partidaE'] !== ''  
	&& $_GET['clasifE'] !== '' 
	&& $_GET['descripcionE'] !== '' 
	&& $_GET['precioDE'] !== '' 
	&& $_GET['precioME'] !== '' 
	)
{
	// FORMATEAR Y LIMPIAR DATOS
	$id_contrato 	= 	mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
	$id_partidaEE 	= 	mysqli_real_escape_string($dbd2, $_GET['id_partidaE']);
	$clasif 		= 	mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['clasifE'])));
	$descripcion 	= 	mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['descripcionE'])));

	$marcas 		= 	mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['marcasE']))); // texto varchar
	$modelos 		= 	mysqli_real_escape_string($dbd2, $_GET['modelosE']); // varchar
	$cilindros 		= 	mysqli_real_escape_string($dbd2, $_GET['cilindrosE']); // numero

	$precioD 		= 	mysqli_real_escape_string($dbd2, $_GET['precioDE']);
	$calculoPD 		= 	mysqli_real_escape_string($dbd2, $_GET['calculoPDE']);
	$precioM 		= 	mysqli_real_escape_string($dbd2, $_GET['precioME']);
	$calculoPM 		= 	mysqli_real_escape_string($dbd2, $_GET['calculoPME']);
	$minimoP 		= 	mysqli_real_escape_string($dbd2, $_GET['minimoPE']);
	$maximoP 		= 	mysqli_real_escape_string($dbd2, $_GET['maximoPE']);

	$minU 			= 	mysqli_real_escape_string($dbd2, $_GET['minUE']);
	$maxU 			= 	mysqli_real_escape_string($dbd2, $_GET['maxUE']);	

	$capturo 		= $_SESSION["id_usuario"];

	// evitar duplicidad carga partida
	$sql_ED = "SELECT * FROM ctoPartidas WHERE id_contrato = '$id_contrato'
			 AND descripcion 	= '$descripcion' 
			 AND clasif 		= '$clasif' 
			 AND precioD 		= '$precioD' 
			 AND precioM 		= '$precioM' LIMIT 1 ";
	$sql_ED_R = mysqli_query($dbd2, $sql_ED);
	$contador = mysqli_affected_rows($dbd2);
	$noHacer = 0 ;		 
	if( $contador > 1 ){ $noHacer = 1 ;}
	// evitar duplicidad carga partida

	if( $noHacer == 0 )
	{
		// INICIO Update BD
		$sql_conv_up = "UPDATE  `ctoPartidas`  SET 
		clasif 		= '$clasif', 
		descripcion = '$descripcion', 
		marcas 		= '$marcas', 
		modelos 	= '$modelos', 
		cilindros 	= '$cilindros', 
		precioD 	= '$precioD', 
		calculoPD 	= '$calculoPD', 
		precioM 	= '$precioM', 
		calculoPM 	= '$calculoPM', 
		capturo 	= '$capturo', 
		minimoP 	= '$minimoP', 
		maximoP 	= '$maximoP', 
		minU 		= '$minU', 
		maxU 		= '$maxU' 	
		WHERE id_cliente = '$id_cliente'  
		AND id_contrato = '$id_contrato' 
		AND id_partida 	= '$id_partidaEE' 
		LIMIT 1 ";
		$res_conv_up = mysqli_query($dbd2, $sql_conv_up );
		// TERMINA Update DB

		if(!$res_conv_up)
		{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
			echo "DUPLICATE: ES POR UNA PARTIDA DUPLICADA ... ";
		}
		else
		{
			// INICIA Control Cambios
			if($res_conv_up)
			{ 
				$sql_up 	= mysqli_real_escape_string($dbd2, $sql_conv_up);
				$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo);
					
				$sql_control_cambios = "INSERT INTO controlcambios  
				(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
				VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
					
				$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
				//TERMINA Control Cambios
				include ("clienteCtoSoloCto.php");
				echo "<br><h2>ACTUALIZACION DE PARTIDA EXITOSA</h2><br>";
			}
			$actualizado = 'si';
		}

	// TERMINA Update BD
	}
	if(@!$res_conv_up)
	{
		include ("clienteCtoSoloCto.php");
		echo $contador;
		echo $noHacer;
		$mensaje = ($contador > 0)?', PARTIDA YA EXISTE :( ':'';
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n"; ##### ##### ##### ##### ##### #####
		echo "<br>HUBO UN ERROR, FAVOR DE ENVIAR CAPTURA DE PANTALLA A odesales@jetvan.com.mx<br> $mensaje" ;
	}
	else
	{
		echo "<br><h2>REGISTRO DE PARTIDA EXITOSO</h2><br>";
	}
	$actualizado = 'si';
}


if ($actualizado == ''){

include ("clienteCtoSoloCto.php");

echo "<h2>EDITAR PARTIDA</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO</th>
		</tr>
		
		<tr>
				<input type="hidden" name="id_cliente"  value="<?php echo $id_clienteE; ?>">
				<input type="hidden" name="id_contrato" value="<?php echo $id_contratoE; ?>">
				<input type="hidden" name="id_partidaE" value="<?php echo $id_partidaE; ?>">  

			<td>PARTIDA, SUBPARTIDA,<br> INCISO, NUMERAL ... </td>
			<td>
				<input type="text" name="clasifE" value="<?php echo $clasifE; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>DESCRIPCION</td>
			<td>
				<input type="text" name="descripcionE" value="<?php echo $descripcionE; ?>"  required >
			</td>
		</tr>



		<tr>
			<td>MARCAS</td>
			<td>
				<input type="text" name="marcasE" value="<?php echo $marcasE; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>MODELOS</td>
			<td>
				<input type="text" name="modelosE" value="<?php echo $modelosE; ?>"  required >
			</td>
		</tr>


		<tr>
			<td>CILINDROS</td>
			<td>
				<input type="number" lang="nb" step="1" min="1" 
				name="cilindrosE" value="<?php echo $cilindrosE; ?>" 
				style="text-align: right;" max='20' >
			</td>
		</tr>

<?php 
$cPD1 = ($calculoPDE == 1 )? 'checked':'';
$cPD2 = ($calculoPDE == 2 )? 'checked':'';
?>
		<tr>
			<td>PRECIO DIARIO A/IVA</td>
			<td>
				<b>$</b><input type="number" lang="nb" step="0.01" min="0" 
				name="precioDE" value="<?php echo $precioDE; ?>"   
				style="text-align: right;" max='200000' > 0000.00 sin comas
				<input type=radio name='calculoPDE' value='1' id='cPD1' 
				<?php echo $cPD1; ?> > 
				<label for='cPD1' title='EXISTE EN CONTRATO'>REAL</label>
				<input type=radio name='calculoPDE' value='2' id='cPD2'
				<?php echo $cPD2; ?> > 
				<label for='cPD2'>CALCULADO</label>
			</td>
		</tr>

<?php 
$cPM1 = ($calculoPME == 1 )? 'checked':'';
$cPM2 = ($calculoPME == 2 )? 'checked':'';
?>
		<tr>
			<td>PRECIO MENSUAL A/IVA</td>
			<td>
				<b>$</b><input type="number" lang="nb" step="0.01" min="0" 
				name="precioME" value="<?php echo $precioME; ?>"   
				style="text-align: right;" max='200000' > 0000.00 sin comas
				<input type=radio name='calculoPME' value='1' id='cPM1'
				<?php echo $cPM1; ?> > 
				<label for='cPM1' title='EXISTE EN CONTRATO'>REAL</label>
				<input type=radio name='calculoPME' value='2' id='cPM2'
				<?php echo $cPM2; ?> > 
				<label for='cPM2'>CALCULADO</label>
			</td>
		</tr>

		<tr>
			<td>MONTO MINIMO</td>
			<td>
				<b>$</b><input type="number" lang="nb" step="0.01" min="0" 
				name="minimoPE" value="0<?php echo $minimoPE; ?>"   
				style="text-align: right;" max='200000000' > 0000.00 sin comas
			</td>
		</tr>

		<tr>
			<td>MONTO MAXIMO</td>
			<td>
				<b>$</b><input type="number" lang="nb" step="0.01" min="0" 
				name="maximoPE" value="0<?php echo $maximoPE; ?>"   
				style="text-align: right;" max='200000000' > 0000.00 sin comas
			</td>
		</tr>


		<tr>
			<td>UNIDADES MINIMO</td>
			<td>
				<input type="number" lang="nb" step="1" min="1" 
				name="minUE" value="0<?php echo $minUE; ?>"   
				style="text-align: right;" max='200000000' >
			</td>
		</tr>
		<tr>
			<td>UNIDADES MAXIMO</td>
			<td>
				<input type="number" lang="nb" step="1" min="1" 
				name="maxUE" value="0<?php echo $maxUE; ?>"   
				style="text-align: right;" max='200000000' >
			</td>
		</tr>

		<tr>
			<td colspan=2 align=center>
				<INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="EDITAR PARTIDA">
			</td>
		</tr>

	</table>
</form>
</fieldset>

<?php 
}

// VOLVER AL CONTRATO
	echo "<p>
		  <FORM action='ctoIndex.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
		  </FORM>
		</p>";
// VOLVER AL CONTRATO

// INICIA BOTON VOLVER AL CLIENTE 
	echo "<td>
		<FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
		</FORM>
		</td>";
// TERMINA BOTON VOLVER AL CLIENTE		

} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>