<?php 
include("1header.php");


if($_SESSION["movForaneo"] > 0){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 
include ("nav_mov.php");

$id_usuario = $_SESSION["id_usuario"]; 

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 10; //RESULTADOS POR PAGINA

if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}
else
{
	$pagina = "1";
}

if($pagina == "" || $pagina == 1)
{ // AQUI SE CHECA SI TIENE DATO O NO
	$pagina_1 = 0;
}
else
{
	$pagina_1 = ($pagina * $rxpag) - $rxpag;
}

$cuenta_gps;

if($_SESSION["movForaneo"] == 0)
{
$cuenta_gps 		= " SELECT COUNT(id_movFor) cuenta FROM mov_traslados WHERE capturo = '$id_usuario' AND borrar = 0";
}

if($_SESSION["movForaneo"] > 0)
{
$cuenta_gps 		= " SELECT COUNT(id_movFor) cuenta FROM mov_traslados WHERE borrar = 0 ";	
}

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuentaM			= mysqli_fetch_assoc($sacar_cuentagps);
$cuenta 			= $cuentaM['cuenta'];

$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE TRASLADOS REGISTRADOS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta TRASLADOS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4>";
echo "Página $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION

/*
// BOTON DE DESCARGA
echo "<p> 
	<a href='mttoSolRes_GET.php?id_usuario=$id_usuario&pagina=$pagina' 
	title='DESCARGAR RESUMEN MANTENIMIENTO'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR FLOTILLA'>
	</a>
	</p>";
// BOTON DE DESCARGA
*/

$sql_movFor = '';

if($_SESSION["movForaneo"] == 0){
// SI CONSULTA EJECUTIVO
	$sql_movFor = 'SELECT * '
		. ' FROM mov_traslados '
		. "  WHERE capturo = '$id_usuario' AND borrar = 0 "
		. ' ORDER BY '
		. ' id_movFor '
		. ' DESC '
		. " LIMIT $pagina_1, $rxpag " ;
}

if($_SESSION["movForaneo"] > 0){
// SI CONSULTA SUPERVISOR
	$sql_movFor = 'SELECT * '
		. ' FROM mov_traslados WHERE borrar = 0 '
 //	   . "  WHERE capturo = '$id_usuario' "
		. ' ORDER BY '
		. ' id_movFor '
		. ' DESC '
		. " LIMIT $pagina_1, $rxpag " ;
}


include('movResultSet.php');


} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>