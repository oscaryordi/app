<?php 
include("1header.php");
if($_SESSION["consultaB"] > 0)
{ // INICIO PRIVILEGIO VISTA A SUPERVISOR
	include ("nav_consultaB.php");
} // FIN PRIVILEGIO VISTA SUPERVISOR
include("1footer.php");?>