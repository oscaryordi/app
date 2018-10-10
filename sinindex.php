<?php 
include("1header.php");

if($_SESSION["siniestro"] > 0){ // VISTA A EJECUTIVOS
	include ("nav_sin.php");


	?>
	<div style="padding:5px;">
		<p> BUSCAR SINIESTRO POR <b>FOLIO EN EL SISTEMA (BD)</b>  
		<form action='' method='post'>
			<input type='text' name='id_siniestro' 
			placeholder='Indique Folio de Siniestro' 
			title='Indique Folio de Siniestro' >
			<input type='submit' name='buscar' value='Buscar'  >
		</form>
		</p>
	</div>
	<?php

	if( isset($_POST['id_siniestro']) &&  $_POST['id_siniestro'] != '')
	{
		$id_siniestro 	= mysqli_real_escape_string($dbd2, $_POST['id_siniestro']);
		echo $id_siniestro;

		$pagina 	= '';

		$sql_sin = 'SELECT * '
        . ' FROM siniestro '
        . " WHERE id_siniestro = '$id_siniestro' "
        . ' ORDER BY '
        . ' id_siniestro '
        . ' DESC ';
        //. " LIMIT $pagina_1, $rxpag " ;

		include('sinResultSet.php');
	}


	?>
	<div style="padding:5px;">
		<p> BUSCAR SINIESTRO POR <b>NUMERO DE SINIESTRO</b>  
		<form action='' method='post'>
			<input type='text' name='numSin' 
			placeholder='Indique Numero de Siniestro' 
			title='Indique Numero de Siniestro' >
			<input type='submit' name='buscar' value='Buscar'  >
		</form>
		</p>
	</div>
	<?php

	if( isset($_POST['numSin']) &&  $_POST['numSin'] != '')
	{
		$numSin 	= mysqli_real_escape_string($dbd2, $_POST['numSin']);
		echo $numSin;

		$pagina 	= '';

		$sql_sin = 'SELECT * '
        . ' FROM siniestro '
        . " WHERE numSin LIKE '%$numSin%' "
        . ' ORDER BY '
        . ' numSin '
        . ' DESC '
        . " LIMIT 5 " ;
 
		include('sinResultSet.php');

	}



} // FIN PRIVILEGIO VISTA EJECUTIVOS

include("1footer.php");?>