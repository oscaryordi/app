<?php
include '1header.php';
include ("nav_cliente.php");

//<!-- CANDADO PRIVILEGIO -->
if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS 

$id_cliente		= $_GET['id_cliente'];
$id_contrato	= $_GET['id_contrato'];

include ("clientegral.php");

// INICIO motrar contrato a que se agrega PARTIDA
##### ##### ##### ##### ##### #####
include ("clienteCtoSoloCto.php");
##### ##### ##### ##### ##### #####
// TERMINA mostrar contrato a que se agrega PARTIDA

$actualizado = '';

if (isset($_GET['actualizar']) 
	&& $_GET['clasif'] 	!== '' 
	&& $_GET['descripcion'] !== '' 
	&& $_GET['precioD'] !== '' 
	&& $_GET['precioM'] !== '' 
	)
{
	// FORMATEAR Y LIMPIAR DATOS

	$clasif 		= 	mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['clasif'])));
	$descripcion 	= 	mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['descripcion'])));
	$precioD 		= 	mysqli_real_escape_string($dbd2, $_GET['precioD']);
	$calculoPD 		= 	mysqli_real_escape_string($dbd2, $_GET['calculoPD']);
	$precioM 		= 	mysqli_real_escape_string($dbd2, $_GET['precioM']);
	$calculoPM 		= 	mysqli_real_escape_string($dbd2, $_GET['calculoPM']);
	$minimoP 		= 	mysqli_real_escape_string($dbd2, $_GET['minimoP']);
	$maximoP 		= 	mysqli_real_escape_string($dbd2, $_GET['maximoP']);

	$minU 			= 	mysqli_real_escape_string($dbd2, $_GET['minU']);
	$maxU 			= 	mysqli_real_escape_string($dbd2, $_GET['maxU']);

	$marcas 		= 	mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['marcas']))); // texto varchar
	$modelos 		= 	mysqli_real_escape_string($dbd2, $_GET['modelos']); // varchar
	$cilindros 		= 	mysqli_real_escape_string($dbd2, $_GET['cilindros']); // numero

	$id_cliente 	= 	mysqli_real_escape_string($dbd2, $_GET['id_cliente']);
	$id_contrato 	= 	mysqli_real_escape_string($dbd2, $_GET['id_contrato']);

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
	if( $contador > 0 ){ $noHacer = 1 ;}
	// evitar duplicidad carga partida

	if( $noHacer == 0 )
	{
		$sql_ptds= "INSERT INTO `ctoPartidas` 
		(`id_partida`, `id_cliente`, `id_contrato`, 
		`clasif`, `descripcion`, `precioD`, calculoPD,
		`precioM`, calculoPM,`capturo`, minimoP, maximoP, 
		minU, maxU, marcas, modelos, cilindros) 
		VALUES  
		(NULL, '$id_cliente', '$id_contrato', 
		'$clasif', '$descripcion', '$precioD', '$calculoPD',
		'$precioM', '$calculoPM', '$capturo',  '$minimoP', '$maximoP', 
		'$minU', '$maxU', '$marcas', '$modelos', '$cilindros') ";

		$res_ptds = mysqli_query($dbd2, $sql_ptds);
	}
	if(@!$res_ptds)
	{
		echo $contador;
		echo $noHacer;
		$mensaje = ($contador > 0)?', PARTIDA YA EXISTE :( ':'';
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		echo "<br>HUBO UN ERROR, FAVOR DE ENVIAR CAPTURA DE PANTALLA A odesales@jetvan.com.mx<br> $mensaje" ;
	}
	else
	{
		echo "<br><h2>REGISTRO DE PARTIDA EXITOSO</h2><br>";
	}
	$actualizado = 'si';
}


if ($actualizado == ''){
echo "<h2>ALTA DE PARTIDAS PARA CONTRATO</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO</th>
		</tr>
		
		<tr>
			<input type="hidden" name="id_cliente"  value="<?php echo $id_cliente; ?>">
			<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>"> 

			<td>PARTIDA, SUBPARTIDA,<br> INCISO, NUMERAL ... </td>
			<td>
				<input type="text" name="clasif" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>DESCRIPCION</td>
			<td>
				<input type="text" name="descripcion" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>MARCAS</td>
			<td>
				<input type="text" name="marcas" value="<?php //echo $marcas; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>MODELOS (AÑOS)</td>
			<td>
				<input type="text" name="modelos" value="<?php //echo $modelos; ?>"  required >
			</td>
		</tr>


		<tr>
			<td>CILINDROS</td>
			<td>
				<input type="number" lang="nb" step="1" min="1" 
				name="cilindros" value="0<?php echo @$_POST['cilindros']; ?>" 
				style="text-align: right;" max='20' >
			</td>
		</tr>


		<tr>
			<td>PRECIO DIARIO A/IVA</td>
			<td>
				<b>$</b><input type="number" lang="nb" step="0.01" min="0" 
				name="precioD" value="0<?php echo @$_POST['precioD']; ?>"   
				style="text-align: right;" max='200000' > 0000.00 sin comas
				<input type=radio name='calculoPD' value='1' id='cPD1'> 
				<label for='cPD1' title='EXISTE EN CONTRATO'>REAL</label>
				<input type=radio name='calculoPD' value='2' id='cPD2'> 
				<label for='cPD2'>CALCULADO</label>
			</td>
		</tr>
		<tr>
			<td>PRECIO MENSUAL A/IVA</td>
			<td>
				<b>$</b><input type="number" lang="nb" step="0.01" min="0" 
				name="precioM" value="0<?php echo @$_POST['precioM']; ?>"   
				style="text-align: right;" max='200000' > 0000.00 sin comas
				<input type=radio name='calculoPM' value='1' id='cPM1'> 
				<label for='cPM1' title='EXISTE EN CONTRATO'>REAL</label>
				<input type=radio name='calculoPM' value='2' id='cPM2'> 
				<label for='cPM2'>CALCULADO</label>
			</td>
		</tr>

		<tr>
			<td>MONTO MINIMO</td>
			<td>
				<b>$</b><input type="number" lang="nb" step="0.01" min="0" 
				name="minimoP" value="0<?php echo @$_POST['minimoP']; ?>"   
				style="text-align: right;" max='2000000000' > 0000.00 sin comas
			</td>
		</tr>
		<tr>
			<td>MONTO MAXIMO</td>
			<td>
				<b>$</b><input type="number" lang="nb" step="0.01" min="0" 
				name="maximoP" value="0<?php echo @$_POST['maximoP']; ?>"   
				style="text-align: right;" max='2000000000' > 0000.00 sin comas
			</td>
		</tr>

		<tr>
			<td>UNIDADES MINIMO</td>
			<td>
				<input type="number" lang="nb" step="1" min="1" 
				name="minU" value="0<?php echo @$_POST['minU']; ?>"   
				style="text-align: right;" max='200000000' >
			</td>
		</tr>
		<tr>
			<td>UNIDADES MAXIMO</td>
			<td>
				<input type="number" lang="nb" step="1" min="1" 
				name="maxU" value="0<?php echo @$_POST['maxU']; ?>"   
				style="text-align: right;" max='200000000' >
			</td>
		</tr>


		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Registrar NUEVA PARTIDA"></td>
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