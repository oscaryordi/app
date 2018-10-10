<?php
include("1header.php");

if($_SESSION["externo"] == 0)
{ // PRIVILEGIO VISTA  

echo "<iframe src='https://sistema.jetvan.com.mx/exp/politicas/Politica de Autorizacion de Compras_Rev 3_Jetvan.pdf'  height='900' width='900'></iframe>";
//echo "<iframe src='https://sistema.jetvan.com.mx/$d_ruta/$d_archivo' height='800' width='900'></iframe>";
} // PRIVILEGIO VISTA 
include("1footer.php");
?>