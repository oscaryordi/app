<?php
include("1header.php");

if($_SESSION["asigna"] > 1 OR $_SESSION["asigcto"] > 1){ // VISTA A Gerencia Ventas Gobierno
	include ("nav_asigna.php");
} // FIN PRIVILEGIO VISTA Gerencia Ventas Gobierno

include("1footer.php");?> 