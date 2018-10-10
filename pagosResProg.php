<?php
include("1header.php");
if($_SESSION["mttoSolPag"] > 0){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 

include ("nav_pagos.php"); 

$id_usuario = $_SESSION["id_usuario"]; 

// INICIA TRATAMIENTO DE FORMULARIO BLOQUE

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');
$fechaPg = date("Y-m-d H:i:s");
 
if(isset($_POST['checkBoxArray']))
{
// echo "RECIBIENDO DATOS<br>";
	$capturo = $_SESSION["id_usuario"];
	$noHacer = 0;

	if($noHacer == 0)
	{
		foreach ($_POST['checkBoxArray'] as $key ) 
		{
			$sql_pagoInfo 	= " UPDATE mttoSol SET pagadoInfo = 1  WHERE id_mttoSol = '$key'  " ;
			// INICIA EVITAR REFRESH
			// TERMINA EVITAR REFRESH
			$sql_pagoInfo_R = mysqli_query($dbd2, $sql_pagoInfo);

			if(!$sql_pagoInfo_R)
				{
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL PROGRAMAR PAGO \n";
				}
			else{
					$id_mttoSol = $key; 
					echo "<h4>STATUS PAGADO $id_mttoSol </h4>";
					$id_mttoSol = '';
				}
		}
	}
}
elseif( isset($_POST['PagadoInfoB']) && $_POST['checkBoxArray'] == NULL )
{
	echo "NO SELECCIONO SOLICITUDES :(";
}

/**/
	// INICIA FORMULARIO PARA ACTUALIZAR ESTADO DE SOLICITUDES BLOQUE BULK
   echo "<form action='' method='post'>";
	 ?>
		<div style='padding:5px;'>
		<input type='submit'  name='PagadoInfoB'  value="Marcar Pagado Bloque" >
		</div>
	<?php

// TERMINA TRATAMIENTO FORMULARIO BLOQUE


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
	$cuenta_gps		 = " SELECT  COUNT(id_mttoSol) cuenta, SUM(importe) as total  FROM mttoSol WHERE autorizadoS = 1 AND  supPago = '456' AND programadoPago = 1 AND pagadoInfo = 0";
}
else{ // SI ES ROSA GALLEGOS O DULCE MARGARITA 
	$cuenta_gps		 = " SELECT  COUNT(id_mttoSol) cuenta, SUM(importe) as total  FROM mttoSol WHERE autorizadoS = 1 AND  supPago = '$id_usuario' AND programadoPago = 1 AND pagadoInfo = 0";
}
// TERMINA DEFINIR QUERY PARA ALGORITMO DE PAGINACION

$sacar_cuentagps	= mysqli_query($dbd2, $cuenta_gps);

$cuentaArray		= mysqli_fetch_array($sacar_cuentagps);
$cuenta			 = $cuentaArray['cuenta'];
$importe			= $cuentaArray['total'];
$paginas			= $cuenta/$rxpag;
$paginas_entero	 = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE SOLICITUDES <span style='color:green;'>PROGRAMADAS</span></h2>";
echo "".$paginas_entero." PAGINAS, 
		<span style='color:green; font-size:1.5em;'> $cuenta</span> SOLICITUDES, 
		<span style='color:green; font-size:1.5em;'> $ ".number_format($importe,2)."</span> 
		IMPORTE TOTAL DE SOLICITUDES PROGRAMADAS<br>";
echo "".$rxpag." Resultados por página, ";
echo "Página $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION

/**/
// BOTON DE DESCARGA
echo "<p>  
	<a style='color:green; text-decoration:none;' 
	 href='pagosResProg_GET.php?id_usuario=$id_usuario&pagina=$pagina' 
	title='DESCARGAR SOLICITUDES PROGRAMADAS'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR LISTADO DE PROGRAMADOS PARA PAGO'>
	DESCARGAR LISTADO DE SOLICITUDES PROGRAMADAS PARA PAGO
	</a>
	</p>";
// BOTON DE DESCARGA

?>
<section><fieldset><legend>RESUMEN DE SOLICITUDES <span style='color:green;'>PROGRAMADAS</span></legend>
<?php

// INICIO QUERY A PRESENTAR
$sql_mttoSol = '';
if($_SESSION["id_usuario"] == 458){ // SI ES JAZMIN
			$sql_mttoSol = 'SELECT * '
		. ' FROM mttoSol '
		. "  WHERE autorizadoS = 1 AND  supPago = '456'  AND programadoPago = 1  AND pagadoInfo = 0 "
		. ' ORDER BY '
		. ' id_mttoSol '
		. ' ASC '
		. " LIMIT $pagina_1, $rxpag " ;
}
else{ // SI ES ROSA GALLEGOS O DULCE MARGARITA 
		$sql_mttoSol = 'SELECT * '
		. ' FROM mttoSol '
		. "  WHERE autorizadoS = 1 AND  supPago = '$id_usuario'  AND programadoPago = 1  AND pagadoInfo = 0 "
		. ' ORDER BY '
		. ' id_mttoSol '
		. ' ASC '
		. " LIMIT $pagina_1, $rxpag " ;
}
// TERMINA QUERY A PRESENTAR


// RESULTADOS
include('pagosResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
// RESULTADOS

		echo "</form>";
	// TERMINA FORMULARIO PARA ACTUALIZAR ESTADO DE SOLICITUDES BLOQUE BULK



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

echo "</fieldset></section>";
} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>