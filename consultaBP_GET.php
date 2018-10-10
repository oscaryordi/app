<?php #############################################
header("Content-Type: application/vnd.ms-excel");header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Flotilla.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
?>
<meta charset='utf-8'>
<style>
	table, th, td {border: 1px solid #ddd; font-size: 10px;}
</style>
<?php 
include_once ("base.inc.php");
include_once ("funcion.php");

$busqueda 	= $_POST['busqueda']; // para saber el tipo de query a usar
$celulas 	= $_POST['celulasDescarga'];
$celulas 	= explode(',', $celulas);

// INICIO DEFINIR TIPO DE BUSQUEDA
if($busqueda == 'placas'){
	$query_search = 'SELECT id_unidad FROM placa WHERE ';
	for ($i=0; $i<count($celulas); $i++) {
		if ($i == 0)
			$query_search .= 'Placas = "'.$celulas[$i].'"';
		else
			$query_search .= ' OR Placas = "'.$celulas[$i].'"  '; //ORDER BY Economico ASC
	}
	$query_search .= ' ORDER BY id_unidad ASC ';
}
elseif($busqueda == 'economicos'){
		$query_search = 'SELECT id as id_unidad  FROM ubicacion WHERE ';
	for ($i=0; $i<count($celulas); $i++) {
		if ($i == 0)
			$query_search .= 'Economico = "'.$celulas[$i].'"';
		else
			$query_search .= ' OR Economico = "'.$celulas[$i].'"  '; //ORDER BY Economico ASC
	}
	$query_search .= ' ORDER BY Economico ASC ';
}
elseif($busqueda == 'series'){
	   $query_search = 'SELECT id as id_unidad  FROM ubicacion WHERE ';
	for ($i=0; $i<count($celulas); $i++) {
		if ($i == 0)
			$query_search .= 'Serie = "'.$celulas[$i].'"';
		else
			$query_search .= ' OR Serie = "'.$celulas[$i].'"  '; //ORDER BY Economico ASC
	}
	$query_search .= ' ORDER BY Economico ASC ';
}
// TERMINA DEFINIR TIPO DE BUSQUEDA

$sql_flotilla 	= $query_search;
$res_flotilla 	= mysqli_query($dbd2, $sql_flotilla );


echo "FECHA: ".date('Y-m-d');
echo "<table>";
echo "<tr>
		<th>id_unidad</th>
		<th>ECONOMICO</th>
		<th>MARCA</th>
		<th>SERIE</th>
		<th>VEHICULO</th>
		<th>MODELO</th>
		<th>COLOR</th>
		<th>MOTOR</th>
		<th>CILINDROS</th>
		<th>TRANSMISION</th>
		<th>PLACAS</th>";

echo "	<th>CLIENTE ASG</th>
		<th>CONTRATO ASG</th>
		<th>FECHA ASG</th>";

echo "	<th>CLIENTE UB</th>
		<th>UBICACION UB</th>
		<th>FECHA UB</th>";

echo "<th>GPS</th>";

echo	"</tr>";

while($row = mysqli_fetch_assoc($res_flotilla)){
	$id_unidad 	= $row['id_unidad']; // PARA QUE FUNCIONE LA QUERY DEL HISTORICO
	datosxid($id_unidad);

	$TransTxt = '';
	if($Transmision==1){$TransTxt = 'AUTOMATICA';}
	if($Transmision==2){$TransTxt = 'ESTANDAR';}
	echo "<tr>";

	echo "<td>{$id_unidad}</td>";
	echo "<td>{$Economico}</td>";
	echo "<td>{$Marca}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Modelo}</td>";
	echo "<td>{$Color}</td>";
	echo "<td>{$Motor}</td>";
	echo "<td>{$Cilindros}</td>";
	echo "<td>{$TransTxt}</td>";
	echo "<td>{$Placas}</td>";

	unidadAsignacion($id_unidad);
	clientexid($id_cliente);
	echo '<td>'.$id_cliente.'::: '.$rfc.' ::: '.$razonSocial.'</td>';


	contratoxid($id_contrato);
	echo '<td>ALAN->'.$id_alan.'<-ALAN ::: '.$numero.'</td>';
	echo '<td>'.$fecha_inicioASG.'</td>';

	ubicacionHistorico($id_unidad);
	echo '<td>'.$clienteA.'</td>';
	echo '<td>'.$ubicacionA.'</td>';
	echo '<td>'.$fechaA.'</td>';

	if($_SESSION["gps"] > 0){ // INICIA PUEDE VER GPS
		gpsxid($id_unidad);
		$color = '';
		if($tienegps == 'No'){$color = 'red';}
		echo "<td style='color:$color;'>{$tienegps}</td>";
	} // TERMINA PUEDE VER GPS

	echo '</tr>';

	$clienteA   = '';
	$ubicacionA = '';
	$id_unidad  = '';
	$id_cliente = '';
	$id_contrato = '';
	$fecha_inicioASG = '';
	$id_unidad  = '';
	$fechaA 	= '';
}
echo "</table>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y')."</p>";
?>