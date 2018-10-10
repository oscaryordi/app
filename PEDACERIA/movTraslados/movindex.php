<?php 
include("1header.php");
include_once ("base.inc.php");

if($_SESSION["movForaneo"] > 0){ // VISTA A EJECUTIVOS
	include ("nav_mov.php");
} // FIN PRIVILEGIO VISTA EJECUTIVOS

include("1footer.php");?>