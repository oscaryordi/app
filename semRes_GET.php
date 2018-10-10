<?php #############################################
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=SeminuevosReporte.xls");

echo "<meta charset='utf-8'>";

include_once ("base.inc.php");
include_once("funcion.php");

$fechainicio 	= @$_GET['fechainicio'];
$fechafinal 	= @$_GET['fechafinal'];
$cuantosR 		= @$_GET['cuantosR'];

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
$cuenta = '';
$paginas = '';
$paginas_entero = '';

$cuenta_gps = " SELECT id_venta 
				FROM sem 
				WHERE '$fechainicio' <= fechaFact 
				AND  fechaFact <= '$fechafinal'  ";

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuantosFueron 		= mysqli_affected_rows($dbd2);

if($cuantosFueron > 0)
{
	$cuenta 	= mysqli_num_rows($sacar_cuentagps);
	$paginas 	= $cuenta/$rxpag;
	$paginas_entero = ceil($cuenta/$rxpag);
}
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE VENTA SEMINUEVOS</h2>";
echo "PERIODO DEL <b>$fechainicio</b> AL <b>$fechafinal</b><br>";
echo "".$paginas_entero." PAGINAS,  $cuenta VENTAS<br>";
echo "".$rxpag." Resultados por Pagina<br><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

?>
<style>
	table, th, td {border: 1px solid #ddd;}
</style>
<section><fieldset><legend>RESUMEN</legend>
<?php

// SI CONSULTA GERENTE
	$sql_sem = 'SELECT * '
        . ' FROM sem '
        . " WHERE '$fechainicio' <= fechaFact 
        	AND  fechaFact <= '$fechafinal' "
        . ' ORDER BY '
        . ' vendedor ASC, id_venta '
        . ' ASC '
        . " LIMIT $pagina_1, $rxpag " ;

		
echo "<table>";
echo "<tr>
		<th>ID VTA</th>
		<th>VENDEDOR</th>
		<th>UNIDAD</th>
		<th>DEPOSITO<BR>FECHA - IMPORTE</th>
		<th>FECHA FACTURA</th>
		<th>IMPORTE FACTURA</th>
		<th>PRECIO</th>
		<th>FOLIO FACTURA</th>
		<th>NOMBRE CLIENTE</th>
		<th>OBSERVACIONES</th>
	  </tr>";

$sem_R = mysqli_query($dbd2, $sql_sem);

if($sem_R){ // INICIA hubo resultados
while($row = mysqli_fetch_assoc($sem_R)){ // INICIA PONER RESULTADOS

	$id_venta 	= $row['id_venta']; // 
	$id_unidad	= $row['id_unidad'];
	$vendedor 	= $row['vendedor'];

	$semDep 	= $row['semDep'];

	$fechaDep 	= $row['fechaDep'];
	$importeD	= $row['importeD'];
	$fechaFact 	= $row['fechaFact'];
	$folioF 	= $row['folioF'];
	$importe 	= $row['importe'];
	$precioT 	= $row['precioT'];	
	$clienteN 	= $row['clienteN'];
	$obs 		= $row['obs'];

// DOCUMENTOS ASOCIADOS
	//$dM5 		= $row['dM5'];
	//$dF4 		= $row['dF4'];
	//$dC1 		= $row['dC1'];
	//$pagado 	= $row['pagado'];
	//$facturado 	= $row['facturado'];


// INICIO saber si tiene DEPOSITO
$tieneDep = 0;
if($semDep > 0){	
	$sql_D = "	SELECT * FROM semDep 
				WHERE id_venta = '$id_venta' 
				ORDER BY id_dep ASC ";
	$tD_R 		= mysqli_query($dbd2, $sql_D);
	$tieneDep 	= mysqli_affected_rows($dbd2);
}
// FIN saber si subio COTIZACION


// INICIO poner renglon resultados
	echo "<tr>";

	echo "<td>{$id_venta}</td>";
	switch($vendedor){
		case '1':
			$iniciales = 'ACB';
			break;
		case '2':
			$iniciales = 'GVF';
			break;
		case '3':
			$iniciales = 'JVO';
			break;
		case '4':
			$iniciales = 'JMVO';
			break;
		case '5':
			$iniciales = 'RMR';
			break;	
		default:
		break;
	}

	echo "<td>{$iniciales}</td>";

	datosxid($id_unidad);
	echo "<td>{$Economico} ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</td>";

	// INICIO FECHA DE DEPOSITOS
	if($tieneDep > 0){
	echo "<td><table style='width:100%;'>";
				while($rowtD = mysqli_fetch_assoc($tD_R)){ 
					$fechaD = $rowtD['fechaD'];
					$fechaD = strtotime($fechaD);
					$fechaD = date('Y-m-d', $fechaD);					
					$importeD = $rowtD['importeD'];
					$importeD = number_format($importeD, 2);			
					echo "<tr><td>{$fechaD}</td>  ";
					echo "<td style='text-align: right;' >$ {$importeD}</td></tr>";
				}
	echo "</table></td>";
	}
	else 
		{
			echo "<td><table><tr><td></td><td></td></tr></table></td>";
		}
	// TERMINA FECHA DE DEPOSITOS


	$fechaFact = strtotime($fechaFact); // CONVIERTE EN SEGUNDOS UNIX
	$fechaFact = date('Y-m-d', $fechaFact); // DA FORMATO QUE SE PRESENTARA
	echo "<td>{$fechaFact}</td>";
	$importe = number_format("$importe", 2 ,".",",");
	echo "<td style='text-align: right;' >$\t {$importe}</td>";
	
	$precioTipo = 'Piso';
	if($precioT == 1){$precioTipo = 'Flotilla';}
	echo "<td>{$precioTipo}</td>";

	echo "<td>{$folioF}</td>";	

	echo "<td>{$clienteN}</td>";
	echo "<td>{$obs}</td>";

	
	echo "</tr>";
// FIN poner renglon resultados

} // TERMINA PONER RESULTADOS
echo "</table></fieldset></section>";
} // TERMINA hubo resultados

echo "<br> &copy Jet Van Car Rental, S.A. de C.V. - ".date('Y');
?>