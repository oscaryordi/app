<?php
include("1header.php");

if($_SESSION["sustituto"] > 0){ //PRIVILEGIOS  VISTA A EJECUTIVOS DE CUENTA
	include ("nav_sust.php"); 
} // CIERRE PRIVILEGIOS

echo "</br></br>";

if($_SESSION["sustituto"] > 0){  // APERTURA PRIVILEGIOS

$capturo = $_SESSION["id_usuario"];

$rxpag = 15; //RESULTADOS POR PAGINA

if(isset($_GET['pagina'])){
	$pagina = $_GET['pagina'];
}
else{
	$pagina = "";
}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
	$pagina_1 = 0;
}
else{
	$pagina_1 = ($pagina * $rxpag) - $rxpag;
}

$cuenta_sustitutos;
// SI CONSULTA GERENTE
if($_SESSION["ejecutivo"] > 1 || $_SESSION["sustituto"] > 2 ){
	$cuenta_sustitutos = " SELECT * FROM sustituto  ";
}
// SI CONSULTA USUARIO NORMAL
else{
	$cuenta_sustitutos = " SELECT * FROM sustituto WHERE capturo = $capturo ";
}

$sacar_cuenta 	= mysqli_query($dbd2, $cuenta_sustitutos);
$cuenta 		= mysqli_num_rows($sacar_cuenta);
$paginas 		= $cuenta/$rxpag;
$paginas_entero = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";


echo "<h2>RESUMEN DE SOLICITUDES DE SUSTITUTO</h2>";
echo "<h3>$paginas_entero páginas,  $cuenta Solicitudes</h3>";
echo "<h3> VISUALIZANDO página <span style='color:red;'>".$pagina."</span>, $rxpag Resultados por página</h3><br>";

$sql_sust;

// SI CONSULTA GERENTE
if($_SESSION["ejecutivo"] > 1  || $_SESSION["sustituto"] > 2  )
{
	$sql_sust = 'SELECT * '
        . ' FROM sustituto '
        . ' ORDER BY '
        . ' id_sust '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}
// SI CONSULTA USUARIO NORMAL
else
{
	$sql_sust = 'SELECT * '
        . ' FROM sustituto '
        . " WHERE capturo = $capturo "		
        . ' ORDER BY '
        . ' id_sust '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}

include('1paginacion.php');
echo "<section><fieldset><legend>LISTADO DE SOLICITUDES AUTOS SUSTITUTO</legend>";

	include('autosustitutoResultSet.php');

echo "</fieldset></section>";
include('1paginacion.php');

} // CIERRE PRIVILEGIOS
include("1footer.php");?>