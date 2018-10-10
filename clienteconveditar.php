<?php
include '1header.php';
include ("nav_cliente.php");

echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS

@$id_cliente 	= $_POST['id_cliente'];
@$id_contrato 	= $_POST['id_contrato'];
@$id_convenio 	= $_POST['id_convenio'];

if($id_cliente 	== ''){$id_cliente = $_GET['id_cliente'];}
if($id_contrato == ''){$id_contrato = $_GET['id_contrato'];}
if($id_convenio == ''){$id_convenio = $_GET['id_convenio'];}

include ("clientegral.php");
$actualizado = '';

// INICIO Consultar CONVENIO
$sql_conv = 'SELECT id_convenio, id_cliente, id_contrato, id_convAO,
			documento, fuente, estatus, numero, aliasConv, fechafirma, fechainicio, fechafin, min, max '
		. ' FROM '
		. ' clbCtoConv '
		. " WHERE id_cliente = '$id_cliente'  AND id_contrato = '$id_contrato' AND id_convenio = '$id_convenio' ";

$resultado_conv = mysqli_query($dbd2, $sql_conv);
@$campos_conv 	= mysqli_num_fields($resultado_conv);
@$filas_conv 	= mysqli_num_rows($resultado_conv);
// TERMINA Consultar CONVENIO

// INICIO Asignar variables CONVENIO
while($row = mysqli_fetch_assoc($resultado_conv))
	{
		$id_contrato 	= 	$row['id_contrato'];
		$id_cliente 	= 	$row['id_cliente'];
		$id_convenio 	= 	$row['id_convenio'];
		$id_convAO 		= 	$row['id_convAO'];
		$documento 		= 	$row['documento'];
		$fuente 		= 	$row['fuente'];
		$estatus 		= 	$row['estatus'];
		$numero 		= 	$row['numero'];
		$aliasConv 		= 	$row['aliasConv'];
		$fechafirma 	= 	$row['fechafirma'];
		$fechainicio 	= 	$row['fechainicio'];
		$fechafin 		= 	$row['fechafin'];
		$min 			= 	$row['min'];
		$max 			= 	$row['max'];
	} 
// TERMINA Asignar variables de CONVENIO

// INICIO Array viejo -- Para Control de Cambios
$arrayviejo =  "id_contrato = ".$id_contrato.",  id_cliente = ".$id_cliente.",  id_convenio = ".$id_convenio
				.",  id_convAO = ".$id_convAO.",  documento = ".$documento.",  fuente = ".$fuente.",  estatus = ".$estatus
				.",  numero = ".$numero.",  aliasConv = ".$aliasConv.",  fechafirma = ".$fechafirma
				.",  fechainicio = ".$fechainicio
				.",  fechafin = ".$fechafin.",  min = ".$min.",  max = ".$max ;
// TERMINA Array viejo -- Para Control de Cambios

