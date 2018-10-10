<!-- ########### CUADRO RESUMEN FLOTILLA ########## -->
<?php //URGE ACTUALIZAR

# RECUADRO BASADO EN CLAVE VEHICULAR
if($_SESSION["clientes"] > 0){  // APERTURA PRIVILEGIOS

$sql = "SELECT  COUNT( u.claveVehicular ) cuenta,  u.claveVehicular 
        FROM asignaUactual aua
        JOIN ubicacion u 
        ON u.id = aua.id_unidad
        WHERE id_contrato = '$id_contrato'
        GROUP BY claveVehicular
        ORDER BY claveVehicular ASC "; 

$res        = mysqli_query($dbd2, $sql);
@$campos    = mysqli_num_fields($res);
@$filas     = mysqli_num_rows($res);


echo "  <fieldset>
        <legend>Cuadro Resumen de Flotilla
        </legend>
        <table>"; // Empezar tabla
echo "  <caption>
        <a>TOTAL DE UNIDADES: <b>$filas CLAVES VEHICULARES DIFERENTES</b>   ";
echo "  </a>
        </caption>";

    echo "<tr>"; // Crear fila
    echo "<th>Unidades</th>";
    echo "<th>Clave Vehicular</th>";
 
    echo "<th>Modelo</th>";
    echo "<th>Version</th>";
   // echo "<th>Empresa</th>";
    echo "</tr>"; // Cerrar fila

    while (@$row = mysqli_fetch_assoc($res)) 
    {
        $cuenta         = $row['cuenta'];
        $ClaveVehicular = $row['claveVehicular'];

        cVehicularxid($ClaveVehicular);

        echo "<tr>"; // Crear fila
        echo "<td>$cuenta</td>";
        echo "<td>$ClaveVehicular</td>";
        echo "<td>$cVmodeloDescrip</td>";
        echo "<td>$cVehicularDescrip</td>";
        //echo "<td>$cVempresaDescrip</td>";
        echo "</tr>"; // Cerrar fila
    } 
echo "</table></fieldset>\n"; // Cerrar tabla
} // CIERRE PRIVILEGIOS  
# RECUADRO BASADO EN CLAVE VEHICULAR

?>
<!-- ########### CUADRO RESUMEN FLOTILLA ########## -->