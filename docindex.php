<?php
include("1header.php");
if($_SESSION["documentos"] > 2)
{ // VISTA A CONTROL VEHICULAR
	include ("nav_doc.php");
} // FIN PRIVILEGIO VISTA A CONTROL VEHICULAR 
include("1footer.php");?>