<?php 
include("1header.php");

if($_SESSION["movForaneo"] > 0){ // VISTA A LOGISTICA
	include ("nav_mov.php");


?>
<div style="padding:5px;">
	<p> BUSCAR TRASLADO POR <b>FOLIO</b> DEL INVENTARIO
	<form action='' method='post'>
		<input type='text' name='folio_inv' placeholder='Indique Folio de Inventario' title='Indique Folio de Inventario' >
		<input type='submit' name='buscar' value='Buscar'  >
	</form>
	</p>
</div>
<?php


if( isset($_POST['folio_inv']) &&  $_POST['folio_inv'] != '')
	{
		$folio_inv = mysqli_real_escape_string($dbd2, $_POST['folio_inv']);
		echo $folio_inv;

		$pagina 	= '';

		$sql_movFor = 	  ' SELECT * '
			        	. ' FROM mov_traslados '
			        	. " WHERE folio_inv = '$folio_inv' ";

		$id_usuario = $_SESSION["id_usuario"];

		include('movResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
	}


} //  VISTA LOGISTICA
include("1footer.php");?>