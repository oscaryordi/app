<?php
include("1header.php");

if($_SESSION["superLog"] > 0){ // SUPERVISOR LOGISTICA
include ("nav_logistica.php");


$cuenta;
$cuenta 			= "SELECT COUNT(id_formato) cuenta FROM formato_inventario  ";
$sacar_cuenta 	 	= mysqli_query($dbd2, $cuenta);
$row_cuenta			= mysqli_fetch_array($sacar_cuenta);
$cuenta 			= $row_cuenta['cuenta'];

echo "<h2>BITACORA DE ENTRADAS Y SALIDAS A PATIOS DE JET VAN</h2>";
echo "<h3>$cuenta REGISTROS</h3>";


$contador = 0;
for( $iconoMil = 1; $iconoMil <= ($cuenta); $iconoMil= $iconoMil+ 1000 ) 
{
	$contador 	+= 1;
	$fin 		= $contador * 1000;
	$inicio 	= $fin - 999;
	// BOTON DE DESCARGA
	echo "<p> 
		<a href='logESres_GET.php?contador=$contador' 
		title='DESCARGAR BITACORA DEL $inicio AL $fin'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR BITACORA'>
		DESCARGAR BITACORA MAS RECIENTES DEL $inicio A MAXIMO $fin </a>
		</p>";
	// BOTON DE DESCARGA
}

} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>