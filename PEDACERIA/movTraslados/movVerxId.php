<?php 
include("1header.php");
include_once ("base.inc.php");

if($_SESSION["movForaneo"] > 0){ // VISTA A EJECUTIVOS
	include ("nav_mov.php");


$id_movForR = $_GET['id_movFor'];

echo "<h2>TRASLADO BD : $id_movForR </h2>";
echo "<p>";

include('trasladoRegistrado.php');

echo "</p>";

} // FIN PRIVILEGIO VISTA EJECUTIVOS

include("1footer.php");?>