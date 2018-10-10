<?php include("1header.php");
?>
<meta charset='utf-8'>
<?php

define('DB_SERVER', '50.63.236.78');
define('DB_SERVER_USERNAME', 'jetvantlc');
define('DB_SERVER_PASSWORD', 'Jetvan12#');
define('DB_DATABASE', 'jetvantlc');

$conexion4 = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE); // DEL CODIGO ORIGINAL

?>

<form action="consultaBloque.php" method="post">
    <p><label>Escribe en el siguiente campo las SERIES a buscar:</label></p>
    <p><textarea name="celulas" rows="7" cols="40"><?php echo @$_POST['celulas']; ?></textarea></p>
    <p><input type="submit" name="search" value="Buscar" /></p>
</form>

<?php
if (isset($_POST['search'])) {
    $celulas = trim($_POST['celulas']);
    $celulas = trim(preg_replace('/\s\s+/', '', $celulas));
    $celulas = str_replace(' ',"",$celulas);
    $celulas = explode(',', $celulas);

    $query_search = 'SELECT id, Economico, Serie, Vehiculo, Modelo, Color FROM ubicacion WHERE ';
    for ($i=0; $i<count($celulas); $i++) {
        if ($i == 0)
            $query_search .= 'Serie = "'.$celulas[$i].'"';
        else
            $query_search .= ' OR Serie = "'.$celulas[$i].'"';
    }

    $search = $conexion4->query($query_search);

    $consecutivo = 0;
    if ($search->num_rows > 0) {
        
        echo '<table border="1" cellpadding="5" cellspacing="5">';
        echo '<tr>';
        echo '<th>LISTADO</th>';
        echo '<th>ECONOMICO</th>';
        echo '<th>SERIE</th>';
        echo '<th>VEHICULO</th>';
        echo '<th>MODELO</th>';
        echo '<th>PLACAS</th>';
        echo '</tr>';    
        while ($row_searched = $search->fetch_array()) { 
            $consecutivo++ ;          
            echo '<tr>';
            echo '<td>'.$consecutivo.'</td>';
            echo '<td>'.$row_searched['Economico'].'</td>';
            echo '<td>'.$row_searched['Serie'].'</td>';
            echo '<td>'.$row_searched['Vehiculo'].'</td>';
            echo '<td>'.$row_searched['Modelo'].'</td>';
            $id_unidad = $row_searched['id'];
            datosxid($id_unidad);
            echo '<td>'.$Placas.'</td>';
            echo '</tr>';
            $id_unidad = '';            
        }
        echo '</table><br/>';
    }
    else {
        echo '<div class="info">No hay resultados para los criterios de búsqueda.</div>';
    }   
}

include("1footer.php");?>