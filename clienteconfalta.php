<?php
include '1header.php';
include ("nav_cliente.php");

if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS

$id_cliente		= $_GET['id_cliente'];
$id_contrato	= $_GET['id_contrato'];

include ("clientegral.php");

// INICIO motrar contrato a que se agrega poliza
##### ##### ##### ##### ##### #####


$sql_ccto =   ' SELECT id_contrato, id_alan, documento, fuente, 
				estatus, numero, aliasCto, fechacontrato, 
				fechainicio, fechafin, min, max '
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
		echo "<table class='tablasimple'>
			<tr>
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
	&& $_GET['poliza'] !== '' 
	&& $_GET['afianzadora'] !== '' 
	&& $_GET['fecha'] !== '' 
	&& $_GET['monto'] !== '' 
	&& $_GET['anualototal'] !== '' 
	&& $_GET['pagada'] !== '' 
	&& $_GET['montofactura'] !== '' 
	)
	{ 
		// FORMATEAR Y LIMPIAR DATOS

		$poliza 		= 	mysqli_real_escape_string($dbd2, $_GET['poliza']);
		$afianzadora 	= 	mysqli_real_escape_string($dbd2, $_GET['afianzadora']);
		$fecha 			= 	mysqli_real_escape_string($dbd2, $_GET['fecha']);
		$monto 			= 	mysqli_real_escape_string($dbd2, $_GET['monto']);
		$anualototal 	= 	mysqli_real_escape_string($dbd2, $_GET['anualototal']);
		$pagada 		= 	mysqli_real_escape_string($dbd2, $_GET['pagada']);			
		$montofactura 	= 	mysqli_real_escape_string($dbd2, $_GET['montofactura']);

		$id_cliente 	= 	mysqli_real_escape_string($dbd2, $_GET['id_cliente']);
		$id_contrato 	= 	mysqli_real_escape_string($dbd2, $_GET['id_contrato']);

		$capturo = $_SESSION["id_usuario"];

		$sql_pcmpl = "INSERT INTO `jetvantlc`.`cldConfid` 
						(id_polconfid, id_cliente, id_contrato,  poliza, 
						afianzadora, fecha, monto, anualototal, 
						pagada, montofactura, capturo) 
						VALUES  
						(NULL, '$id_cliente', '$id_contrato',  '$poliza', 
						'$afianzadora', '$fecha', '$monto', '$anualototal', 
						'$pagada', '$montofactura', '$capturo') ";
						

		$res_pcmpl = mysqli_query($dbd2, $sql_pcmpl);

		if(!$res_pcmpl){
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else{
			echo "<br><h2>REGISTRO DE POLIZA EXITOSO</h2><br>";
		}
		$actualizado = 'si';
	}
	

if ($actualizado == ''){

echo "<h2>AGREGAR NUEVA POLIZA DE CONFIDENCIALIDAD</h2>";
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
	<table>
		<tr>
			<th colspan=2>FORMULARIO REGISTRAR NUEVO CONTRATO</th>
		</tr>
		
		<tr>
			<td>Póliza</td>
			<td>
				<input type="text" name="poliza" value="<?php //echo $banco; ?>" required >
				<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
				<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>"> 
			</td>
		</tr>
		
		<tr>
			<td>Afianzadora</td>
			<td>
				<input type="text" name="afianzadora" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>



		<tr>
			<td>Fecha</td>
			<td>
				<input type="date" name="fecha" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>



		<tr>
			<td>Monto Cobertura</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="monto" value="0<?php //echo $clabe; ?>"  required >
			</td>
		</tr>

		<tr>
			<td>Anual o Total</td>
			<td>
				<input type="text" name="anualototal" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>


		<tr>
			<td>Pagada</td>
			<td>
				<input type="text" name="pagada" value="<?php //echo $cuenta; ?>"  required >
			</td>
		</tr>



		<tr>
			<td>Monto Factura</td>
			<td>
				<input type="number" lang="nb" step="0.01" min="0" name="montofactura" value="0<?php //echo $clabe; ?>"  required >
			</td>
		</tr>

		

		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Registrar POLIZA DE CONFIDENCIALIDAD"></td>
		</tr>

	</table>
</form>
</fieldset>

<?php };

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
            <INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
        </FORM>
        </td>";
// TERMINA BOTON VOLVER AL CLIENTE        

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>