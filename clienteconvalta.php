<?php
include '1header.php';

include ("nav_cliente.php");

//<!-- CANDADO PRIVILEGIO -->
if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS 

$id_cliente		= $_GET['id_cliente'];
$id_contrato	= $_GET['id_contrato'];

include ("clientegral.php");

// INICIO motrar contrato a que se agrega poliza
##### ##### ##### ##### ##### #####

$sql_ccto = 'SELECT id_contrato, id_alan, documento, fuente, estatus, numero, aliasCto, fechacontrato, fechainicio, fechafin, min, max '
		. ' FROM '
		. ' clbCto '
		. " WHERE id_contrato = '$id_contrato' ";		

$resultado_ccto = mysqli_query($dbd2, $sql_ccto);
@$campos_ccto 	= mysqli_num_fields($resultado_ccto);
@$filas_ccto 	= mysqli_num_rows($resultado_ccto);

echo "<section><p>CONTRATO ACTUAL: <b>$filas_ccto</b></p>"; 

while($row = mysqli_fetch_assoc($resultado_ccto))
	{

		echo "<div style='background-color: #d0e1e1; margin:15px; padding: 10px;'>";
		echo "<table class='tablasimple'><tr>
		<th>ID alan</th>
		<th>NUMERO</th>
		<th>UNIDADES ACTUALES</th>
		<th>ALIAS CTO</th>
		<th>DOCUMENTO</th>
		<th>FUENTE</th>
		<th>ESTATUS</th>
		<th>FECHA DEL CONTRATO</th>
		<th>INICIO</th>
		<th>FIN</th>
		<th>MINIMO</th>
		<th>MAXIMO</th>
		</tr>";
		global $id_contrato;
		$id_contrato 	= 	$row['id_contrato'];
		$id_alan	 	= 	$row['id_alan'];		
		$documento 		= 	$row['documento'];
		$fuente 		= 	$row['fuente'];
		$estatus 		= 	$row['estatus'];
		$numero 		= 	$row['numero'];
		$aliasCto 		= 	$row['aliasCto'];
		$fechacontrato 	= 	$row['fechacontrato'];
		$fechainicio 	= 	$row['fechainicio'];
		$fechafin 		= 	$row['fechafin'];
		$min 			= 	$row['min'];
		$max 			= 	$row['max'];

		@$min = number_format($min,2);
		@$max = number_format($max,2);

		echo "<tr>";
		echo "<td>{$id_alan}</td>";
		echo "<td>{$numero}</td>";

		unidadesContratoxid($id_contrato);
		echo "<td>{$unidadesCto}</td>";

		echo "<td>{$aliasCto}</td>";
		echo "<td>{$documento}</td>";
		echo "<td>{$fuente}</td>";
		echo "<td>{$estatus}</td>";
		echo "<td>{$fechacontrato}</td>";
		echo "<td>{$fechainicio}</td>";
		echo "<td>{$fechafin}</td>";
		echo "<td>{$min}</td>";
		echo "<td>{$max}</td>";

// INICIO EDITAR INFORMACION DEL CONTRATO
		echo 	"<td>
			   	<FORM action='clientectoeditar.php' method='POST' id='entabla'>
			   		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
					<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
					<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
				</FORM>
		  		</td>";
// INICIO EDITAR INFORMACION DEL CONTRATO

// INICIA SUBIR ARCHIVOS DEL CONTRATO		
		echo 	"<td>
			   	<FORM action='clienteCtoDtoAlta.php' method='POST' id='entabla'>
			   		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
					<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
					<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Subir Archivo'>
				</FORM>
		  		</td>";
// TERMINA SUBIR ARCHIVOS DEL CONTRATO

		echo "</tr></table>";


		echo "</div>";	 
		
	}
echo "</section>"; // Cerrar tabla


##### ##### ##### ##### ##### #####
// TERMINA mostrar contrato a que se agrega poliza


$actualizado = '';


