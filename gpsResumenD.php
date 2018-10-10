<?php
include("1header.php");

if($_SESSION["gps"] > 0)
{ // VISTA A C4
include ("nav_gps.php");

$cuenta_gps;
$cuenta_gps 		= " SELECT id_gps FROM gpsAsignado  ";
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
//$paginas 			= $cuenta/$rxpag;
//$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";".$paginas_entero." PAGINAS,  
echo "<h2>RESUMEN DE EQUIPOS GPS ASIGNADOS</h2>";
echo "<h3>$cuenta EQUIPOS ASIGNADOS</h3>";
//echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

	$contador = 0;
	for( $iconoMil = 1; $iconoMil <= ($cuenta); $iconoMil= $iconoMil+ 500 ) 
	{
		$contador 	+= 1;
		$fin 		= $contador * 500;
		$inicio 	= $fin - 499;
		// BOTON DE DESCARGA
		echo "<p> 
			<a href='gpsresumen_GET.php?contador=$contador' 
			title='DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio AL $fin'>
			<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
			DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio A MAXIMO $fin ANTERIORES </a>
			</p>";
		// BOTON DE DESCARGA
	}
} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>