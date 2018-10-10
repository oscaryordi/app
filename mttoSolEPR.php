<?php

$sql_mttoSolEP 	= "	SELECT id_prov_c FROM `mttoSol` 
					WHERE `id_mttoSol` = '$id_mttoSol' LIMIT 1 ";
$sql_mttoSol_REP = mysqli_query($dbd2, $sql_mttoSolEP);
$sql_mttoSol_MEP = mysqli_fetch_array($sql_mttoSol_REP);

$id_prov_cED		= 	$sql_mttoSol_MEP['id_prov_c'];
provCtaxid($id_prov_cED);

?>
<h3>DATOS NUEVOS</h3>
<table>
	<tr>
		<td>
 
			<b>PAGO</b> 
			<br>Clabe: 
			<?php echo "&nbsp". $PCclabe; // REEMBOLSO ?>
			<br>Cuenta:
			<?php echo "&nbsp". $PCcuenta ; // REEMBOLSO ?>
			<br>Sucursal:
			<?php echo "&nbsp". $PCsucursal; // REEMBOLSO ?>
			<br>Banco:
			<?php echo "&nbsp". $PCbanco; // REEMBOLSO ?>
 
		</td>
	</tr>
</table>