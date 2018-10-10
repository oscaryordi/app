<?php
include("1header.php");

if($_SESSION["mttoSolAut"] > 0)
{ // INICIA PRIVILEGIO SUPERVISOR
	include ("nav_mtto.php"); 
	include ("nav_mtto_AUT.php"); 
	$id_usuario = $_SESSION["id_usuario"]; 

	?>
	<div style="padding:5px;">
		<p> BUSCAR SOLICITUD
		<form action='' method='post'>
			<input type='text' name='id_mttoSol' placeholder='Indique Folio de Solicitud' title='Indique Folio de Solicitud' >
			<input type='submit' name='buscar' value='Buscar'  >
		</form>
		</p>
	</div>
	<?php

	if(isset($_POST['id_mttoSol']) &&  $_POST['id_mttoSol'] != '' )
	{

		$id_mttoSol = mysqli_real_escape_string($dbd2, $_POST['id_mttoSol']);

		echo $id_mttoSol;

		$pagina 	 = '';
		$sql_mttoSol = '';

		$sql_mttoSol = 	' SELECT * '
				        . ' FROM mttoSol '
				        . " WHERE id_mttoSol = '$id_mttoSol'   " ;

		if($_SESSION["mttoSol"] < 3)
		{
		// SI CONSULTA EJECUTIVO
			$sql_mttoSol .= " AND capturo = '$id_usuario' ";
		}
		include('mttoSolResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
	}
} // TERMINA PRIVILEGIO SUPERVISOR
include("1footer.php");?>