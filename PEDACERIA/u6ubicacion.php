<!--UBICACION-->
<?php
if($_SESSION["movimientos"] > 0){  // puede ver movimientos???

##### UBICACION
#$sql2 = "SELECT `cliente`,`ubicacion`,`fechaRegistro` FROM `movimientos` WHERE `economico` = $uNEco ORDER BY `fechaRegistro` DESC limit 1";

$sql2 =   ' SELECT `mt_fecha_movimiento` fecha, `mt_proyecto_d` proyecto, `mt_ubicacion_d` ubicacion '
		. ' FROM `movimientos_tacuba` '
		. " WHERE `id_unidad`= $id_unidad "
		. ' UNION '

		. ' SELECT `fechaRegistro` fecha, `cliente` proyecto, `ubicacion` ubicacion '
		. ' FROM movimientos '
		. " WHERE `id_unidad`= $id_unidad "
		. ' UNION '

		. " SELECT CONCAT( fecharecepcion, ' ', `hora_entrada` ) fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion "
		. ' FROM formato_inventario '
		. " WHERE `id_unidad`= $id_unidad AND `proyecto_destino` LIKE '%JETVAN%' "
		. ' UNION '
		
		. " SELECT CONCAT( fechaentrega, ' ', `hora_salida` ) fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion "
		. ' FROM formato_inventario '
		. " WHERE `id_unidad`= $id_unidad AND `hora_salida` > '0:00' "

		. ' ORDER BY fecha DESC ';


$resultado2 = mysql_query($sql2);
@$matriz2 	= mysql_fetch_array($resultado2);

$dn 	= array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$mn 	= array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
		"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
@$hoy3 	= getdate(strtotime($matriz2[fecha]));
##### UBICACION


echo "<td></td>\n";



?>
<fieldset><legend>Ubicación</legend>
<table>
<tr><th>Ubicacion</th><td><?echo @$matriz2[proyecto];?> / <?echo @$matriz2[ubicacion];?></td></tr>
<tr><th>Fecha del Reporte</th>
	<td><? $fvacia = (@$matriz2[fecha] !== NULL)? $dn[$hoy3['wday']].", ".$hoy3['mday']." de ".$mn[$hoy3['mon']-1]." de ".$hoy3['year']:" No hay fecha";
	echo $fvacia; ?> 
	
	<?php if($_SESSION["movimientos"] > 1){  // VER HISTORICO // APERTURA PRIVILEGIOS ?>	
	<a href='u6ubicacionhist.php?id_unidad=<?php echo "$id_unidad";?>' >
	<button type='button' title='Ver historico de movimientos'>
	Ver histórico</button></a>
	<?php } // VER HISTORICO // CIERRE PRIVILEGIOS 


	if($_SESSION["direccion"] > 0 || $_SESSION["compra"] > 0 || $_SESSION["movForaneo"] > 0){  // EDITAR UBICACION // APERTURA PRIVILEGIOS ?>	
	<a href='u6ubicacioneditar.php?id_unidad=<?php echo "$id_unidad";?>' >
	<button type='button' title='Editar ubicacion'>
	Actualizar Ubicación</button></a>
	<?php } // EDITAR UBICACION // CIERRE PRIVILEGIOS


	if($_SESSION["movForaneo"] > 0 ){  // REGISTRAR TRASLADO // APERTURA PRIVILEGIOS ?>	
	<a href='movTrasladoRF.php?id_unidad=<?php echo "$id_unidad";?>' >
	<button type='button' title='Registrar Traslado'>
	Registrar Traslado</button></a>
	<?php } // EDITAR UBICACION // CIERRE PRIVILEGIOS


	if($_SESSION["movForaneo"] > 0 ){  // HISTORICO TRASLADOS ?>	
	<a href='movResUno.php?id_unidad=<?php echo "$id_unidad";?>' >
	<button type='button' title='Historico Traslados'>
	Histórico Traslados</button></a>
	<?php } // HISTORICO TRASLADOS ?>  


	</td>
</tr>
</table>
</fieldset>
<!--UBICACION-->
<?} // CIERRE PRIVILEGIOS puede ver movimientos ?>