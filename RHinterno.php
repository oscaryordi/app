<?php
include("1header.php");

if($_SESSION["rh"] > 0){ // 
include("nav_RH.php");

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 25; //RESULTADOS POR PAGINA 
//$rxpag = 10; //RESULTADOS POR PAGINA PARA PRUEBAS


if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}
else
{
	$pagina = "";
}

if($pagina == "" || $pagina == 1)
{ // AQUI SE CHECA SI TIENE DATO O NO
	$pagina_1 = 0;
}
else
{
	$pagina_1 = ($pagina * $rxpag) - $rxpag;
}

$cuenta;
$cuenta 		= " SELECT COUNT(id_usuario) cuenta FROM usuarios   
					WHERE  externo = 0  ";
$cuentaR 		= mysqli_query($dbd2, $cuenta);
$row			= mysqli_fetch_array($cuentaR);
$cuenta 		= $row['cuenta'];
$paginas 		= $cuenta/$rxpag;
$paginas_entero = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";

include('1paginacion.php');


echo "<h2>RESUMEN DE USUARIOS INTERNOS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta USUARIOS INTERNOS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION


	$sql_personal = 'SELECT * '
        . ' FROM usuarios '
        . " WHERE externo = 0 "       
        . ' ORDER BY '
        . ' suspendido ASC,  '
        . ' paterno ASC,  '
        . ' materno ASC  '
        
        . " LIMIT $pagina_1, $rxpag " ;


include('RHResultSet.php');

include('1paginacion.php');

} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>