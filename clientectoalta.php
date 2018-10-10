<?php
include '1header.php';
include ("nav_cliente.php");

$id_cliente = $_GET['id_cliente'];

$puedeContinuar = '';

if ($id_cliente != null 
	&& $id_cliente != '' 
	&&  $id_cliente != '--'
	&&  $id_cliente != 0 
	&&  $id_cliente > 0
	) {$puedeContinuar = 1;}

if($_SESSION["clientes"] > 1 && $puedeContinuar == 1){  // APERTURA PRIVILEGIOS<!-- CANDADO PRIVILEGIO -->
include ("clientegral.php");
$actualizado = '';


if (isset($_GET['actualizar']) 
	&& $_GET['id_alan'] !== '' 
//	&& $_GET['documento'] !== '' 
//	&& $_GET['fuente'] !== '' 
//	&& $_GET['estatus'] !== '' 
//	&& $_GET['numero'] !== '' 
//	&& $_GET['fechacontrato'] !== '' 
//	&& $_GET['fechainicio'] !== '' 
//	&& $_GET['fechafin'] !== '' 
//	&& $_GET['min'] !== '' 
//	&& $_GET['max'] !== '' 
	)
	{ 
		// FORMATEAR Y LIMPIAR DATOS
			$tipoC 		= 	mysqli_real_escape_string($dbd2, $_GET['tipoC'] );
			$id_alan 	= 	mysqli_real_escape_string($dbd2, $_GET['id_alan']);
			$documento 	= 	mysqli_real_escape_string($dbd2, $_GET['documento']);
			$fuente 	= 	mysqli_real_escape_string($dbd2, $_GET['fuente']);
			$fuenteB 	= 	mysqli_real_escape_string($dbd2, $_GET['fuenteB']);
			$fuente 	= 	$fuente."|".$fuenteB;
			$estatus 	= 	mysqli_real_escape_string($dbd2, $_GET['estatus']);
			$numero 	= 	mysqli_real_escape_string($dbd2, $_GET['numero']);

			$aliasCto 	= 	mysqli_real_escape_string($dbd2, $_GET['aliasCto']);
			
			$fechacontrato 	= 	mysqli_real_escape_string($dbd2, $_GET['fechacontrato']);
			$fechainicio 	= 	mysqli_real_escape_string($dbd2, $_GET['fechainicio']);
			$fechafin 		= 	mysqli_real_escape_string($dbd2, $_GET['fechafin']);
			
			$min = 	mysqli_real_escape_string($dbd2, $_GET['min']);
			$max = 	mysqli_real_escape_string($dbd2, $_GET['max']);

			$id_cliente = $_GET['id_cliente'];
			$capturo 	= $_SESSION["id_usuario"];

		$sql_ccto = "INSERT INTO `jetvantlc`.`clbCto` 
		(id_contrato, id_cliente, id_alan, documento, 
		fuente, estatus, numero, aliasCto, 
		fechacontrato, fechainicio, fechafin, 
		min, max, capturo, tipoC, validado) 
		VALUES  
		(NULL, '$id_cliente', '$id_alan', '$documento', 
		'$fuente', '$estatus', '$numero', '$aliasCto', 
		'$fechacontrato', '$fechainicio', '$fechafin', 
		'$min', '$max', '$capturo', '$tipoC', 0) ";

		$res_ccto = mysqli_query($dbd2, $sql_ccto);

		if(!$res_ccto){
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else{
			echo "<br><h2>REGISTRO DE CONTRATO EXITOSO</h2><br>";
		}
		$actualizado = 'si';
	}
	


if ($actualizado == ''){

echo "<h2>AGREGAR NUEVO CONTRATO</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO REGISTRAR NUEVO CONTRATO</th>
		</tr>


		<tr>
			<td>TIPO DE CONTRATO</td>
			<td>
				<input type="radio" name="tipoC" value="0" id='tipoCA' selected >
				<label for='tipoCA'>ARRENDAMIENTO</label>
				<input type="radio" name="tipoC" value="1" id='tipoCM' >
				<label for='tipoCM'>MANTENIMIENTO</label> 
			</td>
		</tr>

		
		<tr>
			<td>ID</td>
			<td>
				<input type="number" name="id_alan" value="<?php //echo $banco; ?>" required >
				<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>"> 
			</td>
		</tr>

		<tr>
			<td>Documento</td>
			<td>
				<select name="documento" >
					<option value="ORIGINAL" >ORIGINAL</option>
					<option value="COPIA" >COPIA</option>
				</select>
			</td>
		</tr>

		<tr>
			<td>Fuente</td>
			<td>
				<select name="fuente" >
					<option value="ORIGINAL" >LICITACION</option>
					<option value="DIRECTA" >DIRECTA</option>
					<option value="ADHESION" >ADHESION</option>
					<option value="ADHESION" >ADHESION SAT</option>
					<option value="ADHESION_OTROS" >ADHESION OTROS</option>
					<option value="PRIVADO" >PRIVADO</option>
				</select>
				 <br>TIPO:<input type='text' name="fuenteB">
			</td>
		</tr>

		<tr>
			<td>Estatus</td>
			<td>
				<select  name="estatus"  >
					<option value="VIGENTE" >VIGENTE</option>
					<option value="TERMINADO" >TERMINADO</option>
				</select>
			</td>
		</tr>

		<tr>
			<td>Numero</td>
			<td>
				<input type="text" name="numero" value="<?php //echo $cuenta; ?>"   >
			</td>
		</tr>

		<tr>
			<td>Alias CTO</td>
			<td>
				<input type="text" name="aliasCto" value="<?php //echo $cuenta; ?>"   >
			</td>
		</tr>		

		<tr>
			<td>Fecha del Contrato</td>
			<td>
				<input type="date" name="fechacontrato" value="<?php //echo $cuenta; ?>"   >
			</td>
		</tr>

		<tr>
			<td>Fecha de Inicio VIGENCIA</td>
			<td>
				<input type="date" name="fechainicio" value="<?php //echo $cuenta; ?>"   >
			</td>
		</tr>

		<tr>
			<td>Fecha de Final VIGENCIA</td>
			<td>
				<input type="date" name="fechafin" value="<?php //echo $cuenta; ?>"   >
			</td>
		</tr>

		<tr>
			<td>Monto Minimo</td>
			<td>
				<input type="number" lang="nb" 
				step="0.01" min="0" name="min" 
				value="0<?php //echo $clabe; ?>" >
			</td>
		</tr>

		<tr>
			<td>Monto Máximo</td>
			<td>
				<input type="number" lang="nb" 
				step="0.01" min="0" name="max" 
				value="0<?php //echo $cuenta; ?>" >
			</td>
		</tr>
		

		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Registrar nuevo CONTRATO"></td>
		</tr>

	</table>
</form>
</fieldset>

<?php };

// BOTON PARA VER LA CLIENTE // IR AL INDEX DE CLIENTE CONSULTADO
	echo "<p>
		<FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
		</FORM>
		</p>";

} // CIERRE PRIVILEGIOS
else
{
	echo "<br>ID_CLIENTE NO PROPORCIONADO"; 
}
include ("1footer.php"); ?>