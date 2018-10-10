<?php
include_once('base.inc.php');

// BUSCAR SERIE DE AUTO
@$search1 = mysqli_real_escape_string($dbd2, $_POST['search1']);

if(!empty($search1))
{
	$sql3 = 'SELECT id, Serie '
	. ' FROM '
	. ' ubicacion '
	. " WHERE Serie LIKE '$search1%' LIMIT 10 ";

	$search_query = mysqli_query($dbd2, $sql3);
	if(!$search_query) 
		{
			die('QUERY FAILED' . mysqli_error($dbd2));
		}
	echo "<select name='id_unidad'>";   
	while($row = mysqli_fetch_array($search_query))
		{
			$id = $row['id'];
			$Serie = $row['Serie'];
			echo "<option value='{$id}'>{$Serie}</option>";
		}
		echo "</select>"; 
	$filas 	= mysqli_num_rows($search_query);
	$xz 	= ($filas > 0)?"":"No hay coincidencias en BD";
	echo $xz;
}

// inicio BUSCAR IMEI
@$search2 = mysqli_real_escape_string($dbd2, $_POST['search2']);
if(!empty($search2))
{
	$sql4 = 'SELECT id_imei, imei '
	. ' FROM '
	. ' gpsImei '
	. " WHERE imei LIKE '$search2%' LIMIT 10 ";
		
		$search_query2 = mysqli_query($dbd2, $sql4);
		if(!$search_query2) 
			{
			die('QUERY FAILED' . mysqli_error($dbd2));
			}
		echo "<select name='id_imei'>";   
		while($row = mysqli_fetch_array($search_query2)) {
			$id_imei = $row['id_imei'];
			$imei = $row['imei'];
			echo "<option value='{$id_imei}'>{$imei}</option>";
		}
			echo "</select>"; 
	$filas2 = mysqli_num_rows($search_query2);
	$xz2 = ($filas2 > 0)?"":"No hay coincidencias en BD";
	echo $xz2;
}
// fin BUSCAR IMEI


// inicio BUSCAR LINEA
@$search3 = mysqli_real_escape_string($dbd2, $_POST['search3']);
if(!empty($search3))
{
	$sql5 = 'SELECT id_linea, numero '
	. ' FROM '
	. ' gpsLinea '
	. " WHERE numero LIKE '$search3%' LIMIT 10 ";
		
	$search_query3 = mysqli_query($dbd2, $sql5);
	if(!$search_query3) 
		{
			die('QUERY FAILED' . mysqli_error($dbd2));
		}
	echo "<select name='id_linea'>";   
	while($row = mysqli_fetch_array($search_query3)) {
			$id_linea = $row['id_linea'];
			$linea = $row['numero'];
			echo "<option value='{$id_linea}'>{$linea}</option>";
		}
			echo "</select>"; 
	$filas3 = mysqli_num_rows($search_query3);
	$xz3 = ($filas3 > 0)?"":"No hay coincidencias en BD";
	echo $xz3;
}
// fin BUSCAR LINEA


// inicio BUSCAR SIM
@$search4 = mysqli_real_escape_string($dbd2, $_POST['search4']);
if(!empty($search4))
{
	$sql6 = 'SELECT id_sim, numeroSim '
	. ' FROM '
	. ' gpsSim '
	. " WHERE numeroSim LIKE '$search4%' LIMIT 10 ";

	$search_query4 = mysqli_query($dbd2, $sql6);
	if(!$search_query4) 
		{
			die('QUERY FAILED ' . mysqli_error($dbd2));
		}
	echo "<select name='id_sim'>";   
	while($row = mysqli_fetch_array($search_query4)) {
			$id_sim = $row['id_sim'];
			$numeroSim = $row['numeroSim'];
			echo "<option value='{$id_sim}'>{$numeroSim}</option>";
		}
	echo "</select>"; 
	$filas4 = mysqli_num_rows($search_query4);
	$xz4 = ($filas4 > 0)?"":"No hay coincidencias en BD";
	echo $xz4;
}
// fin BUSCAR SIM
?>