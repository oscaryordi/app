<?php
include("1header.php");

if($_SESSION["solAtn"] > 0)
{ // PRIVILEGIO VISTA
	include ("nav_solAtn.php");
	/**/
	?>
	<div style="padding:5px;">
		<p> BUSCAR SOLICITUD POR <b>PLACAS</b> (NUMERO DE PLACAS) 
		<form action='' method='post'>
			<input type='text' name='placas' placeholder='Indique PLACAS' title='Indique Número de Placas' >
			<input type='submit' name='buscar' value='Buscar'  >
		</form>
		</p>
	</div>
	<?php

	if( isset($_POST['placas']) &&  $_POST['placas'] != '')
	{
		$placas = mysqli_real_escape_string($dbd2,  $_POST['placas']);
		echo $placas;

		$pagina 	= '';

		idxplaca($placas);

		include("u16solAtn.php");
	}
} // FIN PRIVILEGIO VISTA

include("1footer.php");
?>