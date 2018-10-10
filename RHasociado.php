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
					WHERE  externo = 2  ";
$cuentaR 		= mysqli_query($dbd2, $cuenta);
$row			= mysqli_fetch_array($cuentaR);
$cuenta 		= $row['cuenta'];
$paginas 		= $cuenta/$rxpag;
$paginas_entero = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";


echo "<h2>RESUMEN DE USUARIOS ASOCIADOS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta USUARIOS ASOCIADOS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION


	$sql_personal = 'SELECT * '
        . ' FROM usuarios '
        . " WHERE externo = 2 "       
        . ' ORDER BY '
        . ' paterno ASC, materno '
        . ' ASC '
        . " LIMIT $pagina_1, $rxpag " ;


include('RHResultSet.php');


#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo = 5;
$pagina_vista_inicio = $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if(($pagina_vista_inicio - $paginas_intervalo) > 0 ){
	$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
}

$max_mostrar = $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
if(($pagina_vista_inicio + $paginas_intervalo) < $max_mostrar){
	$max_mostrar = $pagina_vista_inicio + $paginas_intervalo;
}
	
$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
	{
		if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
			{
				$color = 'red';
			}
		else {$color='';}
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>