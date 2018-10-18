<?php
include("1header.php");
?>
<head>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
	integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<?php

if($_SESSION["callcenterH"] > 0 || $_SESSION["callcenterV"] > 0)
{ 
include ("nav_callcenter.php"); 

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 10; //RESULTADOS POR PAGINA 
//$rxpag = 10; //RESULTADOS POR PAGINA PARA PRUEBAS


if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
else{
		$pagina = 1;
	}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
		$pagina_1 = 0;
	}
else{
		$pagina_1 = ($pagina * $rxpag) - $rxpag;
	}

$cuenta_gps;
$cuenta_gps 		= " SELECT count(id_callcenter) suma FROM callcenter  ";
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$sacar_cuentaR		= mysqli_fetch_assoc($sacar_cuentagps);
$cuenta 			= $sacar_cuentaR['suma']	;
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE LLAMADAS RECIBIDAS EN EL CALL CENTER</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta LLAMADAS REGISTRADAS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

/*
$contador = 0;
for( $iconoMil = 1; $iconoMil <= ($cuenta); $iconoMil= $iconoMil+ 1000 ) 
{
	$contador 	+= 1;
	$fin 		= $contador * 1000;
	$inicio 	= $fin - 999;
	// BOTON DE DESCARGA

	// BOTON DE DESCARGA
}
*/

##### INICIAR ARRAY DE CONTRATOS
$contratosArray[] = '';
$clientesArray[] = '';
##### INICIAR ARRAY DE CONTRATOS

/*
$inicio 	= 1;
$fin 		= 500;
$contador 	= 1;
	echo "<p> 
		<a href='gpsresumen_GET.php?contador=$contador' 
		title='DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio AL $fin'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
		DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio A MAXIMO $fin INMEDIATOS ANTERIORES </a>
		</p>";
*/


// SI CONSULTA GERENTE
	$sql_call = 'SELECT * '
        . ' FROM callcenter '
        . ' ORDER BY '
        . ' id_callcenter '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;

include'callcenterResultSet.php';

/* // PARA CONTROLAR PRUEBAS
print_r($contratosArray) ;
echo "<br>";
echo "<br>";
var_dump($contratosArray) ;
echo "<br>";
echo "<br>";
*/


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
	


echo "<nav aria-label='Page navigation example'>
  		<ul class='pagination justify-content-center'>";

$color 	= ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
$active = '';
$item 	= 'item';
$span 	= "";

$anterior = $pagina - 1;
$siguiente = $anterior + 2;
$disabled = ( $pagina == 1 )?'disabled':'';
$disabledN = ( $pagina == $paginas_entero )?'disabled':'';
echo "	<li class='page-item $disabled'  >
      	<a class='page-link' href='?pagina=$anterior' >Previous</a>
    	</li>";
for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
	{
		if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
			{
				$color 	= 'red';
				$active = 'active';
				$item 	= 'link';
				$span = "<span class='sr-only'>(current)</span>";
			}
		else {$color=''; $active='';$item = 'item';$span = "";}
		echo "
			<li class='page-item $active'><a class='page-link' href='?pagina=$i'>$i</a></li>
			";
	}
echo "	<li class='page-item $disabledN'>
      	<a class='page-link' href='?pagina=$siguiente'>Next</a>
    	</li>";

echo " </ul>
	 </nav>";
// FIN ALGORITMO PAGINACION // 2da parte
#####



//<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
// <a href='?pagina=$i' >$i</a> 


/*
<nav aria-label="...">//
  <ul class="pagination">//
 
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>



    <li class='page-item'><a class='page-link' href='#'>1</a></li>
    <li class="page-item active">
      <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>

 
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
 
  </ul>
</nav>
*/








?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php 

} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>