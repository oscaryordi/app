<?php #############################################
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ResumenSiniestros.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php"); 
include_once("funcion.php");
echo "<meta charset='utf-8'>";

//$id_usuario = $_SESSION["id_usuario"];

if($_SESSION["siniestro"] > 1){ // PRIVILEGIO 

// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 2000; //RESULTADOS POR PAGINA

if(isset($_GET['contador'])){
		$pagina = $_GET['contador'];
	}
else{
		$pagina = "1";
	}

if($pagina == "" || $pagina == 1)
{ // AQUI SE CHECA SI TIENE DATO O NO
	$pagina_1 = 0;
}
else
{
	$pagina_1 = ($pagina * $rxpag) - $rxpag;
}

$cuenta;
$cuenta 			= "SELECT COUNT(id_siniestro) cuenta FROM siniestro  ";
$sacar_cuenta 	 	= mysqli_query($dbd2, $cuenta);
$row_cuenta			= mysqli_fetch_array($sacar_cuenta);
$cuenta 			= $row_cuenta['cuenta'];

echo "<h2>RESUMEN DE SINIESTROS</h2>";
echo "<h3>$cuenta REGISTROS</h3>";

?>
<style>
	table, th, td {border: 1px solid #ddd; font-size: 10px;}
</style>
<?php

##### INICIAR ARRAY DE CONTRATOS
$contratosArray[] = '';
$clientesArray[] = '';
##### INICIAR ARRAY DE CONTRATOS


	$sql = 'SELECT * '
        . ' FROM siniestro '
        . ' ORDER BY '
        . ' id_siniestro '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;

echo "<table>";
echo "<tr>
		<th>IDBD SINIESTRO</th>

		<th>ECONOMICO</th>
		<th>PLACAS</th>
		<th>SERIE</th>
		<th>TIPO</th>

		<th>CIUDAD</th>
		<th>MOTIVO</th>
		<th>DE FECHA</th>
		<th>NUMERO S</th>
		<th>STATUS</th>
		<th>CLIENTE</th>
	  </tr>";

$res = mysqli_query($dbd2, $sql);

while($row = mysqli_fetch_assoc($res)){

	$id_unidad 		= $row['id_unidad'];
	$id_siniestro 	= $row['id_siniestro']; // 
	$cdSin 			= $row['cdSin'];
	$motivo			= $row['motivo'];
	$fechaSin 		= $row['fechaSin'];
	$numSin 		= $row['numSin'];
	$status 		= $row['status'];
	$id_cliente 	= $row['id_cliente'];

// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>
			$id_siniestro
		  </td>";

	datosxid($id_unidad);

	echo "<td>{$Economico}</td>";
	echo "<td>{$Placas}</td>";	
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";

	echo "<td>{$cdSin}</td>";
	echo "<td>{$motivo}</td>";
	echo "<td>{$fechaSin}</td>";
	echo "<td>{$numSin}</td>";
	echo "<td>{$status}</td>";

/*
	clientexid($id_cliente);
	echo "<td>$razonSocial</td>";
	$razonSocial = '';	
*/

	if ($id_cliente=='')
	{
		$asinacionTXT = ($id_asignacion=='')?'NO CLIENTE FORMAL':'';
		echo "<td>$asinacionTXT</td>";
	}
	elseif(@$clientesArray[$id_cliente] != '') {
		echo '<td>'.$clientesArray[$id_cliente][1].'</td>';
	}
	else
	{
		clientexid($id_cliente);
		echo '<td>'.$razonSocial.'</td>';
		$clientesArray[$id_cliente][1] = $razonSocial;
	}
	echo "<td>";
	echo "</td>";

	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y')."</p>";
} // FIN PRIVILEGIO