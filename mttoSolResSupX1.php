<?php
include("1header.php");

if($_SESSION["mttoSolSup"] > 1){ // PRIVILEGIO SUPERVISOR

include ("nav_mtto.php");

//$id_usuario = $_SESSION["id_usuario"];

########## ########## ########## ######### CODIGO JAVASCRIPT CALENDARIO
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
<?php
########## ########## ########## ######### CODIGO JAVASCRIPT CALENDARIO

//INICIA FORMULARIO ELEGIR EJECUTIVO
// CONSULTAR EJECUTIVOS PARA NORMALIZAR TABLA MTTOJTACUBA
$sql_mttoSol_E 	= 'SELECT id_usuario, nombre FROM usuarios WHERE mttoSol > 1 AND externo = 0 ORDER BY nombre';
$sql_mttoSol_ER =  mysqli_query($dbd2, $sql_mttoSol_E );
// CONSULTA EJECUTIVOS

if(isset($_GET['ejecutivoID']))
{
	$ejecutivoID = $_GET['ejecutivoID'];
}
else{
	$ejecutivoID = '';
}

?>
<p>
<p>Consulta de Solicitudes por Usuario:</p>
<form action='' method='GET' >
ELIJA EJECUTIVO->
	<select name="ejecutivoID" style='font-size:.9em;'>
		<?php 
			while($row = mysqli_fetch_assoc($sql_mttoSol_ER))
			{
				$id_usuarioE 	= 	$row['id_usuario'];
				$nombreE 		=	strtoupper($row['nombre']);

				$checked = '';
				if($ejecutivoID == $id_usuarioE ){$checked = 'selected';}
				echo "<option value='$id_usuarioE' style='font-size:.9em;' $checked >";
				echo "{$nombreE}";
				echo "</option>";
				$checked = '';
			}
		?>
	</select>

Fecha Inicio->
<input type='text' id='fechainicio' name='fechainicio' placeholder='dd/mm/aaaa' />
Fecha Final->
<input type='text' id='fechafinal' name='fechafinal' placeholder='dd/mm/aaaa' />


<input type='submit'  name='consultar' value='consultar'>
</form>
<p/>
<?php
//$ejecutivoID 		= @$_GET['ejecutivoID'];
//TERMINA FORMULARIO ELEGIR EJECUTIVO

$fechainicio 	= @$_GET['fechainicio'];
$fechafinal 	= @$_GET['fechafinal'];
$periodoDefinido = '';
$consultar 		= '';

// INICIA PROCESO DE FORMULARIO 
if(isset($_GET['consultar']) && $_GET['consultar'] != '' ){
	$consultar = $_GET['consultar'];
//INICIA VALIDA FORMATO DE FECHA
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
//TERMINA VALIDA FORMATO DE FECHA
	$fechafinalQ1 = date_create($fechafinal);
	$fechafinalQ2 = date_add($fechafinalQ1, date_interval_create_from_date_string('1 days'));
	$fechafinalQ3 = date_format($fechafinalQ2, 'Y-m-d'); 

$periodoDefinido = " AND ('".$fechainicio."' <=  `fechaEj` AND   `fechaEj` <= '".$fechafinalQ3."') " ;
}// TERMINA PROCESO DE FORMULARIO


// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 50; //RESULTADOS POR PAGINA // TEMPORALMENTE 5 PARA PRUEBAS LOCALES

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
$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol WHERE capturo = '$ejecutivoID'  $periodoDefinido  ";

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";

$id_usuario = $ejecutivoID;
usuarioxid($id_usuario);
$nombre 	= strtoupper($nombre);

echo "<p>RESUMEN DE MANTENIMIENTO X EJECUTIVO :</p>";
echo "<h2> $nombre </h2>";

echo "<p>".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES</p>";
echo "<p>".$rxpag." Resultados por Pagina</p><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

echo "<section><fieldset><legend>RESUMEN DE MANTENIMIENTO</legend>";

$sql_mttoSol = '';

$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . " WHERE capturo = '$ejecutivoID'  $periodoDefinido "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;


		include('mttoSolResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN

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
		echo "<a href='?pagina=$i&ejecutivoID=$ejecutivoID&fechainicio=$fechainicio&fechafinal=$fechafinal&consultar=$consultar' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></section>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA
include("1footer.php");?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />