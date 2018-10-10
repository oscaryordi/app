<?php #############################################
header("Content-Type: application/vnd.ms-excel");header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte.xls");
?>
<meta charset='utf-8'>
<?php include_once ("base.inc.php"); ?>

<?php 
$proyecto 		= @$_GET['proyecto'];
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

$cuenta_inventarios = "SELECT id_formato FROM formato_inventario  WHERE  
		`proyecto_origen` LIKE '%$proyecto%' 
		OR `proyecto_destino` LIKE '%$proyecto%' 
		";
if(isset($proyecto) and $proyecto !=''){
$sacar_cuenta 	= mysqli_query($dbd2, $cuenta_inventarios);
}
@$cuenta 		= mysqli_num_rows($sacar_cuenta);
@$paginas 		= $cuenta/$rxpag;
@$paginas_entero = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";
if($pagina == ""){$pagina = 1;}
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta RESULTADOS SEGUN CRITERIOS </h3>";
echo "<h3>PAGINA ACTUAL $pagina, RESULTADOS POR PAGINA $cuantosR </h3>";
// FIN FASE 1 ALGORITMO DE PAGINACION

$sql_entradas = 'SELECT '
        . ' `id_formato`, '
        . ' `fechaentrega`, '
        . ' `fecharecepcion`, '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo`, ' 
        . ' `razonsalida`, '
        . ' `proyecto_origen`, '
        . ' `proyecto_destino` '
        . ' FROM `formato_inventario` ';
$sql_entradas .= " WHERE 
		`proyecto_origen` LIKE '%$proyecto%' 
		OR `proyecto_destino` LIKE '%$proyecto%' 
		";
		
 $sql_entradas .= ' ORDER BY '
        . ' `id_formato` '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag"; 


echo "<fieldset><legend>Resumen de movimientos</legend><table >\n";
echo "<tr>
<th>FECHA DE ENTRADA</th>
<th>FECHA DE SALIDA</th>
<th>INVENTARIO</th>
<th>ECONOMICO</th>
<th>PLACAS</th>
<th>SERIE</th>
<th>TIPO</th>

<th>MOTIVO</th>
<th>ORIGEN</th>
<th>DESTINO</th>
<th>VER DETALLE</th>
</tr>";



$res_entradas = mysqli_query($dbd2, $sql_entradas);

while(@$row = mysqli_fetch_assoc($res_entradas))
{
	$id_inventario = $row['id_formato'];	
	$fechaentrega = $row['fechaentrega'];
	$fecharecepcion = $row['fecharecepcion'];	
	$inventario = $row['numero_inventario'];
	$economico = $row['economico'];
	$placas = $row['placas'];
	$serie = $row['serie'];
	$tipo = $row['tipo'];
	$razonsalida = $row['razonsalida'];
	$proyecto_origen = $row['proyecto_origen'];
	$proyecto_destino = $row['proyecto_destino'];
	//$pagado = $row['PAGADO'];
	
	echo "<tr>";
	echo "<td>{$fecharecepcion}</td>";	
	echo "<td>{$fechaentrega}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";
	echo "<td>{$razonsalida}</td>";
	echo "<td>{$proyecto_origen}</td>";
	echo "<td>{$proyecto_destino}</td>";
}
echo "</table></fieldset>";

echo "&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y');
?>