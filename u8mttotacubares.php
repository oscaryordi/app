<?php
$sql_MJT = ' SELECT * '
        . ' FROM mttoJtacuba '
        . " WHERE id_unidad = '$id_unidad' "
        . ' ORDER BY '
        . ' id_mttoJ '
        . ' DESC ' ; 

$res_MJT 	= mysqli_query($dbd2, $sql_MJT);
$filas_MJT 	= mysqli_num_rows($res_MJT);

if($filas_MJT > 0){ //APERTURA EJECUTAR SI HUBO ALGO

echo "<table class='ResTabla'>\n";
echo "<caption><a>Mantenimientos Jet Van Tacuba:</caption>";
echo "<tr>
		<th>Folio</th>
		<th>FECHA DE INGRESO</th>
		<th>TIPO DE SERVICIO</th>
		<th>KILOMETRAJE</th>
		<th>DEPENDENCIA</th>
		<th>STATUS</th>
		<th>EDITAR STATUS</th>
		<th>ACUSE EJECUTIVO</th>
	  </tr>";

while($row = mysqli_fetch_assoc($res_MJT)){
	$id_mttoJ = $row['id_mttoJ'];
	$id_unidad = $row['id_unidad'];
	$fechaI = $row['fechaI'];
	$horaI = $row['horaI'];

	datosxid($id_unidad);

	$preventivo = $row['preventivo'];
	if($preventivo == 1){$preventivo = 'PREVENTIVO';} else {$preventivo = '';}

	$frenos = $row['frenos'];
	if($frenos == 1){$frenos = 'FRENOS';} else {$frenos = '';}

	$suspdir = $row['suspdir'];
	if($suspdir == 1){$suspdir = 'SUSPENSION/DIRECCION';} else {$suspdir = '';}

	$clima = $row['clima'];
	if($clima == 1){$clima = 'CLIMA';} else {$clima = '';}

	$motor = $row['motor'];
	if($motor == 1){$motor = 'MOTOR';} else {$motor = '';}

	$transm = $row['transm'];
	if($transm == 1){$transm = 'TRANSMISION';} else {$transm = '';}

	$llantas = $row['llantas'];
	if($llantas == 1){$llantas = 'LLANTAS';} else {$llantas = '';}

	$hojalateria = $row['hojalateria'];
	if($hojalateria == 1){$hojalateria = 'HOJALATERIA';} else {$hojalateria = '';}

	$electrico = $row['electrico'];
	if($electrico == 1){$electrico = 'ELECTRICO';} else {$electrico = '';}


	$status = $row['status'];
	if($status == 1){$status = 'POR ASIGNAR';} 
	elseif($status == 2) {$status = 'EN PROCESO';}
	elseif($status == 3) {$status = 'PENDIENTE/REFACCIONES';}
	elseif($status == 4) {$status = 'TALLER EXTERNO';}
	elseif($status == 5) {$status = 'TERMINADO';}

	$colort = '';
	if($row['status'] == 5){$colort = 'red';}else{$colort = 'black';}

	$ejecutivo = $row['ejecutivo'];

	// CONSULTAR EJECUTIVOS PARA NORMALIZAR TABLA MTTOJTACUBA
	$sql_mttoJt_ejec 	= "SELECT  nombre FROM usuarios WHERE  id_usuario = '$ejecutivo' ";
	$sql_mttoJt_ejec_r 	= mysqli_query($dbd2, $sql_mttoJt_ejec );
	while($row_ejec 	= mysqli_fetch_assoc($sql_mttoJt_ejec_r)){
		$ejecutivo 		= strtoupper($row_ejec['nombre']);
	}
	// CONSULTA EJECUTIVOS

	$cliente 	= $row['cliente'];
	$km 		= $row['km'];
	$actualizado = $row['fechareg'];
	$actualizado = date("d/m/Y H:i:s", strtotime("$actualizado + 2 hours"));
	
	echo "<tr>";
	echo "<td>{$id_mttoJ}</td>";
	echo "<td>{$fechaI}</td>";
	//echo "<td>{$horaI}</td>";
	//echo "<td>{$Placas}</td>";
	//echo "<td>{$Serie}</td>";
	//echo "<td>{$Vehiculo}</td>";
	//echo "<td>{$Color}</td>";

	echo "<td style='font-size:.8em;'>{$preventivo}
		{$frenos}
		{$suspdir}
		{$clima}
		{$transm}
		{$llantas}
		{$hojalateria}
		{$electrico}
		</td>";
	echo "<td>{$km}</td>";

	//echo "<td>{$ejecutivo}</td>";
	echo "<td>{$cliente}</td>"; 
	echo "<td><span style='color:{$colort};' >{$status}</span></td>";
	//echo "<td>{$actualizado}</td>";	

	if($_SESSION["mttos"] > 2){ // SI TERMINADO, YA NO SE PUEDE ACTUALIZAR
	echo "<td >";	
		if($status == 'TERMINADO'){
			echo "TERMINADO";
		}
		else{
		echo "	
		<FORM action='mttoTacubaEditar.php' method='POST' >
			<INPUT TYPE='hidden' NAME='id_mttoJ' value='$id_mttoJ'>
			<INPUT TYPE='hidden' NAME='id_unidad' value='$id_unidad'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ACTUALIZAR' style='font-size:.8em;'>
		</FORM>	";
		}
		echo "</td>"; 
	}else{echo "<td></td>";}

	// CHECAR ACUSE DE EJECUTIVO STATUS 6
	$sql_update = "	SELECT status, fechareg 
					FROM mttoJtacubaStatus 
					WHERE id_mttoJ = '$id_mttoJ' 
					ORDER BY status DESC LIMIT 1 ";
	$sql_update_r 	=  mysqli_query($dbd2, $sql_update );
	$statusUpdated 	= '';
	$fecharegStatus = '';
	while($row_update_r = mysqli_fetch_assoc($sql_update_r)){
		$statusUpdated 	=  $row_update_r['status'];
		$fecharegStatus =  $row_update_r['fechareg'];
		$fecharegStatus = date("d/m/Y H:i:s", strtotime("$fecharegStatus + 2 hours"));
	}
	// CHECAR ACUSE DE EJECUTIVO STATUS 6

	if($_SESSION["mttos"] > 1){ // SI $statusUpdated = 6, YA NO SE PUEDE ACTUALIZAR
	echo "<td >";
		if($statusUpdated == '6'){
			echo "ENTERADO $fecharegStatus";
		}
		elseif($statusUpdated == '5'){
			echo "
			<FORM action='mttoTacubaEditarAcuse.php' method='POST' >
				<INPUT TYPE='hidden' NAME='id_mttoJ' value='$id_mttoJ'>
				<INPUT TYPE='hidden' NAME='id_unidad' value='$id_unidad'>
				<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ACUSE' style='font-size:.8em;'>
			</FORM>	";
		}
	echo "</td>"; 
	}else{echo "<td></td>";}
	echo "</tr>";
}
echo "</table>";

} // CIERRE EJECUTAR SI HUBO ALGO
?>