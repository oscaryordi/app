<?php
include("1header.php");

if($_SESSION["mttoSolPag"] > 0){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 
include ("nav_pagos.php"); 

// INICIA FECHA Y HORA PARA LIMITAR LO QUE VISUALIZA TESORERIA
date_default_timezone_set('America/Mexico_city');
$hoy    = date("Y-m-d ");
$corte  = $hoy."13:01:00";
// TERMINA FECHA Y HORA PARA LIMITAR LO QUE VISUALIZA TESORERIA

$id_usuario = $_SESSION["id_usuario"]; 


// INICIA TRATAMIENTO DE FORMULARIO BLOQUE
	// FECHA Y HORA DE CIUDAD DE MEXICO
	date_default_timezone_set('America/Mexico_city');
	$fechaPg = date("Y-m-d H:i:s");
 
if(isset($_POST['checkBoxArray'])){

   // echo "RECIBIENDO DATOS<br>";
    $capturo = $_SESSION["id_usuario"];
   	$noHacer = 0;

    if($noHacer == 0)
    {
        foreach ($_POST['checkBoxArray'] as $key ) 
        {
                $sql_progPago 	= " UPDATE mttoSol SET programadoPago = 1, fechaPg = '$fechaPg' WHERE id_mttoSol = '$key'  " ;

                // INICIA EVITAR REFRESH
                    $sql_progPago_Refresh = " SELECT programadoPago FROM mttoSol WHERE id_mttoSol = '$key' AND  programadoPago = 1 ";
                    $sql_progPago_Refresh_R = mysqli_query($dbd2, $sql_progPago_Refresh);
                    $repetido = mysqli_affected_rows($dbd2);
                    if($repetido == 1){}else
                    {
                // TERMINA EVITAR REFRESH
                    $sql_progPago_R = mysqli_query($dbd2, $sql_progPago);
                    if(!$sql_progPago_R)
                        {
                            echo mysqli_errno($ddbd2) . ": " . mysqli_error($dbd2). " FALLO AL PROGRAMAR PAGO \n";
                        }
                    else{
                            $id_mttoSol = $key; 
                            echo "<h4>PROGRAMADO $id_mttoSol </h4>";
                            $id_mttoSol = '';
                        }
                    }
        }
    }
}
elseif( isset($_POST['ProgramarPB']) && $_POST['checkBoxArray'] == NULL )
{
    echo "NO SELECCIONO SOLICITUDES :(";
}


       echo "<form action='pagosResTodo.php' method='post'>";
             ?>
                <div style='padding:5px;'>
                <input type='submit'  name='ProgramarPB'  value="Programar Pago Bloque" >
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

// INICIA REACTIVAR VISUALIZACION DESPUES CORTE
$corteExtendido = $hoy."15:30:00";
if($_SESSION["id_usuario"] == 121 ){$corteExtendido = $hoy."13:02:00";}
$ahora          = date("Y-m-d H:i:s");
if( $ahora > $corteExtendido ){ 
    $corte = $hoy."23:59:59"    ;
}
// TERMINA REACTIVAR VISUALIZACION DESPUES CORTE

// INICIA DEFINIR QUERY PARA ALGORITMO DE PAGINACION
$cuenta_gps;
if($_SESSION["id_usuario"] == 458){ // SI ES JAZMIN
    $cuenta_gps        = " SELECT COUNT(id_mttoSol) cuenta, SUM(importe) as total FROM mttoSol WHERE autorizadoS = 1 AND  supPago = '456' AND programadoPago = 0 AND fechaAu < '$corte' ";
}
else{ // SI ES ROSA GALLEGOS O DULCE MARGARITA 
    $cuenta_gps        = " SELECT COUNT(id_mttoSol) cuenta, SUM(importe) as total FROM mttoSol WHERE autorizadoS = 1 AND  supPago = '$id_usuario' AND programadoPago = 0  AND fechaAu < '$corte' ";
}
// TERMINA DEFINIR QUERY PARA ALGORITMO DE PAGINACION

$sacar_cuentagps    = mysqli_query($dbd2, $cuenta_gps);
$cuentaArray        = mysqli_fetch_array($sacar_cuentagps);
$cuenta             = $cuentaArray['cuenta'];
$importe            = $cuentaArray['total'];
$paginas            = $cuenta/$rxpag;
$paginas_entero     = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE SOLICITUDES CON <span style='color:#406299;'>Vo.Bo.</span></h2>";
echo "".$paginas_entero." PAGINAS,  
        <span style='color:#406299; font-size:1.5em;'>$cuenta </span> SOLICITUDES, 
        <span style='color:#406299; font-size:1.5em;'>$ ".number_format($importe,2)."</span> 
        IMPORTE TOTAL DE SOLICITUDES CON VO.BO.<br>";
echo "".$rxpag." Resultados por página, ";
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



// INICIO QUERY A PRESENTAR
$sql_mttoSol = '';
if($_SESSION["id_usuario"] == 458){ // SI ES JAZMIN
        $sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE autorizadoS = 1 AND  supPago = '456'  AND programadoPago = 0  AND fechaAu < '$corte'  "
        . ' ORDER BY '
        . ' fechaAu '
        . ' ASC '
        . " LIMIT $pagina_1, $rxpag " ;
}
else{ // SI ES ROSA GALLEGOS O DULCE MARGARITA 
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE autorizadoS = 1 AND  supPago = '$id_usuario'  AND programadoPago = 0  AND fechaAu < '$corte'  "
        . ' ORDER BY '
        . ' fechaAu '
        . ' ASC '
        . " LIMIT $pagina_1, $rxpag " ;
}
// TERMINA QUERY A PRESENTAR



echo "<section><fieldset><legend>RESUMEN DE SOLICITUDES CON VO.BO.</legend>";
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


echo "</fieldset></section>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>