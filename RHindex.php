<?php
include("1header.php");

if($_SESSION["rh"] > 0)
{ // VISTA A C4 
	include ("nav_RH.php"); 


?>
<div style="padding:5px;">
	<p> BUSCAR USUARIO POR <b>NOMBRE</b> 
	<form action='' method='post'>
		<input type='text' name='nombre' placeholder='Indique NOMBRE' title='Indique NOMBRE' >
		<input type='submit' name='buscar' value='Buscar'  >
	</form>
	</p>
</div>
<?php

if( isset($_POST['nombre']) &&  $_POST['nombre'] != '')
	{
		$nombre = mysqli_real_escape_string($dbd2, $_POST['nombre']);
		echo $nombre;

		$pagina 	= '';

		$sql_personal = 'SELECT * '
    				    . ' FROM usuarios '
				        . " WHERE nombre like '%$nombre%' "       
				        . ' ORDER BY '
				        . ' paterno ASC, materno '
				        . ' ASC ';
				       // . " LIMIT $pagina_1, $rxpag " ;
		include('RHResultSet.php');
	}
/**/

} // FIN PRIVILEGIO VISTA C4

include("1footer.php");
?>