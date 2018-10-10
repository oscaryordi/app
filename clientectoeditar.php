<?php
include '1header.php';
include ("nav_cliente.php");
echo "<meta charset='utf-8'>"; 

if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS

@$id_cliente 	= $_POST['id_cliente'];
@$id_contrato 	= $_POST['id_contrato'];

if($id_cliente == ''){$id_cliente = $_GET['id_cliente'];}
if($id_contrato == ''){$id_contrato = $_GET['id_contrato'];}

include ("clientegral.php");
$actualizado = '';

// INICIO Consultar contrato
$sql_ccto = '	SELECT id_contrato,  id_cliente,  id_alan,  documento,  
				fuente,  estatus,  numero,  aliasCto, 
				fechacontrato ,  fechainicio,  fechafin,  
				min,  max, tipoC '
	        . ' FROM '
	        . ' clbCto '
	        . " WHERE id_contrato = '$id_contrato' ";		
$resultado_ccto = mysqli_query($dbd2, $sql_ccto);
@$campos_ccto 	= mysqli_num_fields($resultado_ccto);
@$filas_ccto 	= mysqli_num_rows($resultado_ccto);
// TERMINA Consultar contrato

// INICIO Asignar variables contrato
while($row = mysqli_fetch_assoc($resultado_ccto))
	{
		$id_contrato 	= 	$row['id_contrato'];
		$id_cliente 	= 	$row['id_cliente'];
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
		$tipoC 			= 	$row['tipoC'];
	} 
// TERMINA Asignar variables de contrato

// INICIO Array viejo -- Para Control de Cambios
$arrayviejo =  "id_contrato = ".$id_contrato
				.",  id_cliente = ".$id_cliente
				.",  id_alan = ".$id_alan
				.",  documento = ".$documento
				.",  fuente = ".$fuente
				.",  estatus = ".$estatus
				.",  numero = ".$numero
				.",  aliasCto = ".$aliasCto
				.",  fechacontrato = ".$fechacontrato
				.",  fechainicio = ".$fechainicio
				.",  fechafin = ".$fechafin
				.",  min = ".$min
				.",  max = ".$max
				.",  tipoC = ".$tipoC ;
// TERMINA Array viejo -- Para Control de Cambios

