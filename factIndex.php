<?php
include("1header.php");

if($_SESSION["facturacionV"] > 0)
{ // PRIVILEGIO VISTA FACTURACION 
	include ("nav_fact.php"); 

?>
<div style="padding:5px;">
	<p> BUSCAR FACTURA POR <b>FOLIO</b> 
	<form action='' method='post'>
		<input type='text' name='nombreO' placeholder='Indique Folio' title='Indique Folio' >
		<input type='submit' name='buscar' value='Buscar'  >
	</form>
	</p>
</div>
<?php


if( isset($_POST['nombreO']) &&  $_POST['nombreO'] != '')
	{
		$nombreO = mysqli_real_escape_string($dbd2, $_POST['nombreO']);
		echo $nombreO;

		$pagina 	= '';

		$sql_fact = 	  ' SELECT * '
			        	. ' FROM estimacionDocto '
			        	. " WHERE nombreO like '%$nombreO%' LIMIT 10 ";

		$id_usuario = $_SESSION["id_usuario"];

		include('factResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
	}


} // PRIVILEGIO VISTA FACTURACION
include("1footer.php");
?>