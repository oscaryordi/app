<?php
include("1header.php");

$id_usuario 	= $_SESSION["id_usuario"];
$id_contrato 	= mysqli_real_escape_string($dbd2, $_REQUEST['id_contrato']);
$filtroFlotilla = $_SESSION["filtroFlotilla"];
tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla);

@$id_subDiv2	= mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']); // Variable local?
if(!isset($id_subDiv2) OR $id_subDiv2 =='')
{
	$id_subDiv2 = mysqli_real_escape_string($dbd2, $_GET['id_subDiv2']);
}



if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 )
{
	echo "<h2>Aut Ok</h2>";

	include('clienteCtoHeader.php');

	$id_subDiv2 = mysqli_real_escape_string($dbd2, $_GET['id_subDiv2']); // variable local?
	descId_subDiv2($id_subDiv2);
	echo "<br><h3> AREA ADMINISTRATIVA : $subDiv2Desc </h3>";


	if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 ){ // APERTURA PRIVILEGIOS
		echo " <a href='clienteCtoAA_SD3_Alta.php?id_contrato=$id_contrato&id_subDiv2=$id_subDiv2'>
		<button>Nueva Subárea Administrativa</button></a>";
		} // CIERRE PRIVILEGIOS 

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

include("1footer.php");?>