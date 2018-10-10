<?php
include("1header.php");
// solAtnRPropias.php
if($_SESSION["solAtn"] > 0){ // VISTA A C4
include("nav_solAtn.php");

$id_usuario = $_SESSION["id_usuario"];

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 25 ;//RESULTADOS POR PAGINA 
//$rxpag = 10; //RESULTADOS POR PAGINA PARA PRUEBAS

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

$cuentaEventos;
$cuentaEventos 		= "SELECT COUNT(id_solAtn) cuenta FROM solAtn  WHERE capturoPg = '$id_usuario' ";
$sacar_ctaPag 		= mysqli_query($dbd2, $cuentaEventos);
$sacar_ctaPagMatriz	= mysqli_fetch_array($sacar_ctaPag);
$cuenta 			= $sacar_ctaPagMatriz['cuenta'];
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);

echo "<h2>SOLICITUDES PROPIAS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

#####
include('1paginacion.php');
#####

// CONSULTA
if($_SESSION["solAtn"] > 0)
{
	$sql_SA =   ' SELECT * '
				. ' FROM solAtn '
				. " WHERE capturoPg = '$id_usuario' "
				. " ORDER BY fechareg ASC LIMIT  $pagina_1, $rxpag ";
	$sql_SA_R 	= mysqli_query($dbd2,$sql_SA);
	@$camposuh  = mysqli_num_fields($sql_SA_R);
	@$filasuh   = mysqli_num_rows($sql_SA_R);

	// tabulacion resultados
	include ('solAtnResultSet.php');
	// tabulacion resultados
}// CONSULTA


#####
include('1paginacion.php');
#####

} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>