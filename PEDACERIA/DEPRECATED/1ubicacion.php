<!--UBICACION-->
<?php if($_SESSION["movimientos"] > 0){  // puede ver movimientos??? ?>
<?
##### UBICACION
#$sql2 = "SELECT `cliente`,`ubicacion`,`fechaRegistro` FROM `movimientos` WHERE `economico` = $uNEco ORDER BY `fechaRegistro` DESC limit 1";

$sql2 = 'SELECT `mt_fecha_movimiento` fecha, `mt_proyecto_d` proyecto, `mt_ubicacion_d` ubicacion '
        . ' FROM `movimientos_tacuba` '
        . " WHERE `mt_economico` = $uNEco "
        . ' UNION '

        . ' SELECT `fechaRegistro` fecha, `cliente` proyecto, `ubicacion` ubicacion '
        . ' FROM movimientos '
        . " WHERE `economico` = $uNEco "
        . ' UNION '

        . ' SELECT `fecharecepcion` fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion '
        . ' FROM formato_inventario '
        . " WHERE `economico` = $uNEco AND `proyecto_destino` LIKE '%JETVAN%' "
        . ' UNION '
		
        . ' SELECT `fechaentrega` fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion '
        . ' FROM formato_inventario '
        . " WHERE `economico` = $uNEco AND `hora_salida` > '0:00' "		

        . ' ORDER BY fecha DESC '; 

	
		
$resultado2 = mysql_query($sql2);
@$matriz2 = mysql_fetch_array($resultado2);

$dn = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$mn = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
@$hoy3 = getdate(strtotime($matriz2[fecha]));
##### UBICACION


echo "<td></td>\n";
	


?>
<fieldset><legend>Ubicación</legend>
<table>
<tr><th>Ubicacion</th><td><?echo @$matriz2[proyecto];?> / <?echo @$matriz2[ubicacion];?></td></tr>
<tr><th>Fecha del Reporte</th><td><? $fvacia = (@$matriz2[fecha] !== NULL)? $dn[$hoy3['wday']].", ".$hoy3['mday']." de ".$mn[$hoy3['mon']-1]." de ".$hoy3['year']:" No hay fecha";
	echo $fvacia; ?> 
	
	<?php if($_SESSION["movimientos"] > 1){  // APERTURA PRIVILEGIOS ?>	
	<a href='ubicacion_historico.php?uNEco=<?php echo "$uNEco";?>' >
	<button type='button' title='Ver historico de movimientos'>
	<span style='font-size:1.4em'>&#9925;</span>Ver histórico</button></a>
	<?php } // CIERRE PRIVILEGIOS ?>
	
	</td></tr>
</table>
</fieldset>
<!--UBICACION-->
<?} // CIERRE PRIVILEGIOS puede ver mantenimientos ?>