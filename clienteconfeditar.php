<?php
include '1header.php';
include ("nav_cliente.php");

echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS 

@$id_cliente 	= $_POST['id_cliente'];
@$id_contrato 	= $_POST['id_contrato'];
@$id_polconfid 	= $_POST['id_polconfid'];

if($id_cliente == '')	{$id_cliente 	= $_GET['id_cliente'];}
if($id_contrato == '')	{$id_contrato 	= $_GET['id_contrato'];}
if($id_polconfid == '')	{$id_polconfid 	= $_GET['id_polconfid'];}

include ("clientegral.php");
$actualizado = '';

// INICIO Consultar CONFIDENCIALIDAD
$sql_cconf = 'SELECT 
			id_polconfid, id_cliente, id_contrato, poliza, 
			afianzadora, fecha, monto, anualototal, 
			pagada, montofactura '
        . ' FROM '
        . ' cldConfid '
        . " WHERE id_cliente = '$id_cliente' 
        	AND id_contrato = '$id_contrato' 
        	AND id_polconfid = '$id_polconfid' ";		

$resultado_cconf	= mysqli_query($dbd2, $sql_cconf);
@$campos_cconf 		= mysqli_num_fields($resultado_cconf);
@$filas_cconf 		= mysqli_num_rows($resultado_cconf);
// TERMINA Consultar CONFIDENCIALIDAD

// INICIO Asignar variables CONFIDENCIALIDAD
while($row = mysqli_fetch_assoc($resultado_cconf))
	{
		$id_contrato 	= 	$row['id_contrato'];
		$id_cliente 	= 	$row['id_cliente'];

		$id_polconfid 	= 	$row['id_polconfid'];
		$poliza 		= 	$row['poliza'];		
		$afianzadora 	= 	$row['afianzadora'];
		$fecha 			= 	$row['fecha'];
		$monto 			= 	$row['monto'];
		$anualototal 	= 	$row['anualototal'];
		$pagada 		= 	$row['pagada'];
		$montofactura 	= 	$row['montofactura'];
	} 
// TERMINA Asignar variables de CONFIDENCIALIDAD

// INICIO Array viejo -- Para Control de Cambios
$arrayviejo =  "id_contrato = ".$id_contrato.",  id_cliente = ".$id_cliente.",  id_polconfid = ".$id_polconfid
				.",  poliza = ".$poliza
				.",  afianzadora = ".$afianzadora.",  fecha = ".$fecha.",  monto = ".$monto
				.",  anualototal = ".$anualototal.",  pagada = ".$pagada
				.",  montofactura = ".$montofactura ;
// TERMINA Array viejo -- Para Control de Cambios

// INICIO Procesar formulario
if (isset($_GET['actualizar']) 
	&& $_GET['id_contrato'] !== '' 
	&& $_GET['id_cliente'] !== '' 
	&& $_GET['id_polconfid'] !== '' 

	&& $_GET['poliza'] !== '' 
	&& $_GET['afianzadora'] !== '' 
	&& $_GET['fecha'] !== '' 
	&& $_GET['monto'] !== '' 
	&& $_GET['anualototal'] !== '' 
	&& $_GET['pagada'] !== '' 
	&& $_GET['montofactura'] !== '' 
	)
	{ 
		// INICIO Formatear y limpiar datos
			$id_contrato = 	mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
			$id_cliente = 	mysqli_real_escape_string($dbd2, $_GET['id_cliente']);
			$id_polconfid	 = 	mysqli_real_escape_string($dbd2, $_GET['id_polconfid']);

			$poliza 	= 	mysqli_real_escape_string($dbd2, $_GET['poliza']);
			$afianzadora 	= 	mysqli_real_escape_string($dbd2, $_GET['afianzadora']);
			$fecha 		= 	mysqli_real_escape_string($dbd2, $_GET['fecha']);
			$monto 		= 	mysqli_real_escape_string($dbd2, $_GET['monto']);
			$anualototal 	= 	mysqli_real_escape_string($dbd2, $_GET['anualototal']);
			$pagada 	= 	mysqli_real_escape_string($dbd2, $_GET['pagada']);
			$montofactura 	= 	mysqli_real_escape_string($dbd2, $_GET['montofactura']);
		// TERMINA Formatear y limpiar datos

			$capturo 	= $_SESSION["id_usuario"];
		
		// INICIO Update BD
		$sql_polconf_up = "UPDATE  `jetvantlc`.`cldConfid`  SET 
  
		poliza 		=   '$poliza',  
		afianzadora =  '$afianzadora',  
		fecha 		=   '$fecha',  
		monto 		=   '$monto',  
		anualototal =   '$anualototal',  
		pagada		=  '$pagada',  
		montofactura =  '$montofactura',  
		capturo 	=  '$capturo' 
		WHERE id_cliente = '$id_cliente'  AND id_contrato = '$id_contrato' AND id_polconfid = '$id_polconfid' LIMIT 1 ";
		$res_polconf_up = mysqli_query($dbd2, $sql_polconf_up );
		// TERMINA Update DB

		if(!$res_polconf_up)
		{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else{
				// INICIA Control Cambios
				if($res_polconf_up)
					{ 
						$sql_up 	= mysqli_real_escape_string($dbd2, $sql_polconf_up);
						$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo);
						
						$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
						(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
						VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
						
						$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
						//TERMINA Control Cambios

						echo "<br><h2>ACTUALIZACION DE POLIZA DE CONFIDENCIALIDAD EXITOSA</h2><br>";
					}
				$actualizado = 'si';
			}
	}
// TERMINA Procesar formulario	


if ($actualizado == ''){ // INICIA Mostrar Formulario

echo "<h2>EDITAR POLIZA DE CONFIDENCIALIDAD</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO EDITAR POLIZA DE CONFIDENCIALIDAD</th>
		</tr>
		
		<tr>
			<td>Póliza</td>
			<td>
				<input type="text" name="poliza" value="<?php echo $poliza; ?>" required >
				<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
				<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>">
				<input type="hidden" name="id_polconfid" value="<?php echo $id_polconfid; ?>">  
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
			<td>Monto Cobertura</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="monto" value="<?php echo $monto; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Anual o Total</td>
			<td>
				<input type="text" name="anualototal" value="<?php echo $anualototal; ?>"  required >
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
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Editar POLIZA DE CONFIDENCIALIDAD"></td>
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

// BOTON PARA VER LA CLIENTE
    echo "<td>
        <FORM action='clienteindexuno.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
        </FORM>
        </td>";

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>