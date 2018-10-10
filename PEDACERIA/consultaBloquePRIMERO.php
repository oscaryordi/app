<?php include("1header.php");
?>
<meta charset='utf-8'>
<?php

define('DB_SERVER', '50.63.236.78');
define('DB_SERVER_USERNAME', 'jetvantlc');
define('DB_SERVER_PASSWORD', 'Jetvan12#');
define('DB_DATABASE', 'jetvantlc');

/*
$servername = "50.63.236.78";
$username   = "jetvantlc";
$password   = "Jetvan12#";
*/

/*
try {
    $conexionPOO = new PDO("mysql:host=$servername;dbname=$username", $username, $password);
    // set the PDO error mode to exception
    $conexionPOO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


//$conexion = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE); // DEL CODIGO ORIGINAL

*/

//$conexion4 = new mysqli($servername, $username, $password, $username); // SI FUNCIONO CON VARIABLES

// PRUEBA CON CONSTANTES
$conexion4 = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE); // DEL CODIGO ORIGINAL

?>


<form action="consultaBloque.php" method="post">
    <p><label>Escribe en el siguiente campo las SERIES a buscar:</label></p>
    <p><textarea name="celulas" rows="7" cols="40"><?php echo @$_POST['celulas']; ?></textarea></p>
    <p><input type="submit" name="search" value="Buscar" /></p>
</form>

<?php
if (isset($_POST['search'])) {
    $celulas = explode(',', $_POST['celulas']);

    $query_search = 'SELECT Economico, Serie, Vehiculo, Modelo, Color FROM ubicacion WHERE ';
    for ($i=0; $i<count($celulas); $i++) {
        if ($i == 0)
            $query_search .= 'Serie = "'.$celulas[$i].'"';
        else
            $query_search .= ' OR Serie = "'.$celulas[$i].'"';
    }

    $search = $conexion4->query($query_search);
   // $search = $conexion4->query($query_search);

    if ($search->num_rows > 0) {
        echo '<table border="1" cellpadding="5" cellspacing="5">';
        echo '<tr>';
        echo '<td><strong>ECONOMICO</strong></td>';
        echo '<td><strong>SERIE</strong></td>';
        echo '<td><strong>VEHICULO</strong></td>';
        echo '<td><strong>MODELO</strong></td>';
        echo '</tr>';    
        while ($row_searched = $search->fetch_array()) {                
            echo '<tr>';
            echo '<td>'.$row_searched['Economico'].'</td>';
            echo '<td>'.$row_searched['Serie'].'</td>';
            echo '<td>'.$row_searched['Vehiculo'].'</td>';
            echo '<td>'.$row_searched['Modelo'].'</td>';
            echo '</tr>';            
        }
        echo '</table><br/>';
    }
    else {
        echo '<div class="info">No hay resultados para los criterios de búsqueda.</div>';
    }   
}


include("1footer.php");?>