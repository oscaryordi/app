<?php
include("1header.php");

if($_SESSION["mttoSol"] > 1){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 

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
<h3>MANTENIMIENTO:</h3>
<form action='' method='GET' >
<!-- -->
<fieldset><legend>ELEGIR PERIODO</legend>
Fecha Inicio->
<input type='text' id='fechainicio' name='fechainicio' placeholder='dd/mm/aaaa'  readonly='true' />
Fecha Final->
<input type='text' id='fechafinal' name='fechafinal' placeholder='dd/mm/aaaa'   readonly='true' />
</fieldset>


<fieldset><legend>FILTRAR POR STATUS DE AUTORIZACION / PAGO</legend>
	<input type='checkbox' name='A0' id='A0' value='1' checked > <!-- 0 pend y 6 prea -->
	<label for='A0'>EN REVISION</label>

	<input type='checkbox' name='A1' id='A1' value='1' checked >
	<label for='A1'>AUTORIZADAS</label>

	<input type='checkbox' name='A2' id='A2' value='1' checked >
	<label for='A2'>CORREGIR</label>

	<input type='checkbox' name='A4' id='A4' value='1' checked >
	<label for='A4'>RECHAZADAS</label>

	<input type='checkbox' name='A5' id='A5' value='1' checked >
	<label for='A5'>CANCELADAS</label>
</fieldset>

<fieldset><legend>FILTRAR POR TIPO DE SERVICIO / INCIDENCIA</legend>
	<table id='cuadrotiposervicio'>
		<tr>
			<td>
			<input type="checkbox" id="preventivo" name="t1" class = 'checkST' value="1" >
			<label for = "preventivo" >PREVENTIVO</label>
			</td><td>
			<input type="checkbox" id="frenos" name="t2"  class = 'checkST' value="1">
			<label for = "frenos" >FRENOS</label>
			</td><td>
			<input type="checkbox" id="susp" name="t3"  class = 'checkST' value="1" >
			<label for = "susp" >SUSPENSION</label>
			</td><td>
			<input type="checkbox" id="dir" name="t4"  class = 'checkST' value="1" >
			<label for = "dir" >DIRECCION</label>
			</td>
			<td>
			<input type="checkbox" id="deducible" name="t13"  class = 'checkST' value="1" >
			<label for = "deducible" ><span style='color:red;'>DEDUCIBLE/SINIESTROS</span></label>
			</td>
		</tr><tr>
			<td>
			<input type="checkbox" id="clima" name="t5"  class = 'checkST' value="1" >
			<label for = "clima" >CLIMA</label>
			</td><td>
			<input type="checkbox" id="motor" name="t6"  class = 'checkST' value="1" >
			<label for = "motor" >MOTOR</label>
			</td><td>
			<input type="checkbox" id="enfria" name="t7"  class = 'checkST' value="1" >
			<label for = "enfria" >ENFRIAMIENTO</label>
			</td><td>
			<input type="checkbox" id="transmision" name="t8"  class = 'checkST' value="1" >
			<label for = "transmision" >TRANSMISION</label>
			</td>
			<td></td>
		</tr><tr>
			<td>
			<input type="checkbox" id="llantas" name="t9"  class = 'checkST' value="1" >
			<label for = "llantas" >LLANTAS</label>
			</td><td>
			<input type="checkbox" id="hojalateria" name="t10"  class = 'checkST' value="1" >
			<label for = "hojalateria" >HOJALATERIA</label>
			</td><td>
			<input type="checkbox" id="electrico" name="t11"  class = 'checkST' value="1" >
			<label for = "electrico" >ELECTRICO</label>
			</td><td>
			<input type="checkbox" id="electron" name="t12"  class = 'checkST' value="1" >
			<label for = "electron" >ELECTRONICO</label>
			</td>
			<td></td>
		</tr>
	</table>
</fieldset>

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



/* // DEFINICION DE TIPO DE SERVICIO A BASE
'$preventivo','$frenos','$susp','$dir',
'$clima','$motor','$enfria','$transmision',
'$llantas','$hojalateria','$electrico','$electron', '$deducible'

t1, t2, t3, t4, 
t5, t6, t7, t8, 
t9, t10, t11, t12, t13

t1,'$preventivo', 
t2,'$frenos', 
t3,'$susp', 
t4,'$dir', 
t5,'$clima', 
t6,'$motor', 
t7,'$enfria', 
t8,'$transmision', 
t9,'$llantas', 
t10,'$hojalateria', 
t11,'$electrico', 
t12,'$electron',  
t13,'$deducible'
*/ // DEFINICION DE TIPO DE SERVICIO A BASE


//   readonly='true'  PERMITE QUE EL TECLADO AUTOMATICO DE ANDROID SE OCULTE PERO 
// JQUERY SIGUE FUNCIONAL, EN UN INPUT

$fechainicio 	= @mysqli_real_escape_string($dbd2, $_GET['fechainicio']);
$fechafinal 	= @mysqli_real_escape_string($dbd2, $_GET['fechafinal']);
//$cuantosR 		= @$_GET['cuantosR'];
$periodoDefinido = '';
$Atodas 	= '';
$AtdsGet 	= '';
$ttodas 	= '';
$ttdsGet 	= '';
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

	// INICIA OPCIONES DE FILTRADO
	$A0 	= @mysqli_real_escape_string($dbd2, $_GET['A0']); // 0 Y 5
	$A1 	= @mysqli_real_escape_string($dbd2, $_GET['A1']); // AUTORIZADO
	$A2 	= @mysqli_real_escape_string($dbd2, $_GET['A2']); // 2 Y 3 A REVISION
	$A4 	= @mysqli_real_escape_string($dbd2, $_GET['A4']); // 4 RECHAZADO
	$A5 	= @mysqli_real_escape_string($dbd2, $_GET['A5']); // CANCELADO

 	$A0sql = ($A0 == 1 )? ' AutorizadoS = 0 OR AutorizadoS = 6 ' : '' ;
	$A1sql = ($A1 == 1 )? ' AutorizadoS = 1  ' : '' ;
	$A2sql = ($A2 == 1 )? ' AutorizadoS = 2 OR AutorizadoS = 3 ' : '' ;
	$A4sql = ($A4 == 1 )? ' AutorizadoS = 4  ' : '' ;
	$A5sql = ($A5 == 1 )? ' AutorizadoS = 5 ' : '' ;

	$A05sumas = 0;
	$A05sumas = $A0+$A1+$A2+$A4+$A5;

 	$A0or = ($A0 == 1 AND $A1 == 1 )? ' OR ' : '' ;
	$A1or = (($A0+$A1) > 0 AND $A2 == 1 )? ' OR ' : '' ;
	$A2or = (($A0+$A1+$A2) > 0 AND $A4 == 1 )? ' OR ' : '' ;
	$A4or = (($A0+$A1+$A2+$A4) > 0 AND $A5 == 1 )? ' OR ' : '' ;

	$AtodasPrevio = $A0sql.$A0or.$A1sql.$A1or.$A2sql.$A2or.$A4sql.$A4or.$A5sql;

	if($A05sumas > 0){
		$Atodas = " AND ( ".$AtodasPrevio." ) " ;		
	}
		// PARA EL GET PAGINACION
		$A0g = ($A0 == 1)? '&A0=1':'';
		$A1g = ($A1 == 1)? '&A1=1':'';
		$A2g = ($A2 == 1)? '&A2=1':'';
		$A4g = ($A4 == 1)? '&A4=1':'';
		$A5g = ($A5 == 1)? '&A5=1':'';

		$AtdsGet = $A0g.$A1g.$A2g.$A4g.$A5g;
	// TERMINA OPCIONES DE FILTRADO

	// INICIA  PROCESO OPCIONES FILTRADO TIPO SERVICIO
	$t1= 	@mysqli_real_escape_string($dbd2, $_GET['t1']); //preventivo
	$t2= 	@mysqli_real_escape_string($dbd2, $_GET['t2']); //frenos
	$t3= 	@mysqli_real_escape_string($dbd2, $_GET['t3']); //susp
	$t4= 	@mysqli_real_escape_string($dbd2, $_GET['t4']); //dir
	$t5= 	@mysqli_real_escape_string($dbd2, $_GET['t5']); //clima
	$t6= 	@mysqli_real_escape_string($dbd2, $_GET['t6']); //motor
	$t7= 	@mysqli_real_escape_string($dbd2, $_GET['t7']); //enfria
	$t8= 	@mysqli_real_escape_string($dbd2, $_GET['t8']); //transmision
	$t9= 	@mysqli_real_escape_string($dbd2, $_GET['t9']); //llantas
	$t10= 	@mysqli_real_escape_string($dbd2, $_GET['t10']); //hojalateria
	$t11= 	@mysqli_real_escape_string($dbd2, $_GET['t11']); //electrico
	$t12= 	@mysqli_real_escape_string($dbd2, $_GET['t12']); //electron
	$t13= 	@mysqli_real_escape_string($dbd2, $_GET['t13']); //deducible

	$t1sql = ($t1 == 1 )? ' t1 = 1  ' : '' ;
	$t2sql = ($t2 == 1 )? ' t2 = 1  ' : '' ;
	$t3sql = ($t3 == 1 )? ' t3 = 1  ' : '' ;
	$t4sql = ($t4 == 1 )? ' t4 = 1  ' : '' ;
	$t5sql = ($t5 == 1 )? ' t5 = 1  ' : '' ;
	$t6sql = ($t6 == 1 )? ' t6 = 1  ' : '' ;
	$t7sql = ($t7 == 1 )? ' t7 = 1  ' : '' ;
	$t8sql = ($t8 == 1 )? ' t8 = 1  ' : '' ;
	$t9sql = ($t9 == 1 )? ' t9 = 1  ' : '' ;
	$t10sql = ($t10 == 1 )? ' t10 = 1  ' : '' ;
	$t11sql = ($t11 == 1 )? ' t11 = 1  ' : '' ;
	$t12sql = ($t12 == 1 )? ' t12 = 1  ' : '' ;
	$t13sql = ($t13 == 1 )? ' t13 = 1  ' : '' ;

	$tsumas = 0;
	$tsumas = $t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8+$t9+$t10+$t11+$t12+$t13;

	$t1or = ($t1 == 1 AND $t2 == 1 )? ' OR ' : '' ;
	$t2or = (($t1+$t2) > 0 AND $t3 == 1 )? ' OR ' : '' ;
	$t3or = (($t1+$t2+$t3) > 0 AND $t4 == 1 )? ' OR ' : '' ;
	$t4or = (($t1+$t2+$t3+$t4) > 0 AND $t5 == 1 )? ' OR ' : '' ;
	$t5or = (($t1+$t2+$t3+$t4+$t5) > 0 AND $t6 == 1 )? ' OR ' : '' ;
	$t6or = (($t1+$t2+$t3+$t4+$t5+$t6) > 0 AND $t7 == 1 )? ' OR ' : '' ;
	$t7or = (($t1+$t2+$t3+$t4+$t5+$t6+$t7) > 0 AND $t8 == 1 )? ' OR ' : '' ;
	$t8or = (($t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8) > 0 AND $t9 == 1 )? ' OR ' : '' ;
	$t9or = (($t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8+$t9) > 0 AND $t10 == 1 )? ' OR ' : '' ;
	$t10or = (($t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8+$t9+$t10) > 0 AND $t11 == 1 )? ' OR ' : '' ;
	$t11or = (($t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8+$t9+$t10+$t11) > 0 AND $t12 == 1 )? ' OR ' : '' ;
	$t12or = (($t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8+$t9+$t10+$t11+$t12) > 0 AND $t13 == 1 )? ' OR ' : '' ;

	$ttodasPrevio = $t1sql.$t1or.$t2sql.$t2or
					.$t3sql.$t3or.$t4sql.$t4or
					.$t5sql.$t5or.$t6sql.$t6or
					.$t7sql.$t7or.$t8sql.$t8or
					.$t9sql.$t9or.$t10sql.$t10or
					.$t11sql.$t11or.$t12sql.$t12or
					.$t13sql;

	if($tsumas > 0){
		$ttodas = " AND ( ".$ttodasPrevio." ) " ;
	}

	// PARA EL GET PAGINACION
	$tg1 = ($t1 == 1)? '&t1=1':'';
	$tg2 = ($t2 == 1)? '&t2=1':'';
	$tg3 = ($t3 == 1)? '&t3=1':'';
	$tg4 = ($t4 == 1)? '&t4=1':'';
	$tg5 = ($t5 == 1)? '&t5=1':'';
	$tg6 = ($t6 == 1)? '&t6=1':'';
	$tg7 = ($t7 == 1)? '&t7=1':'';
	$tg8 = ($t8 == 1)? '&t8=1':'';
	$tg9 = ($t9 == 1)? '&t9=1':'';
	$tg10 = ($t10 == 1)? '&t10=1':'';
	$tg11 = ($t11 == 1)? '&t11=1':'';
	$tg12 = ($t12 == 1)? '&t12=1':'';
	$tg13 = ($t13 == 1)? '&t13=1':'';

	$ttdsGet = $tg1.$tg2.$tg3.$tg4.$tg5.$tg6.$tg7.$tg8.$tg9.$tg10.$tg11.$tg12.$tg13;
	// TERMINA PROCESO OPCIONES FILTRADO TIPO SERVICIO

	######### falta poner condiciones en GET de paginacion y en SQL principal

} // TERMINA PROCESO DE FORMULARIO


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
$cuenta_gps 		= " SELECT id_mttoSol 
						FROM mttoSol 
						WHERE capturo = '$id_usuario' AND 
						cancelado = 0 
						$periodoDefinido  $Atodas $ttodas ";
}

