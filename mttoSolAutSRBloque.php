<?php
include("1header.php");

// SOLICITUDES A REVISION
if($_SESSION["mttoSolAut"] > 0){ // PRIVILEGIO SUPERVISOR
	include ("nav_mtto.php"); 
	include ("nav_mtto_AUT.php"); 



$id_usuario = $_SESSION["id_usuario"]; 

// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 20; //RESULTADOS POR PAGINA // 5 PARA ENSAYOS

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
$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol  WHERE cancelado = 0  AND autorizadoS = 0 AND fechaEj >  '2017-02-06' ";	


$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE MANTENIMIENTO EN <span style='color: blue;' >REVISIÓN</span></h2>";
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



##### ##### ##### ##### INICIA  TRATAMIENTO DE FORMULARIO AUTORIZAR BLOQUE
if(isset($_POST['checkBoxArray'])){
   // echo "RECIBIENDO DATOS<br>";
    $capturo = $_SESSION["id_usuario"];
    $noHacer = 0;
    //echo $noHacer."= NO HACER";

    if($noHacer == 0)
    {
        foreach ($_POST['checkBoxArray'] as $key ) 
        {
            //echo $key.",<br>";
            
            $procede = 0; // SI PROCEDE EL REGISTRO INDIVIDUAL
       		// (1) CODIGO BORRAR - INICIA
            //VALIDAR NO ESTE CANCELADA
			$sqlCan 	= " SELECT cancelado, autorizadoS FROM mttoSol 
	 						WHERE id_mttoSol = '$key' WHERE cancelado =0 AND autorizadoS != 1 ";
			$sqlCanR 	= mysqli_query($dbd2, $sqlCan);
			$existe 	= mysqli_affected_rows($dbd2);
            //VALIDAR NO ESTE CANCELADA

            if($existe == 1){
                $procede = $procede +1;
                echo "ESTA CANCELADA: ".$key."<br>";
            }
            else{
                //echo "HACER";
            }
            //echo $procede; (1) CODIGO BORRAR - TERMINA
            
            $autorizadoS = $_POST['autorizadoS'];
            if($procede == 0)
            { 
			date_default_timezone_set('America/Mexico_city');
			$fechaAu = date("Y-m-d H:i:s");
            // REGISTRAR AUTORIZACION
		 		$sql_MUp = "UPDATE  mttoSol SET 
						fechaAu = '$fechaAu', 
						autorizo = '$capturo', 
						autorizadoS = '$autorizadoS' 
			 			WHERE id_mttoSol = '$key' "; 
				$R_MUp	= mysqli_query($dbd2, $sql_MUp );
				// REGISTRO OBSERVACIONES AUTORIZADO
				$sql_Mobs = "INSERT INTO mttoSolObs (`id_mttoSolOb`, `id_mttoSol`, `capturo`, `obsA`, `fechareg`, statusAu)
							VALUES 
							(NULL, '$key', '$capturo', 'DESDE FORMULARIO BLOQUE', '$fechaAu', '$autorizadoS')
							";
				$MobsR = mysqli_query($dbd2, $sql_Mobs); 
				// REGISTRO OBSERVACIONES AUTORIZADO
			// REGISTRAR AUTORIZACION

			// MENSAJE POR RESULTADO DE AUTORIZACION - INICIA	
                if(!$R_MUp)
                    {
                        echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR AUTORIZACION \n";
                    }
                else{
                		$accionAoR = ($autorizadoS == 1)? 'AUTORIZACION': 'RECHAZO';
                        echo "<h4>ACCION $accionAoR ,  REGISTRADO CORRECTAMENTE SOLICITUD:  $key </h4>";
                    }
            // MENSAJE POR RESULTADO DE AUTORIZACION - TERMINA        
            }
        }
    }
    else
    {
        echo "ALGUN ERROR / WITHOUT FLAG ... ";
    }
}
elseif( isset($_POST['AutorizarB']) && $_POST['checkBoxArray'] == NULL )
{
    echo "NO SELECCIONO SOLICITUDES :(";
}
##### ##### ##### #####	TERMINA TRATAMIENTO DE FORMULAIRO AUTORIZAR BLOQUE
 





echo "<section><fieldset><legend>RESUMEN DE MANTENIMIENTO</legend>";


$sql_mttoSol = '';

// autorizadoS 0 PENDIENTE DE REVISAR
// autorizadoS 6 REVISION OK
// SI CONSULTA SUPERVISOR
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE cancelado = 0 AND (autorizadoS = 0 OR autorizadoS = 6) AND fechaEj >  '2017-02-06' "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' ASC '
        . " LIMIT $pagina_1, $rxpag " ;


		include('mttoSolResultSetBloque.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN

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
	
echo "</fieldset></section>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>