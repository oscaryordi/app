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

//$id_contrato = $_GET['id_contrato'];
contratoxid($id_contrato);
clientexid($id_cliente);

echo "<h2>CONTACTOS DEL CONTRATO</h2>";
echo "<h3>CLIENTE</h3>";
echo "<p>RFC  ::: $rfc, RAZON SOCIAL ::: $razonSocial, ALIAS_CTE ::: $alias</p>";
echo "<h3>CONTRATO</h3>";
echo "<p>ALAN ::: $id_alan, NUMERO ::: $numero,  ALIAS_CTO ::: $aliasCto</p> ";


########## ########## ######### ######### #########


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


///////////////
contratoContactos($id_contrato);
$sql_ctoContactoR; // viene de la funcion ejecutada
@$filas_ctoContactos 	= mysqli_num_rows($sql_ctoContactoR);

if($filas_ctoContactos==0){echo "NO HAY CONTACTOS REGISTRADOS";}

if($filas_ctoContactos > 0)
{
	echo "<section><p>CONTACTOS: <b>$filas_ctoContactos</b>"; 
	echo "<table class='ResTabla'>
		<tr>
			<th>id_contacto</th>
			<th>NOMBRE</th>
			<th>CORREO</th>
			<th>TELEFONO</th>
			<th>CARGO</th>
			<th>ROLL</th>
			<th>DIRECCION</th>
		</tr>";

	while($row = mysqli_fetch_assoc($sql_ctoContactoR))
	/////////////
		{
			$id_contacto 	= 	$row['id_contacto'];
			$nombre 		= 	$row['nombre']; // ID de ejecutivo asignado
			$correo			= 	$row['correo'];
			$cargo			= 	$row['cargo'];
			$telefono 		= 	$row['telefono'];
			$direccion		= 	$row['direccion'];
			$rollCargo 		= 	$row['rollCargo'];
			$r1 			= 	$row['r1'];
			$r2 			= 	$row['r2'];
			$r3 			= 	$row['r3'];

			echo "<tr>";

			echo "<td>{$id_contacto}</td>";

			echo "<td>{$nombre}</td>";
			echo "<td>{$correo}</td>";
			echo "<td>{$telefono}</td>";
			echo "<td>{$cargo}</td>";
			$r1t = ($r1 == 1)?' FACTURACION ':'';
			$r2t = ($r2 == 1)?' FLOTILLA ':'';
			$r3t = ($r3 == 1)?' CONTRATO ':'';
			echo "<td>{$rollCargo} $r1t $r2t $r3t</td>";
			echo "<td>{$direccion}</td>";
			echo "<td><a href='clienteCtoContactoEditar.php?id_contacto=$id_contacto&id_contrato=$id_contrato' >Editar</a></td>";

			//resetear variables
			$id_contacto 	= '';
			$nombre 		= '';
			$correo 		= '';
			$telefono 		= '';
			//resetear variables

			echo "</tr>";
		}
	echo "</table></section>"; // Cerrar tabla
}

########## ########## ######### ######### #########

} // CIERRE PRIVILEGIOS


echo"<br>
	<p>
	  <FORM action='ctoIndex.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
	  </FORM>
	</p>";

if($_SESSION["clientes"] > 0  )
{
	echo"<br>
		<p>
		  <FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CLIENTE'>
		  </FORM>
		</p>";
}

include ("1footer.php");
?>