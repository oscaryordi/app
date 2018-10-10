<?php
$TipoBusqueda = "HISTORICO UBICACION";
include '1header.php';
if($_SESSION["movimientos"] > 1){  // APERTURA PRIVILEGIOS<!--UBICACION HISTORICO-->

$uNEco = $_GET['uNEco'];

echo "<h2>".$uNEco."</h2><br />";

include ("1datos.php");
include ("1placas.php");


##### UBICACION
#$sql2 = "SELECT `cliente`,`ubicacion`,`fechaRegistro` FROM `movimientos` WHERE `economico` = $uNEco ORDER BY `fechaRegistro` DESC limit 1";

//$uNEco = 2131187;

$sqluh = 'SELECT `mt_fecha_movimiento` fecha, `mt_proyecto_d` proyecto, `mt_ubicacion_d` ubicacion '
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

$resultadouh = mysqli_query($dbd2, $sqluh);
//@$matrizuh = mysqli_fetch_array($resultadouh); // quita la primera linea cuando se ejecuta la tabla de abajo

$dn = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$mn = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
@$hoy3 = getdate(strtotime($matriz2[fecha]));
##### UBICACION


@$camposuh = mysqli_num_fields($resultadouh);
@$filasuh = mysqli_num_rows($resultadouh);


echo "<fieldset><legend>Histórico de Ubicación</legend> \n";

echo "<table>\n"; // Empezar tabla
	echo "<tr><th colspan=3 >CANTIDAD DE MOVIMIENTOS ENCONTRADOS: <b>$filasuh</b></th></tr>\n";
	echo "<tr>"; // Crear fila
for ($i = 0;$i < $camposuh;$i++) {
    $nombrecampouh = mysqli_field_name($resultadouh, $i);
    echo "<th>$nombrecampouh</th>";
	} 
	echo "</tr>\n"; // Cerrar fila
while (@$rowuh = mysqli_fetch_assoc($resultadouh)) {
    echo "<tr>"; // Crear fila
    foreach ($rowuh as $key => $value) {
        echo "<td>$value</td>";
    } 
} 
echo "</table>\n"; // Cerrar tabla
echo "</fieldset>";

//<!--UBICACION HISTORICO-->

} // CIERRE PRIVILEGIOS
include '1footer.php'; ?>