// INICIO Procesar formulario
if (isset($_GET['actualizar']) 
	&& $_GET['id_contrato'] !== '' 
	&& $_GET['id_cliente'] !== '' 
	&& $_GET['id_convenio'] !== '' 
	&& $_GET['id_convAO'] !== '' 
	&& $_GET['documento'] !== '' 
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
		// INICIO Formatear y limpiar datos
			$id_contrato = 	mysqli_real_escape_string($dbd2, $_GET['id_contrato'] );
			$id_convenio = 	mysqli_real_escape_string($dbd2, $_GET['id_convenio'] );
			$id_cliente	 = 	mysqli_real_escape_string($dbd2, $_GET['id_cliente'] );
			$id_convAO = 	mysqli_real_escape_string($dbd2, $_GET['id_convAO'] );
			$documento 	= 	mysqli_real_escape_string($dbd2, $_GET['documento'] );
			$fuente 	= 	mysqli_real_escape_string($dbd2, $_GET['fuente'] );
			$estatus 	= 	mysqli_real_escape_string($dbd2, $_GET['estatus'] );
			$numero 	= 	mysqli_real_escape_string($dbd2, $_GET['numero'] );
			$aliasConv 	= 	mysqli_real_escape_string($dbd2, $_GET['aliasConv'] );

			$fechafirma 	= 	mysqli_real_escape_string($dbd2, $_GET['fechafirma'] );
			$fechainicio 	= 	mysqli_real_escape_string($dbd2, $_GET['fechainicio'] );
			$fechafin 		= 	mysqli_real_escape_string($dbd2, $_GET['fechafin'] );
			
			$min = 	mysqli_real_escape_string($dbd2, trim($_GET['min'], ",") );
			$max = 	mysqli_real_escape_string($dbd2, trim($_GET['max'], ",") );
		// TERMINA Formatear y limpiar datos

			$capturo 	= $_SESSION["id_usuario"];
		
		// INICIO Update BD
		$sql_conv_up = "UPDATE  `jetvantlc`.`clbCtoConv`  SET 

		id_convAO 	= '$id_convAO', 
		documento 	= '$documento', 
		fuente 		= '$fuente', 
		estatus 	= '$estatus', 
		numero 		= '$numero', 
		aliasConv 	= '$aliasConv', 
		fechafirma	= '$fechafirma', 
		fechainicio = '$fechainicio', 
		fechafin 	= '$fechafin', 
		min 		= '$min', 
		max 		= '$max', 
		capturo 	= '$capturo' 
		WHERE id_cliente = '$id_cliente'  AND id_contrato = '$id_contrato' AND id_convenio = '$id_convenio' LIMIT 1 ";
		$res_conv_up = mysqli_query($dbd2, $sql_conv_up );
		// TERMINA Update DB

		if(!$res_conv_up)
		{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
			echo "DUPLICATE: ES POR UN ID CONVENIO DUPLICADO ... ";
		}
		else{
				// INICIA Control Cambios
				if($res_conv_up)
					{ 
						$sql_up = mysqli_real_escape_string($dbd2, $sql_conv_up );
						$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
						$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
						VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
						
						$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
						//TERMINA Control Cambios

						echo "<br><h2>ACTUALIZACION DE CONVENIO EXITOSA</h2><br>";
					}
				$actualizado = 'si';
			}
	}
// TERMINA Procesar formulario	


if ($actualizado == ''){ // INICIA Mostrar Formulario

echo "<h2>EDITAR CONVENIO MODIFICATORIO</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO EDITAR CONVENIO MODIFICATORIO</th>
		</tr>

		<tr>
				<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
				<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>">
				<input type="hidden" name="id_convenio" value="<?php echo $id_convenio; ?>">
			<td>ID Convenio</td>
			<td>
				<input type="text" name="id_convAO" value="<?php echo $id_convAO; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Documento</td>
			<td>
				<input type="text" name="documento" value="<?php echo $documento; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Fuente</td>
			<td>
				<input type="text" name="fuente" value="<?php echo $fuente; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Estatus</td>
			<td>
				<input type="text" name="estatus" value="<?php echo $estatus; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Numero</td>
			<td>
				<input type="text" name="numero" value="<?php echo $numero; ?>" size="50" required >
			</td>
		</tr>

		<tr>
			<td>Alias CONVENIO</td>
			<td>
				<input type="text" name="aliasConv" value="<?php echo @$aliasConv; ?>"   >
			</td>
		</tr>		

		<tr>
			<td>Fecha del Convenio</td>
			<td>
				<input type="date" name="fechafirma" value="<?php echo $fechafirma; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Fecha de Inicio VIGENCIA</td>
			<td>
				<input type="date" name="fechainicio" value="<?php echo $fechainicio; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Fecha de Final VIGENCIA</td>
			<td>
				<input type="date" name="fechafin" value="<?php echo $fechafin; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Monto Minimo</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="min" value="<?php echo $min; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Monto Máximo</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="max" value="<?php echo $max; ?>"  required >
			</td>
		</tr>
		
		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Editar CONVENIO"></td>
		</tr>

	</table>
</form>
</fieldset>

<?php }; // TERMINA Mostrar formulario


// VOLVER AL CONTRATO
	echo "<p>
		  <FORM action='ctoIndex.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
		  </FORM>
		</p>";
// VOLVER AL CONTRATO


// BOTON PARA VER LA CLIENTE // IR AL INDEX DE CLIENTE CONSULTADO
	echo "<td>
		<FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
		</FORM>
		</td>";

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>