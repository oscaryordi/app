<?php
include '1header.php';
include ("nav_cliente.php");

$id_usuario 	= $_SESSION["id_usuario"];
$id_contrato 	= mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
$filtroFlotilla = $_SESSION["filtroFlotilla"];
tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla);

//<!-- CANDADO PRIVILEGIO -->
if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 ){  // APERTURA PRIVILEGIOS 

//$id_cliente		= $_GET['id_cliente'];
$id_contrato	= $_GET['id_contrato'];

echo "<br>";
include('clienteCtoHeader.php');

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
	$id_contrato 	= mysqli_real_escape_string($dbd2, $_GET['id_contrato']);

	$descripcion 	= mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['descripcion'])) );
	$nombre 		= mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['nombre'])) );
	$domicilio 		= mysqli_real_escape_string($dbd2, trim(strtoupper($_GET['domicilio'])) );

	$capturo 		= $_SESSION["id_usuario"];


	// evitar duplicidad carga partida
	$sql_ED = "	SELECT * FROM clbSubDiv2 WHERE id_contrato = '$id_contrato' 
			 	AND descripcion = '$descripcion' 
			 	LIMIT 1 ";
	$sql_ED_R = mysqli_query($dbd2, $sql_ED);
	$contador = mysqli_affected_rows($dbd2);
	$noHacer  = 0 ;		 
	if( $contador > 0 ){ $noHacer = 1 ;}
	// evitar duplicidad carga partida

	if( $noHacer == 0 )
	{
		$sql_ptds= "INSERT INTO `clbSubDiv2` 
					(`id_subDiv2`, `id_cliente`, `id_contrato`, 
					`concepto`, `descripcion`, nombre, domicilio, `capturo`, fechareg) 
					VALUES  
					(NULL, '$id_cliente', '$id_contrato', 
					'$descripcion', '$descripcion', '$nombre', '$domicilio', '$capturo', current_timestamp) ";
		$res_ptds = mysqli_query($dbd2, $sql_ptds);
	}
	if(@!$res_ptds)
	{
		echo $contador;
		echo $noHacer;
		$mensaje = ($contador > 0)?', AREA YA EXISTE :( ':'';
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n"; ##### ##### ##### ##### ##### #####
		echo "<br>HUBO UN ERROR, FAVOR DE ENVIAR CAPTURA DE PANTALLA A odesales@jetvan.com.mx<br> $mensaje" ;
	}
	else
	{
		echo "<br><h2>REGISTRO DE AREA ADMINISTRATIVA EXITOSO</h2><br>";
		echo "<br><a href='clienteCtoAAAlta.php?id_cliente=$id_cliente&id_contrato=$id_contrato' >Dar de alta otra Área<a>  ";
		include("clientoCtoAASD2Res.php");
	}
	$actualizado = 'si';
}


if ($actualizado == ''){
echo "<h2>ALTA DE AREA ADMINISTRATIVA PRIMERA DIVISION (SD2) </h2>";
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

			<td>DESCRIPCION</td>
			<td>
				<input type="text" name="descripcion" value="<?php //echo $cuenta; ?>"   size="100" maxlength="100" required  >
			</td>
		</tr>


		<tr>
			<td>NOMBRE</td>
			<td>
				<input type="text" name="nombre" value="<?php //echo $cuenta; ?>"   size="100" maxlength="100" required  >
			</td>
		</tr>
		<tr>
			<td>DOMICILIO</td>
			<td>
				<input type="text" name="domicilio" value="<?php //echo $cuenta; ?>"   size="100" maxlength="100" required  >
			</td>
		</tr>


		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Registrar NUEVA AREA ADMINISTRATIVA"></td>
		</tr>

	</table>
</form>
</fieldset>

<?php 
include("clientoCtoAASD2Res.php");


}
echo "<br>";

echo"
	<p>
	  <FORM action='clienteCtoAA.php' method='GET' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver a AREAS ADMINISTRATIVAS'>
	  </FORM>
	</p>";

echo"
	<p>
	  <FORM action='ctoIndex.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
	  </FORM>
	</p>";
//echo "<a href='clienteindexuno.php?id_cliente='$id_cliente'>Volver al contrato</a>";

if($_SESSION["clientes"] > 0  )
{
	echo"
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