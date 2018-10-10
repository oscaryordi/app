<?php
include("1header.php");

if($_SESSION["mttoSolSup"] > 1){ // INICIA PRIVILEGIO SUPERVISOR
	include ("nav_mtto.php"); 
	include ("nav_mtto_est.php"); 

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
		</script>

		<script>
		$(function() {
		$( "#fechafinal" ).datepicker({changeYear: true, changeMonth: true});
		});
		</script>

<p>
<h3>CLIENTES: Consultar periodo:</h3>
<form action='' method='GET' >
<!-- -->
Fecha Inicio->
<input type='text' id='fechainicio' name='fechainicio' placeholder='dd/mm/aaaa' />
Fecha Final->
<input type='text' id='fechafinal' name='fechafinal' placeholder='dd/mm/aaaa' />


Resultados por pagina->
<select name='cuantosR' >
<option>50</option>
<option>100</option>
<option>300</option>
</select>

<input type='submit' name='consultar' value='consultar'>

</form>
<p/>


<?php 
$fechainicio 	= @$_GET['fechainicio'];
$fechafinal 	= @$_GET['fechafinal'];
$cuantosR 		= @$_GET['cuantosR'];

// TERMINA  FORMULARIO PARA FILTRAR PROYECTO ORIGEN DESTINO
#####


if(isset($_GET['consultar'])){// INICIA PROCESO DE FORMULARIO


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




	// INICIO FASE 1 ALGORITMO DE PAGINACION

	$rxpag = $cuantosR; //RESULTADOS POR PAGINA

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

	$cuenta_gps;
	$cuenta 	= '';
	$paginas 	= '';
	$paginas_entero = '';

	$cuenta_gps 		= "	SELECT COUNT(DISTINCT(id_cliente)) sontantos 
							FROM `mttoSol`  
							WHERE '$fechainicio' <=  `fechaEj` 
							AND   `fechaEj` <= '$fechafinal'  ";
	$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
	$arraySC 			= mysqli_fetch_array($sacar_cuentagps);
	$cuenta 			= $arraySC['sontantos'];


	if($cuenta > 0){
		$paginas = $cuenta/$rxpag;
		$paginas_entero = ceil($cuenta/$rxpag);
	}
	// echo $cuenta."<br>";
	// echo $paginas."<br>";
	echo "<h2>SOLICITUDES POR CLIENTE</h2>";
	echo "PERIODO DEL <b>$fechainicio</b> AL <b>$fechafinal</b><br>";
	echo "".$paginas_entero." PAGINAS,  $cuenta CLIENTES<br>";
	echo "".$rxpag." Resultados por Pagina<br><br>";
	//	$fechafinal = date('Y-m-d', strtotime($date));
	$fechafinalQ1 = date_create($fechafinal);
	$fechafinalQ2 = date_add($fechafinalQ1, date_interval_create_from_date_string('1 days'));
	$fechafinalQ3 = date_format($fechafinalQ2, 'Y-m-d');
	echo $fechafinalQ3;
	// FIN FASE 1 ALGORITMO DE PAGINACION

	/*
	// DESCARGA
	echo "<p> <a href='semRes_GET.php?pagina=$pagina&fechainicio=$fechainicio&fechafinal=$fechafinal&cuantosR=$cuantosR' 
			title='Descargar'>
			<img src='img/Download1.gif' style='width:16px;height:16px;' alt='Descargar'>
			</a>
		</p>\n";
	// DESCARGA
	*/

	?>
	<section><fieldset><legend>RESUMEN</legend>
	<?php

	// SI CONSULTA GERENTE
		$sql_MSU = 'SELECT c.razonSocial nombre, count( m.id_mttoSol ) solicitudes, 
					sum( m.importe ) suma, 
					sum( m.`facturado` ) facturado, 
					sum( m.`dC1` ) cotizado, 
					sum( m.`pagado` ) pagado, 
					sum( m.`cancelado` ) cancelado, 
					m.id_cliente id_cliente  					
					FROM `mttoSol` m 
					JOIN claCliente c 
					ON m.id_cliente = c.id_cliente '
	        . "  WHERE '$fechainicio' <=  `fechaEj` AND  `fechaEj` <= '$fechafinalQ3'  "
	        . ' GROUP BY m.id_cliente '
	        . ' ORDER BY solicitudes  '
	        . ' DESC '
	        . " LIMIT $pagina_1, $rxpag " ;

			
	echo "<table class='ResTabla' >";
	echo "<tr>
			<th>NOMBRE</th>
			<th>SOLICITUDES</th>
			<th>CANCELADAS</th>
			
			<th>CON FACTURA</th>
			<th>CON COTIZACION</th>
			<th>PAGADO</th>

			<th>SUMA</th>
			<th>PROMEDIO</th>
		</tr>";

	$sql_MSUR = mysqli_query($dbd2, $sql_MSU);

	if($sql_MSUR){ // INICIA hubo resultados
	while($row = mysqli_fetch_assoc($sql_MSUR))
		{ // INICIA PONER RESULTADOS
			$id_cliente 	= $row['id_cliente']; 
			$nombre 		= $row['nombre']; // 
			$solicitudes	= $row['solicitudes'];

			$facturado		= $row['facturado'];
			$cotizado		= $row['cotizado'];
			$pagado			= $row['pagado'];
			$cancelado		= $row['cancelado'];

			$suma 			= $row['suma'];
			$suma1 			= $row['suma'];
		// INICIO poner renglon resultados
			echo "<tr>";

			echo "<td><a
			href='mttoSolResSupCte.php?id_cliente=$id_cliente' 
			>{$nombre}</a></td>";

			echo "<td style='text-align:center;'>{$solicitudes}</td>";
			echo "<td style='text-align:center;'>{$cancelado}</td>";

			echo "<td style='text-align:center;'>{$facturado}</td>";
			echo "<td style='text-align:center;'>{$cotizado}</td>";
			echo "<td style='text-align:center;'>{$pagado}</td>";

			$suma = number_format("$suma", 2 ,".",",");
			echo "<td style='text-align: right;' >$\t {$suma}</td>";
			
			$promedioU = ($suma1/$solicitudes);	
			
			$promedioU = number_format("$promedioU", 2 ,".",",");
			echo "<td style='text-align: right;' >$\t {$promedioU}</td>";

			$promedioU = 0;
		// FIN poner renglon resultados

		} // TERMINA PONER RESULTADOS
	echo "</table>";
	} // TERMINA hubo resultados



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
		
	$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
	for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
		{
			if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
				{
					$color = 'red';
				}
			else {$color='';}
			echo "<a href='mttoSolEstC.php?pagina=$i&fechainicio=$fechainicio&fechafinal=$fechafinal&cuantosR=$cuantosR&consultar=consultar' 
			style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
		}
	// FIN ALGORITMO PAGINACION // 2da parte
	#####
		
	?>
	</fieldset></section>

<?php
}// TERMINA PROCESO DE FORMULARIO




######### ########## ########## #########


} // TERMINA PRIVILEGIO SUPERVISOR
include("1footer.php");?>
<!-- 	<link rel="stylesheet" href="js/jquery-ui.min.css" /> -->
<!--	<link rel="stylesheet" href="js/jquery-ui.theme.min.css" />  hot-sneaks -->	
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />