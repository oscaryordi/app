<?php 

if($_SESSION["mttoSolPag"] > 0){ // RESUMEN TODO ?>
<form action="pagosResTodo.php" class="navegacion">
<input id="gobutton2" type="submit" name="solicitudesValidadas" value="Solicitudes con Vo.Bo."></form>
<?php }


if($_SESSION["mttoSolPag"] > 0){ // RESUMEN PROGRAMADO ?>
<form action="pagosResProg.php" class="navegacion">
<input id="gobutton2" type="submit" name="solicitudesProgramadas" value="Solicitudes Programadas"></form>
<?php }

if($_SESSION["mttoSolPag"] > 0){ // RESUMEN PROGRAMADO ?>
<form action="pagosResPagados.php" class="navegacion">
<input id="gobutton2" type="submit" name="solicitudesPagadas" value="Solicitudes Pagadas"></form>
<?php }

?>