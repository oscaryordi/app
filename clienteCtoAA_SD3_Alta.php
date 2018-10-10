<?php
include '1header.php';

include ("nav_cliente.php");


$id_usuario 	= $_SESSION["id_usuario"];
$id_contrato 	= mysqli_real_escape_string($dbd2, $_REQUEST['id_contrato']);
$filtroFlotilla = $_SESSION["filtroFlotilla"];
tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla);

//<!-- CANDADO PRIVILEGIO -->
if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 ){  // APERTURA PRIVILEGIOS 

//$id_cliente		= $_GET['id_cliente'];
$id_contrato	= mysqli_real_escape_string($dbd2, $_REQUEST['id_contrato']);
$id_subDiv2		= mysqli_real_escape_string($dbd2, $_REQUEST['id_subDiv2']);

echo "<br>";
include('clienteCtoHeader.php');

descId_subDiv2($id_subDiv2);
echo "<br><h3> AREA ADMINISTRATIVA : $subDiv2Desc </h3>";

$actualizado = '';

if ( isset($_GET['actualizar']) 
	&& $_GET['descripcion'] !== '' 
	)
{
	// FORMATEAR Y LIMPIAR DATOS
	$id_cliente 	= mysqli_real_escape_string($dbd2, $_GET['id_cliente'] );
	$id_contrato 	= mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
	$id_subDiv2 	= mysqli_real_escape_string($dbd2, $_GET['id_subDiv2'] );
	$descripcion 	= mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['descripcion'])));
	$capturo 		= $_SESSION["id_usuario"];


	// evitar duplicidad carga partida
	$sql_ED = "	SELECT * FROM clbSubDiv3 WHERE id_subDiv2 = '$id_subDiv2' 
			 	AND descripcion = '$descripcion' 
			 	LIMIT 1 ";
	$sql_ED_R = mysqli_query($dbd2, $sql_ED);
	$contador = mysqli_affected_rows($dbd2);
	$noHacer  = 0 ;		 
	if( $contador > 0 ){ $noHacer = 1 ;}
	// evitar duplicidad carga partida

	if( $noHacer == 0 )
	{
		$sql_ptds= "INSERT INTO `clbSubDiv3` 
					(`id_subDiv3`, `id_cliente`, `id_contrato`, id_subDiv2, 
					 `descripcion`, `capturo`, fechareg) 
					VALUES  
					(NULL, '$id_cliente', '$id_contrato', '$id_subDiv2',
					 '$descripcion',  '$capturo', current_timestamp) ";
		$res_ptds = mysqli_query($dbd2, $sql_ptds );
	}
	if(@!$res_ptds)
	{
		echo $contador;
		echo $noHacer;
		$mensaje = ($contador > 0)?', SUBAREA YA EXISTE :( ':'';
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n"; ##### ##### ##### ##### ##### #####
		echo "<br>HUBO UN ERROR, FAVOR DE ENVIAR CAPTURA DE PANTALLA A odesales@jetvan.com.mx<br> $mensaje" ;
	}
	else
	{
		echo "<br><h2>REGISTRO DE AREA ADMINISTRATIVA EXITOSO</h2><br>";
		echo "<br><a href='clienteCtoAA_SD3_Alta.php?id_subDiv2=$id_subDiv2&id_contrato=$id_contrato' >
				Dar de alta otra Subárea<a>  ";
		include("clientoCtoAA_SD3Res.php");
	}
	$actualizado = 'si';
}


if ($actualizado == ''){
echo "<h2>ALTA DE SUBAREA ADMINISTRATIVA (SEGUNDA DIVISION / SD3) </h2>";
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

			<td>DESCRIPCION</td>
			<td>
				<input type="text" name="descripcion" value="<?php //echo $cuenta; ?>"  size="100" maxlength="100" required >
			</td>
		</tr>

		<tr>
			<td colspan=2 align=center>
				<INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Registrar NUEVA SUBAREA">
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