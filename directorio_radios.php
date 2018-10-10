<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["gerencia"] > 0)
{  // APERTURA PRIVILEGIOS 
    include("nav_gerencia.php");
    $sql_directorio = 'SELECT * FROM `directorio` LIMIT 0, 100 '; 

    $res_directorio     = mysqli_query($dbd2, $sql_directorio);
    @$campos_directorio = mysqli_num_fields($res_directorio);
    @$filas_directorio  = mysqli_num_rows($res_directorio);

    echo "<fieldset><legend>DIRECTORIO DE RADIOS</legend>
            <table class='ResTabla' >"; // Empezar tabla
    echo "<caption>Total radios: <b>$filas_directorio</b></caption>";
    echo "<tr>"; // Crear fila
        echo "<th>#</th>";
        echo "<th>NOMBRE</th>";
        echo "<th>TELEFONO</th>";
        echo "<th>ID</th>";
        echo "<th>PUESTO</th>";
    echo "</tr>"; // Cerrar fila

    while (@$row = mysqli_fetch_assoc($res_directorio)) 
    {
    echo "<tr>"; // Crear fila
        foreach ($row as $key => $value)
        {
            echo "<td>$value&nbsp;</td>";
        } 
    echo "</tr>"; // Cerrar fila
    } 
    echo "</table></fieldset>"; // Cerrar tabla
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>