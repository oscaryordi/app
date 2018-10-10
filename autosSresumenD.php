<?php
include("1header.php");

if($_SESSION["sustituto"] > 2)
{ // SUPERVISOR LOGISTICA
include ("nav_sust.php");

$cuenta;
$cuenta 			= "SELECT COUNT(id_sust) cuenta FROM sustituto  ";
$sacar_cuenta 	 	= mysqli_query($dbd2, $cuenta);
$row_cuenta			= mysqli_fetch_array($sacar_cuenta);
$cuenta 			= $row_cuenta['cuenta'];

?>
<style>
.fa-download{color:gray;}
.fa-download:hover{ color:green;}
</style>
<?php 
echo "<h2>DESCARGAR RESUMEN DE SOLICITUDES DE SUSTITUTO</h2>";
echo "<h3>$cuenta REGISTROS</h3>";

	$contador = 0;
	for( $iconoMil = 1; $iconoMil <= ($cuenta); $iconoMil= $iconoMil+ 1000 ) 
	{
		$contador 	+= 1;
		$fin 		= $contador * 1000;
		$inicio 	= $fin - 999;
		// BOTON DE DESCARGA
		echo "<p> 
			<a href='autoSresumenD_GET.php?contador=$contador' 
			title='DESCARGAR SOLICITUDES DE SUSTITUTO DEL $inicio AL $fin'>
			<i class='fas fa-download'   style='font-size:16px;' ></i>

			DESCARGAR SOLICITUDES DE SUSTITUTO MAS RECIENTES DEL $inicio A MAXIMO $fin </a>
			</p>";
		// BOTON DE DESCARGA
	}
} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>