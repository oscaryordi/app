<?php
$TipoBusqueda = "";
include ("1header.php"); ?>
<style>
td{ font-size:.85em;}
a img {width:163px;height:70px;}
th {background-color:#016155;FONT-SIZE: .65em; FONT-FAMILY: Arial; COLOR: white; padding: 1px 4px;border-radius: 5px;}
</style>
<!--BITACORA MANTENIMIENTO-->
<fieldset><legend>Bitacora de Mantenimiento</legend>
<?
$sql3 = 'SELECT '
		. '	b.`fecha` FECHA, '
		. '	b.`cliente` CLIENTE,'
		. '	b.`economico` ECONOMICO, '
        . ' u.Vehiculo VEHICULO, '
        . ' b.`km` KM, '
		. '	b.`concepto` CONCEPTO, '
		. "	concat('$', format((b.`importe`), 2)) IMPORTE, "
		. '	b.autorizado AUTORIZADO, '
		. '	b.pagado PAGADO '
		. ' FROM '
        . ' `bitacora` b '
        . ' LEFT JOIN'
        . ' ubicacion u '
        . ' ON '
        . ' u.Economico = b.economico '
        . ' WHERE solicita = \'GANEM\' ORDER BY b.fecha DESC '; 

echo "<table class='table   table-hover table-condensed'>\n";
echo "<tr><th>FECHA</th><th>CLIENTE</th><th>ECONOMICO</th><th>VEHICULO</th><th>KM</th><th>CONCEPTO</th><th>IMPORTE</th><th>AUTORIZADO</th><th>PAGADO</th><th>VER HISTORIAL</th></tr>";
$res3 = mysqli_query($dbd2, $sql3);
while($row = mysqli_fetch_assoc($res3)){
	$fecha 		= $row['FECHA'];
	$cliente 	= $row['CLIENTE'];
	$economico 	= $row['ECONOMICO'];
	$vehiculo 	= $row['VEHICULO'];
	$km 		= $row['KM'];
	$concepto 	= $row['CONCEPTO'];
	$importe 	= $row['IMPORTE'];
	$autorizado = $row['AUTORIZADO'];
	$pagado 	= $row['PAGADO'];
	
	echo "<tr>";
	echo "<td>{$fecha}</td>";
	echo "<td>{$cliente}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$vehiculo}</td>";
	echo "<td>{$km}</td>";
	echo "<td>{$concepto}</td>";
	echo "<td>{$importe}</td>";

	echo "<td><a href='#'><button type='button' class='";
	if($autorizado == 'autorizado'){echo "btn btn-success  btn-sm";} 
	else {echo "btn btn-warning  btn-sm";}
	echo "'> $autorizado </button></a></td>";

	echo "<td><a href='#'><button type='button' class='";
	if($pagado == 'si'){echo "btn btn-success  btn-sm";} 
	else {echo "btn btn-warning  btn-sm";}
	echo "'> $pagado </button></a></td>";
	
	echo "<td><a href='unidadMtto.php?uNEco=".$economico."'><button type='button' class='btn btn-success  btn-sm'>
	<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> Bitacora</button></a></td>";
	echo "</tr>";
}
echo "</table>";

?>
</fieldset>
<br />
<form action="index.html"><input id="gobutton" type="submit" name="enviar" value="Consultar Otro" class='btn btn-primary ' ></form>
<br />
<hr/>
<address>&copy Jet Van Car Rental, S.A. de C.V.
<br /><font size=1.5>Pensilvania 131-1, Col. Napoles, Del. Benito Juárez, 
<br />México, D.F., C.P. 03810 
<br />Call-Center 01 800 822 7737, Tel. 01 55 5527 1161
<br /> RFC JCR040721NU2</font></address>
<br />
<br />
<?php include 'poweredby.php'; ?>
</body>
</html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>