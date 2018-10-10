<!--BITACORA MANTENIMIENTO-->
<?php if($_SESSION["mttos"] > 0){  // puede ver mantenimientos??? ?>
<fieldset><legend>Bitacora de Mantenimiento</legend>
<?
$sql3 = "SELECT `fecha` as `Fecha del Servicio`, `proveedor` as `Taller o Agencia`, 
		`importe` as `Costo`, `concepto` as `Descripcion`, `cliente` as `Cliente-Proyecto`, 
		`km` as `Kilometraje` FROM `bitacora` 
		WHERE `economico` = $uNEco  ORDER BY fecha DESC LIMIT 0, 30 ";
$res3 = mysql_query($sql3);
@$campos3 = mysql_num_fields($res3);
@$filas3 = mysql_num_rows($res3);


echo "<table>\n"; // Empezar tabla
echo "<caption><a>Cantidad de mantenimientos encontrados: <b>$filas3</b>   ";

			if($_SESSION["mttos"] > 1){  // APERTURA PRIVILEGIOS
			
				echo "<a href='mantenimiento.php?uNEco=".@$uNEco."' ><button type='button' title='mantenimiento'><span style='font-size:1.4em'>&#9881;</span>Mantenimiento</button></a>\n";
			
			} // CIERRE PRIVILEGIOS

echo "</a></caption>\n";
	echo "<tr>"; // Crear fila
for ($i = 0;$i < $campos3;$i++) {
    $nombrecampo = mysql_field_name($res3, $i);
    echo "<th>$nombrecampo</th>";
	} 
	echo "</tr>\n"; // Cerrar fila
while (@$row = mysql_fetch_assoc($res3)) {
    echo "<tr>"; // Crear fila
    foreach ($row as $key => $value) {
        echo "<td>$value&nbsp;</td>";
    } 
    echo "</tr>\n"; // Cerrar fila
} 
echo "</table>\n"; // Cerrar tabla
?>
</fieldset>
<?} // CIERRE PRIVILEGIOS puede ver mantenimientos ?>