if (isset($_GET['actualizar']) 
	&& $_GET['documento'] !== '' 
	&& $_GET['id_convAO'] !== '' 
	&& $_GET['fuente'] !== '' 
	&& $_GET['estatus'] !== '' 
	&& $_GET['numero'] !== '' 
	&& $_GET['fechafirma'] !== '' 
	&& $_GET['fechainicio'] !== '' 
	&& $_GET['fechafin'] !== '' 
	&& $_GET['min'] !== '' 
	&& $_GET['max'] !== ''  
	)
{
	// FORMATEAR Y LIMPIAR DATOS
	$id_convAO 		= 	mysqli_real_escape_string($dbd2, $_GET['id_convAO'] ); // ID AO
	$documento 		= 	mysqli_real_escape_string($dbd2, $_GET['documento'] );
	$fuente 		= 	mysqli_real_escape_string($dbd2, $_GET['fuente'] );
	$estatus 		= 	mysqli_real_escape_string($dbd2, $_GET['estatus'] );
	$numero 		= 	mysqli_real_escape_string($dbd2, $_GET['numero'] );

	@$aliasConv 	= 	mysqli_real_escape_string($dbd2, $_GET['aliasCto'] );
		
	$fechafirma 	= 	mysqli_real_escape_string($dbd2, $_GET['fechafirma'] );
	$fechainicio 	= 	mysqli_real_escape_string($dbd2, $_GET['fechainicio'] );
	$fechafin 		= 	mysqli_real_escape_string($dbd2, $_GET['fechafin'] );
			
	$min 			= 	mysqli_real_escape_string($dbd2, $_GET['min'] );
	$max 			= 	mysqli_real_escape_string($dbd2, $_GET['max'] );

	$id_cliente 	= 	mysqli_real_escape_string($dbd2, $_GET['id_cliente'] );
	$id_contrato 	= 	mysqli_real_escape_string($dbd2, $_GET['id_contrato'] );

	$capturo = $_SESSION["id_usuario"];

	$sql_conv = "INSERT INTO `jetvantlc`.`clbCtoConv` 
	(id_convenio, id_cliente, id_contrato, id_convAO, documento, fuente, estatus, numero, aliasConv, fechafirma, fechainicio, fechafin, min, max, capturo) VALUES  
	(NULL, '$id_cliente', '$id_contrato', '$id_convAO', '$documento', '$fuente', '$estatus', '$numero', '$aliasConv', '$fechafirma', '$fechainicio', '$fechafin', '$min', '$max', '$capturo') ";

	$res_conv = mysqli_query($dbd2, $sql_conv );

	if(!$res_conv)
	{
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n"; ##### ##### ##### ##### ##### #####
		echo "<br>DUPLICATE:  ES POR ID DE CONVENIO REPETIDO ... <br>" ;
	}
	else
	{
		echo "<br><h2>REGISTRO DE CONVENIO MODIFICATORIO EXITOSO</h2><br>";
	}
	$actualizado = 'si';
}


if ($actualizado == ''){

echo "<h2>AGREGAR NUEVO CONVENIO MODIFICATORIO</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO REGISTRAR NUEVO CONVENIO MODIFICATORIO</th>
		</tr>
		
		<tr>
				<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
				<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>"> 

			<td>ID Convenio</td>
			<td>
				<input type="text" name="id_convAO" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>


		<tr>
			<td>Documento</td>
			<td>
				<input type="text" name="documento" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Fuente</td>
			<td>
				<input type="text" name="fuente" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Estatus</td>
			<td>
				<input type="text" name="estatus" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Numero</td>
			<td>
				<input type="text" name="numero" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Alias CONVENIO</td>
			<td>
				<input type="text" name="aliasConv" value="<?php //echo $cuenta; ?>"   >
			</td>
		</tr>		

		<tr>
			<td>Fecha del Convenio</td>
			<td>
				<input type="date" name="fechafirma" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Fecha de Inicio VIGENCIA</td>
			<td>
				<input type="date" name="fechainicio" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Fecha de Final VIGENCIA</td>
			<td>
				<input type="date" name="fechafin" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Monto Minimo</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="min" value="0<?php //echo $clabe; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Monto Máximo</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="max" value="0<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>


		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Registrar CONVENIO MODIFICATORIO"></td>
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

// INICIA VOTON VOLVER AL CLIENTE 
// BOTON PARA VER LA CLIENTE // IR AL INDEX DE CLIENTE CONSULTADO
	echo "<td>
		<FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
		</FORM>
		</td>";
// TERMINA BOTON VOLVER AL CLIENTE		

} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>