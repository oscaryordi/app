<?php
include("1header.php");

if($_SESSION["siniestro"] > 1){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 
include ("nav_sin.php"); 

$id_usuario = $_SESSION["id_usuario"]; 

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 15; //RESULTADOS POR PAGINA // para diseño
//$rxpag = 50; //RESULTADOS POR PAGINA

if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
else{
		$pagina = "1";
	}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
		$pagina_1 = 0;
	}
else{
		$pagina_1 = ($pagina * $rxpag) - $rxpag;
	}

$cuenta_gps;

// VISTA EJECUTIVO
if($_SESSION["siniestro"] == 0){
$cuenta_gps 		= " SELECT 
						`id_siniestro`, `cdSin`, `motivo`, 
						`fechaSin`, `numSin`, `status` 
						FROM `siniestro`  ";
}

// VISTA SUPERVISOR
if($_SESSION["siniestro"] > 0){
$cuenta_gps 		= " SELECT 
						`id_siniestro`, `cdSin`, `motivo`, 
						`fechaSin`, `numSin`, `status` 
						FROM `siniestro` ";	
}

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE SINIESTROS, CORRALONES E INCIDENCIAS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta REGISTROS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4>";
echo "Página $pagina";
echo "<h4 style='color:red;'>PARA VER EL DETALLE DEL SINIESTRO, DEBE HACER CLICK SOBRE EL FOLIO DEL MISMO (IDBD SINIESTRO, PRIMER COLUMNA)</h4>";
// FIN FASE 1 ALGORITMO DE PAGINACION


?>
<style>
.fa-download{color:gray;}
.fa-download:hover{ color:green;}
</style>
<?php 
/**/
// BOTON DE DESCARGA
echo "<p> 
	<a href='sinRes_GET.php'  
	title='DESCARGAR RESUMEN DE SINIESTROS'>
	<i class='fas fa-download'   style='font-size:16px;' ></i>
	DESCARGAR RESUMEN DE SINIESTROS
	</a>
	</p>";
// BOTON DE DESCARGA



$sql_sin = '';

// SI CONSULTA EJECUTIVO
if($_SESSION["siniestro"] == 0){
	$sql_sin = 'SELECT `id_unidad`, id_siniestro, `cdSin`, 
					`motivo`, `fechaSin`, `numSin`, `status`, id_cliente  
					FROM `siniestro` '
//				. "  WHERE capturo = '$id_usuario' "
				. ' ORDER BY '
				. ' id_siniestro '
				. ' DESC '
				. " LIMIT $pagina_1, $rxpag " ;
}

// SI CONSULTA SUPERVISOR
if($_SESSION["siniestro"] > 0){

	$sql_sin = 'SELECT `id_unidad`, id_siniestro, `cdSin`, 
					`motivo`, `fechaSin`, `numSin`, `status`, id_cliente  
					FROM `siniestro` '
//				. "  WHERE capturo = '$id_usuario' "
				. ' ORDER BY '
				. ' id_siniestro '
				. ' DESC '
				. " LIMIT $pagina_1, $rxpag " ;
}


include'sinResultSet.php';

#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo 	= 5;
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

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>