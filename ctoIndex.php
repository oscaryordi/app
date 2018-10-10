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








if( $_SESSION["clientes"] > 0 OR $tieneEsteContrato == 1 )
{ // APERTURA PRIVILEGIOS
	include ("nav_cliente.php");
	echo "<br>";

	//$id_contrato = $_GET['id_contrato'];
	contratoxid($id_contrato);


	if($borrado == 0) // SI ESTA BORRADO NO SE PUEDE VISUALIZAR
	{
		clientexid($id_cliente);

		if($id_contrato != null && $id_contrato != '' &&  $id_contrato != '--')
		// NO NULO, NO VACIO, NO DEFAULT PERSIANA
		{
			include('clienteEncabezado.php');
			include("ctoResultSet.php");
			mysqli_close($dbd2);
		}
		else
		{
			echo "<br><h3>Contrato no está registrado</h3><br>";
		}
	}

} // CIERRE PRIVILEGIOS









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

include ("1footer.php");
?>