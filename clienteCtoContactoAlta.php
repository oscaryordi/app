<?php 
include("1header.php");
echo "<meta charset='utf-8'>";

$id_usuario 		= $_SESSION['id_usuario'];
if(@$_GET['id_contrato']){
$id_contrato 		= $_GET['id_contrato'];}
if(@$_POST['id_contrato']){
$id_contrato 		= $_POST['id_contrato'];}
$filtroFlotilla 	= $_SESSION['filtroFlotilla'];

// PARA QUE VEA SOLO EJECUTIVO AUTORIZADO
tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla);


if($_SESSION["clientes"] > 0 OR $tieneEsteContrato == 1 )
{ // APERTURA PRIVILEGIOS

include ("nav_cliente.php");

//$id_contrato = $_POST['id_contrato'];
contratoxid($id_contrato);
clientexid($id_cliente);

echo "<h2>CONTACTOS DEL CONTRATO</h2>";
echo "<h3>CLIENTE</h3>";
echo "<p>RFC  ::: $rfc, RAZON SOCIAL ::: $razonSocial, ALIAS_CTE ::: $alias</p>";
echo "<h3>CONTRATO</h3>";
echo "<p>ALAN ::: $id_alan, NUMERO ::: $numero,  ALIAS_CTO ::: $aliasCto</p> ";


echo "<br>";
if($_SESSION["clientes"] > 1 OR $tieneEsteContrato == 1 ){ // APERTURA PRIVILEGIOS	
	echo 	"<p>
		   	<FORM action='clienteCtoContactoAlta.php' method='POST' id='entabla'>
		   		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
				<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
				<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='CREAR NUEVO CONTACTO'>
			</FORM>
	  		</p>";
		} // CIERRE PRIVILEGIOS
echo "<br>";

$creado = ''; //FLAG

if( isset($_POST['guardar']) )
{
	$noprocede = 0;

	if(1!=1){$noprocede +=1;}

	if($noprocede == 0)
	{
		$id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato']);
		$id_cliente 	= mysqli_real_escape_string($dbd2, $_POST['id_cliente']);
		$nombre 		= mysqli_real_escape_string($dbd2, $_POST['nombre']);
		$correo 		= mysqli_real_escape_string($dbd2, $_POST['correo']);
		$cargo 			= mysqli_real_escape_string($dbd2, $_POST['cargo']);	
		$telefono 		= mysqli_real_escape_string($dbd2, $_POST['telefono']);
		$direccion 		= mysqli_real_escape_string($dbd2, $_POST['direccion']);
		@$r1 			= mysqli_real_escape_string($dbd2, $_POST['r1']);
		@$r2 			= mysqli_real_escape_string($dbd2, $_POST['r2']);
		@$r3 			= mysqli_real_escape_string($dbd2, $_POST['r3']);

		$capturo 		= $_SESSION['id_usuario'];

		date_default_timezone_set('America/Mexico_city');
		$sql_CnctA = "INSERT INTO clgContacto 
					(`id_contacto`, `id_cliente`, `id_contrato`, 
					`nombre`, `correo`, cargo, `telefono`, `direccion`, 
					`r1`, `r2`, `r3`, 
					`capturo`, `fechareg`) 
					VALUES 
					(NULL, '$id_cliente', '$id_contrato', 
					'$nombre', '$correo', '$cargo', '$telefono', '$direccion', 
					'$r1','$r2', '$r3',
					'$capturo', CURRENT_TIMESTAMP
					)";
		$sql_CnctA_R = mysqli_query($dbd2, $sql_CnctA);
		if($sql_CnctA_R)
		{
			echo "ALTA DE NUEVO CONTACTO REGISTRADO CORRECTAMENTE";
			$creado = 'ok';
		}
	}
}


if($creado == '')
{ // MOSTRAR FORMULARIO
?>

<fieldset>
<form acion='' method='POST'>
<H3>FORMULARIO CREAR CONTACTO</H3>
<input type='hidden' name='id_contrato'  value=<?php echo $id_contrato;?>>
<input type='hidden' name='id_cliente'   value=<?php echo $id_cliente;?>>
<table>
	<tr><th>Roll</th>
		<td>
		<input type="checkbox" id="r1" name="r1" value="1" >
		<label for = "r1" >FACTURACION</label>
		<input type="checkbox" id="r2" name="r2" value="1" >
		<label for = "r2" >FLOTILLA</label>
		<input type="checkbox" id="r3" name="r3" value="1" >
		<label for = "r3" >CONTRATO</label>			
		</td>
	</tr>
	<tr><th>Nombre</th>
		<td><input type='text' name='nombre' required >	</td>
	</tr>
	<tr><th>Correo</th>
		<td><input type='text' name='correo' required ></td>
	</tr>
	<tr><th>Puesto/Cargo</th>
		<td><input type='text' name='cargo' ></td>
	</tr>
	<tr><th>Telefono</th>
		<td><input type='text' name='telefono'  ></td>
	</tr>
	<tr><th>Direccion</th>
		<td><input type='text' name='direccion' ></td>
	</tr>
	<tr><td colspan='2'><input type='submit' name='guardar' value='GUARDAR' >
	</td>
	</tr>
</table>
</form>
</fieldset>

<?php
} // MOSTRAR FORMULARIO

} // CIERRE PRIVILEGIOS


echo "<a href='clienteCtoContacto.php?id_contrato=$id_contrato'>Volver a listado de Contactos</a>";

// VOLVER
echo"
	<p>
	  <FORM action='ctoIndex.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
	  </FORM>
	</p>";
if($_SESSION["clientes"] > 0  )
{
	echo"
		<p>
		  <FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CLIENTE'>
		  </FORM>
		</p>";
}
// VOLVER

include ("1footer.php");
?>