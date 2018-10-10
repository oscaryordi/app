<?php include("1header.php");?>
<!-- CANDADO PRIVILEGIO -->
<?php if($_SESSION["movimientos"] > 2){  // APERTURA PRIVILEGIOS ?>

<?php include ("base.inc.php"); ?>
<?php include("funcion.php"); ?>

<?php

@$uPlacas = limpiarVariable($_POST['uPlacas']);
@$uNEco = limpiarVariable($_POST['uNEco']);
@$uSerie = limpiarVariable($_POST['uSerie']);

if(isset($_POST['Movimientos'])){ // SI EL FORMULARIO SE LLENO PROCEDE CONSULTA

// OBTENER ECONOMICO
	if(isset($uPlacas) && $uPlacas !== ''){
		datosporplaca($uPlacas);
		}
	elseif(isset($uNEco) && $uNEco !== ''){
		datosporeconomico($uNEco);
		}
	elseif(isset($uSerie) && $uSerie !== ''){
		datosporserie($uSerie);
	}

// ASIGNAR A VARIABLE QUE SE CONSULTARA
$uNEco = $Economico;

echo "<h2>".$Economico." - ".$Placas." - ".$Serie." - ".$Vehiculo." - ".$Modelo."</h2><br />";

$sqluh = 'SELECT `mt_fecha_movimiento` fecha, `mt_proyecto_d` proyecto, `mt_ubicacion_d` ubicacion, mt_no_formato NroInventario '
        . ' FROM `movimientos_tacuba` '
        . " WHERE `mt_economico` = $uNEco "
        . ' UNION '

        // . ' SELECT `fechaRegistro` fecha, `cliente` proyecto, `ubicacion` ubicacion '
        // . ' FROM movimientos '
        // . " WHERE `economico` = $uNEco "
        // . ' UNION '

        . ' SELECT `fecharecepcion` fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion, numero_inventario NroInventario '
        . ' FROM formato_inventario '
        . " WHERE `economico` = $uNEco AND `proyecto_destino` LIKE '%JETVAN%' "
        . ' UNION '
		
        . ' SELECT `fechaentrega` fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion, numero_inventario NroInventario  '
        . ' FROM formato_inventario '
        . " WHERE `economico` = $uNEco AND `hora_salida` > '0:00' "		

        . ' ORDER BY fecha DESC '; 

$resultadouh = mysql_query($sqluh);

$dn = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$mn = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
@$hoy3 = getdate(strtotime($matriz2[fecha]));
##### UBICACION

@$camposuh = mysql_num_fields($resultadouh);
@$filasuh = mysql_num_rows($resultadouh);


echo "<fieldset><legend>Histórico de Ubicación</legend> \n";

echo "<table>\n"; // Empezar tabla
	echo "<tr><th colspan=3 >CANTIDAD DE MOVIMIENTOS ENCONTRADOS: <b>$filasuh</b></th></tr>\n";
	echo "<tr>"; // Crear fila
for ($i = 0;$i < $camposuh;$i++) {
    $nombrecampouh = mysql_field_name($resultadouh, $i);
    echo "<th>$nombrecampouh</th>";
	} 
	echo "</tr>\n"; // Cerrar fila
while (@$rowuh = mysql_fetch_assoc($resultadouh)) {
    echo "<tr>"; // Crear fila
    foreach ($rowuh as $key => $value) {
        echo "<td>$value</td>";
    } 
} 
echo "</table>\n"; // Cerrar tabla
echo "</fieldset>";


}


?>









<h2>CONSULTAS A BITACORA DE ENTRADAS Y SALIDAS</h2>
<fieldset><legend>Consultar Unidad</legend>
<table>
	<FORM action="registrofisico_consultas.php" method="POST">
		<tr>
			<th colspan=4 >Indique uno de los 3 siguientes datos.</th>
		</tr>
		<tr>
			<td>Económico<INPUT TYPE="text" NAME="uNEco" placeholder="Pon aqui el economico"></td>
			<td>Placas<INPUT TYPE="text" NAME="uPlacas" placeholder="Aqui van las placas" autofocus></td>
			<td>Serie<INPUT   TYPE="text" NAME="uSerie" placeholder="Aqui la serie"></td>
			<td colspan=3 align=center ><INPUT id="gobutton2" TYPE="SUBMIT" NAME="Movimientos" VALUE="Ver movimientos"></td>
		</tr>		
	</FORM>
</table>
</fieldset> 


<?php if($_SESSION["movimientos"] > 2){ // SE HABILITA VISTA A SUPERVISOR BRENDA OMAR ?>
<form action="paginacion_salidas.php" class="navegacion"><input id="gobutton2" type="submit" name="salidaspaginacion" value="Ver todas las Salidas"></form>
<?php } ?>
<?php if($_SESSION["movimientos"] > 2){ // SE HABILITA VISTA A SUPERVISOR BRENDA OMAR ?>
<form action="paginacion_entradas.php" class="navegacion"><input id="gobutton2" type="submit" name="entradaspaginacion" value="Ver todas las Entradas"></form>
<?php } ?>



<?php } // CIERRE PRIVILEGIOS ?>
<?php include("1footer.php");?>