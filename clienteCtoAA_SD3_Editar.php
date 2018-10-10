<?php
include '1header.php';
include ("nav_cliente.php");

$id_usuario 	= $_SESSION["id_usuario"];
$filtroFlotilla = $_SESSION["filtroFlotilla"];
$id_contrato	= mysqli_real_escape_string($dbd2, $_REQUEST['id_contrato']);
tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla);

//<!-- CANDADO PRIVILEGIO -->
if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 ){  // APERTURA PRIVILEGIOS 

//$id_cliente		= $_GET['id_cliente'];
@$id_contrato	= mysqli_real_escape_string($dbd2, $_POST['id_contrato']) ;
if(!isset($id_contrato) OR $id_contrato==''){
	$id_contrato = mysqli_real_escape_string($dbd2, $_GET['id_contrato']) ;
}
@$id_subDiv2		= mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']) ;
if(!isset($id_subDiv2) OR $id_subDiv2==''){
	$id_subDiv2 = mysqli_real_escape_string($dbd2, $_GET['id_subDiv2']) ;
}
@$id_subDiv3		= mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']) ;
if(!isset($id_subDiv2) OR $id_subDiv3==''){
	$id_subDiv3 = mysqli_real_escape_string($dbd2, $_GET['id_subDiv3']) ;
}

areaAXid_subDiv3($id_subDiv3);
//descId_subDiv2($id_subDiv2);
$descripcionSE 	= $mostrarAAsn3;
$arrayviejo 	= "Descripcion: ".$descripcionSE ;

echo "<br>";
include('clienteCtoHeader.php');
descId_subDiv2($id_subDiv2);
echo "<br><h3> AREA ADMINISTRATIVA : $subDiv2Desc </h3>";

// INICIO motrar contrato a que se agrega PARTIDA
##### ##### ##### ##### ##### #####
//include ("clienteCtoSoloCto.php");
##### ##### ##### ##### ##### #####
// TERMINA mostrar contrato a que se agrega PARTIDA

$actualizado = '';

if (isset($_GET['actualizar']) 
	&& $_GET['descripcion'] !== '' 
	)
{
	// FORMATEAR Y LIMPIAR DATOS
	$id_cliente 	= mysqli_real_escape_string($dbd2, $_GET['id_cliente'] );
	$id_contrato 	= mysqli_real_escape_string($dbd2, $_GET['id_contrato'] );
	$id_subDiv2 	= mysqli_real_escape_string($dbd2, $_GET['id_subDiv2'] );
	$id_subDiv3 	= mysqli_real_escape_string($dbd2, $_GET['id_subDiv3'] );
	$descripcion 	= mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['descripcion'])) );
	$capturo 		= $_SESSION["id_usuario"];

	$noHacer  = 0 ;		 
	if( $noHacer == 0 )
	{
		$sql_ptds= " UPDATE `clbSubDiv3` SET 
					descripcion =  '$descripcion' 
					WHERE id_subDiv3 = '$id_subDiv3' LIMIT 1 ";
		$res_ptds = mysqli_query($dbd2, $sql_ptds );
	}
	if(@!$res_ptds)
	{
		$mensaje = ($contador > 0)?', AREA YA EXISTE :( ':'';
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n"; ##### ##### ##### ##### ##### #####
		echo "<br>HUBO UN ERROR, FAVOR DE ENVIAR CAPTURA DE PANTALLA A odesales@jetvan.com.mx<br> $mensaje" ;
	}
	else
	{
		// CONTROL CAMBIOS
		$sql_up 	= mysqli_real_escape_string($dbd2, $sql_ptds );
		$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
		$sql_control_cambios = "INSERT INTO controlcambios  
							(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
							VALUES 
							(NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
		$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
		// CONTROL CAMBIOS

		echo "<br><h2>REGISTRO DE SUBAREA EXITOSO</h2><br>";
		echo "<br><a href='clienteCtoAA_SD3_Alta.php?id_subDiv2=$id_subDiv2&id_contrato=$id_contrato' >
				Dar de alta otra Subárea<a>  ";
		include("clientoCtoAA_SD3Res.php");
	}
	$actualizado = 'si';
}

if ($actualizado == '')
{
	echo "<h2>SUBAREA ADMINISTRATIVA (SEGUNDA DIVISION / SD3)</h2>";
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
				<input type="hidden" name="id_subDiv2" value="<?php echo $id_subDiv2; ?>">
				<input type="hidden" name="id_subDiv3" value="<?php echo $id_subDiv3; ?>">
				<td>DESCRIPCION</td>
				<td>
					<input type="text" name="descripcion" value="<?php echo $descripcionSE;?>"  size="100" maxlength="100" required >
				</td>
			</tr>

			<tr>
				<td colspan=2 align=center>
					<INPUT id="gobutton" TYPE="submit" NAME="actualizar" 
					VALUE="Editar SUBAREA">
				</td>
			</tr>

		</table>
	</form>
	</fieldset>

	<?php 
	include("clientoCtoAA_SD3Res.php");
}


echo"<br>
	<p>
	  <FORM action='clienteCtoAA.php' method='GET' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver a AREAS ADMINISTRATIVAS'>
	  </FORM>
	</p>";


echo"<br>
	<p>
	  <FORM action='ctoIndex.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
	  </FORM>
	</p>";
//echo "<a href='clienteindexuno.php?id_cliente='$id_cliente'>Volver al contrato</a>";


if($_SESSION["clientes"] > 0  )
{
	echo"<br>
		<p>
		  <FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CLIENTE'>
		  </FORM>
		</p>";
	//echo "<a href='clienteindexuno.php?id_cliente='$id_cliente'>Volver al cliente</a>";
}

} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>