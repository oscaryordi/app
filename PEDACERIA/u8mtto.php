<!-- ########### BITACORA MANTENIMIENTO BASADA EN ID_UNIDAD ########## -->
<?php if($_SESSION["mttos"] > 0){  // puede ver mantenimientos??? ?>
<fieldset>
<?php 
echo "<p>";
	if($_SESSION["mttoSol"] > 1 && isset($id_contrato)){  // SOLICITAR MANTENIMIENTO
		echo "<a href='mttoSol.php?id_unidad=".@$id_unidad."&id_contrato=".$id_contrato."&id_cliente=
			".$id_cliente."' >
			<button type='button' title='mantenimiento'>Solicitar Mantenimiento</button></a>\n";
	} // SOLICITAR MANTENIMIENTO


	

	if($_SESSION["mttoSol"] > 1){ 
	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    echo "
        <a href='mttoSolRes.php?pagina=$paginaRM' style='text-decoration:none;'><INPUT  TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen de Mantenimiento'></a>
         ";
 	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    }    


	if($_SESSION["mttoSolAut"] > 0){ 
	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    echo "
        <a href='mttoSolResAutSR.php?pagina=$paginaRM' style='text-decoration:none;'><INPUT  TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen de AUTORIZACION'></a>
         ";
 	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    }    



	if($_SESSION["mttos"] > 2){  // REGISTRAR MANTENIMIENTO JET VAN TACUBA
		echo "<a href='u8mttotacuba.php?id_unidad=".$id_unidad."' >
			<button type='button' title='mttoTacuba'>Mtto Jet Van Tacuba</button></a>\n";
	} // REGISTRAR MANTENIMIENTO JET VAN TACUBA
echo "</p>";
?>


<?php include("mttoSolResUnidad.php"); ?>



<legend>Bitacora de Mantenimiento</legend>

<?php
$sql3 = "SELECT `fecha` as `Fecha del Servicio`, `proveedor` as `Taller o Agencia`, 
		`importe` as `Costo`, `concepto` as `Descripcion`, `cliente` as `Cliente-Proyecto`, 
		`km` as `Kilometraje` FROM `bitacora` 
		WHERE `id_unidad` = $id_unidad  ORDER BY fecha DESC LIMIT 0, 30 ";
$res3 	= mysql_query($sql3);
@$campos3 = mysql_num_fields($res3);
@$filas3 = mysql_num_rows($res3);


echo "<table>\n"; // Empezar tabla
echo "<caption><a>Cantidad de mantenimientos encontrados: <b>$filas3</b>   ";
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


<?php include("u8mttotacubares.php"); ?>

</fieldset>
<?} // CIERRE PRIVILEGIOS puede ver mantenimientos ?>
<!-- ########### BITACORA MANTENIMIENTO BASADA EN ID_UNIDAD ########## -->