// INICIO Procesar formulario
if (isset($_GET['actualizar']) 
	&& $_GET['id_contrato'] !== '' 
	&& $_GET['id_alan'] !== '' 
	&& $_GET['documento'] !== '' 
	&& $_GET['fuente'] !== '' 
	&& $_GET['estatus'] !== '' 
	&& $_GET['numero'] !== '' 
	&& $_GET['fechacontrato'] !== '' 
	&& $_GET['fechainicio'] !== '' 
	&& $_GET['fechafin'] !== '' 
	&& $_GET['min'] !== '' 
	&& $_GET['max'] !== '' 
	)
	{ 
		// INICIO Formatear y limpiar datos
			$id_contrato = 	mysqli_real_escape_string($dbd2, $_GET['id_contrato'] );
			$tipoC 		= 	mysqli_real_escape_string($dbd2, $_GET['tipoC'] );

			$id_alan 	= 	mysqli_real_escape_string($dbd2, $_GET['id_alan'] );
			$documento 	= 	mysqli_real_escape_string($dbd2, $_GET['documento'] );
			$fuente 	= 	mysqli_real_escape_string($dbd2, $_GET['fuente'] );
			$estatus 	= 	mysqli_real_escape_string($dbd2, $_GET['estatus'] );
			$numero 	= 	mysqli_real_escape_string($dbd2, $_GET['numero'] );
			$aliasCto 	= 	mysqli_real_escape_string($dbd2, $_GET['aliasCto'] );

			$fechacontrato 	= 	mysqli_real_escape_string($dbd2, $_GET['fechacontrato'] );
			$fechainicio 	= 	mysqli_real_escape_string($dbd2, $_GET['fechainicio'] );
			$fechafin 		= 	mysqli_real_escape_string($dbd2, $_GET['fechafin'] );
			
			$min = 	mysqli_real_escape_string($dbd2, trim($_GET['min'], ",") );
			$max = 	mysqli_real_escape_string($dbd2, trim($_GET['max'], ",") );
		// TERMINA Formatear y limpiar datos

			$id_cliente = $_GET['id_cliente'];
			$capturo 	= $_SESSION["id_usuario"];
		
		// INICIO Update BD
		$sql_ccto_up = "UPDATE  `jetvantlc`.`clbCto`  SET 
		id_alan 	=  '$id_alan' ,  
		documento 	=   '$documento',  
		fuente 		=  '$fuente',  
		estatus 	=   '$estatus',  
		numero 		=   '$numero',  
		aliasCto 	=   '$aliasCto',  
		fechacontrato =  '$fechacontrato',  
		fechainicio =  '$fechainicio',  
		fechafin 	=  '$fechafin',  
		min 		=  '$min',  
		max 		=  '$max',  
		capturo 	=  '$capturo', 
		tipoC 		=  '$tipoC' 
		WHERE id_contrato = '$id_contrato' LIMIT 1 ";
		$res_ccto_up = mysqli_query($dbd2, $sql_ccto_up );
		// TERMINA Update DB

		if(!$res_ccto_up)
		{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else
		{
			// INICIA Control Cambios
			if($res_ccto_up)
			{ 
				$sql_up 	= mysqli_real_escape_string($dbd2, $sql_ccto_up );
				$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
				$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
						VALUES 
						(NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";

				$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
				echo "<br><h2>ACTUALIZACION DE CONTRATO EXITOSA</h2><br>";
			}//TERMINA Control Cambios
			$actualizado = 'si';
		}
	}
// TERMINA Procesar formulario	

if ($actualizado == ''){ // INICIA Mostrar Formulario
echo "<h2>EDITAR CONTRATO</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO EDITAR CONTRATO</th>
		</tr>

<?php
$tipoCArray = array('','');
$tipoCArray[$tipoC] = 'checked';
?>
		<tr>
			<td>TIPO DE CONTRATO</td>
			<td>
				<input type="radio" name="tipoC" value="0" id='tipoCA' <?php echo $tipoCArray[0];?> >
				<label for='tipoCA'>ARRENDAMIENTO</label>
				<input type="radio" name="tipoC" value="1" id='tipoCM' <?php echo $tipoCArray[1];?> >
				<label for='tipoCM'>MANTENIMIENTO</label> 
			</td>
		</tr>

		<tr>
			<td>ID</td>
			<td>
				<input type="number" name="id_alan" value="<?php echo $id_alan; ?>" min="0" step="1" required >
				<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
				<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>"> 
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
				<input type="text" name="numero" value="<?php echo $numero; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Alias CTO</td>
			<td>
				<input type="text" name="aliasCto" value="<?php echo $aliasCto; ?>"   >
			</td>
		</tr>

		<tr>
			<td>Fecha del Contrato</td>
			<td>
				<input type="date" name="fechacontrato" value="<?php echo $fechacontrato; ?>"  required >
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
				<input type="number" step="any" name="min" value="<?php echo $min; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Monto Máximo</td>
			<td>
				<input type="number" step="any" name="max" value="<?php echo $max; ?>"  required >
			</td>
		</tr>
		
		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Editar CONTRATO"></td>
		</tr>

	</table>
</form>
</fieldset>

<?php };  // TERMINA Mostrar formulario


// VOLVER AL CONTRATO
	echo "<p>
		  <FORM action='ctoIndex.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
		  </FORM>
		</p>";
// VOLVER AL CONTRATO

// BOTON PARA VER LA CLIENTE // IR AL INDEX DE CLIENTE CONSULTADO
    echo "<p>
        <FORM action='clienteindexuno.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
            <INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
        </FORM>
        </p>";

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>