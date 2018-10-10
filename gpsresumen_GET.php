<?php #############################################
header("Content-Type: application/vnd.ms-excel");header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=GpsAsignado.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php"); 
include_once("funcion.php");
echo "<meta charset='utf-8'>";

$id_usuario = $_SESSION["id_usuario"];

if(isset($_GET['id_contrato']))
{
	$id_contrato = $_GET['id_contrato'];
}
else{
	$id_contrato = '';
}

tienecontrato($id_usuario);
if($_SESSION["gps"] > 1 ){ // PRIVILEGIO EJECUTIVO// PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 


// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 500; //RESULTADOS POR PAGINA

if(isset($_GET['contador'])){
		$pagina = $_GET['contador'];
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
$cuenta_gps 		= " SELECT id_gps FROM gpsAsignado  ";
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";

##### INICIAR ARRAY DE CONTRATOS
$contratosArray[] = '';
$clientesArray[] = '';
##### INICIAR ARRAY DE CONTRATOS

echo "<b>RESUMEN DE GPS ASIGNADO</b><br/>";
//echo "".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES<br/>";
echo "$cuenta GPS ASIGNADO, Hasta".$rxpag." Resultados<br/>";
//echo "Pag. $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION

?>
<style>
	table, th, td {border: 1px solid #ddd; font-size: 10px;}
</style>
<?php

	$sql_gps = 'SELECT * '
        . ' FROM gpsAsignado '
        . ' ORDER BY '
        . ' id_gps '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;

echo "<section><fieldset><legend>RESUMEN DE EQUIPOS ASIGNADOS</legend>";		
echo "<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>
<th>ASIGNACION</th>
<th>GPS IMEI</th>
<th>LINEA NUMERO</th>
<th>SIM SERIE</th>
<th>BLOQUEO INSTALADO</th>
<th>ECONOMICO</th>
<th>SERIE</th>
<th>TIPO</th>
<th>PLACAS</th>
<th>FECHA DE INSTALACION</th>
<th>ASG CLIENTE</th>
<th>ASG CONTRATO</th>
<th>ASG FECHA</th>
<th>UB CLIENTE</th>
<th>UB LUGAR</th>
<th>UB FECHA</th>
<th>FOTO</th>
</tr>";

$res_GPS = mysqli_query($dbd2, $sql_gps);

while($row = mysqli_fetch_assoc($res_GPS)){

	$id_gps 	= $row['id_gps']; // asignacion corresponde al equipo configurado
	$id_imei 	= $row['id_imei'];
	$id_linea 	= $row['id_linea'];
	$id_sim 	= $row['id_sim'];
	$id_unidad	= $row['id_unidad'];
	$fechaInicio = $row['fechaInicio'];
	$bloqueo 	= $row['bloqueo'];
	$obs 		= $row['obs'];

	// INICIO sacar imei
	$sql_imei = "SELECT imei FROM gpsImei WHERE id_imei = '$id_imei' LIMIT 1 ";
	$res_imei = mysqli_query($dbd2, $sql_imei);
	while($rowimei = mysqli_fetch_assoc($res_imei)){ $imei = $rowimei['imei'];}
	// FIN sacar imei

	// INICIO sacar linea
	$sql_linea = "SELECT numero FROM gpsLinea WHERE id_linea = '$id_linea' LIMIT 1 ";
	$res_linea = mysqli_query($dbd2, $sql_linea);
	while($rowlinea = mysqli_fetch_assoc($res_linea)){ $linea = $rowlinea['numero'];}
	// FIN sacar linea

	// INICIO sacar sim
	$sql_sim = "SELECT numeroSim FROM gpsSim WHERE id_sim = '$id_sim' LIMIT 1 ";
	$res_sim = mysqli_query($dbd2, $sql_sim);
	while($rowsim = mysqli_fetch_assoc($res_sim)){ $sim = $rowsim['numeroSim'];}
	// FIN sacar sim

	// INICIO poner renglon resultados
	echo "<tr>";

	echo "<td>{$id_gps}</td>";
	echo "<td>'{$imei}</td>";
	echo "<td>'{$linea}</td>";
	echo "<td>'{$sim}</td>";

	$bloqueoA = array("NO", "BOMBA DE GASOLINA", "IGNICION", "OTRO");
	echo "<td>{$bloqueoA[$bloqueo]} {$obs}</td>";

	datosxid($id_unidad);
	echo "<td>{$Economico}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Placas}</td>";
	echo "<td>{$fechaInicio}</td>";


	unidadAsignacion($id_unidad);
	if ($id_asignacion=='')
	{
		$asinacionTXT = ($id_asignacion=='')?'NO HAY ASIGNACION FORMAL':'';
		echo "<td>$asinacionTXT</td><td></td><td></td>";
	}
	elseif (@$contratosArray[$id_contrato] != '') {
		echo '<td>'.$id_cliente.'::: '.$clientesArray[$id_cliente][0].' ::: '.$clientesArray[$id_cliente][1].'</td>';
		echo '<td>  id_contrato '.$id_contrato.' ::: ALAN '.$contratosArray[$id_contrato][0].' ALAN ::: No. OFICIAL '.$contratosArray[$id_contrato][1].'</td>';
		echo '<td>'.$fecha_inicioASG.'</td>';
	}
	else
	{
		clientexid($id_cliente);		
		echo '<td>'.$id_cliente.'::: '.$rfc.' ::: '.$razonSocial.'</td>';
		contratoxid($id_contrato);
		echo '<td>  id_contrato '.$id_contrato.' ::: ALAN '.$id_alan.' ALAN ::: No. OFICIAL '.$numero.'</td>';
		echo '<td>'.$fecha_inicioASG.'</td>';

		$contratosArray[$id_contrato][0] = $id_alan;
		$contratosArray[$id_contrato][1] = $numero;
		$contratosArray[$id_contrato][2] = $aliasCto;

		$clientesArray[$id_cliente][0] = $rfc;
		$clientesArray[$id_cliente][1] = $razonSocial;
		//$clientesArray[$id_cliente][2] = $aliasCto;
	}


	ubicacionHistorico($id_unidad);
	echo '<td>'.$clienteA.'</td>';
	echo '<td>'.$ubicacionA.'</td>';
	echo '<td>'.$fechaA.'</td>';

	buscaFotoS($id_unidad);
	$fsTXT = ($ArchivoFS != '')? 'FS': '' ;
	echo "<td>";
//	echo "<a href='http://sistema.jetvan.com.mx/exp/fotos/$rutaFS/$ArchivoFS' target='_blank'>$fsTXT</a>";
	echo "$fsTXT";
	echo "</td>";

	echo "</tr>";
	// FIN poner renglon resultados


// CAPTURAR DATOS DE CLIENTE Y CONTRATO EN ARRAYS

/*
function areasAdmDelContrato($id_contrato){ // OBTENER SUBDIV2
global $conectar;
global $areasAdmArray;

$sqlAreas 	= "SELECT id_subDiv2, concepto FROM clbSubDiv2 WHERE id_contrato = '$id_contrato' ";
$sqlA_R		= mysqli_query($dbd2, $sqlAreas);

while ($fila = mysqli_fetch_array($sqlA_R	, MYSQL_ASSOC))
	{
		$areasAdmArray[$fila["id_subDiv2"]] = $fila["concepto"];
	}
mysqli_free_result($sqlA_R);
}
*/

// CAPTURAR DATOS DE CLIENTE Y CONTRATO EN ARRAYS



}
echo "</table>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y')."</p>";
} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA