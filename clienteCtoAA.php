<?php
include '1header.php';
include ("nav_cliente.php");

$id_usuario 	= $_SESSION["id_usuario"];
$id_contrato 	= mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
$filtroFlotilla = $_SESSION["filtroFlotilla"];
tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla);

//echo "Lo tiene $tieneEsteContrato";

if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 )
{
	//echo "<h2>Aut Ok</h2>";
	echo "<br>";
	include('clienteCtoHeader.php');

	if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 ){ // APERTURA PRIVILEGIOS
		echo " <a href='clienteCtoAAAlta.php?id_contrato=$id_contrato'>
		<button>Nueva Área Administrativa</button></a>";
		} // CIERRE PRIVILEGIOS 

	include("clientoCtoAASD2Res.php");
}

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

include("1footer.php");?>