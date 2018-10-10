<?php
include("1header.php");
include ("nav_sust.php");

if($_SESSION["sustituto"] > 0)
{ //PRIVILEGIOS  VISTA
	?>
	<div style="padding:5px;">
		<p> BUSCAR SOLICITUD POR <b>FOLIO</b>  
		<form action='' method='post'>
			<input type='text' name='id_sust' 
			placeholder='Indique Folio' 
			title='Indique Folio' >
			<input type='submit' name='buscar' value='Buscar'  >
		</form>
		</p>
	</div>
	<?php

	if( isset($_POST['id_sust']) &&  $_POST['id_sust'] != '')
	{
		$id_sust 	= mysqli_real_escape_string($dbd2, $_POST['id_sust']);
		echo $id_sust;

		$pagina 	= '';

		$sql_sust = 'SELECT * '
        . ' FROM sustituto '
        . " WHERE id_sust = '$id_sust' "
        . ' ORDER BY '
        . ' id_sust '
        . ' DESC ';
        //. " LIMIT $pagina_1, $rxpag " ;

		include('autosustitutoResultSet.php');
	}
} // CIERRE PRIVILEGIOS VISTA
include("1footer.php");?>