if($_SESSION["mttoSol"] > 2){
$cuenta_gps 		= " SELECT id_mttoSol 
						FROM mttoSol  
						WHERE id_mttoSol > 0 
						$periodoDefinido $Atodas $ttodas ";
}

//echo $cuenta_gps; PARA DEBUG

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
echo "<p> 
	<a href='mttoSolRes_GET.php?id_usuario=$id_usuario&pagina=$pagina' 
	title='DESCARGAR RESUMEN MANTENIMIENTO'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR FLOTILLA'>
	</a>
	</p>";
// BOTON DE DESCARGA


$sql_mttoSol = '';

if($_SESSION["mttoSol"] == 2){
// SI CONSULTA EJECUTIVO
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE capturo = '$id_usuario'  AND cancelado = 0  $periodoDefinido  $Atodas $ttodas "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}

if($_SESSION["mttoSol"] > 2){
// SI CONSULTA SUPERVISOR
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE capturo like '%%'  $periodoDefinido  $Atodas $ttodas "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}

//echo $sql_mttoSol;
echo "<section><fieldset><legend>RESUMEN DE MANTENIMIENTO</legend>";

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
				echo "<a href='?pagina=$i&fechainicio=$fechainicio&fechafinal=$fechafinal&consultar=$consultar$AtdsGet$ttdsGet' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></section>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />