<?php
include("1header.php");

if($_SESSION["mttoSol"] > 1  && $_SESSION["filtroFlotilla"] < 2 ){ 
// PRIVILEGIO VISTA EJECUTIVO QUE tiene asignado el contrato con Filtro 1 y mtto 2 

include ("nav_mtto.php"); 

$id_usuario = $_SESSION["id_usuario"]; 

########## ########## ########## #########
?>
	<!--<script src="js/jquery-1.11.2.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!--<script src="js/jquery-ui.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<script> 
	$.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'dd/mm/yy',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);

	$(function() {
		$( "#fechainicio" ).datepicker({changeYear: true, changeMonth: true});
	});

	$(function() {
		$( "#fechafinal" ).datepicker({changeYear: true, changeMonth: true});
	});
	</script>

<p>
<h3>MANTENIMIENTO: Consultar periodo:</h3>
<form action='' method='GET' >
<!-- -->
Fecha Inicio->
<input type='text' id='fechainicio' name='fechainicio' placeholder='dd/mm/aaaa' />
Fecha Final->
<input type='text' id='fechafinal' name='fechafinal' placeholder='dd/mm/aaaa' />

<!--
Resultados por pagina->
<select name='cuantosR' >
<option>50</option>
<option>100</option>
<option>300</option>
</select>
-->
<input type='submit' name='consultar' value='consultar'>

</form>
<p/>
<?php 

$fechainicio 	= @$_GET['fechainicio'];
$fechafinal 	= @$_GET['fechafinal'];
//$cuantosR 		= @$_GET['cuantosR'];
$periodoDefinido = '';
// TERMINA  FORMULARIO PARA FILTRAR PROYECTO ORIGEN DESTINO
#####
$consultar = '';

if(isset($_GET['consultar']) && $_GET['consultar'] != '' ){// INICIA PROCESO DE FORMULARIO 
	$consultar = $_GET['consultar'];
// VALIDA FORMATO DE FECHA
   function validateDate($date, $format = 'Y-m-d H:i:s')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

    if( validateDate($fechainicio, 'Y-m-d') == true )
        { ;}
    else
        { 
        	$date = str_replace('/', '-', $fechainicio);
			$fechainicio = date('Y-m-d', strtotime($date));
        }

    if( validateDate($fechafinal, 'Y-m-d') == true )
        { ;}
    else
        { 
        	$date = str_replace('/', '-', $fechafinal);
			$fechafinal = date('Y-m-d', strtotime($date));
        }
// VALIDA FORMATO DE FECHA
	$fechafinalQ1 = date_create($fechafinal);
	$fechafinalQ2 = date_add($fechafinalQ1, date_interval_create_from_date_string('1 days'));
	$fechafinalQ3 = date_format($fechafinalQ2, 'Y-m-d'); 

$periodoDefinido = " AND ('".$fechainicio."' <=  `fechaEj` AND   `fechaEj` <= '".$fechafinalQ3."') " ;

} // TERMINA PROCESO DE FORMULARIO

##### // INICIA DEFINIR LOS CONTRATOS DEL EJECUTIVO
contratosDelEjecutivo($id_usuario);
//print_r($contratosArray) ;
//echo "<br/>";
//var_dump($contratosArray) ;
if($contratosArray) // OBTIENE UN ARRAY PARA HACER UN SELECT QUE INCLUYA LOS CONTRATOS DEL EJECUTIVO
{
	$todosMisContratos='';
	$cuantos 	= sizeof($contratosArray);
	$contador 	= 1;
	foreach( $contratosArray as $key => $value){
		$todosMisContratos.=" id_contrato = $value ";
		if($cuantos > $contador){
			$todosMisContratos.=" OR ";
		}
		$contador++;
	}
	echo "<br>";
	//echo $todosMisContratos; // PARA VER CONSTRUCCION DEL WHERE
}else{
	echo "NO TIENE CONTRATOS ASIGNADOS";
}
##### // TERMINA DEFINIR LOS CONTRATOS DEL EJECUTIVO

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 50; //RESULTADOS POR PAGINA // 50 truncado a 5 para razones de editar resumen como tal

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

if($_SESSION["mttoSol"] == 2){
$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol WHERE ($todosMisContratos) AND cancelado = 0 $periodoDefinido ";
}

if($_SESSION["mttoSol"] > 2){
$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol WHERE ($todosMisContratos) AND cancelado = 0 $periodoDefinido ";
}

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE MANTENIMIENTO SOLICITADO</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4>";
echo "Página $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION


// BOTON DE DESCARGA
/*echo "<p> 
	<a href='mttoSolRes_GET.php?id_usuario=$id_usuario&pagina=$pagina' 
	title='DESCARGAR RESUMEN MANTENIMIENTO'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR FLOTILLA'>
	</a>
	</p>";*/
// BOTON DE DESCARGA


echo "<section><fieldset><legend>RESUMEN DE MANTENIMIENTO</legend>";


$sql_mttoSol = '';

if($_SESSION["mttoSol"] == 2){
// SI CONSULTA EJECUTIVO
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE  ($todosMisContratos) AND cancelado = 0  $periodoDefinido "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}

if($_SESSION["mttoSol"] > 2){
// SI CONSULTA SUPERVISOR
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE  ($todosMisContratos) AND cancelado = 0  $periodoDefinido  "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}


include('mttoSolResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN

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
				echo "<a href='?pagina=$i&fechainicio=$fechainicio&fechafinal=$fechafinal&consultar=$consultar' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></section>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />