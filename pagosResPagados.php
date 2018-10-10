<?php
include("1header.php");

if($_SESSION["mttoSolPag"] > 0){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 

include ("nav_pagos.php"); 

$id_usuario = $_SESSION["id_usuario"]; 

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 50; //RESULTADOS POR PAGINA

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

// INICIA DEFINIR QUERY PARA ALGORITMO DE PAGINACION
$cuenta_gps;
if($_SESSION["id_usuario"] == 458){ // SI ES JAZMIN
    $cuenta_gps         = " SELECT id_mttoSol FROM mttoSol WHERE autorizadoS = 1 AND  supPago = '456'  AND pagadoInfo = 1 ";
}
else{ // SI ES ROSA GALLEGOS O DULCE MARGARITA O MG BLANCO
    $cuenta_gps         = " SELECT id_mttoSol FROM mttoSol WHERE autorizadoS = 1 AND  supPago = '$id_usuario'  AND pagadoInfo = 1 ";
}
// TERMINA DEFINIR QUERY PARA ALGORITMO DE PAGINACION

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE SOLICITUDES PAGADAS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES</h3>";
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


?>
<section><fieldset><legend>RESUMEN DE SOLICITUDES PAGADAS</legend>
<?php

// INICIO QUERY A PRESENTAR
$sql_mttoSol = '';
if($_SESSION["id_usuario"] == 458){ // SI ES JAZMIN
            $sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE autorizadoS = 1 AND  supPago = '456' AND pagadoInfo = 1 "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}
else{ // SI ES ROSA GALLEGOS O DULCE MARGARITA 
        $sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE autorizadoS = 1 AND  supPago = '$id_usuario' AND pagadoInfo = 1 "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}
// TERMINA QUERY A PRESENTAR

// RESULTADOS
include('pagosResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
// RESULTADOS

echo "</form>";

#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo 	= 5;
$pagina_vista_inicio = $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if(($pagina_vista_inicio - $paginas_intervalo) > 0 )
	{
		$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
	}

$max_mostrar = $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
if(($pagina_vista_inicio + $paginas_intervalo) < $max_mostrar)
	{
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
//		echo "<a href='mttoSolRes.php?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
				echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

?>
</fieldset></section>

<?php } // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>