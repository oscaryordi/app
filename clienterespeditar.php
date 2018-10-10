<?php
include '1header.php';
include ("nav_cliente.php");

echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS 

@$id_cliente 	= $_POST['id_cliente'];
@$id_contrato 	= $_POST['id_contrato'];
@$id_polrc 		= $_POST['id_polrc'];

if($id_cliente == '')	{$id_cliente 	= $_GET['id_cliente'];}
if($id_contrato == '')	{$id_contrato 	= $_GET['id_contrato'];}
if($id_polrc == '')		{$id_polrc 		= $_GET['id_polrc'];}

include ("clientegral.php");
$actualizado = '';

// INICIO Consultar CONFIDENCIALIDAD
$sql_rc = '	SELECT 
			id_polrc, id_cliente, id_contrato, poliza, 
			afianzadora, fecha, sumasegurada, periodo, 
			pagada, montofactura '
        . ' FROM '
        . ' cleRc '
        . " WHERE id_cliente = '$id_cliente' 
        	AND id_contrato = '$id_contrato' 
        	AND id_polrc 	= '$id_polrc' ";		

$resultado_rc	= mysqli_query($dbd2, $sql_rc);
@$campos_rc 	= mysqli_num_fields($resultado_rc);
@$filas_rc 		= mysqli_num_rows($resultado_rc);
// TERMINA Consultar CONFIDENCIALIDAD

// INICIO Asignar variables CONFIDENCIALIDAD
while($row = mysqli_fetch_assoc($resultado_rc))
	{
		$id_contrato 	= 	$row['id_contrato'];
		$id_cliente 	= 	$row['id_cliente'];

		$id_polrc 		= 	$row['id_polrc'];
		$poliza 		= 	$row['poliza'];		
		$afianzadora 	= 	$row['afianzadora'];
		$fecha 			= 	$row['fecha'];
		$sumasegurada 	= 	$row['sumasegurada'];
		$periodo 		= 	$row['periodo'];
		$pagada 		= 	$row['pagada'];
		$montofactura 	= 	$row['montofactura'];
	} 
// TERMINA Asignar variables de CONFIDENCIALIDAD

// INICIO Array viejo -- Para Control de Cambios
$arrayviejo =  "id_contrato = ".$id_contrato.",  id_cliente = ".$id_cliente.",  id_polrc = ".$id_polrc
				.",  poliza = ".$poliza.",  afianzadora = ".$afianzadora
				.",  fecha = ".$fecha.",  sumasegurada = ".$sumasegurada
				.",  periodo = ".$periodo.",  pagada = ".$pagada
				.",  montofactura = ".$montofactura ;
// TERMINA Array viejo -- Para Control de Cambios

// INICIO Procesar formulario
if (isset($_GET['actualizar']) 
	&& $_GET['id_contrato'] !== '' 
	&& $_GET['id_cliente'] !== '' 
	&& $_GET['id_polrc'] !== '' 

	&& $_GET['poliza'] !== '' 
	&& $_GET['afianzadora'] !== '' 
	&& $_GET['fecha'] !== '' 
	&& $_GET['sumasegurada'] !== '' 
	&& $_GET['periodo'] !== '' 
	&& $_GET['pagada'] !== '' 
	&& $_GET['montofactura'] !== '' 
	)
	{ 
		// INICIO Formatear y limpiar datos
			$id_contrato 	= 	mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
			$id_cliente 	= 	mysqli_real_escape_string($dbd2, $_GET['id_cliente']);
			$id_polrc	 	= 	mysqli_real_escape_string($dbd2, $_GET['id_polrc']);

			$poliza 		= 	mysqli_real_escape_string($dbd2, $_GET['poliza']);
			$afianzadora 	= 	mysqli_real_escape_string($dbd2, $_GET['afianzadora']);
			$fecha 			= 	mysqli_real_escape_string($dbd2, $_GET['fecha']);
			$sumasegurada 	= 	mysqli_real_escape_string($dbd2, $_GET['sumasegurada']);
			$periodo 		= 	mysqli_real_escape_string($dbd2, $_GET['periodo']);
			$pagada 		= 	mysqli_real_escape_string($dbd2, $_GET['pagada']);
			$montofactura 	= 	mysqli_real_escape_string($dbd2, $_GET['montofactura']);
		// TERMINA Formatear y limpiar datos

			$capturo 	= $_SESSION["id_usuario"];

		// INICIO Update BD
		$sql_polrc_up = "	UPDATE  `jetvantlc`.`cleRc`  
							SET 
							poliza 		= '$poliza',  
							afianzadora = '$afianzadora',  
							fecha 		= '$fecha',  
							sumasegurada= '$sumasegurada',  
							periodo 	= '$periodo',  
							pagada		= '$pagada',  
							montofactura= '$montofactura',  
							capturo 	= '$capturo' 
							WHERE 	id_cliente 	= '$id_cliente'  
							AND 	id_contrato = '$id_contrato' 
							AND 	id_polrc 	= '$id_polrc' 
							LIMIT 1 ";
		$res_polrc_up = mysqli_query($dbd2, $sql_polrc_up );
		// TERMINA Update DB

		if(!$res_polrc_up)
		{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else{
				// INICIA Control Cambios
				if($res_polrc_up)
					{ 
						$sql_up 	= mysqli_real_escape_string($dbd2, $sql_polrc_up );
						$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
						$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
						VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
						
						$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
						//TERMINA Control Cambios

						echo "<br><h2>ACTUALIZACION DE POLIZA DE RESPONSABILIDAD CIVIL EXITOSA</h2><br>";
					}
				$actualizado = 'si';
			}
	}
// TERMINA Procesar formulario	


if ($actualizado == ''){ // INICIA Mostrar Formulario

echo "<h2>EDITAR POLIZA DE RESPONSABILIDAD CIVIL</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO EDITAR POLIZA DE RESPONSABILIDAD CIVIL</th>
		</tr>
		
		<tr>
			<td>Póliza</td>
			<td>
				<input type="text" 	 name="poliza" 		value="<?php echo $poliza; ?>" required >
				<input type="hidden" name="id_cliente" 	value="<?php echo $id_cliente; ?>">
				<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>">
				<input type="hidden" name="id_polrc" 	value="<?php echo $id_polrc; ?>">  
			</td>
		</tr>
		
		<tr>
			<td>Afianzadora</td>
			<td>
				<input type="text" name="afianzadora" value="<?php echo $afianzadora; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Fecha</td>
			<td>
				<input type="date" name="fecha" value="<?php echo $fecha; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Suma Asegurada</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="sumasegurada" value="<?php echo $sumasegurada; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Anual o Total</td>
			<td>
				<input type="text" name="periodo" value="<?php echo $periodo; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Pagada</td>
			<td>
				<input type="text" name="pagada" value="<?php echo $pagada; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Monto Factura</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="montofactura" value="<?php echo $montofactura; ?>"  required >
			</td>
		</tr>

		<tr>
			<td colspan=2 align=center>
				<INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Editar POLIZA DE RESPONSABILIDAD CIVIL">
			</td>
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
    echo "<td>
        <FORM action='clienteindexuno.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
            <INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
        </FORM>
        </td>";
} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>