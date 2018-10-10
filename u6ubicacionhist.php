<?php
$TipoBusqueda = "HISTORICO UBICACION";
include '1header.php'; 

$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";    
    
include ("u4datos.php");
include ("u5placas.php");

if($_SESSION["movimientos"] > 1   or $_SESSION["almacen"] > 0   ){  // APERTURA PRIVILEGIOS

ubicacionHistoricoM($id_unidad);


@$camposuh  = mysqli_num_fields($resultadouhf); // OBTENER CAMPOS
@$filasuh   = mysqli_num_rows($resultadouhf); // OBTENER FILAS

echo "<fieldset><legend>Folios Formato Inventario</legend>";
echo "<section><table><caption>Inventario encontrados: <b>$filasuh</b></caption>"; 
echo "<tr>
        <th>FECHA</th>
        <th>PROYECTO</th>
        <th>UBICACION</th>
        <th>INVENTARIO</th>
      </tr>";

while($row = mysqli_fetch_assoc($resultadouhf))
{
    $u_fecha        = $row['fecha'];    
    $u_proyecto     = $row['proyecto'];
    $u_ubicacion    = $row['ubicacion'];
    $u_inventario   = $row['NroInventario'];
    $u_id           = $row['id'];
    $fuente         = $row['fuente'];
    
    echo "<tr>";
        echo "<td>{$u_fecha}</td>";
        echo "<td>{$u_proyecto}</td>";
        echo "<td>{$u_ubicacion}</td>"; 

        if($fuente == 3){
            echo "<td><a href='formato_vista_id.php?id_inventario=".$u_id."'>Inventario {$u_inventario}</a></td>";
        }
        elseif($fuente == 4){
            echo "<td><a href='movVerxId.php?id_movFor=".$u_id."&pagina=0'>Traslado {$u_inventario}</a></td>";
        }
        else
        {
            echo "<td>Sin documento</td>";
        }
    echo "</tr>";
}
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";


} // CIERRE PRIVILEGIOS 

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<p>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </p>";


include '1footer.php';?>